<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\Creditcard;
use App\Models\User;

class TransactionhookController extends Controller
{
    public function add_transaction(){
        // GET RECURRING DATA
        // \DB::enableQueryLog();
        $recurring_subscriptions = \DB::table('recurring_subscription')
            ->join('subscriptions', 'subscriptions.id', '=', 'recurring_subscription.subscription_id')
            ->select('recurring_subscription.*', 'subscriptions.status', 'subscriptions.user_id','subscriptions.plan_id','subscriptions.plan_amount','subscriptions.plan_period','subscriptions.number_of_users','subscriptions.per_user_amount','subscriptions.customer_id','subscriptions.expiration_date','subscriptions.renewal_id', \DB::raw('subscriptions.created_dt as subscription_dt'))
            ->where('subscriptions.status', 1)
            ->where('subscriptions.user_id', 606)
            ->where(function($query) {
                $query->whereNull('subscriptions.expiration_date')
                      ->orWhere('subscriptions.expiration_date', '<', date('Y-m-d'));
            })
            ->get();

        // dd(\DB::getQueryLog());
        // dd($recurring_subscriptions);
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type'=> 'application/json',
            'Authorization'=> 'Basic ' . env('PAYAPI_TOKEN')
        ];

        foreach ($recurring_subscriptions as $recu) {
            $next_recurring_date = date('Y-m-d');
            if($recu->plan_period == "month") {
                if($recu->last_execution_time) {
                    $next_recurring_date = date('Y-m-d', strtotime($recu->last_execution_time." +1 month"));
                } else {
                    $next_recurring_date = date('Y-m-d', strtotime($recu->subscription_dt." +1 month"));
                }
            } else {
                if($recu->last_execution_time) {
                    $next_recurring_date = date('Y-m-d', strtotime($recu->last_execution_time." +1 year"));
                } else {
                    $next_recurring_date = date('Y-m-d', strtotime($recu->subscription_dt." +1 year"));
                }
            }

            // dd($next_recurring_date);
            if ($next_recurring_date == date('Y-m-d')) {
                // get default card
                $card = Creditcard::where(['user_id' => $recu->user_id, 'active' => 1])->first();
                $total_renewal = $recu->plan_amount * $recu->number_of_users;

                $user = User::find($recu->user_id);
                $user_name = explode(' ', trim($user->name));
                $fname = $user_name[0];
                $lname = isset($user_name[1]) ? $user_name[1] : null;

                // get payment history from API
                $hist_url = env('PAYAPI_URL') . "recurring-schedules/".$recu->renewal_id."/transactions";
                $h_reposnse = $client->request('GET', $hist_url, ['headers' => $headers]);
                $h_statusCode = $h_reposnse->getStatusCode();
                $h_content = json_decode($h_reposnse->getBody(), true);

                if ($h_content) {
                    // send email after transaction
                    $plan = ($recu->plan_id == 1) ? 'Employer' : 'Employer plus';
                    $data = array('name' => $fname, 'amount' => $recu->plan_amount, 'period' => $recu->plan_period, 'plan' => $plan, 'paid_amount' => $total_renewal, 'number_of_user' => $recu->number_of_users);
                    \Mail::send(['html'=>'mail.rec_subscription'], $data, function($message) use ($user) {
                         $message->to($user->email, 'Purple Stairs')->subject
                            ('Purple Stairs Auto-renewal');
                         $message->from('info@purplestairs.com','Purple Stairs');
                    });

                    $old_transactions = Transaction::pluck('transaction_id')->where('customer_id', $recu->customer_id)->toArray();
                    // create transaction entry
                    foreach ($h_content as $key => $hist) {
                        if(!in_array($hist['id'], $old_transactions)) {
                            $transaction = array(
                                'user_id' => $recu->user_id,
                                'subscription_id' => $recu->subscription_id,
                                'per_user_amount' => $recu->per_user_amount,
                                'card_id' => $card->id,
                                'card_number' => substr($card->card_number, -4),
                                'coupon_code' => null,
                                'discount' => null,
                                'tax' => 0,
                                'subtotal' => $total_renewal,
                                'total' => $total_renewal,
                                'transaction_id' => $hist['id'],
                                'customer_id' => $recu->customer_id,
                                'created_dt' => date('Y-m-d h:i:s'),
                                'status' => $hist['status_details']['status'],
                            );
                            Transaction::create($transaction);
                        }
                    }

                    // update last execution date
                    \DB::table('recurring_subscription')
                      ->where('id', $recu->id)
                      ->update(['last_execution_time' => date('Y-m-d H:i:s')]);
                }
            }
        }


        echo "success...";
    }

    public function update_transaction_after_tenmin()
    {
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type'=> 'application/json',
            'Authorization'=> 'Basic ' . env('PAYAPI_TOKEN')
        ];
        // get all transaction from API 
        // task - 86a20t4vm
        // $transactions = Transaction::where('transaction_id', 0)->get();
        $transactions = Transaction::where(function ($query) {
                            $query->where('transaction_id', 0)->whereNull('rec_frequency');
                        })->orwhere(function ($query) {
                            $query->where('transaction_id', 0)->whereNotNull('rec_frequency')->where('next_run_date', date('Y-m-d'));
                        })->get();

        foreach ($transactions as $key => $tr) {
            // task - 86a20t4vm
            $frequency = $tr['rec_frequency'];
            $next_run_date = $tr['next_run_date'];
            if ($tr['rec_frequency'] == null || $tr['rec_frequency'] == '') {
                $trns_url = env('PAYAPI_URL') . "recurring-schedules/".$tr['recurring_id'];
                $trns_reposnse = $client->request('GET', $trns_url, ['headers' => $headers]);
                $trns_statusCode = $trns_reposnse->getStatusCode();
                $trns_content = json_decode($trns_reposnse->getBody(), true);
                $frequency = $trns_content['frequency'];
                if ($trns_content) {
                    $tr->rec_frequency = $frequency;
                    $tr->next_run_date = $trns_content['next_run_date'];
                    $tr->save();
                }
            }

            // get payment history from API
            if ($frequency == 'daily' || $next_run_date==date('Y-m-d')) {
                $hist_url = env('PAYAPI_URL') . "recurring-schedules/".$tr['recurring_id']."/transactions";
                $h_reposnse = $client->request('GET', $hist_url, ['headers' => $headers]);
                $h_statusCode = $h_reposnse->getStatusCode();
                $h_content = json_decode($h_reposnse->getBody(), true);
                if (count($h_content) == 1) {
                    $tmp_transaction = Transaction::where('customer_id', $h_content[0]['customer']['customer_id'])->where('recurring_id', $tr['recurring_id'])->where('transaction_id', 0)->first();
                    $tmp_transaction->transaction_id = $h_content[0]['id'];
                    $tmp_transaction->status = $h_content[0]['status_details']['status'];
                    $tmp_transaction->save();
                }
            }
        }
        echo "Success .....";
    }

    public function cancel_yearly_subscription()
    {
        $users = User::select('users.*', \DB::raw('(select last_execution_time from recurring_subscription where subscription_id = subscriptions.id) as next_date'),\DB::raw('(subscriptions.created_dt) as subscription_dt'))
        ->join('subscriptions', 'subscriptions.user_id', '=', 'users.id')
        ->where('users.user_type', 'employer')
        ->where('subscriptions.plan_period', 'year')
        ->where('subscriptions.status', 1)
        ->get();

        foreach ($users as $key => $user) {
            $next_date = $user->next_date;
            if ($next_date == '') {
                $next_date = date('Y-m-d', strtotime($user->subscription_dt." +1 year"));
            }

            $now = date('Y-m-d');
            $days_before_10 = date('Y-m-d', strtotime($next_date." -10 day"));

            if ($now == $days_before_10) {
                $data = array('end_date' => date('m-d-Y', strtotime($days_before_10)));
                \Mail::send(['html'=>'mail.cancel_yearly_subscription'], $data, function($message) use ($user) { 
                     $message->to($user->email, 'Purple Stairs')->subject
                        ('Purple Stairs Yearly Subscription');
                     $message->from('info@purplestairs.com','Purple Stairs');
                });
            }
        }

        echo "Completed...";
    }

    public function test_cron()
    {
        $data = array('name' => date('m-d-Y h:i A'));
        \Mail::send(['html'=>'mail.mail'], $data, function($message) {
             $message->to('eptdeveloper@gmail.com', 'Purple Stairs')->subject
                ('Purple Stairs Cron');
             $message->from('info@purplestairs.com','Purple Stairs');
        });
    }
}
