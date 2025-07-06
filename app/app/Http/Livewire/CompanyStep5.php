<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\Creditcard;
use App\Models\State;
use App\Models\Discount;


class CompanyStep5 extends Component
{
    public $published;
    public $plan_data;

    public $is_cc_valid = false;

    public $name,
        $email,
        $address,
        $city,
        $state,
        $zipcode,
        $credit_card,
        $cvv,
        $exp_month,
        $exp_year,
        $tax,
        $amount,
        $fine_amount,
        $auto_renew = 1,
        $discount = 0,
        $discount_code,
        $applied_discount_code,
        $number_of_user = 1,
        $api_customer_id = 0;

    public $discount_id = 0, $applied_discount = 0, $discount_error = null,$discount_duration=0;

    public $cc_error, $cc_error_code;

    public $all_states = [];

    protected $listeners = ['update_pg' => '$refresh']; // task - 86a0d8bft

    public
    $cc_mon_valid = false,
    $cc_mon_error = null,
    $cc_yr_valid = false,
    $cc_yr_error = null;

    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->address = Auth::user()->company->company_address;
        $this->zipcode = Auth::user()->company->zip_code;
        $this->state = Auth::user()->company->company_state;
        $this->city = Auth::user()->company->company_city;
        $this->all_states = State::all();
        $user = Auth::user();
        $user->current_step = 4;
        if($user->step_reached<4){
            $user->step_reached=4;
        }
        $user->save();
    }

    public function render()
    {
        $this->plan_data = \Session::get('plan');
        if(empty($this->plan_data)){
            $this->plan_data=json_decode(Auth::user()->plan,true);
        }
        return view('livewire.company-step5');
    }

    public function updated($property)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->cc_error = null;
        $this->cc_error_code = null;
        $this->cc_mon_valid = false;
        $this->cc_mon_error = null;
        $this->cc_yr_valid = false;
        $this->cc_yr_error = null;
    }

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:255'],
            'credit_card' => ['required', 'string', 'min:17', 'max:19'],
            'cvv' => ['required', 'string', 'min:3', 'max:4'],
            'exp_month' => ['required', 'string', 'max:2'],
            'exp_year' => ['required', 'string', 'min:2'],
            'discount_code' => ['required', 'string', 'min:6'], // task - 862k2tb2f
        ];
    }
    protected function messages(): array
    {
        return [
            'credit_card.min' => 'The credit card field must be at least 14 characters.',
            'credit_card.max' => 'The credit card field must not be greater than 16 characters.',

        ];
    }

    public function processPayment()
    {
        // task - 86a0xw101
        $this->resetErrorBag();
        $this->resetValidation();
        $this->cc_error = null;
        $this->cc_error_code = null;
        $this->cc_mon_valid = false;
        $this->cc_mon_error = null;
        $this->cc_yr_valid = false;
        $this->cc_yr_error = null;

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:255'],
            'credit_card' => ['required', 'string', 'min:17', 'max:19'],
            'cvv' => ['required', 'string', 'min:3', 'max:4'],
            'exp_month' => ['required', 'string', 'max:2'],
            'exp_year' => ['required', 'string', 'min:2'],
        ]);
        if(!empty($plan_data)){
            $this->plan_data=$plan_data;
        }
        else{
            $this->plan_data=json_decode(Auth::user()->plan,true);
        }
        // 86a2kvagf
        $period = $this->plan_data['period'];
        $this->amount= $this->plan_data['amount'];
         $additional_charge = $this->amount;
        if ($this->plan_data['plan'] == 1) {
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
        $this->tax = 0;
        // $this->amount = $this->plan_data['amount'];
        // 86a2kvagf
        $this->fine_amount = ($this->tax + ($this->amount + ($additional_charge * ($this->number_of_user-1))))-$this->discount;
        // end 86a2kvagf
        // $this->discount = 0;

        // task - 86a1n51yd
        // 86a2kvagf
        if ($this->discount > ($this->tax + ($this->amount + ($additional_charge * ($this->number_of_user-1))))) {
        // end 86a2kvagf
            $this->discount_error = "Discount is not applicable for amount lesser than discount value.";
            return response()->json();
            die();
        }
        // task - 86a1n51yd end

        $recurring_id = 0;
        $payment_method_id = 0;
        $expiry_date = null;

        // check card is valid
        $api_url = env('PAYAPI_URL') . "transactions/verify";

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
        ];
        $cardNo = $this->credit_card;
        $cardNo = str_replace("-", "", $cardNo);

        $body = '{
          "card": "' . $cardNo.'",
          "expiry_month": ' . (int)$this->exp_month . ',
          "expiry_year": ' .'20'. $this->exp_year .  '
        }';

        try {
            $response = $client->request('POST', $api_url, ['body' => $body, 'headers' => $headers]);
            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody(), true);

            if ($content['status'] == 'Error') {
                $this->cc_error = preg_replace("/\((.*)\)/","", $content['error_message']);
                $this->cc_error_code = $content['error_code'];
                $this->is_cc_valid = false;
                return response()->json();
                die();
            } else {
                $this->cc_error = null;
                $this->cc_error_code = null;
                $this->is_cc_valid = true;
                $name_data = explode(' ', trim($this->name));
                $fname = $name_data[0];
                $lname = isset($name_data[1]) ? $name_data[1] : '';

                // create customer
                $cust_api = env('PAYAPI_URL') . "customers";
                $FourDigitRandomNumber = rand(0, 9999);

                $customer_data = '{
                    "identifier": "' . trim($this->name) . '",
                    "customer_number": "' . $FourDigitRandomNumber . '",
                    "first_name": "' . $fname . '",
                    "last_name": "' . $lname . '",
                    "email": "' . $this->email . '",
                    "billing_info": {
                        "first_name": "' . $fname . '",
                        "last_name": "' . $lname . '",
                        "street": "' . $this->address . '",
                        "state": "' . $this->state . '",
                        "city": "' . $this->city . '",
                        "zip": "' . $this->zipcode . '"
                    }
                }';

                $c_reposnse = $client->request('POST', $cust_api, ['body' => $customer_data, 'headers' => $headers]);
                $c_statusCode = $c_reposnse->getStatusCode();
                $c_content = json_decode($c_reposnse->getBody(), true);

                $this->api_customer_id = (isset($c_content['id'])) ? $c_content['id'] : 0;

                // create payment transaction
                $api_url = env('PAYAPI_URL') . "transactions/charge";
                $cardNo = $this->credit_card;
                $cardNo = str_replace("-", "", $cardNo);
            // 86a2kvagf
                $body = '{
                    "card": "' . $cardNo . '",
                    "expiry_month": ' . (int)$this->exp_month . ',
                    "expiry_year": ' .'20'. $this->exp_year .  ',
                    "amount": ' . (($this->amount + ($additional_charge * ($this->number_of_user-1))) - $this->discount) . ',
                    "cvv2": "' . $this->cvv . '",
                    "amount_details": {
                        "tax": ' . $this->tax . ',
                        "surcharge": 0,
                        "shipping": 0,
                        "tip": 0,
                        "discount": ' . $this->discount . '
                    },
                    "name": "credit card",
                    "billing_info": {
                        "first_name": "' . $fname . '",
                        "last_name": "' . $lname . '",
                        "street": "' . $this->address . '",
                        "city": "' . $this->city . '",
                        "state": "' . $this->state . '",
                        "zip": "' . $this->zipcode . '"
                    },
                    "customer": {
                        "send_receipt": true,
                        "email": "' . $this->email . '",
                        "identifier": "' . trim($this->name) . '",
                        "customer_id": ' . $c_content['id'] . '
                    }
                }';
                if (isset($c_content['id'])) {
                    // create payment method for customer
                    $payment_url = env('PAYAPI_URL') . 'customers/' . $this->api_customer_id . '/payment-methods';
                    $cardNo = $this->credit_card;
                    $cardNo = str_replace("-", "", $cardNo);
                    $payment_method_data = '{
                        "avs_address": "' . $this->address . '",
                        "avs_zip": "' . $this->zipcode . '",
                        "name": "' . trim($this->name) . '",
                        "expiry_month": ' . (int)$this->exp_month . ',
                        "expiry_year": ' .'20'. $this->exp_year .  ',
                        "card": "' . $cardNo . '"
                    }';

                    try {
                        $pm_reposnse = $client->request('POST', $payment_url, ['body' => $payment_method_data, 'headers' => $headers]);
                        $pm_statusCode = $pm_reposnse->getStatusCode();
                        $pm_content = json_decode($pm_reposnse->getBody(), true);
                        // dd($c_content, $pm_content);

                        $payment_method_id = (isset($pm_content['id'])) ? $pm_content['id'] : 0;
                    } catch (\GuzzleHttp\Exception\ClientException $e) {
                        $messages = $e->message;
                        // dd($e);
                        $error_messages = implode("<br>", array_map(function ($a) {
                            return implode("~", $a);
                        }, $messages));
                        // return redirect('company/payment')->with('error_message', $messages);
                    }
                    /******************* end *******************/
                }

                if ($this->auto_renew) {
                    // create recurring charge for customer
                    if (isset($pm_content['id'])) {
                    } elseif (isset($pm_content['error_message'])) {
                        $messages = array_values($pm_content['error_details']);
                        $error_messages = implode("<br>", array_map(function ($a) {
                            return implode("~", $a);
                        }, $messages));
                        return redirect('company/payment')->with('error_message', $error_messages);
                    }
                }

                // for free employers :
                $do_proccess = 0; $_content = [];
                    // 86a2kvagf
                if(strtoupper($this->applied_discount_code) == "FREEEMPLOYER" && (($this->amount + ($additional_charge * ($this->number_of_user-1))) - $this->discount) == 0) {
                    // end 86a2kvagf
                    $do_proccess = 1;
                } else {
                    // $do_proccess = 0;
                    // $_response = $client->request('POST', $api_url, ['body' => $body, 'headers' => $headers]);
                    // $_statusCode = $_response->getStatusCode();
                    // $_content = json_decode($_response->getBody(), true);
                    // if ($_content['status'] == "Approved") {

                        $do_proccess = 1;
                    // }
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
                    return redirect('company/payment')->with('error_message', $error_messages);
                } elseif ($do_proccess) {
                    // send email to user after transaction
                    $user = Auth::user();
                    $plan = ($this->plan_data['plan'] == 1) ? 'Employer' : 'Employer plus';
                    $data = array('name' => $fname, 'amount' => $this->amount, 'period' => $this->plan_data['period'], 'plan' => $plan, 'paid_amount' => $this->fine_amount, 'number_of_user' => $this->number_of_user);
                    \Mail::send(['html' => 'mail.subscription'], $data, function ($message) use ($user) {
                        $message->to($user->email, 'Purple Stairs')->subject('Purple Stairs Subscription');
                        $message->from('info@purplestairs.com', 'Purple Stairs');
                    });

                    // send email to admin after success
                    $name = explode(' ', trim($user->name)); // task - 86a15vje7
                    $data = array('name' => $name[0]/*user->name*/, 'amount' => $this->amount, 'period' => $this->plan_data['period'], 'plan' => $plan, 'paid_amount' => $this->fine_amount, 'number_of_user' => $this->number_of_user, 'email' => $user->email);
                    \Mail::send(['html' => 'mail.admin_subscription'], $data, function ($message) use ($user) {
                        $message->to(['info@purplestairs.com', 'chaya@brand-right.com'], 'Purple Stairs')->subject('Purple Stairs Subscription'); // task - 86a308a4y
                        $message->cc(['sabrina@thepenguin.group','eptdeveloper@gmail.com']); // task - 86a308a4y
                        $message->from('info@purplestairs.com', 'Purple Stairs');
                    });

                    // add user cc data
                    $card = Creditcard::create([
                        'card_number' => substr($this->credit_card, -4),
                        'exp_month' => (int)$this->exp_month,
                        'exp_year' => $this->exp_year,
                        'cvv' => $this->cvv,
                        'user_id' => Auth::user()->id,
                        'payment_method_id' => $payment_method_id,
                        'active' => 1,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);

                    $active_date = date('Y-m-d');
                    $expiry_date = date('Y-m-d', strtotime($active_date . " +1 month"));
                    if ($this->plan_data['period'] == "month") {
                        $expiry_date = date('Y-m-d', strtotime($active_date . " +1 month"));
                    } elseif ($this->plan_data['period'] == "year") {
                        $expiry_date = date('Y-m-d', strtotime($active_date . " +1 year"));
                    }
                    // 86a2kvagf
                    if (strtoupper($this->applied_discount_code) == "FREEEMPLOYER" && (($this->amount + ($additional_charge * ($this->number_of_user-1))) - $this->discount) == 0) {
                        $this->auto_renew = 0;
                    }
                    // end 86a2kvagf
                    $subscription = array(
                        'user_id' => Auth::user()->id,
                        'plan_id' => $this->plan_data['plan'],
                        'plan_amount' => $this->amount,
                        'plan_period' => $this->plan_data['period'],
                        'auto_renew' => $this->auto_renew,
                        'number_of_users' => $this->number_of_user,
                        'per_user_amount' => $this->amount,
                        'coupon_code' => $this->applied_discount_code,
                        'discount' => $this->discount,
                        'customer_id' => $this->api_customer_id,
                        'created_dt' => date('Y-m-d H:i:s'),
                        'status' => 1,
                        'renewal_id' => $recurring_id,
                        'expiration_date' => ($this->auto_renew == 0 ? $expiry_date : null),
                        'body' => $body,
                        'discount_id' => $this->discount_id,
                        'discount_duration' => $this->discount_duration
                    );

                    $subscription_arr = Subscription::create($subscription);

                    // task - 862k2tb2f
                    if ($this->applied_discount_code && $this->discount && $this->applied_discount) {
                        \DB::table('discount_usage')->insert([
                            'user_id' => Auth::user()->id,
                            'discount_id' => $this->discount_id,
                            'date' => date('Y-m-d H:i:s')
                        ]);
                    }

                    if ($this->auto_renew) {
                        // if auto renewal then create recurring table entry
                        \DB::table('recurring_subscription')->insert([
                            [
                                'user_id' => Auth::user()->id,
                                'subscription_id' => $subscription_arr->id,
                                'created_dt' => date('Y-m-d H:i:s')
                            ],
                        ]);
                    }
                // 86a2kvagf
                    if(strtoupper($this->applied_discount_code) == "FREEEMPLOYER" && (($this->amount + ($additional_charge * ($this->number_of_user-1))) - $this->discount) == 0) {


                    }
                    else {
                        // $status = $_content['status'];
                        // $ref_num = $_content['reference_number'];

                        // 86a2kvagf
                        $transaction = array(
                            'user_id' => Auth::user()->id,
                            'subscription_id' => $subscription_arr->id,
                            'per_user_amount' => $this->amount,
                            'card_id' => $card->id,
                            'card_number' => substr($this->credit_card, -4),
                            'coupon_code' => $this->applied_discount_code,
                            'discount' => $this->discount,
                            'tax' => $this->tax,
                            'subtotal' => ($this->amount + ($additional_charge * ($this->number_of_user-1))),
                            'total' => $this->fine_amount,
                            'transaction_id' => '',
                            'customer_id' => $this->api_customer_id,
                            'created_dt' => date('Y-m-d H:i:s'),
                            'status' => 'Pending',
                        );
                        // dd( Transaction::create($transaction));
                        Transaction::create($transaction);
                    }

                    Auth::logout();

                    create_employer_contact($user, true); // task - 86a3d37f9

                    return redirect('/employer/login')->with('error','You have successfully signed up for Purple Stairs. Your account will be verified and approved by email shortly.');

                    // task - 862k2tb3v end
                }
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $message_string = json_decode($e->getResponse()->getBody(), true);
            if ($message_string['error_message'] == "Validation error") {
                foreach ($message_string['error_details'] as $erkey => $erval) {
                    if ($erkey == "expiry_month") {
                        $this->is_cc_valid = false;
                        $this->cc_mon_valid = false;
                        $this->cc_mon_error = "Expiry Month ".$erval[0];
                    } elseif ($erkey == "expiry_year") {
                        $this->is_cc_valid = false;
                        $this->cc_yr_valid = false;
                        // $this->cc_yr_error = "Expiry Year ".$erval[0];
                        $this->cc_yr_error = "Expiry year Must not be  less than current year."; // task - 86a0m88bj
                    }
                }
            }
        }


    }

    public function validate_cc()
    {
        // task - 86a0xw101
        $this->resetErrorBag();
        $this->resetValidation();
        $this->cc_error = null;
        $this->cc_error_code = null;
        $this->cc_mon_valid = false;
        $this->cc_mon_error = null;
        $this->cc_yr_valid = false;
        $this->cc_yr_error = null;

        try{
            if ($this->credit_card) {
                $this->validateOnly('credit_card');
            }

            if ($this->credit_card && $this->exp_month && $this->exp_year && $this->cvv) {
                // task - 86a0xw101
                $this->resetErrorBag();
                $this->resetValidation();
                $this->cc_error = null;
                $this->cc_error_code = null;
                $this->cc_mon_valid = false;
                $this->cc_mon_error = null;
                $this->cc_yr_valid = false;
                $this->cc_yr_error = null;

                $this->validateOnly('credit_card');
                $this->validateOnly('cvv');
                $this->validateOnly('exp_month');
                $this->validateOnly('exp_year');
                $api_url = env('PAYAPI_URL') . "transactions/verify";
                $client = new \GuzzleHttp\Client();
                $headers = [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
                ];
                $cardNo = $this->credit_card;
                $cardNo = str_replace("-", "", $cardNo);
                $body = '{
                  "card": "' . $cardNo . '",
                  "expiry_month": ' . (int)$this->exp_month . ',
                  "expiry_year": ' .'20'. $this->exp_year .  '
                }';

                $response = $client->request('POST', $api_url, ['body' => $body, 'headers' => $headers]);
                $statusCode = $response->getStatusCode();
                $content = json_decode($response->getBody(), true);
                // dd($content);
                if ($content['status'] == 'Error') {
                    $this->cc_error = preg_replace("/\((.*)\)/","", $content['error_message']);
                    $this->cc_error_code = $content['error_code'];
                    $this->is_cc_valid = false;
                } else {
                    $this->is_cc_valid = true;
                }
            }
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $message_string = json_decode($e->getResponse()->getBody(), true);
            if ($message_string['error_message'] == "Validation error") {
                foreach ($message_string['error_details'] as $erkey => $erval) {
                    if ($erkey == "expiry_month") {
                        $this->is_cc_valid = false;
                        $this->cc_mon_valid = false;
                        $this->cc_mon_error = "Expiry Month ".$erval[0];
                    } elseif ($erkey == "expiry_year") {
                        $this->is_cc_valid = false;
                        $this->cc_yr_valid = false;
                        // $this->cc_yr_error = "Expiry Year ".$erval[0];
                        $this->cc_yr_error = "Expiry year Must not be  less than current year."; // task - 86a0m88bj
                    }
                }
            }
        }

        return response()->json();
    }

    public function approveCompany()
    {
        Auth::user()->status = 1;
        Auth::user()->save();
        return redirect('company/dashboard');
    }

    // task - 862k2tb2f
    public function applyDiscount()
    {
        $this->validateOnly('discount_code');

        $discount = Discount::where('coupon_code', $this->discount_code)->where('status', 1)->whereNull('deleted_at')->first();

        // 86a2kvagf
        $period = $this->plan_data['period'];
        $this->amount= $this->plan_data['amount'];
         $additional_charge = $this->amount;
        if ($this->plan_data['plan'] == 1) {
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
        $this->discount_error = null;
        if ($discount) {
            $from       = date('Y-m-d', strtotime($discount->validate_from));
            $to         = date('Y-m-d', strtotime($discount->validate_to));
            $one_time   = $discount->one_time_only;
            $max_use    = $discount->maximum_allow;
            $status     = $discount->status;
            $disc_type  = $discount->type;
            $disc_val   = $discount->discount_value;
            // 86a2kvagf
            $subtotal   = $this->plan_data['amount'] + ($additional_charge * ($this->number_of_user-1));
            // end 86a2kvagf
            if (date('Y-m-d') > date('Y-m-d', strtotime($to))) $status = 2;
            elseif (date('Y-m-d', strtotime($from)) > date('Y-m-d')) $status = 3;

            if ($status == 1) {
                if((!$one_time && $max_use > 0) || $one_time) {
                    $used_count = \DB::table('discount_usage')->where('discount_id', $discount->id)->count();

                    if(($used_count >= $max_use && (!$one_time && $max_use > 0)) || ($one_time && $used_count >= 1)) {
                        $this->discount_code = null;
                        $this->applied_discount_code = $this->discount_code;
                        $this->discount = 0;
                        $this->discount_error = "Maximum usage limit over!";
                        return response()->json();
                        die();
                    }
                }
                $this->applied_discount_code = $this->discount_code;
                $this->discount_id = $discount->id;
                $this->discount_duration = $discount->discount_duration;
                $this->discount_code = null;
                $this->applied_discount = 1;
                // Fixed discount
                if($disc_type == "fixed") {
                    $this->discount = $disc_val;

                } elseif ($disc_type == "percentage") { // Percentage discount
                    $discount_amt = $subtotal * ($disc_val / 100);
                    $this->discount = $discount_amt;
                }

                // task - 86a1n51yd
                // if ($this->discount > ($this->tax + ($this->amount + ($additional_charge * ($this->number_of_user-1))))) {
                //     $this->discount_code = null;
                //     $this->applied_discount_code = $this->discount_code;
                //     $this->discount = 0;
                //     $this->applied_discount = 0;

                //     $this->discount_error = "Discount is not applicable for amount lesser than discount value.";
                //     return response()->json();
                //     die();
                // }
                // task - 86a1n51yd end
            } else {
                $this->discount_code = null;
                $this->applied_discount_code = $this->discount_code;
                $this->discount = 0;
                $this->discount_error = "Invalid discount code!";
                return response()->json();
            }
        } else {
            $this->discount_code = null;
            $this->applied_discount_code = $this->discount_code;
            $this->discount = 0;
            $this->discount_error = "Invalid discount code!";
            return response()->json();
        }
    }

    public function updateDiscount() {
        if ($this->discount_id) {
            $discount = Discount::where('id', $this->discount_id)->where('status', 1)->whereNull('deleted_at')->first();
            // 86a2kvagf
            $period = $this->plan_data['period'];
            $this->amount= $this->plan_data['amount'];
            $additional_charge = $this->amount;
            if ($this->plan_data['plan'] == 1) {
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
            $from       = date('Y-m-d', strtotime($discount->validate_from));
            $to         = date('Y-m-d', strtotime($discount->validate_to));
            $one_time   = $discount->one_time_only;
            $max_use    = $discount->maximum_allow;
            $status     = $discount->status;
            $disc_type  = $discount->type;
            $disc_val   = $discount->discount_value;

            // 86a2kvagf
            $subtotal   = $this->plan_data['amount'] + ($additional_charge * ($this->number_of_user-1));
            // end 86a2kvagf

            if (date('Y-m-d') > date('Y-m-d', strtotime($to))) $status = 2;
            elseif (date('Y-m-d', strtotime($from)) > date('Y-m-d')) $status = 3;

            if((!$one_time && $max_use > 0) || $one_time) {
                $used_count = \DB::table('discount_usage')->where('discount_id', $discount->id)->count();
                if($used_count >= $max_use) {
                    $this->discount_code = null;
                    $this->applied_discount_code = $this->discount_code;
                    $this->discount = 0;
                    $this->discount_error = "Maximum usage limit over!";
                    return response()->json();
                    die();
                }
            }
            $this->applied_discount_code = $discount->coupon_code;
            $this->applied_discount = 1;

            // Fixed discount
            if($disc_type == "fixed") {
                $this->discount = $disc_val;

            } elseif ($disc_type == "percentage") { // Percentage discount
                $discount_amt = $subtotal * ($disc_val / 100);
                $this->discount = $discount_amt;
            }
        }
    }
    // task - 862k2tb2f end

    // task - 86a0d8bft
    public function removeEmp($empID)
    {
        $employment = Employment::find($empID);
        if ($employment) {
            $employment->delete();
        }
        $this->emit(event: 'update_pg');
    }
    // task - 86a0d8bft end
}
