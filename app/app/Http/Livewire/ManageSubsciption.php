<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\Creditcard;
use App\Models\Company;
use App\Models\User;
use App\Models\Invited_user;
// use App\Helpers\Api_helper;
use Auth;
use App\Models\Delete;
use App\Http\Controllers\Backend\EmployersController;
use Illuminate\Support\Carbon;

class ManageSubsciption extends Component
{
    public $plan1_amount;
    public $plan1_active;
    public $plan1_period;

    public $plan2_amount;
    public $plan2_active;
    public $plan2_period;

    public $cards = [];

    public $is_cc_valid = false, $cc_error, $cc_error_code;

    // task - 86a0m88bj
    public
        $cc_mon_valid = false,
        $cc_mon_error = null,
        $cc_yr_valid = false,
        $cc_yr_error = null;

    public $plan1_switch = false, $plan2_switch = false;

    protected $listeners = ['updateCC' => '$refresh', 'clearMessage' => 'clearMessage', 'updateInvitation','reactivateUser','cancelSubscription'];

    public $credit_card,
    $exp_month,
    $exp_year,
    $cvv;

    public $active_plan, $company_users;
    public $recurring_dt = null;
    public $number_of_users;
    public $price_on_number_of_users;

    public $invite_username = [];
    public $invite_useremail = [];
    public $joined_user = [];
    public $temp_usersIds = [];
    // protected $dontReset =  ["invited_list","invite_username","invite_useremail"];

    public $manage_user_message = null;

    public $switch_to_plan, $switch_period, $btn1_class = false, $btn2_class = false; // task - 86a0y5va2

    public $card_save = 0, $active_card = [];

    // task - 86a23ebne
    public $active_credit_card = null, $active_cc_error = null;

    public function mount()
    {
        $this->active_plan = Subscription::where('user_id', Auth::user()->id)->where('status', 1)->orderBy('id', 'desc')->first();

        if (Auth::user()->reference && is_null($this->active_plan)) {
            session()->flash('errors', 'Your company subscription is expired. Please contact to your company.');
            Auth::logout();
        } elseif (Auth::user()->reference) {
            echo "<script>window.location.href = '" . url('/company/dashboard') . "';</script>";
        }

        /*$card = Creditcard::where(['user_id' => Auth::user()->id, 'active' => 1])->first();
        if($card == null) {
            $tmp_card = Creditcard::where(['user_id' => Auth::user()->id])->first();
            if($tmp_card) {
                $tmp_card->active = 1;
                $tmp_card->save();
            }
        }*/

        $_invited_list = Invited_user::where('invited_users.sender_userid', Auth::user()->id)->whereNull("invited_users.invited_user_id")->get()->toArray();

        $joined_user = User::select('users.id', 'users.email', 'users.status', 'users.created_at', \DB::raw('(IF(users.reference, (select name from invited_users where invited_user_id=users.id), users.name)) as name'))->where('reference', Auth::user()->id)->orWhere('id', Auth::user()->id)->get();

        // task - 8678ffnv3
        foreach ($joined_user as $u_key => $juser) {
            $this->joined_user[] = array(
                'id' => $juser->id,
                'name' => $juser->name,
                'email' => $juser->email,
                'status' => $juser->status,
                'invited_id' => null,
                'created_at' => $juser->created_at,
            );
           // $this->temp_usersIds[$u_key] = $u_key;
        }
       // print_r($this->temp_usersIds[$u_key]);
        foreach ($_invited_list as $i_key => $iuser) {
            $status = null;
            if ($iuser['invited_user_id']) {
                $user = User::find($iuser['invited_user_id']);
                if($user) $status = $user->status;
            }
            // $this->temp_usersIds[$i_key] = $i_key;
            $this->joined_user[] = array(
                'id' => $iuser['invited_user_id'],
                'name' => $iuser['name'],
                'email' => $iuser['email'],
                'invited_id' => $iuser['id'],
                'status' => ($iuser['invited_user_id']) ? $status : null,
                'created_at' => $iuser['created_at'],
            );
             $this->temp_usersIds[$i_key+1] = $iuser['id'];
        }

        /* task - 8678ffnv3 $signup_user = User::find(Auth::user()->id)->toArray();
        $invited_list[] = array(
            'name' => $signup_user['name'],
            'email' => $signup_user['email'],
        );
        $invited_list = array_merge($invited_list, $_invited_list);*/

        $invited_list = $_invited_list;

        $this->invited_list = $invited_list;

        foreach ($invited_list as $key => $inv) {
            // $this->invite_username[] = $inv['name'];
            // $this->invite_useremail[] = $inv['email'];
        }

        if ($this->active_plan && $this->active_plan->auto_renew) {
            if(!empty(\DB::table('recurring_subscription')->where('subscription_id', $this->active_plan['id'])->first())){
            $this->recurring_dt = \DB::table('recurring_subscription')->where('subscription_id', $this->active_plan['id'])->first()->last_execution_time;
        }
        }
        // dd($this->recurring_dt);
        if (is_null($this->active_plan)) {
            $subscription = Subscription::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->first();

            // task - 86a0y5va2
            $this->switch_to_plan = null;
            $this->switch_period = null;

            $this->number_of_users = ($subscription ? $subscription->number_of_users : 1);
            $this->number_of_users = ($subscription ? $subscription->number_of_users : 1);
            $this->active_plan = [
                'user_id' => null,
                'plan_id' => null,
                'plan_amount' => null,
                'plan_period' => null,
                'auto_renew' => null,
                'number_of_users' => ($subscription ? $subscription->number_of_users : 1),
                'per_user_amount' => null,
                'coupon_code' => null,
                'discount' => null,
                'customer_id' => null,
                'created_dt' => null,
                'status' => null,
                'renewal_id' => null,
                'expiration_date' => null,
                'additional_charge' => null,
            ];
            $this->price_on_number_of_users = 0;
        } else {
            $this->number_of_users = $this->active_plan->number_of_users;

            // task - 86a0y5va2
            $this->switch_to_plan = $this->active_plan['plan_id'];
            $this->switch_period = $this->active_plan['plan_period'];

            // task - 86a0c14rr
            if ($this->active_plan['plan_id'] == 1) {
                if ($this->active_plan['plan_period'] == 'month') {
                    $this->active_plan['additional_charge'] = 50;
                } else {
                    $this->active_plan['additional_charge'] = 479;
                }
            } elseif ($this->active_plan['plan_id'] == 2) {
                if ($this->active_plan['plan_period'] == 'month') {
                    $this->active_plan['additional_charge'] = 100;
                } else {
                    $this->active_plan['additional_charge'] = 949;
                }
            }
            if ($this->number_of_users > 0) {
                if ($this->active_plan['plan_period'] == "month") {
                    $payable_amount = round($this->active_plan['additional_charge'] * $this->number_of_users, 2);
                } else {
                    $subscription_dt = ($this->active_plan['plan_id']) ? $this->active_plan['created_dt'] : null;
                    $ts1 = strtotime($subscription_dt);
                    $ts2 = strtotime(date('Y-m-d'));

                    $year1 = date('Y', $ts1); $month1 = date('m', $ts1);
                    $year2 = date('Y', $ts2); $month2 = date('m', $ts2);

                    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                    $remaining_mo = ($diff == 0) ? 12 : 12 - $diff;

                    $monthly_amount = $this->active_plan['additional_charge'] / 12;
                    $payable_amount = round($monthly_amount * $this->number_of_users * $remaining_mo, 2);
                }
            }
            // task - 86a0c14rr end

            $this->price_on_number_of_users = $payable_amount;
        }

        // $this->price_on_number_of_users=$this->active_plan->plan_amount*1;
        // $this->number_of_users = 1;
        // default value
        $this->plan1_amount = 299;
        $this->plan1_period = 'month';

        $this->plan2_amount = 749;
        $this->plan2_period = 'month';

        if($this->active_plan['plan_id'] == 1) {

            if ($this->active_plan['plan_period'] == 'month') {
                $this->plan1_amount = 299;
                $this->plan1_period = 'month';
            } else {
                $this->plan1_amount = 2999;
                $this->plan1_period = 'year';
            }
        } elseif ($this->active_plan['plan_id'] == 2) {
            if ($this->active_plan['plan_period'] == 'month') {
                $this->plan2_amount = 749;
                $this->plan2_period = 'month';
            } else {
                $this->plan2_amount = 8500;
                $this->plan2_period = 'year';
            }
        }

        if ($this->active_plan['plan_period'] == 'year') {
            $this->plan1_amount = 2999;
            $this->plan1_period = 'year';

            $this->plan2_amount = 8500;
            $this->plan2_period = 'year';
        }
                // 86a2ggtje
                $deleted=Delete::where('user_id',Auth::id())->first();
                if(!empty($deleted->status)){
                    session()->flash('error', 'Your account has been deactivated.');
                    echo "<script>window.location.href = '" . url('/company/manage-account') . "';</script>";
                }
    }

    public function render()
    {
        $this->cards = Creditcard::where('user_id', Auth::user()->id)->get();

        // task - 86a1ap0x2
        $this->active_card = $card = Creditcard::where(['user_id' => Auth::user()->id, 'active' => 1])->first(); // task - 86a1fwwdq
        if($card == null) {
            $tmp_card = Creditcard::where(['user_id' => Auth::user()->id])->first();
            if($tmp_card) {
                $tmp_card->active = 1;
                $tmp_card->save();

                $this->active_card = $tmp_card; // task - 86a1fwwdq
            }
        }

        // get payment details
        $payments = Transaction::where('user_id', Auth::user()->id)->paginate(10);

        // company users
        // $this->invite_username = [];
        // $this->invite_useremail = [];
        $this->joined_user = [];
        $this->invited_list = [];
        $this->company_users = Company::with('users')->where('user_id', Auth::user()->id)->get();
        $_invited_list = Invited_user::where('invited_users.sender_userid', Auth::user()->id)->whereNull("invited_users.invited_user_id")->get()->toArray();

        $joined_user = User::select('users.id', 'users.email', 'users.status', 'users.created_at', \DB::raw('(IF(users.reference, (select name from invited_users where invited_user_id=users.id), users.name)) as name'))->where('reference', Auth::user()->id)->orWhere('id', Auth::user()->id)->get();

        // task - 8678ffnv3
        foreach ($joined_user as $u_key => $juser) {
            $this->joined_user[] = array(
                'id' => $juser->id,
                'name' => $juser->name,
                'email' => $juser->email,
                'status' => $juser->status,
                'invited_id' => null,
                'created_at' => $juser->created_at,
            );
            //$this->temp_usersIds[$u_key] = $u_key;
        }

        foreach ($_invited_list as $i_key => $iuser) {
            $status = null;
            if ($iuser['invited_user_id']) {
                $user = User::find($iuser['invited_user_id']);
                if($user) $status = $user->status;
            }
            $this->joined_user[] = array(
                'id' => $iuser['invited_user_id'],
                'name' => $iuser['name'],
                'email' => $iuser['email'],
                'invited_id' => $iuser['id'],
                'status' => ($iuser['invited_user_id']) ? $status : null,
                'created_at' => $iuser['created_at'],
            );
           // $this->temp_usersIds[$i_key] = $i_key;
        }

        /* task - 8678ffnv3 $signup_user = User::find(Auth::user()->id)->toArray();
        $invited_list[] = array(
            'name' => $signup_user['name'],
            'email' => $signup_user['email'],
        );
        $invited_list = array_merge($invited_list, $_invited_list);*/

        $invited_list = $_invited_list;

        $this->invited_list = $invited_list;
        foreach ($invited_list as $key => $inv) {
            //$this->temp_usersIds[$i_key] = $i_key;
            // $this->invite_username[] = $inv['name'];
            // $this->invite_useremail[] = $inv['email'];
        }
        // $this->invite_username  =[];
        // $this->invite_useremail =[];
        $subscription = Subscription::where('user_id', Auth::id())->where('status', 1)->first();


        $nextDate = "";

        if (!empty($subscription->renewal_id)) {

            try {
                $client = new \GuzzleHttp\Client();
                $api_url = env('PAYAPI_URL') . "transactions/charge";
                $headers = [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
                ];
                $hist_url = env('PAYAPI_URL') . "recurring-schedules/" . $subscription->renewal_id;
                $h_reposnse = $client->request('GET', $hist_url, ['headers' => $headers]);
                $h_statusCode = $h_reposnse->getStatusCode();
                $h_content = json_decode($h_reposnse->getBody(), true);
                $recurring = $h_content;

                if (!empty($recurring['next_run_date'])) {
                    $nextDate = $recurring['next_run_date'];
                }
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                // dd($e->getMessage());
                session()->flash('message', $e->getMessage());
                // return response()->json();
            }
        }
        $delete=Delete::where('user_id',Auth::id())->first();
        $lastSubscription="";
        if(!empty($subscription->renewal_id)){
            $lastSubscription = Subscription::where('user_id', Auth::id())->where('status', 0)->where('renewal_id',$subscription->renewal_id)->orderBy('id','DESC')
            // ->whereHas('transactions')
            ->first();

        }
        return view('livewire.manage-subsciption', compact('payments','nextDate','delete','lastSubscription'));

    }

    public function updateSubscription($is_checked, $element) {
        if($is_checked) {
            $this->switch_period = 'year'; // task - 86a0y5va2
            if($element == "price-info-first") {
                $this->switch_to_plan = 1; // task - 86a0y5va2

                $this->plan1_amount = 2999;
                $this->plan1_period = 'year';

                $this->plan1_switch = ($this->active_plan['plan_id'] == 1 && $this->active_plan['plan_period'] == 'year') ? false : true;
                $this->plan2_switch = false;

                $this->btn1_class = 'active';
                $this->btn2_class = null;
            } else {
                $this->switch_to_plan = 2; // task - 86a0y5va2

                $this->plan2_amount = 8500;
                $this->plan2_period = 'year';

                $this->plan1_switch = false;
                $this->plan2_switch = ($this->active_plan['plan_id'] == 2 && $this->active_plan['plan_period'] == 'year') ? false : true;

                $this->btn1_class = null;
                $this->btn2_class = 'active';
            }
        } else {
            $this->switch_period = 'month'; // task - 86a0y5va2
            if($element == "price-info-first") {
                $this->switch_to_plan = 1; // task - 86a0y5va2
                $this->plan1_amount = 299;
                $this->plan1_period = 'month';

                $this->plan1_switch = ($this->active_plan['plan_id'] == 1 && $this->active_plan['plan_period'] == 'month') ? false : true;
                $this->plan2_switch = false;

                $this->btn1_class = 'active';
                $this->btn2_class = null;
            } else {
                $this->switch_to_plan = 2; // task - 86a0y5va2
                $this->plan2_amount = 749;
                $this->plan2_period = 'month';

                $this->plan1_switch = false;
                $this->plan2_switch = ($this->active_plan['plan_id'] == 2 && $this->active_plan['plan_period'] == 'month') ? false : true;

                $this->btn1_class = null;
                $this->btn2_class = 'active';
            }
        }

        return response()->json();
    }
    public function reactivateAccount() {

        $delete=Delete::where('user_id',Auth::id())->first();
        $deletedUser=$delete;
        if($delete->delete()){
            $subscription = Subscription::where('user_id', Auth::id())->where('status', 1)->first();
            $nextDate = "";
            if (!empty($subscription->renewal_id)) {

                try {
                    $client = new \GuzzleHttp\Client();
                    $api_url = env('PAYAPI_URL') . "transactions/charge";
                    $headers = [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
                    ];
                    $hist_url = env('PAYAPI_URL') . "recurring-schedules/" . $subscription->renewal_id;
                    $h_reposnse = $client->request('GET', $hist_url, ['headers' => $headers]);
                    $h_statusCode = $h_reposnse->getStatusCode();
                    $h_content = json_decode($h_reposnse->getBody(), true);
                    $recurring = $h_content;

                    if (!empty($recurring['next_run_date'])) {
                        $nextDate = $recurring['next_run_date'];
                    }
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    // dd($e->getMessage());
                    session()->flash('message', $e->getMessage());
                    // return response()->json();
                }
            }

            $createdAtString = $deletedUser->created_at->format('Y-m-d H:i:s');

            if ($nextDate < $createdAtString) {
                if (!empty($deletedUser->user_id)) {
                    if(!empty($subscription)){
                        $subscription->status=0;
                        $subscription->save();
                    }
                    session()->flash('message', 'Your account has been activated. To continue, click on a plan below.');
                    return redirect()->route('company.manage.subsciption');
                }
            }else{
                if (!empty($subscription->renewal_id)) {
                    $client = new \GuzzleHttp\Client();
                    $recurring_url = env('PAYAPI_URL') . "recurring-schedules/".$subscription->renewal_id;
                    $headers = [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
                    ];
                    $recurring_data = '{
                    "active": true
                    }';
                }

            $rec_response = $client->request('PATCH', $recurring_url, ['body' => $recurring_data, 'headers' => $headers]);
            }
            // task - 86a2v224u session()->flash('message', 'Your account has been activated. To continue, click on a plan below.');
            session()->flash('message', 'Your account has been reactivated and your previous subscription plan has been reinstated.');
        }
    }
    public function removeCard($id) {
        $cc_data = Creditcard::find($id);

        if ($cc_data) {
            $client = new \GuzzleHttp\Client();
            $headers = [
                'Authorization'=> 'Basic ' . env('PAYAPI_TOKEN')
            ];
            // get all recurring schedule with this card before delete
            $rec_content = [];
            $rec_url = env('PAYAPI_URL') . "payment-methods/".$cc_data->payment_method_id."/recurring-schedules";
            try {
                $rec_response = $client->request('GET', $rec_url, ['headers' => $headers]);
                $rec_statusCode = $rec_response->getStatusCode();
                $rec_content = json_decode($rec_response->getBody(), true);
                // dd($rec_url, $rec_content);
            } catch(\GuzzleHttp\Exception\ClientException $e) {
                $message_string = json_decode($e->getResponse()->getBody(), true);
                // dd($message_string);
            }
            // dd($rec_url);
            $cc_data->delete();

            $card = Creditcard::where(['user_id' => Auth::user()->id, 'active' => 1])->first();
            $active_payment_method = 0;
            if($card == null) {
                $tmp_card = Creditcard::where(['user_id' => Auth::user()->id])->first();
                if($tmp_card) {
                    $tmp_card->active = 1;
                    $tmp_card->save();

                    $active_payment_method = $tmp_card->payment_method_id;
                }
            } else {
                $active_payment_method = $card->payment_method_id;
            }

            // update recurring schedule payment method
            foreach ($rec_content as $m_key => $method) {
                try {
                    $rec_url = env('PAYAPI_URL') . "recurring-schedules/".$method['id'];
                    $body = '{
                      "payment_method_id": '.$active_payment_method.'
                    }';

                    $rec_response = $client->request('PATCH', $rec_url, ['body' => $body, 'headers' => $headers]);
                    $rec_statusCode = $rec_response->getStatusCode();
                    $rec_content = json_decode($rec_response->getBody(), true);
                } catch(\GuzzleHttp\Exception\ClientException $e) {
                    $message_string = json_decode($e->getResponse()->getBody(), true);
                    dd($message_string);
                }
            }

            // delete from API
            $api_url = env('PAYAPI_URL') . "payment-methods/".$cc_data->payment_method_id;

            $response = $client->request('DELETE', $api_url, ['headers' => $headers]);
            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody(), true);

        }

        $this->emit(event: 'updateCC'); // update seaches on save
    }

    public function validate_cc()
    {
        $this->card_save = 0;
        // task - 86a0m88bj
        /*$this->cc_mon_valid = false;
        $this->cc_mon_error = null;
        $this->cc_yr_valid = false;
        $this->cc_yr_error = null;
        // dd("test - 456");
        $this->resetErrorBag();
        $this->resetValidation();*/
        /*$this->validate();
        if ($this->credit_card) {
            $this->validateOnly('credit_card');
        }*/
        /*if ($this->credit_card) {
            $this->validateOnly('credit_card');
        }
        if ($this->exp_month) {
            $this->validateOnly('exp_month');
        }
        if ($this->exp_year) {
            $this->validateOnly('exp_year');
        }

        if ($this->credit_card && $this->exp_month && $this->exp_year && $this->cvv) {
            $this->validate();

            $this->dispatchBrowserEvent('disable-card-save');
            $is_card_valid = $this->varify_card();
        }*/

        $this->resetErrorBag();
        $this->resetValidation();

        $this->cc_mon_valid = false;
        $this->cc_mon_error = null;
        $this->cc_yr_valid = false;
        $this->cc_yr_error = null;

        // $this->is_cc_valid = true;
        $this->cc_error = null;
        $this->cc_error_code = 0;
        $this->dispatchBrowserEvent('remove-card-errors');
        return response()->json();
    }

    public function rules()
    {
        return [
            'credit_card' => ['required', 'string', 'min:17', 'max:19'],
            'exp_month' => ['required', 'string', 'min:1', 'max:2'],
            'exp_year' => ['required', 'string', 'min:2', 'max:2'],
            'cvv' => ['required', 'string', 'min:3'],
        ];
    }

    protected function messages(): array
    {
        return [
            'credit_card.min' => 'The credit card field must be at least 14 characters.',
            'credit_card.max' => 'The credit card field must not be greater than 16 characters.',
            'cvv.min' => 'The CVV field must must be at least 3 digits.',
        ];
    }

    public function addCard()
    {
        // dd("test - 123");
        $this->card_save = 1;
        $this->resetErrorBag();
        $this->resetValidation();

        $cardNo = str_replace("-", "", $this->credit_card);
        $this->credit_card = chunk_split($cardNo, 4, '-');
        $last_ch = substr($this->credit_card, -1);
        if($last_ch == "-") {
            $this->credit_card = substr_replace($this->credit_card, '', -1);
        }
        
        $this->validate();

        $is_card_valid = $this->varify_card();
        if(!$is_card_valid) {
            return response()->json();
        }
        $existing_cards = Creditcard::where('user_id', Auth::user()->id)->count();
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type'=> 'application/json',
            'Authorization'=> 'Basic ' . env('PAYAPI_TOKEN')
        ];

        $this->is_cc_valid = true;
        $this->cc_error = null;
        $this->cc_error_code = 0;
        $this->cvv = null;

        // task - 86a0m88bj
        $this->cc_mon_valid = false;
        $this->cc_mon_error = null;
        $this->cc_yr_valid = false;
        $this->cc_yr_error = null;

        // create payment method for customer
        try {
            $customer_id = $this->get_customer_id();
            $payment_url = env('PAYAPI_URL') . 'customers/'.$customer_id.'/payment-methods';

                // "avs_address": "'.$this->company_users->company_address.'",
                // "avs_zip": "'.$this->zipcode.'",
                $cardNo = $this->credit_card;
                $cardNo = str_replace("-", "", $cardNo);
                    $payment_method_data = '{
                        "name": "'.trim(Auth::user()->name).'",
                        "expiry_month": '.(int)$this->exp_month.',
                        "expiry_year": '.'20'. $this->exp_year . ',
                        "card": "'.$cardNo.'"
                    }';

            $pm_reposnse = $client->request('POST', $payment_url, ['body' => $payment_method_data, 'headers' => $headers]);
            $pm_statusCode = $pm_reposnse->getStatusCode();
            $pm_content = json_decode($pm_reposnse->getBody(), true);
        } catch(\GuzzleHttp\Exception\ClientException $e) {
            $message_string = json_decode($e->getResponse()->getBody(), true);
            // dd($message_string);
            if (isset($message_string['error_details'])) {
                if (isset($message_string['error_details']['error'])) {
                    $this->is_cc_valid = false;
                    $this->cc_error = $message_string['error_details']['error'];
                    $this->cc_error_code = $e->getResponse()->getStatusCode();
                }
            }

            if ($message_string['error_message'] == "Validation error") {
                $this->is_cc_valid = false;
                foreach ($message_string['error_details'] as $erkey => $erval) {
                    // var_dump($erkey);
                    if ($erkey == "expiry_month") {
                        $this->cc_mon_valid = false;
                        $this->cc_mon_error = "Expiry Month ".$erval[0];
                    } elseif ($erkey == "expiry_year") {
                        $this->cc_yr_valid = false;
                        // $this->cc_yr_error = "Expiry Year ".$erval[0];
                        $this->cc_yr_error = "Expiry year Must not be  less than current year."; // task - 86a0m88bj
                    }
                }
            }
            // exit;
            return response()->json();
        }
        /******************* end *******************/

        if (isset($pm_content['id'])) {
            Creditcard::create([
                'user_id' => Auth::user()->id,
                'card_number' => substr($this->credit_card,-4),
                'exp_month' => $this->exp_month,
                'exp_year' => $this->exp_year,
                'cvv' => $this->cvv,
                'active' => ($existing_cards > 0 ? 0 : 1),
                'payment_method_id' => $pm_content['id'],
                'created_at' => date('Y-m-d h:i:s')
            ]);

            $this->credit_card = null;
            $this->exp_month = null;
            $this->exp_year = null;
            $this->cvv = null;
            $this->is_cc_valid = false;
            $this->dispatchBrowserEvent('close-card');
            $this->emit(event: 'updateCC'); // update seaches on save
        }
    }

    public function varify_card()
    {
        $this->cc_mon_valid = false;
        $this->cc_mon_error = null;
        $this->cc_yr_valid = false;
        $this->cc_yr_error = null;
        $api_url = env('PAYAPI_URL') . "transactions/verify";
        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type'=> 'application/json',
            'Authorization'=> 'Basic ' . env('PAYAPI_TOKEN')
        ];
        $cardNo = $this->credit_card;
        $cardNo = str_replace("-", "", $cardNo);
        $body = '{
          "card": "'.$cardNo.'",
          "expiry_month": '.(int)$this->exp_month.',
          "expiry_year": '.'20'. $this->exp_year . '
        }';

        try { // task - 86a0m88bj
            $response = $client->request('POST', $api_url, ['body' => $body, 'headers' => $headers]);
            $statusCode = $response->getStatusCode();
            $content = json_decode($response->getBody(), true);
            // dd($content);
            if ($content['status'] == 'Error') {
                $this->cc_error = preg_replace("/\((.*)\)/","", $content['error_message']);
                $this->cc_error_code = $content['error_code'];
                $this->is_cc_valid = false;
            } else {
                $this->dispatchBrowserEvent('enable-card-save');
                $this->cc_error = null;
                $this->cc_error_code = 0;
                $this->is_cc_valid = true;
                // $this->cvv = null;
            }
            return $this->is_cc_valid;
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
        return $this->is_cc_valid;
    }

    public function updateDeaultCard($id, $status)
    {
        // active only one
        Creditcard::where('user_id', Auth::user()->id)->update(['active' => 0]);

        $cc_id = ($status) ? $id : 0;
        $card = Creditcard::find($id);

        $card->active = !$status;
        $card->save();

        // task - 86a1ap0x2
        $this->active_card = $card = Creditcard::where(['user_id' => Auth::user()->id, 'active' => 1])->first();
        if($card == null) {
            $tmp_card = Creditcard::where(['user_id' => Auth::user()->id])->first();
            if($tmp_card) {
                $tmp_card->active = 1;
                $tmp_card->save();

                $cc_id = $tmp_card->id;
                $this->active_card = $tmp_card;
            }
        } else {
            $cc_id = $card->id;
        }

        $this->cards = Creditcard::where('user_id', Auth::user()->id)->get();
        $this->dispatchBrowserEvent('update-card', ['cc_id' => $cc_id]);
    }

    // 86a2bf326
    public function cancelSubscription()
    {
             $subscription = Subscription::where('user_id', Auth::id())->where('status', 1)->first();
             Delete::create([
                 'reason' => 'cancelled subscription',
                 'other'  => '',
                 'user_id' => Auth::user()->id,
                 'type' => 'delete'
             ]);
                 if (!empty($subscription->renewal_id)) {
                     $employersController = new EmployersController();
                     $employersController->recurringOff($subscription->renewal_id, $subscription->id);
                 }
             // Auth::user()->delete();
             session()->flash('error', 'Your account has been deactivated.');
             return redirect()->route('company.manage.subsciption');

    }

    public function switchSubscription($plan)
    {

            $amount = 0;
            $userId = Auth::id();
            $planId = $plan;
            $planPeriod = "";
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
            if ($planId == 1) {
                $planPeriod = $this->plan1_period;
                $planAmount = $this->plan1_amount;
            } else{
                $planPeriod = $this->plan2_period;
                $planAmount = $this->plan2_amount;

            }
            $additional_charge = $amount;
            if ($planId == 1) {
                if ($planPeriod == 'month') {
                    $additional_charge = 50;
                    $planAmount = 299;
                } else {
                    $additional_charge = 479;
                    $planAmount = 2999;
                }
            } else {
                if ($planPeriod == 'month') {
                    $additional_charge = 100;
                    $planAmount = 749;
                } else {
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
            // get active subscription
        $active_subscription = Subscription::where('user_id', Auth::user()->id)->where('status', 1)->orderBy('id', 'desc')->first();
            if(empty($active_subscription)) {
            $active_subscription = Subscription::where('user_id', Auth::user()->id)->orderBy('id','DESC')->first();
        }
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
                // get default card
                $this->active_card = $card = Creditcard::where(['user_id' => Auth::user()->id, 'active' => 1])->first();
                if($card == null) {
                    $tmp_card = Creditcard::where(['user_id' => Auth::user()->id])->first();
                    if($tmp_card) {
                        $tmp_card->active = 1;
                        $tmp_card->save();

                        $this->active_card = $tmp_card;
                        $card = $tmp_card;
                    } else {
                        session()->flash('error', 'You don\'t have an active card.'); // task - 86a2uhbkv
                        return redirect()->route('company.manage.subsciption');
                    }
                }
                if ($planPeriod == 'year') {
                    $api_url = env('PAYAPI_URL') . "transactions/charge";
                    $body = '{
                    "amount": ' . $amount . ',
                    "source":"pm-' . $card->payment_method_id . '"
                }';

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
                $rec_response_get = $client->request('GET', $recurring_url,['headers' => $headers]);
                $rec_response_get = json_decode($rec_response_get->getBody(), true);
                if(!empty($rec_response_get['next_run_date'])){
                    $tomorrow = Carbon::tomorrow()->setTimezone('America/New_York')->format('Y-m-d');
                    $date = Carbon::parse($rec_response_get['next_run_date']);
                    $amount = ($planAmount + (($number_of_user - 1) * $additional_charge));
                    if ($date->isPast()) {
                        $recurring_data = '{
                            "active": true,
                            "frequency": "' . $frequency . '",
                            "amount": ' . $amount . ',
                            "next_run_date":  "' . $tomorrow . '"
                        }';
                    } else {
                        $recurring_data = '{
                            "active": true,
                            "frequency": "' . $frequency . '",
                            "amount": ' . $amount . '
                        }';
                    }
                    $rec_response = $client->request('PATCH', $recurring_url, ['body' => $recurring_data, 'headers' => $headers]);
                    $rec_response = json_decode($rec_response->getBody(), true);
                }

                if (!empty($rec_response['id'])) {
                    $expiry_date='';
                    $updateSubscription = Subscription::find($active_subscription->id);
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
                    $data = array('name' => $fname, 'amount' => $amount + (($number_of_user - 1) * $additional_charge), 'period' => $planPeriod, 'plan' => $plan_nm, 'paid_amount' => $amount, 'number_of_user' => $number_of_user);

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

            // return redirect()->route('company.manage.subsciption');
    }

    protected function get_customer_id()
    {
        $customer_id = null;
        $user = Auth::user();
        $user_name = explode(' ', trim($user->name));
        $fname = $user_name[0];
        $lname = isset($user_name[1]) ? $user_name[1] : null;

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type'=> 'application/json',
            'Authorization'=> 'Basic ' . env('PAYAPI_TOKEN')
        ];

        // get active subscription
        $active_subscription = Subscription::where('user_id', Auth::user()->id)->where('status', 1)->orderBy('id', 'desc')->first();
        if($active_subscription) {
            $customer_id    = $active_subscription['customer_id'];
        } else {
            $subscription = Subscription::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();
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

    public function InviteUser($no)
    {

        if (isset($this->invite_username[$no]) && isset($this->invite_useremail[$no])) {
            if (!empty($this->invite_username) && !empty($this->invite_useremail)) {
                // task - 86a12jfv8
                if(!filter_var($this->invite_useremail[$no], FILTER_VALIDATE_EMAIL)) {
                    $this->dispatchBrowserEvent('validate-invite', ['no' => $no, 'username' => $this->invite_username[$no], 'email' => $this->invite_useremail[$no], 'error' => 'This is not valid email.']);
                    return response()->json([]);
                    die();
                }

                // 86a2qxw15
                $exclude_domains = array('gmail.com', 'yahoo.com', 'hotmail.com', 'aol.com', 'mailinator.com', 'yopmail.com', 'example.com', 'test.com', 'outlook.com', 'icloud.com', 'live.com', 'protonmail.com', 'zoho.com', 'gmx.com', 'inbox.com');
                $exp_umail = explode('@', $this->invite_useremail[$no]);

                $parent_umail = explode('@', Auth::user()->email);
                // matching email server to parent users mail server
                  if ($parent_umail[1]!=$exp_umail[1]) {
                    $this->dispatchBrowserEvent('validate-invite', ['no' => $no, 'username' => $this->invite_username[$no], 'email' => $this->invite_useremail[$no], 'error' => 'Email must match parent account\'s mail server.']);return response()->json([]);
                    die();
                }

                if($this->invite_username[$no] != '' && $this->invite_useremail[$no] != '') {
                    if(!empty(User::where('email',$this->invite_useremail[$no])->first())) {
                        $this->dispatchBrowserEvent('validate-invite', ['no' => $no, 'username' => $this->invite_username[$no], 'email' => $this->invite_useremail[$no], 'error' => 'User already exists.']);
                        return response()->json([]);
                        die();
                    }
                    $user = Auth::user();
                    $user_name = explode(' ', trim($user->name));
                    $fname = $user_name[0];
                    $lname = isset($user_name[1]) ? $user_name[1] : null;
                    // store invited user

                    $shuffle_string = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                    $verify_token = substr(str_shuffle($shuffle_string),1,16);
                    $userInvited = User::create([
                                'name' => $this->invite_username[$no],
                                'email' => $this->invite_useremail[$no],
                                'profile_photo_path' => '',
                                'provider_id' => '',
                                'provider' => '',
                                //bypasss email verification for social logins
                                'email_verified_at' => Carbon::now(),
                            //   'email_verified_at' => ($ref == 0 && Session::get('user_type')=="employer") ? null : Carbon::now(),
                                'user_type' => 'employer',
                                'reference' => $user->id,
                                'status' => 3,
                                'verify_token' => $verify_token,
                            ]);

                            $data = array( 'name' => $userInvited->name, 'email' => $userInvited->email, 'parent_user' => $user->name, 'invitation_id' => $userInvited->id);

                            \Mail::send(['html'=>'mail.invited_user'], $data, function($message) {
                                $message->to('info@purplestairs.com', 'Purple Stairs')->subject('Invitation to Review and Approve New User Account');
                                $message->from('info@purplestairs.com','Purple Stairs');
                            });

                            // dd($userInvited );
                    $invited = Invited_user::create([
                        'sender_userid' => $user->id,
                        'invited_user_id'=> $userInvited->id,
                        'name' => $this->invite_username[$no],
                        'email' => $this->invite_useremail[$no],
                        'created_at' => date('Y-m-d H:i:s'),
                    ]);
                    // $this->invite_username[$no] = '';
                    // $this->invite_useremail[$no] = '';
                    // $this->invited_list = Invited_user::where('sender_userid', $user->id)->get()->toArray();
                    // $_invited_list = Invited_user::join('users', 'users.id','=','invited_users.invited_user_id')->where('invited_users.sender_userid', Auth::user()->id)->whereNull("invited_users.invited_user_id")->whereNull("users.deleted_at")->get()->toArray();
                    $_invited_list = Invited_user::where('invited_users.sender_userid', Auth::user()->id)->whereNull("invited_users.invited_user_id")->get()->toArray();
                    $joined_user = User::where('reference', Auth::user()->id)->orWhere('id', Auth::user()->id)->get();
                    // task - 8678ffnv3
                    $this->joined_user = [];
                    foreach ($joined_user as $u_key => $juser) {
                        $this->joined_user[] = array(
                            'id' => $juser->id,
                            'name' => $juser->name,
                            'email' => $juser->email,
                            'invited_id' => null,
                            'status' => $juser->status,
                            'created_at' => $juser->created_at,
                        );
                    }

                    foreach ($_invited_list as $i_key => $iuser) {
                        $status = null;
                        if ($iuser['invited_user_id']) {
                            $user = User::find($iuser['invited_user_id']);
                            if($user) $status = $user->status;
                        }
                        $this->joined_user[] = array(
                            'id' => $iuser['invited_user_id'],
                            'name' => $iuser['name'],
                            'email' => $iuser['email'],
                            'invited_id' => $iuser['id'],
                            'status' => ($iuser['invited_user_id']) ? $status : null,
                            'created_at' => $iuser['created_at'],
                        );
                        $this->temp_usersIds[$no] =  $iuser['id'];
                    }

                    $invited_list = $_invited_list;
                    $this->invited_list = $invited_list;
                    // send user invitation
                    $name = explode(' ', trim($this->invite_username[$no])); // task - 86a15vje7
                    $data = array('sender' => $fname, 'name' => $name[0]/*$this->invite_username[$no]*/, 'email' => $this->invite_useremail[$no], 'ref' => $user->id, 'invitation_id' => $invited->id);
                    \Mail::send(['html'=>'mail.invite'], $data, function($message) use ($no) {
                         $message->to($this->invite_useremail[$no], 'Purple Stairs')->subject
                            ('Purple Stairs Invitation');
                         $message->from('info@purplestairs.com','Purple Stairs');
                    });
                    unset($this->invite_username[$no]);
                    unset($this->invite_useremail[$no]);
                    $userData = [
                        'username' => $this->invite_username,
                        'email' => $this->invite_useremail,
                    ];
                    $this->emit('storeUserData', $userData);
                    // $userDataNo = [
                    //     'username' => $this->invite_username[$no],
                    //     'email' => $this->invite_useremail[$no],
                    // ];
                    // $this->emit('storeUserDataNo', $userDataNo);
                    // unset($this->invite_username[$no]);
                    // unset($this->invite_useremail[$no]);
                    // $this->invite_username = $this->invite_username;
                    // $this->invite_useremail = $this->invite_useremail;
                    $this->emit(event: 'updateCC');
                }
            }
        }

        return response()->json();
    }

    public function disableCompanyuser($id)
    {
        $join_user = User::find($id);
        if ($join_user) {
            $join_user->status = 0;
            $join_user->save();
        }

        // task - 86a0xw0v2
        $_key_ = array_search($id, array_column($this->joined_user, 'id'));
        $this->joined_user[$_key_]['status'] = 0;

        session()->flash('success', 'User disabled successfully.');
        $this->manage_user_message = 'Your next subscription payment has been updated.';
        $this->emit(event: 'updateCC');
        $this->dispatchBrowserEvent('close-adduser');
        // return redirect()->route('company.manage.subsciption');
        // return response()->json();
    }

    public function enableCompanyuser($id)
    {
        $join_user = User::find($id);
        if ($join_user) {
            $join_user->status = 1;
            $join_user->save();
        }

        // task - 86a0xw0v2
        $_key_ = array_search($id, array_column($this->joined_user, 'id'));
        $this->joined_user[$_key_]['status'] = 1;

        session()->flash('success', 'User enabled successfully.');
        $this->dispatchBrowserEvent('close-adduser');
        $this->emit(event: 'updateCC');
        // return redirect()->route('company.manage.subsciption');
        // return response()->json();
    }

    public function deleteCompanyuser($id, $type)
    {
        $join_user = User::find($id);
        $_invited_list = Invited_user::where('invited_users.sender_userid', Auth::user()->id)->whereNull("invited_users.invited_user_id")->get()->toArray();
        $tactive_plan_usr= Subscription::where('user_id', Auth::user()->id)->where('status', 1)->orderBy('id', 'desc')->first();
        // $joined_user = User::select('users.id', 'users.email', 'users.status', 'users.created_at', \DB::raw('(IF(users.reference, (select name from invited_users where invited_user_id=users.id), users.name)) as name'))->where('reference', Auth::user()->id)->orWhere('id', Auth::user()->id)->get();
        $remaining_usr=($tactive_plan_usr['number_of_users']-count($_invited_list) );
        // check if exist in invited list
        // task - 86a12jfv8
        if($type == 'invited_id') {
            $_key_ = array_search($id, array_column($this->joined_user, 'invited_id'));
        } else {
            $_key_ = array_search($id, array_column($this->joined_user, 'id'));
        }
        if($_key_ !== false) unset($this->joined_user[$_key_]);
        $this->temp_usersIds = array_filter($this->temp_usersIds, function($e) use ($id) {
            return ($e !== $id);
        });
        //unset($this->temp_usersIds[$id]);
        // task - 86a12jfv8
        if($type == 'invited_id') {
            Invited_user::where('id', $id)->delete();
            $this->dispatchBrowserEvent('delete-user', ['id' => $id,'remianing'=>$remaining_usr]);

        } else {
            Invited_user::where('invited_user_id', $id)->delete();
           $this->dispatchBrowserEvent('delete-user', ['id' => $id,'remianing'=>$remaining_usr]);
        }

        /*if ($invited_row) {
            $invited_row->delete();
        }*/

        if ($join_user) {
            // task - 86a0unjh4
            $join_user->reference = 0;
            $join_user->save();
            // $join_user->delete();

        }


        session()->flash('success', 'User deleted successfully.');
        $this->manage_user_message = 'Your next subscription payment has been updated.';
        $this->emit(event: 'updateCC');
        // $this->dispatchBrowserEvent('close-adduser');
        // return redirect()->route('company.manage.subsciption');
        // return response()->json();
    }

    public function clearMessage()
    {
        $this->manage_user_message = null;
        $this->emit(event: 'updateCC');
        return response()->json();
    }

    public function clearCardModel()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->is_cc_valid = false;
        $this->cc_error = null;
        $this->cc_error_code;
        $this->cc_mon_valid = false;
        $this->cc_mon_error = null;
        $this->cc_yr_valid = false;
        $this->cc_yr_error = null;
        $this->credit_card = null;
        $this->exp_month = null;
        $this->exp_year = null;
        $this->cvv = null;
        // return response()->json();
    }

    public function updateUsers()
    {
        // task - 86a23ebne
        $this->active_cc_error = null;
        // 86a26mmr3
        // $last_num = substr($this->active_credit_card,-4);
        // if($last_num != $this->active_card->card_number) {
        //     $this->active_cc_error = "Please enter default credit card number.";
        //     return response()->json();
        // }
        // 86a26mmr3
        // task - 86a23ebne end

        $period = $this->active_plan['plan_period'];
        $amount = $this->active_plan['plan_amount'];
        // task - 86a0c14rr
        $additional_charge = $amount;
        if ($this->active_plan['plan_id'] == 1) {
            if ($this->active_plan['plan_period'] == 'month') {
                $additional_charge = 50;
            } else {
                $additional_charge = 479;
            }
        } else {
            if ($this->active_plan['plan_period'] == 'month') {
                $additional_charge = 100;
            } else {
                $additional_charge = 949;
            }
        }
        // task - 86a0c14rr end

        $old_number_of_users = $this->active_plan['number_of_users'];
        $new_number_of_users = $this->number_of_users;

        $countable_users = $new_number_of_users;
        // $countable_users = $new_number_of_users - $old_number_of_users;
        $abs_countable_users = abs($countable_users);

        $payable_amount = 0;
        if ($countable_users > 0) {
            // 86a26mnw9
            // if ($period == "month") {
            //     // $payable_amount = $amount * $countable_users; task - 86a0c14rr
            //     $payable_amount = round($additional_charge * $countable_users, 2);
            // } else {
            //     $subscription_dt = ($this->active_plan['plan_id']) ? $this->active_plan['created_dt'] : null;
            //     $ts1 = strtotime($subscription_dt);
            //     $ts2 = strtotime(date('Y-m-d'));

            //     $year1 = date('Y', $ts1); $month1 = date('m', $ts1);
            //     $year2 = date('Y', $ts2); $month2 = date('m', $ts2);

            //     $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
            //     $remaining_mo = ($diff == 0) ? 12 : 12 - $diff;

            //     // $monthly_amount = $amount / 12; task - 86a0c14rr
            //     $monthly_amount = $additional_charge / 12;
            //     $payable_amount = round($monthly_amount * $countable_users * $remaining_mo, 2);
            // }
            $payable_amount = round($additional_charge * $countable_users, 2);
            // end 86a26mnw9
        }

        $client = new \GuzzleHttp\Client();
        $headers = [
            'Content-Type'=> 'application/json',
            'Authorization'=> 'Basic ' . env('PAYAPI_TOKEN')
        ];

        if ($this->active_plan['plan_id'] && $payable_amount > 0) {
            $customer_id = $this->active_plan['customer_id'];
            $user = Auth::user();

            // get default card
            $card = Creditcard::where(['user_id' => $user->id, 'active' => 1])->first();

            // cancel current subscription and create switched subscription
            $current_subscription = Subscription::where('user_id', $user->id)->where('status', 1)->orderBy('id', 'desc')->first();
            // ->update(['status' => 0, 'expiration_date' => date('Y-m-d')]);

            if ($this->active_plan['renewal_id']) {
                $rec_url = env('PAYAPI_URL') . 'recurring-schedules/'.$this->active_plan['renewal_id'];

                try {
                    $rsch_reposnse = $client->request('DELETE', $rec_url, ['headers' => $headers]);
                    $rsch_statusCode = $rsch_reposnse->getStatusCode();
                    $rsch_content = json_decode($rsch_reposnse->getBody(), true);

                    if ($rsch_statusCode == 204) {
                        $message = "The recurring schedule was deleted successfully.";
                    }
                } catch(\GuzzleHttp\Exception\ClientException $e) {
                    // dd($e->getMessage());
                }
            }

            $subscription_dt = $this->active_plan['created_dt'];
            $time = strtotime($subscription_dt);
            $next_run_date = date('Y-m-d', strtotime("+1 month", $time));
            if ($subscription_dt) {
                if($period == "month") {
                    $next_run_date = date('Y-m-d', strtotime("+1 month", $time));
                } else {
                    $next_run_date = date('Y-m-d', strtotime("+1 year", $time));
                }
            }
            $expiry_date = $next_run_date;

            // create recurring charge for customer
            /* task - 86a23ebne $recurring_url = env('PAYAPI_URL') . 'customers/'.$customer_id.'/recurring-schedules';

            $recurring_data = '{
                "title": "Subscription change for : '.$customer_id.'",
                "frequency": "daily",
                "amount": '.$payable_amount.',
                "next_run_date": "'.date('Y-m-d').'",
                "num_left": 1,
                "payment_method_id": '.$card->payment_method_id.',
                "active": true,
                "receipt_email": "'.$user->email.'",
                "use_this_source_key": false
            }';

            $rec_reposnse = $client->request('POST', $recurring_url, ['body' => $recurring_data, 'headers' => $headers]);
            $rec_statusCode = $rec_reposnse->getStatusCode();
            $rec_content = json_decode($rec_reposnse->getBody(), true);
            $recurring_id = isset($rec_content['id']) ? $rec_content['id'] : 0;*/
            $api_url = env('PAYAPI_URL') . "transactions/charge";
            $cardNo = str_replace("-", "", $this->active_credit_card);
            // 86a26mmr3
            $body = '{
                    "amount": ' . $payable_amount . ',
                    "source":"pm-'.$card->payment_method_id.'"
                }';
             // 86a26mmr3

            $rec_reposnse = $client->request('POST', $api_url, ['body' => $body, 'headers' => $headers]);
            $rec_statusCode = $rec_reposnse->getStatusCode();
            $rec_content = json_decode($rec_reposnse->getBody(), true);
            // task - 86a23ebne end

            $next_rec_id = 0;
            if(/*task - 86a23ebne $recurring_id*/$rec_content['status'] == "Approved" && $current_subscription->auto_renew) {
                // create next recurring schedule for annully/monthly
                $recurring_url = env('PAYAPI_URL') . 'customers/'.$customer_id.'/recurring-schedules';

                $recurring_data = '{
                    "title": "Subscription change for : '.$customer_id.'",
                    "frequency": "'.($period == "month" ? 'monthly' : 'annually').'",
                    "amount": '.($amount * $this->number_of_users).',
                    "next_run_date": "'.$next_run_date.'",
                    "num_left": 0,
                    "payment_method_id": '.$card->payment_method_id.',
                    "active": true,
                    "receipt_email": "'.$user->email.'",
                    "use_this_source_key": false
                }';

                $nrec_reposnse = $client->request('POST', $recurring_url, ['body' => $recurring_data, 'headers' => $headers]);
                $nrec_statusCode = $nrec_reposnse->getStatusCode();
                $nrec_content = json_decode($nrec_reposnse->getBody(), true);

                $next_rec_id = isset($nrec_content['id']) ? $nrec_content['id'] : 0;
            }

            $new_subscription = array(
                'user_id' => Auth::user()->id,
                'plan_id' => $this->active_plan['plan_id'],
                'plan_amount' => $amount,
                'plan_period' => $period,
                'auto_renew' => $current_subscription->auto_renew,
                'number_of_users' => ($old_number_of_users+$new_number_of_users),
                'per_user_amount' => $amount,
                'coupon_code' => null,
                'discount' => null,
                'customer_id' => $customer_id,
                // 'created_dt' => date('Y-m-d H:i:s'),
                'created_dt' => $current_subscription->created_dt,
                'status' => 1,
                // 'renewal_id' => $recurring_id,
                // 'expiration_date' => ($recurring_id > 0 ? null : $expiry_date),
                'renewal_id' => $next_rec_id,
                'expiration_date' => ($next_rec_id > 0 ? null : $expiry_date),
            );

            // \DB::enableQueryLog();
            $new_subscription_arr = Subscription::create($new_subscription);

            $current_subscription->status = 0;
            $current_subscription->expiration_date = date('Y-m-d');
            $current_subscription->save();

            // if auto renewal then create recurring table entry
            if($current_subscription->auto_renew) {
                \DB::table('recurring_subscription')->insert([
                    [
                        'user_id' => Auth::user()->id,
                        'subscription_id' => $new_subscription_arr->id,
                        'created_dt' => date('Y-m-d H:i:s')
                    ],
                ]);
            }

            if ($payable_amount > 0) {
                $transaction = array(
                    'user_id' => Auth::user()->id,
                    'subscription_id' => $new_subscription_arr->id,
                    'per_user_amount' => $amount,
                    'card_id' => $card->id,
                    'card_number' => substr($card->card_number, -4),
                    'coupon_code' => null,
                    'discount' => null,
                    'tax' => 0,
                    'subtotal' => $payable_amount,
                    'total' => $payable_amount,
                    'transaction_id' => $rec_content['reference_number'], // task - 86a23ebne
                    // 'transaction_id' => 0,
                    // 'recurring_id' => $recurring_id,
                    'customer_id' => $customer_id,
                    'created_dt' => date('Y-m-d h:i:s'),
                    'status' => (!empty($rec_content['transaction']['status_details']['status'])?$rec_content['transaction']['status_details']['status']:null),
                );
                Transaction::create($transaction);
            }

            $this->dispatchBrowserEvent('close-manageusers');
            session()->flash('success', 'Number of users has been updated and payments have been adjusted.');
        }
        session()->flash('success', 'Number of users has been updated and payments have been adjusted.');



        return redirect()->route('company.manage.subsciption');
    }

    public function update_amount_onusers() {
        $period = $this->active_plan['plan_period'];
        $amount = $this->active_plan['plan_amount'];

        $old_number_of_users = $this->active_plan['number_of_users'];
        $new_number_of_users = $this->number_of_users;

        // task - 86a0y5xdh
        if ($this->active_plan['plan_id'] == 1) {
            if ($this->active_plan['plan_period'] == 'month') {
                $additional_charge = 50;
            } else {
                $additional_charge = 479;
            }
        } else {
            if ($this->active_plan['plan_period'] == 'month') {
                $additional_charge = 100;
            } else {
                $additional_charge = 949;
            }
        }

        $countable_users = $new_number_of_users;
        $abs_countable_users = abs($countable_users);

        $payable_amount = 0;
        if ($countable_users > 0) {
                        // 86a26mnw9
            // if ($period == "month") {
            //     // $payable_amount = $amount * $countable_users; task - 86a0c14rr
            //     $payable_amount = round($additional_charge * $countable_users, 2);
            // } else {
            //     $subscription_dt = ($this->active_plan['plan_id']) ? $this->active_plan['created_dt'] : null;
            //     $ts1 = strtotime($subscription_dt);
            //     $ts2 = strtotime(date('Y-m-d'));

            //     $year1 = date('Y', $ts1); $month1 = date('m', $ts1);
            //     $year2 = date('Y', $ts2); $month2 = date('m', $ts2);

            //     $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
            //     $remaining_mo = ($diff == 0) ? 12 : 12 - $diff;

            //     // $monthly_amount = $amount / 12; task - 86a0c14rr
            //     $monthly_amount = $additional_charge / 12;
            //     $payable_amount = round($monthly_amount * $countable_users * $remaining_mo, 2);
            // }
            $payable_amount = round($additional_charge * $countable_users, 2);
            // end 86a26mnw9
        }
        $this->price_on_number_of_users = $payable_amount;

        return response()->json();
    }

    public function updateInvitation($id, $email)
    {
        // dd($id);
        if ($email == '') { // task - 86a12jfv8
            $this->dispatchBrowserEvent('disable-reassign-input', ['id' => $id, 'email' => $email, 'error' => 'This field is required.']);
            return response()->json([]);
            die();
        }

        // task - 86a12jfv8
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->dispatchBrowserEvent('disable-reassign-input', ['id' => $id, 'email' => $email, 'error' => 'This is not valid email.']);
            return response()->json([]);
            die();
        }

        $invite = Invited_user::find($id);
        if($invite->email != $email) {
            $invite->email = $email;
            $invite->save();

            $user = Auth::user();
            $user_name = explode(' ', trim($user->name));
            $fname = $user_name[0];
            $lname = isset($user_name[1]) ? $user_name[1] : null;

            // task - 86a0y6bwz
            $_key_ = array_search($id, array_column($this->joined_user, 'invited_id'));
            if ($_key_ !== false) $this->joined_user[$_key_]['email'] = $email;

            // send user invitation
            $data = array('sender' => $fname, 'name' => $invite->name, 'email' => $email, 'ref' => $user->id, 'invitation_id' => $invite->id);
            \Mail::send(['html'=>'mail.invite'], $data, function($message) use ($email) {
                 $message->to($email, 'Purple Stairs')->subject
                    ('Purple Stairs Invitation');
                 $message->from('info@purplestairs.com','Purple Stairs');
            });
        }
        $this->dispatchBrowserEvent('disable-reassign-input', ['id' => $id, 'email' => $email, 'error' => '']);
    }
    public function updateInputValue($newValue,$no) {
        $this->invite_useremail[$no] = $newValue;
     }


}

