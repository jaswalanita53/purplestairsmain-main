<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Subscription;

class BanquestWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Verify the webhook request
        $logFilePath = base_path('webhook_logs_test.txt');
        $logMessage = date('Y-m-d H:i:s') . ' - testing' . PHP_EOL;
        file_put_contents($logFilePath, $logMessage, FILE_APPEND);

        $signature = $request->header('X-Signature');
        // $secretKey = 'CvweCvKfgIrdpHcW1LMPoPVGAQP5zsuL'; //local
         $secretKey = 'NDrza9YzzqI3wTNvghi1wEzfjCFE1B9J'; // Live

        $payload = $request->getContent();

        // Validate the signature
        if (hash_hmac('sha256', $payload, $secretKey) === $signature) {
            // Signature is valid

            // Process the webhook data
            $arrayVar = json_decode($payload, true);

            // Log the webhook payload to a success log file
            $logFilePath = base_path('webhook_logs_success.txt');
            file_put_contents($logFilePath, json_encode($arrayVar, JSON_PRETTY_PRINT) . PHP_EOL, FILE_APPEND);

            if (!empty($arrayVar['event']) && $arrayVar['event'] == 'transaction') {
                // Update the transaction status based on the webhook data
                $referenceNumber = $arrayVar['data']['reference_number'];
                $subType = $arrayVar['subType'];

                $transaction = Transaction::where('transaction_id', $referenceNumber)->first();

                if ($transaction) {
                    $transaction->status = $subType;
                    $transaction->save();
                }
                if($arrayVar['data']['transaction_details']['source']=='Recurring'){

                     $subscription = Subscription::where('renewal_id', $arrayVar['data']['transaction_details']['schedule_id'])->where('status', 1)->first();
                    if (!empty($subscription->renewal_id)) {

                        try {
                            $planPeriod = $subscription->plan_period;
                            if ($planPeriod == "month" && $subscription->discount_duration>0) {
                            $client = new \GuzzleHttp\Client();
                            $headers = [
                                'Content-Type' => 'application/json',
                                'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
                            ];
                            $hist_url = env('PAYAPI_URL') . "recurring-schedules/" . $subscription->renewal_id;
                            $h_reposnse = $client->request('GET', $hist_url, ['headers' => $headers]);
                            $h_statusCode = $h_reposnse->getStatusCode();
                            $h_content = json_decode($h_reposnse->getBody(), true);
                            $recurring = $h_content;
                            $transaction_count = $recurring['transaction_count'];
                            if($subscription->discount_duration==($transaction_count+1)){
                            $amount = 0;
                            $planId = $subscription->plan_id;
                            $number_of_user = $subscription->number_of_users;
                            $planAmount = 0;
                            $additional_charge = $amount;
                            if ($planId == 1) {
                                    $additional_charge = 50;
                                    $planAmount = 299;
                            } else {
                                    $additional_charge = 100;
                                    $planAmount = 749;
                            }
                            $number_of_user = ($subscription->number_of_users-1);
                            $amount = ($planAmount + (($number_of_user - 1) * $additional_charge));
                            $recurring_data = '{
                                "amount": ' . $amount . '
                                }';


                        $client->request('PATCH', $hist_url, ['body' => $recurring_data, 'headers' => $headers]);
                        try {
                            $transaction = array(
                                'user_id' => $subscription->user_id,
                                'subscription_id' => $subscription->id,
                                'per_user_amount' => $arrayVar['data']['amount_details']['amount'],
                                'card_id' => 0,
                                'card_number' => 0,
                                'coupon_code' => null,
                                'discount' => null,
                                'tax' => 0,
                                'subtotal' => $arrayVar['data']['amount_details']['amount'],
                                'total' => $arrayVar['data']['amount_details']['amount'],
                                // 'transaction_id' => $_content['reference_number'],
                                'transaction_id' => $arrayVar['data']['transaction']['id'],
                                'recurring_id' => $arrayVar['data']['transaction_details']['schedule_id'],
                                'customer_id' => $subscription->customer_id,
                                'created_dt' => date('Y-m-d h:i:s'),
                                'status' => $arrayVar['data']['status_details']['status'],
                            );
                            \DB::table('transactions')->insert($transaction);
                        } catch (\Exception $e) {
                            // Handle the exception, log it, or do something else
                            // For example, you can log the error message

                        }

                    }
                    }

                        } catch (\GuzzleHttp\Exception\ClientException $e) {
                            // dd($e->getMessage());
                            session()->flash('message', $e->getMessage());
                            // return response()->json();
                        }
                    }

                }

            }

            return response()->json(['message' => 'Webhook processed successfully'], 200);
        } else {
            // Invalid signature

            // Log the invalid signature to a custom log file
            $logFilePath = base_path('webhook_logs.txt');
            $logMessage = date('Y-m-d H:i:s') . ' - Invalid Banquest Gateway webhook signature' . PHP_EOL;
            file_put_contents($logFilePath, $logMessage, FILE_APPEND);

            return response()->json(['message' => 'Invalid signature'], 403);
        }
    }

}

