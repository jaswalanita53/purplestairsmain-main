<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Invited_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Search;
use App\Models\Salary;
use App\Models\Compensation;
use App\Models\Schedule;
use App\Models\Interest;
use App\Models\Industry;
use App\Models\Skill;
use App\Models\WorkEnvironment;
use App\Models\Language;
use App\Models\Creditcard; //86a2vc3ej

use Session;
use Mail;
use Illuminate\Support\Carbon;
use App\Http\Controllers\IntercomController;

class EmployersController extends Controller
{

    public function index()
    {
        //  86a2u6hhu
        $totalActive = User::where('status', 1)
        ->whereNull('deleted_at')
        ->where('user_type', 'employer')
        ->where('reference', 0)
        ->whereDoesntHave('delete_status')
        ->count();

        $totalPending = User::where('status', 0)->whereNull('deleted_at')->Where('user_type', 'employer')->where('reference', 0)->get()->count();
        $allEmps = User::where('status', 1)->whereNull('deleted_at')->Where('user_type', 'employer')->where('reference', 0)->with('subscriptions')->whereDoesntHave('delete_status')->get();
        $nexChargeIds=[];
        $deletedIds=[];
        foreach($allEmps as $emps){
                if(!empty($emps->subscriptions[0]['next_run_date'])){
                $now = Carbon::now();
                $dateToCheck =Carbon::parse($emps->subscriptions[0]['next_run_date']);
                $thirtyDaysFromNow = $now->copy()->addDays(30);
                if ($dateToCheck->between($now, $thirtyDaysFromNow)) {
                    $nexChargeIds[] = $emps->id;
                }
            }
            if($emps->delete_status){
                $deletedIds[]=$emps->id;
               }
        }

        $totalNextCharge=count($nexChargeIds);

        return view('backend.users.list', [
            'totalActive' => $totalActive,
            'totalPending' => $totalPending,
            'totalNextCharge' => $totalNextCharge,
        ]);
    }

    public function data(Request $request)
    {
        $allEmps = User::where('status', 1)->whereNull('deleted_at')->Where('user_type', 'employer')->where('reference', 0)->with('subscriptions')->with('delete_status')->get();

        $nexChargeIds=[];
        $deletedIds=[];
        foreach($allEmps as $emps){
            if(!empty($emps->subscriptions[0]['next_run_date'])){
                    $now = Carbon::now();
                    $dateToCheck =Carbon::parse($emps->subscriptions[0]['next_run_date']);
                    $thirtyDaysFromNow = $now->copy()->addDays(30);
                    if ($dateToCheck->between($now, $thirtyDaysFromNow)) {
                     $nexChargeIds[] = $emps->id;
                    }
           }
           if($emps->delete_status){
            $deletedIds[]=$emps->id;
           }
        }
        $input = $request->all();
        $search         = $input['search'];
        $order_columns  = $input['order_columns'];
        $columns        = $input['cols'];
        $order          = $input['order'];
        $limit          = $input['length'];
        $offset         = $input['start'];

        $employers = User::all();
        \DB::enableQueryLog();
        $_employers_ = User::select('users.*', \DB::raw('(select last_matches_on from employer_tracking where employer_id=users.id) as last_matches_on'), \DB::raw('(select last_unmask_req from employer_tracking where employer_id=users.id) as last_unmask_req'), \DB::raw('(select company_name from companies where user_id=users.id) as company_name'), \DB::raw('(select count(id) from subscriptions where user_id=users.id) as subcribe_status'));
        $_employers_->whereNull('deleted_at');
        $_employers_->where('user_type', 'employer');
        $_employers_->where('reference', 0);
        if ($request->has('Type') && $request->Type == 'Pending') {
            $_employers_=  $_employers_->where('status', 0);
        }
        if ($request->has('Type') && $request->Type == 'Active') {
            $_employers_=  $_employers_->where('status', 1)
            ->whereNotIn('id',$deletedIds);
        }
        if ($request->has('Type') && $request->Type == 'Charge_In_30_Days') {
            $_employers_=  $_employers_->whereIn('id', $nexChargeIds)
            ->whereNotIn('id',$deletedIds);

        }
       /// $_employers_->whereRaw('(select count(id) from subscriptions where user_id=users.id) > 0');
        $extra_where = [];
        if(!empty($search['value'])) {
          $search_query = "(";
          foreach ($columns as $k => $field) {
            if($k > 0) $search_query .= " OR ";
            $search_query .= $field." LIKE '%".$search['value']."%'";
          }
          $search_query .= ")";
          // $extra_where[] = $search_query;
          $_employers_->whereRaw($search_query);
        }

        $_order = [];
        if(!empty($order)) {
          foreach ($order as $f => $odr) {
            // $_order[$order_columns[$odr['column']]] = $odr['dir'];
            $_employers_->orderBy($order_columns[$odr['column']], $odr['dir']);
          }
        }
        $_employers_->offset($offset)->limit($limit);
        $final_data = $_employers_->get();
        // print_r(\DB::getQueryLog());
        //->whereRaw('(select count(id) from subscriptions where user_id=users.id) > 0')

        $totalData = User::where('user_type', 'employer')->where('reference', 0)->whereNull('deleted_at')->get()->count();

        $response = [];
        foreach ($final_data as $key => $user) {
            $row = array();

            $row['id'] = $user->id;
            $row['company'] = $user->company_name;
            $row['name'] = $user->name;
            $row['email'] = $user->email;
            $row['date'] = date('m-d-Y h:i A', strtotime($user->created_at));

            // task - 8678fd0em
            $now = time();
            $date1 = strtotime($user->last_matches_on);
            $datediff1 = $now - $date1;

            $date2 = strtotime($user->last_unmask_req);
            $datediff2 = $now - $date2;

            $row['last_matches_on'] = ($user->last_matches_on) ? date('m-d-Y h:i A', strtotime($user->last_matches_on)) : 'N/A';
            $row['match_days'] = round($datediff1 / (60 * 60 * 24));
            $row['last_unmask_req'] = ($user->last_unmask_req) ? date('m-d-Y h:i A', strtotime($user->last_unmask_req)) : 'N/A';
            $row['request_days'] = round($datediff2 / (60 * 60 * 24));
            $row['subcribe_status'] = $user->subcribe_status;
            $row['next_charge_amount'] = $user->subscriptions[0]['next_charge']??'';
            // task - 8678fd0em end

            $row['status'] = $user->status;

            $response[] = $row;
        }

        $json_data = array(
            "draw"            => intval($input['draw']),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalData),
            "data"            => $response
        );
        echo json_encode($json_data);
    }

    public function active($id)
    {
        date_default_timezone_set('UTC');
        $user = User::find($id);
        $old_status = $user->status;
        if ($user) {
            if ($old_status == 2) {
                // activate subscription again
                $subscription = \DB::table('subscriptions')->where('user_id', $id)->orderBy('id', 'desc')->first();
                $customer_id    = $subscription->customer_id;
                $number_of_user = $subscription->number_of_users ? $subscription->number_of_users : 1;
                $auto_renew     = $subscription->auto_renew;
                $renewal_id     = $subscription->renewal_id;
                $plan           = $subscription->plan_id;
                $plan_amount    = (floatval($subscription->plan_amount));
                $plan_period    = $subscription->plan_period;
                if ($plan_period == 'year') {
                    $plan_period = 'annually';
                };
                if ($plan_period == 'month') {
                    $plan_period = 'monthly';
                }
                $client = new \GuzzleHttp\Client();
                $headers = [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
                ];

                $card = \DB::table('user_cc_data')->where(['user_id' => $id, 'active' => 1])->first();
                if ($card == null) {
                    $tmp_card = \DB::table('user_cc_data')->where(['user_id' => $id])->first();
                    if ($tmp_card) {
                        $card = $tmp_card;
                    } else {
                        session()->flash('error', 'This user doesn\'t have active card !!');
                        return redirect()->route('admin.employers');
                    }
                }

                //echo date('Y-m-d H:i:s'); exit();
                // create recurring charge for customer
                $recurring_url = env('PAYAPI_URL') . 'customers/' . $customer_id . '/recurring-schedules';

                $total_renewal = ($plan_amount * $number_of_user);
                $recurring_data = '{
                            "title": "Subscription change for : ' . $customer_id . '",
                            "frequency": "' . $plan_period . '",
                            "amount": ' . $total_renewal . ',
                            "next_run_date": "' . date('Y-m-d', time() + 86400) . '",
                            "num_left": 0,
                            "payment_method_id": ' . $card->payment_method_id . ',
                            "active": true,
                            "receipt_email": "' . $user->email . '",
                            "use_this_source_key": false
                        }';

                $rec_reposnse = $client->request('POST', $recurring_url, ['body' => $recurring_data, 'headers' => $headers]);
                $rec_statusCode = $rec_reposnse->getStatusCode();
                $rec_content = json_decode($rec_reposnse->getBody(), true);
                $recurring_id = isset($rec_content['id']) ? $rec_content['id'] : 0;

                $transaction_id = 0;
                $_content['status'] = null;
                if ($recurring_id) {
                    // get payment history from API
                    if ($recurring_id) {
                        $hist_url = env('PAYAPI_URL') . "recurring-schedules/" . $recurring_id . "/transactions";
                        $h_reposnse = $client->request('GET', $hist_url, ['headers' => $headers]);
                        $h_statusCode = $h_reposnse->getStatusCode();
                        $h_content = json_decode($h_reposnse->getBody(), true);

                        $transactions = \DB::table('transactions')->where('customer_id', $customer_id)->get()->toArray();
                        if ($h_content) {
                            foreach ($h_content as $key => $tr) {
                                if (!in_array($tr['id'], $transactions)) {
                                    $transaction_id = $tr['id'];
                                    $_content['status'] = $tr['status_details']['status'];
                                }
                            }
                        }
                    }
                }

                $next_rec_id = 0;
                $frequency = "monthly";
                $time = strtotime(date('Y-m-d'));
                $next_run_date = date('Y-m-d', strtotime("+1 month", $time));

                if ($plan_period == "month") {
                    $frequency = "monthly";
                    $next_run_date = date('Y-m-d', strtotime("+1 month", $time));
                    $expiry_date = $next_run_date;
                } elseif ($plan_period == "year") {
                    $frequency = "annually";
                    $next_run_date = date('Y-m-d', strtotime("+1 year", $time));
                    $expiry_date = $next_run_date;
                }
                if ($auto_renew && $total_renewal > 0) {
                    // create next recurring schedule for annully/monthly
                    $recurring_url = env('PAYAPI_URL') . 'customers/' . $customer_id . '/recurring-schedules';

                    $recurring_data = '{
                        "title": "Subscription change for : ' . $customer_id . '",
                        "frequency": "' . $frequency . '",
                        "amount": ' . ($total_renewal) . ',
                        "next_run_date": "' . $next_run_date . '",
                        "num_left": 0,
                        "payment_method_id": ' . $card->payment_method_id . ',
                        "active": true,
                        "receipt_email": "' . $user->email . '",
                        "use_this_source_key": false
                    }';

                    $nrec_reposnse = $client->request('POST', $recurring_url, ['body' => $recurring_data, 'headers' => $headers]);
                    $nrec_statusCode = $nrec_reposnse->getStatusCode();
                    $nrec_content = json_decode($nrec_reposnse->getBody(), true);

                    $next_rec_id = isset($nrec_content['id']) ? $nrec_content['id'] : 0;
                }

                $new_subscription = array(
                    'user_id'       => $id,
                    'plan_id'       => $plan,
                    'plan_amount'   => $plan_amount,
                    'plan_period'   => $plan_period,
                    'auto_renew'    => 1,
                    'number_of_users' => $number_of_user,
                    'per_user_amount' => $plan_amount,
                    'coupon_code'   => null,
                    'discount'      => null,
                    'customer_id'   => $customer_id,
                    'created_dt'    => date('Y-m-d H:i:s'),
                    'status'        => 1,
                    'renewal_id'    => $next_rec_id,
                    'expiration_date' => ($next_rec_id) ? null : $expiry_date,
                );

                $new_subscription_id = \DB::table('subscriptions')->insertGetId($new_subscription);

                // if auto renewal then create recurring table entry
                if ($auto_renew) {
                    \DB::table('recurring_subscription')->insert([
                        [
                            'user_id' => $id,
                            'subscription_id' => $new_subscription_id,
                            'created_dt' => date('Y-m-d H:i:s')
                        ],
                    ]);
                }

                if ($total_renewal > 0) {
                    $transaction = array(
                        'user_id' => $id,
                        'subscription_id' => $new_subscription_id,
                        'per_user_amount' => $plan_amount,
                        'card_id' => $card->id,
                        'card_number' => substr($card->card_number, -4),
                        'coupon_code' => null,
                        'discount' => null,
                        'tax' => 0,
                        'subtotal' => $total_renewal,
                        'total' => $total_renewal,
                        // 'transaction_id' => $_content['reference_number'],
                        'transaction_id' => $transaction_id,
                        'recurring_id' => $recurring_id,
                        'customer_id' => $customer_id,
                        'created_dt' => date('Y-m-d h:i:s'),
                        'status' => $_content['status'],
                    );
                    \DB::table('transactions')->insert($transaction);
                }

                // dd($new_subscription, \DB::getQueryLog());
                if (isset($rec_content['error_message'])) {
                    $messages = array_values($rec_content['error_details']);
                    $error_messages = implode("<br>", array_map(function ($a) {
                        return implode("~", $a);
                    }, $messages));
                    // return redirect('company/manage-subsciption')->with('error', $error_messages);
                } else {
                    session()->flash('success', 'Your subscription changed successfully !!');
                }
            } else {
                $client = new \GuzzleHttp\Client();
                $api_url = env('PAYAPI_URL') . "transactions/charge";
                $headers = [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
                ];
                $subscription = Subscription::where('user_id', $id)->where('status', 1)->first();
                if (!empty($subscription)) {
                    $customer_id    = $subscription->customer_id;
                    $number_of_user = $subscription->number_of_users ? $subscription->number_of_users : 1;
                    $auto_renew     = $subscription->auto_renew;
                    $renewal_id     = $subscription->renewal_id;
                    $plan           = $subscription->plan_id;
                    $plan_amount    = (floatval($subscription->plan_amount));
                    $plan_period    = $subscription->plan_period;
                    // 86a2kvagf
                    $period = $plan_period;
                    $additional_charge = $plan_amount;
                    if ($plan == 1) {
                        if ($period == 'month') {
                            $additional_charge = 50;
                        } else {
                            $additional_charge = 479;
                        }
                    } else {
                        if ($period == 'month') {
                            $additional_charge = 100;
                        } else {
                            $additional_charge = 949;
                        }
                    }
                    // end 86a2kvagf
                    // if($plan_period=='year'){
                    //     $plan_period='annually';
                    // };
                    // if($plan_period=='month'){
                    //     $plan_period='monthly';
                    // }
                    // dd($plan_period);
                    $body = $subscription->body;
                    $_content = [];
                    if (!empty(json_decode($body, true)['amount'])) {

                        $do_proccess = 0;

                        $_response = $client->request('POST', $api_url, ['body' => $body, 'headers' => $headers]);
                        $_statusCode = $_response->getStatusCode();
                        $_content = json_decode($_response->getBody(), true);

                        if (!empty($_content['status'])) {
                            // if ($_content['status'] == "Approved") {

                            $do_proccess = 1;
                            $recurring_url = env('PAYAPI_URL') . 'customers/' . $customer_id . '/recurring-schedules';
                            $card = \DB::table('user_cc_data')->where(['user_id' => $id, 'active' => 1])->first();
                            if ($card == null) {
                                $tmp_card = \DB::table('user_cc_data')->where(['user_id' => $id])->first();
                                if ($tmp_card) {
                                    $card = $tmp_card;
                                } else {
                                    session()->flash('error', 'This user doesn\'t have active card !!');
                                    return redirect()->route('admin.employers');
                                }
                            }

                            // 86a2kvagf
                            $total_renewal = ($plan_amount + ($additional_charge * ($number_of_user - 1)));
                            // end 86a2kvagf
                            $next_rec_id = 0;
                            $frequency = "monthly";
                            $time = strtotime(date('Y-m-d'));
                            $next_run_date = date('Y-m-d', strtotime("+1 month", $time));

                            if ($plan_period == "month") {
                                if($subscription->discount_duration>1){
                                $total_renewal = json_decode($body, true)['amount'];
                            }
                                $frequency = "monthly";
                                $next_run_date = date('Y-m-d', strtotime("+1 month", $time));
                                $expiry_date = $next_run_date;
                            } elseif ($plan_period == "year") {
                                $frequency = "annually";
                                $next_run_date = date('Y-m-d', strtotime("+1 year", $time));
                                $expiry_date = $next_run_date;
                            }
                            $recurring_data = '{
                            "title": "Subscription change for : ' . $customer_id . '",
                            "frequency": "' . $frequency . '",
                            "amount": ' . ($total_renewal) . ',
                            "next_run_date": "' . $next_run_date . '",
                            "num_left": 0,
                            "payment_method_id": ' . $card->payment_method_id . ',
                            "active": true,
                            "receipt_email": "' . $user->email . '",
                            "use_this_source_key": false
                        }';
                            if ($auto_renew && $total_renewal > 0) {
                                $rec_reposnse = $client->request('POST', $recurring_url, ['body' => $recurring_data, 'headers' => $headers]);
                                $rec_statusCode = $rec_reposnse->getStatusCode();
                                $rec_content = json_decode($rec_reposnse->getBody(), true);
                                $recurring_id = isset($rec_content['id']) ? $rec_content['id'] : 0;
                                $subscription->renewal_id = $recurring_id;
                                $subscription->save();
                                $transaction_id = 0;
                                $_content['status'] = null;
                            }
                        }
                    }
                    if (isset($_content['error_message'])) {
                        if (isset($_content['error_details'])) {
                            $messages = array_values($_content['error_details']);
                            $error_messages = implode("<br>", array_map(function ($a) {
                                return implode("~", $a);
                            }, $messages));
                        } else {
                            $error_messages = $_content['error_message'];
                        }
                        $subscription = Subscription::where('user_id', $id)->where('status', 1)->first();
                        if (!empty($subscription)) {
                            $subscription->delete();
                        }
                        $tasnsction = Transaction::where('user_id', $id)->first();
                        if (!empty($tasnsction)) {
                            $tasnsction->delete();
                        }
                        \DB::table('user_cc_data')->where(['user_id' => $id, 'active' => 1])->delete();

                        $userEmp = User::find($id);
                        $userEmp->card_decline_status = 1;
                        if ($userEmp->save()) {
                            // dd($userEmp);
                            // email functionality to notify employer on card decline
                            $data = array('name' => $userEmp->name);
                            $abc=\Mail::send(['html' => 'mail.payment_decline'], $data, function ($message) use ($userEmp) {
                                $message->to($userEmp->email, 'Purple Stairs')->subject(' Issue Processing Payment on Purple Stairs');
                                $message->from('info@purplestairs.com', 'Purple Stairs');
                            });
                            return redirect('admin/employers')->with('error', $error_messages);
                        }
                        return redirect('admin/employers');

                    } else {
                        if (isset($_content['reference_number'])) {
                            $ref_num = $_content['reference_number'];
                            $card = json_decode($body, true);

                            if (!empty($_content['transaction']['status_details']['status'])) {
                                $status = $_content['transaction']['status_details']['status'];
                            } else {
                                $status = null;
                            }
                            $ref_num = $_content['reference_number'];
                            $tasnsction = Transaction::where('user_id', $id)->first();
                            $tasnsction->transaction_id = $ref_num;
                            $tasnsction->status = $status;
                            $tasnsction->save();
                        }

                        // create recurring charge for customer

                        // task - 86a1ggaay
                        // send email to employer after approved by admin
                        $name = explode(' ', trim($user->name));
                        // 86a2u68b3
                        $number_of_user_mail = 0;
                        if (!empty($number_of_user)) {
                            $number_of_user_mail = $number_of_user;
                        }

                        $data = array('name' => $name[0], 'number_of_user' => $number_of_user_mail);
                        // end 86a2u68b3
                        \Mail::send(['html' => 'mail.employer_approved'], $data, function ($message) use ($user) {
                            $message->to($user->email, 'Purple Stairs')->subject('Purple Stairs Account Approval');
                            $message->from('info@purplestairs.com', 'Purple Stairs');
                        });

                        // task - 86a308a4y
                        // send email to admin after approve
                        $name = $user->name; // task - 86a15vje7
                        $data = array('employer' => $name);
                        \Mail::send(['html' => 'mail.admin_emp_approved'], $data, function ($message) use ($name) {
                            $message->to(['info@purplestairs.com', 'chaya@brand-right.com', 'eptdeveloper@gmail.com'], 'Purple Stairs')->subject('Approval of ' . $name . ' on Purple Stairs');
                            $message->cc(['sabrina@thepenguin.group']); // task - 86a308a4y
                            $message->from('info@purplestairs.com', 'Purple Stairs');
                        });
                        // task - 86a308a4y end

                        $user->status = 1;
                        $user->approved_date = date('Y-m-d H:i:s'); // task - 86a2kkdyc
                        $user->save();
                        return redirect('admin/employers')->with('success', 'User Activated!');
                    }
                }
            }
            // 86a2uj4hw
            $subscription = Subscription::where('user_id', $id)->where('status', 1)->first();
            $card = \DB::table('user_cc_data')->where(['user_id' => $id, 'active' => 1])->first();
            if (empty($subscription) || empty($card)) {
                return redirect('admin/employers')->with('errors', 'User has not added a payment method yet. Please wait for the profile to be completed.');
            }else {
                return redirect('admin/employers')->with('errors', 'Something went wrong!');
            }
        } else {
            return redirect('admin/employers')->with('errors', 'User Not Found!');
        }
    }

    public function deactive($id)
    {
        $user = User::find($id);
        if ($user) {
            // cancel subscription
            $subscription = \DB::table('subscriptions')->where('user_id', $id)->where('status', 1)->orderBy('id', 'desc')->first();

            $client = new \GuzzleHttp\Client();
            $headers = [
                'Content-Type'=> 'application/json',
                'Authorization'=> 'Basic ' . env('PAYAPI_TOKEN')
            ];

            if($subscription) {
                // delete recurring schedule from API
                if ($subscription->renewal_id) {
                    $rec_url = env('PAYAPI_URL') . 'recurring-schedules/'.$subscription->renewal_id;

                    try {
                        $rsch_reposnse = $client->request('DELETE', $rec_url, ['headers' => $headers]);
                        $rsch_statusCode = $rsch_reposnse->getStatusCode();
                        $rsch_content = json_decode($rsch_reposnse->getBody(), true);

                        if ($rsch_statusCode == 204) {
                            $message = "The recurring schedule was deleted successfully.";
                        }
                    } catch(\GuzzleHttp\Exception\ClientException $e) {
                        // dd($e->getMessage());
                        session()->flash('message', $e->getMessage());
                        // return response()->json();
                    }
                }

                $active_date = strtotime($subscription->created_dt);
                // $expiry_date = date('Y-m-d', strtotime("+1 month", $active_date));
                $expiry_date = date('Y-m-d');
                if($subscription->plan_period == "month") {
                    // $expiry_date = date('Y-m-d', strtotime("+1 month", $active_date));
                    $expiry_date = date('Y-m-d');
                }
                elseif ($subscription->plan_period == "year") {
                    $expiry_date = date('Y-m-d', strtotime("+1 year", $active_date));
                }

                // de-active subscription status
                \DB::table('subscriptions')->where('id', $subscription->id)->update(['status' => 0, 'renewal_id' => 0, 'expiration_date' => date('Y-m-d')]);
            }

            $user->status = 2;
            $user->save();
            return redirect('admin/employers')->with('success','User In-Activated!');
        } else {
            return redirect('admin/employers')->with('errors','User Not Found!');
        }
    }

    // task - 86a1hvak1
    public function view($id)
    {
        $recurring="";
        $subscription = Subscription::where('user_id', $id)->where('status', 1)->first();
        $lastSubscription="";
        if(!empty($subscription->renewal_id)){
            $lastSubscription = Subscription::where('user_id', $id)->where('status', 0)->where('renewal_id',$subscription->renewal_id)->orderBy('id','DESC')
            // ->whereHas('transactions')
            ->first();
        }


        if(!empty($subscription->renewal_id)){
            try {
                $client = new \GuzzleHttp\Client();
                $api_url = env('PAYAPI_URL') . "transactions/charge";
                $headers = [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
                ];
                $hist_url = env('PAYAPI_URL') . "recurring-schedules/".$subscription->renewal_id;
                $h_reposnse = $client->request('GET', $hist_url, ['headers' => $headers]);
                $h_statusCode = $h_reposnse->getStatusCode();
                $h_content = json_decode($h_reposnse->getBody(), true);
                $recurring=$h_content;
            } catch(\GuzzleHttp\Exception\ClientException $e) {
                // dd($e->getMessage());
                session()->flash('message', $e->getMessage());
                // return response()->json();
            }
        }

        $user = User::with('subscriptions')->with('transactions')->with('delete_status')->with('company')->withTrashed()->find($id);

        $user_inviteds = Invited_user::withTrashed()->where('sender_userid',$id)->get();
        $subscriptions = Subscription::where('user_id', $id)->get();
        $savedSearches="";
        if(!empty($user['company']['id'])){
           $savedSearches = Search::where('company_id', $user['company']['id'])->get();
        }
        $all_salaries = Salary::where('status', 1)->pluck('id', 'name')->toArray();
        $all_compensations = Compensation::where('status', 1)->pluck('id', 'name')->toArray();
        $all_schedules = Schedule::where('status', 1)->pluck('id', 'name')->toArray();
        $all_interests = Interest::orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $all_industries = Industry::where('status', 1)->orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $all_soft_skills = Skill::where('skill_type', 'soft_skills')->orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $all_hard_skills = Skill::where('skill_type', 'hard_skills')->orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $all_work_environments = WorkEnvironment::where('status', 1)->pluck('id', 'name')->toArray();
        $all_languages = Language::orderByRaw('id=1 DESC,id=4 DESC, `name` ASC')->pluck('id', 'name')->toArray();
        return view('backend.users.view_employer', compact('user','recurring','user_inviteds','subscriptions','lastSubscription','subscription','savedSearches','all_salaries','all_compensations','all_schedules','all_interests','all_industries','all_soft_skills','all_hard_skills','all_work_environments','all_languages'));
    }
    public function recurringOff($id, $subscription_id)
    {

        $client = new \GuzzleHttp\Client();
        $recurring_url = env('PAYAPI_URL') . "recurring-schedules/".$id;
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
        ];
        $recurring_data = '{
            "active": false
        }';
        $rec_response = $client->request('PATCH', $recurring_url, ['body' => $recurring_data, 'headers' => $headers]);

        // task - 86a28fb5z
        $rec_content = json_decode($rec_response->getBody(), true);
        if (isset($pm_content['id'])) {
            $additional_user_recurrings = \DB::table('recurring_subscription')->where(['subscription_id' => $subscription_id, 'is_additional_user' => 1])->get();
            foreach ($additional_user_recurrings as $aur_key => $aur_val) {
                if($aur_val->recurring_id) {
                    $rec_url = env('PAYAPI_URL') . "recurring-schedules/".$aur_val->recurring_id;
                    $rec_data = '{
                        "active": false
                    }';
                    $rec_response = $client->request('PATCH', $rec_url, ['body' => $rec_data, 'headers' => $headers]);
                }
            }
        }
        //  task - 86a28fb5z end
        return redirect()->back();
    }

    // task - 86a2hkjbf
    public function upsert_email(Request $request, $id) {
        $user = User::find($id);
        $email = $request->input('email');

        $user->alt_email = $email;
        echo $user->save();
    }

    // 86a2vc3ej

    public function downgradePlan(Request $request)
    {
        $period = "";
        $amount = 0;
        $userId = $request->user_id;
        $planId = $request->plan_id;
        $planPeriod = $request->plan_period;
        $active_cc_error = null;
        $number_of_user = 1;
        $frequency = "";
        $next_run_date = "";
        $expiry_date = "";
        $time = strtotime(date('Y-m-d'));
        $planAmount = 0;

        $user = User::find($userId);
        $user_name = explode(' ', trim($user->name));
        $fname = $user_name[0];
        $lname = isset($user_name[1]) ? $user_name[1] : null;



        // 86a314zf6
        $intercomTags=[];
        $additional_charge = $amount;
        if ($planId == 1) {
            $intercomTags[]=env('INTERCOM_TAG_REG');
            if ($planPeriod == 'month') {
                $intercomTags[]=env('INTERCOM_TAG_MONTHLY');
                $additional_charge = 50;
                $planAmount = 299;
            } else {
                $intercomTags[]=env('INTERCOM_TAG_ANNUALLY');
                $additional_charge = 479;
                $planAmount = 2999;
            }
        } else {
                $intercomTags[]=env('INTERCOM_TAG_PLUS');
            if ($planPeriod == 'month') {
                $intercomTags[]=env('INTERCOM_TAG_MONTHLY');
                $additional_charge = 100;
                $planAmount = 749;
            } else {
                $intercomTags[]=env('INTERCOM_TAG_ANNUALLY');
                $additional_charge = 949;
                $planAmount = 8500;
            }
        }

        if ($planPeriod == "month") {
            $frequency = "monthly";
            $next_run_date = date('Y-m-d', strtotime("+1 month", $time));
            $expiry_date = $next_run_date;
        } elseif ($planPeriod == "year") {
            $frequency = "annually";
            $next_run_date = date('Y-m-d', strtotime("+1 year", $time));
            $expiry_date = $next_run_date;
        }

        // dd($expiry_date );
        $active_subscription = Subscription::where('user_id', $userId)->where('status', 1)->orderBy('id', 'desc')->first();
        if($active_subscription->number_of_users>1){
            $intercomTags[]=env('INTERCOM_TAG_ASSOCIATED_USERS');
        }

        $addTagsTouser = new IntercomController();
        $addTagsTouser->addTagToContact($intercomTags);
        // 86a314zf6
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
        ];
        if (!empty($active_subscription->renewal_id)) {

            if ($planPeriod == "month") {
                $next_run_date = Carbon::parse($active_subscription->created_dt)->addMonth()->format('Y-m-d');
                if(empty($next_run_date)){
                    $next_run_date = date('Y-m-d', strtotime("+1 month", $time));
                }

                $expiry_date = $next_run_date;
            } elseif ($planPeriod == "year") {
                $next_run_date = Carbon::parse($active_subscription->created_dt)->addYear()->format('Y-m-d');
                if(empty($next_run_date)){
                    $next_run_date = date('Y-m-d', strtotime("+1 year", $time));
                }

                $expiry_date = $next_run_date;
            }

            $number_of_user = $active_subscription->number_of_users;
            $amount = ($planAmount + (($number_of_user - 1) * $additional_charge));
            $card = Creditcard::where(['user_id' => $user->id, 'active' => 1])->first();
            if ($planPeriod == 'year') {
                $api_url = env('PAYAPI_URL') . "transactions/charge";
                $body = '{
                "amount": ' . $amount . ',
                "source":"pm-' . $card->payment_method_id . '"
            }';

                // $rec_reposnse = $client->request('POST', $api_url, ['body' => $body, 'headers' => $headers]);
                // $rec_statusCode = $rec_reposnse->getStatusCode();
                // $rec_content = json_decode($rec_reposnse->getBody(), true);

                $next_rec_id = 0;
                if (!empty($rec_content['reference_number'])) {
                    $transaction = array(
                        'user_id' => $userId,
                        'subscription_id' => $active_subscription->renewal_id,
                        'per_user_amount' => $additional_charge,
                        'card_id' => $card->id,
                        'card_number' => substr($card->card_number, -4),
                        'coupon_code' => null,
                        'discount' => null,
                        'tax' => 0,
                        'subtotal' => $amount,
                        'total' => $amount,
                        'transaction_id' => $rec_content['reference_number'],
                        'customer_id' => $active_subscription->customer_id,
                        'created_dt' => date('Y-m-d h:i:s'),
                        'status' => (!empty($rec_content['transaction']['status_details']['status']) ? $rec_content['transaction']['status_details']['status'] : null),
                    );
                    Transaction::create($transaction);
                }
            }
            $recurring_url = env('PAYAPI_URL') . "recurring-schedules/" . $active_subscription->renewal_id;
            $amount = ($planAmount + (($number_of_user - 1) * $additional_charge));
            if($planPeriod == "month"){
            $recurring_data = '{
                "frequency": "' . $frequency . '",
                "amount": ' . $amount . '
            }';}else{
                // "next_run_date": "' . $next_run_date . '",
                $recurring_data = '{
                    "frequency": "' . $frequency . '",
                    "amount": ' . $amount . '
                }';
            }

            $rec_response = $client->request('PATCH', $recurring_url, ['body' => $recurring_data, 'headers' => $headers]);
            $rec_response = json_decode($rec_response->getBody(), true);

            if (!empty($rec_response['id'])) {
                $expiry_date='';
                $updateSubscription = Subscription::find($active_subscription->id);
                // $updateSubscription->plan_period = $planPeriod;
                // if($planPeriod == "year"){
                // $updateSubscription->expiration_date = $expiry_date;
                // }
                // $updateSubscription->plan_id = $planId;
                // $updateSubscription->plan_amount = $planAmount;
                // $updateSubscription->per_user_amount = $planAmount;
                // $updateSubscription->save();

                $new_subscription = array(
                    'user_id' => $updateSubscription->user_id,
                    'plan_id' => $planId,
                    'plan_amount' =>$planAmount,
                    'plan_period' => $planPeriod,
                    'auto_renew' => $updateSubscription->auto_renew,
                    'number_of_users' => $updateSubscription->number_of_users,
                    'per_user_amount' => $planAmount,
                    'coupon_code' => null,
                    'discount' => null,
                    'customer_id' => $updateSubscription->customer_id,
                    'created_dt' => date('Y-m-d H:i:s'),
                    'status' => 1,
                    'expiration_date' => $expiry_date,
                    'renewal_id' => $updateSubscription->renewal_id,
                    'expiration_date' => null,
                );
                 if(Subscription::create($new_subscription)){
                    $updateSubscription->status=0;
                    $updateSubscription->save();
                 };



                $plan_nm = ($planId == 1) ? 'Employer' : 'Employer plus';
                $data = array('name' => $fname, 'amount' => $amount + (($number_of_user - 1) * $additional_charge), 'period' => $period, 'plan' => $plan_nm, 'paid_amount' => $amount, 'number_of_user' => $number_of_user);

                \Mail::send(['html' => 'mail.switch_subscription'], $data, function ($message) use ($user) {
                    $message->to($user->email, 'Purple Stairs')->subject('Purple Stairs Change Subscription');
                    $message->from('info@purplestairs.com', 'Purple Stairs');
                });
            }
            // Flash success message
            if (isset($rec_content['error_message'])) {
                $messages = array_values($rec_content['error_details']);
                $error_messages = implode("<br>",array_map(function($a) {return implode("~",$a);},$messages));
            } else {
                session()->flash('success', 'Your subscription plan has been changed successfully!');
            }
        }
               // Redirect to manage subscription page
                return redirect('admin/employers/view/' . $userId)->with('successPlanChange', 'Subscription plan has been changed successfully!');
    }
    // 86a2vc3ej
    protected function get_customer_id($userId, $plan, $period, $amount)
    {
        $customer_id = null;
        $user = User::find($userId);
        $user_name = explode(' ', trim($user->name));
        $fname = $user_name[0];
        $lname = isset($user_name[1]) ? $user_name[1] : null;

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type'=> 'application/json',
            'Authorization'=> 'Basic ' . env('PAYAPI_TOKEN')
        ];

        // get active subscription
        $active_subscription = Subscription::where('user_id',$userId)->where('status', 1)->orderBy('id', 'desc')->first();
        if($active_subscription) {
            $customer_id    = $active_subscription['customer_id'];
        } else {
            $subscription = Subscription::where('user_id',$userId)->orderBy('id', 'desc')->first();
            if ($subscription) {
                $customer_id    = $subscription['customer_id'];
            }
        }

        if($customer_id == '') {
            // create customer
            $cust_api = env('PAYAPI_URL') . "customers";
            $FourDigitRandomNumber = rand(0,9999);

            $customer_data = '{
                "identifier": "'.trim($user->name).'",
                "customer_number": "'.$FourDigitRandomNumber.'",
                "first_name": "'.$fname.'",
                "last_name": "'.$lname.'",
                "email": "'.$user->email.'",
                "billing_info": {
                    "first_name": "'.$fname.'",
                    "last_name": "'.$lname.'"
                }
            }';

            // Api_helper::api_call($cust_api, $customer_data, 'POST');
            $c_reposnse = $client->request('POST', $cust_api, ['body' => $customer_data, 'headers' => $headers]);
            $c_statusCode = $c_reposnse->getStatusCode();
            $c_content = json_decode($c_reposnse->getBody(), true);

            if (isset($c_content['id'])) {
                $customer_id = $c_content['id'];
            }
        }

        return $customer_id;
    }

    // task - 86a3d37f9
    public function migrate_to_intercom()
    {
        $employers = User::select('users.*', \DB::raw('(select group_concat(coupon_code) from subscriptions where user_id = users.id) as coupon_codes'))->whereNull('deleted_at')->where('user_type', 'employer')->where('reference', 0)->get();

        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . env('INTERCOM_TOKEN'),
            'Intercom-Version' => '2.11'
        ];

        $contact_message = "";
        $employers_tag = \DB::table('roles')->where('role', 'employer')->first();
        
        $tag_url = env('INTERCOM_URL') . "tags";
        if ($employers_tag->intercom_tagid == null || $employers_tag->intercom_tagid == '') {
            $tag_data = json_encode(["name" => 'Employer']);
            $parameters = ['body' => $tag_data,'headers' => $headers];
            $tagcontent = intercom_api($tag_url, 'POST', $parameters);

            if ($tagcontent['id']) {
                \DB::table('roles')->where('role', 'employer')->update(['intercom_tagid' => $tagcontent['id']]);
            }
        }
        
        $emp_err_cnt = 0;
        set_time_limit(0);
        foreach ($employers as $key => $emp) {
            // if employer subscribed with any coupon codes
            $coupons = isset($emp->coupon_codes) ? $emp->coupon_codes : '';
            $tags = [];
            if ($coupons) {
                $tags = explode(',', $coupons);
                $tags = array_filter($tags);

                $method = "POST";

                foreach ($tags as $tk => $tag) {
                    $discount = Discount::where('coupon_code', 'like', '%' . $tag . '%')->first();
                    if ($discount->intercom_tagid == null || $discount->intercom_tagid == '') {
                        $tag_data = json_encode(["name" => $tag]);
                        $parameters = ['body' => $tag_data,'headers' => $headers];
                        $tagcontent = intercom_api($tag_url, 'POST', $parameters);

                        if ($tagcontent['id']) {
                            $discount->intercom_tagid = $tagcontent['id'];
                            $discount->save();
                        }
                    }
                }
            }

            $request_url = env('INTERCOM_URL') . "contacts";
            $method = "POST";
            if ($emp->intercom_id) {
                $method = "PUT";
                $request_url = env('INTERCOM_URL') . "contacts/" . $emp->intercom_id;
            }

            $phone = null;
            if (isset($emp->company)) {
                if($emp->company->company_phone) {
                    $phone = str_replace([' ','(',')','-'], "", $emp->company->company_phone);
                    $phone = '+1'.$phone;
                }
            }

            $payload = array(
                "role" => $emp->user_type,
                "email" => $emp->email,
                "phone" => $phone,
                "name" => $emp->name,
                "avatar" => $emp->profile_photo_path,
                "signed_up_at" => $emp->created_at,
                "last_seen_at" => $emp->last_login,
                "unsubscribed_from_emails" => true
            );
                
            try {
                $parameters = ['body' => json_encode($payload),'headers' => $headers];
                $content = intercom_api($request_url, $method, $parameters);

                if ($content['id']) {
                    $emp->intercom_id = $content['id'];
                    $emp->save();

                    // ADD ROLE TAG TO USER-INTERCOM
                    $ctag_data = ["id" => $employers_tag->intercom_tagid];

                    $tagc_url = env('INTERCOM_URL') . "contacts/" . $emp->intercom_id . "/tags";
                    $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
                    $content = intercom_api($tagc_url, 'POST', $parameters);
                    // ADD ROLE TAG TO USER-INTERCOM END

                    // ADD DISCOUNT TAG TO USER-INTERCOM
                    foreach ($tags as $tk => $tag) {
                        $discount = Discount::where('coupon_code', 'like', '%' . $tag . '%')->first();
                        if ($discount->intercom_tagid == null || $discount->intercom_tagid == '') {
                            $ctag_data = ["id" => $discount->intercom_tagid];
                            $tagc_url = env('INTERCOM_URL') . "contacts/" . $emp->intercom_id . "/tags";
                            $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
                            $content = intercom_api($tagc_url, 'POST', $parameters);
                        }
                    }
                    // ADD DISCOUNT TAG TO USER-INTERCOM END
                }
            } catch(\GuzzleHttp\Exception\ClientException $e) {
                $message_string = json_decode($e->getResponse()->getBody(), true);
                $errors = $message_string['errors'];
                $err_arr = array_column($errors, "message");
                $contact_message .= "<b>".$emp->name ."</b> : ". implode(' | ', $err_arr);
                $emp_err_cnt++;
                // if($emp->id != '57') { dd($message_string, $emp->id, $payload); }

                if (in_array('phone is invalid', $err_arr)) {
                    $payload['phone'] = null;

                    $parameters = ['body' => json_encode($payload),'headers' => $headers];
                    $content = intercom_api($request_url, $method, $parameters);

                    if ($content['id']) {
                        $emp_err_cnt--;

                        $emp->intercom_id = $content['id'];
                        $emp->save();

                        // ADD ROLE TAG TO USER-INTERCOM
                        $ctag_data = ["id" => $employers_tag->intercom_tagid];

                        $tagc_url = env('INTERCOM_URL') . "contacts/" . $emp->intercom_id . "/tags";
                        $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
                        $content = intercom_api($tagc_url, 'POST', $parameters);
                        // ADD ROLE TAG TO USER-INTERCOM END

                        // ADD DISCOUNT TAG TO USER-INTERCOM
                        foreach ($tags as $tk => $tag) {
                            $discount = Discount::where('coupon_code', 'like', '%' . $tag . '%')->first();
                            if ($discount->intercom_tagid == null || $discount->intercom_tagid == '') {
                                $ctag_data = ["id" => $discount->intercom_tagid];
                                $tagc_url = env('INTERCOM_URL') . "contacts/" . $emp->intercom_id . "/tags";
                                $parameters = ['body' => json_encode($ctag_data),'headers' => $headers];
                                $content = intercom_api($tagc_url, 'POST', $parameters);
                            }
                        }
                        // ADD DISCOUNT TAG TO USER-INTERCOM END
                    }
                }
            }
        }
        if($emp_err_cnt) { 
            // dd($contact_message);
            echo json_encode(['message' => $contact_message]);
        } else {
            echo json_encode(['message' => "Intercom migration successfully completed."]);
        }
    }

    public function hard_delete($id)
    {
        $candidate = User::find($id);

        if ($candidate) {
            \DB::table('users')->where('id', $id)->delete();

            session()->flash('success', 'Employer deleted permanently !!');
            return redirect()->route('admin.employers');
        } else {
            session()->flash('error', 'Employer not found.');
            return redirect()->route('admin.employers');
        }
    }
}
