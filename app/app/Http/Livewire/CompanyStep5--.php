<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Subscription;

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
    $auto_renew = 0,
    $discount,
    $discount_code,
    $api_customer_id = 0;

    public $cc_error, $cc_error_code;

    public function render()
    {   
        $this->plan_data = \Session::get('plan');
        return view('livewire.company-step5');
    }

    protected function rules(){
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:255'],
            'credit_card' => ['required', 'string', 'min:14', 'max:16'],
            'cvv' => ['required', 'string'],
            'exp_month' => ['required', 'string', 'max:2'],
            'exp_year' => ['required', 'string', 'min:4'],
        ];
    }

    public function processPayment(){
        $this->validate();
        $this->cc_error = null;
        $this->cc_error_code = null;
        $this->tax = 0;
        $this->amount = $this->plan_data['amount'];
        $this->fine_amount = ($this->tax + $this->amount);
        $this->discount = 0;

        // check card is valid
        $api_url = env('PAYAPI_URL') . "transactions/verify";

        $body = '{
          "card": "'.$this->credit_card.'",
          "expiry_month": '.(int)$this->exp_month.',
          "expiry_year": '.$this->exp_year.'
        }';

        try {
            $content = api_call($api_url, $body, 'POST');

            if ($content['status'] == 'Error') {
                $this->cc_error = $content['error_message'];
                $this->cc_error_code = $content['error_code'];
                $this->is_cc_valid = false;
                die();
            } else {
                $this->is_cc_valid = true;
                // create payment transaction
                $api_url = env('PAYAPI_URL') . "transactions/charge";

                $name_data = explode(' ', trim($this->name));
                $fname = $name_data[0];
                $lname = isset($name_data[1]) ? $name_data[1] : '';
                $body = '{
                    "card": "'.$this->credit_card.'",
                    "expiry_month": '.(int)$this->exp_month.',
                    "expiry_year": '.$this->exp_year.',
                    "amount": "'.$this->amount.'",
                    "cvv2": "'.$this->cvv.'",
                    "amount_details": {
                        "tax": '.$this->tax.',
                        "surcharge": 0,
                        "shipping": 0,
                        "tip": 0,
                        "discount": '.$this->discount.'
                    },
                    "name": "credit card",
                    "billing_info": {
                        "first_name": "'.$fname.'",
                        "last_name": "'.$lname.'",
                        "street": "'.$this->address.'",
                        "city": "'.$this->city.'",
                        "state": "'.$this->state.'",
                        "zip": "'.$this->zipcode.'"
                    }
                }';

                if($this->auto_renew) {
                    $cust_api = env('PAYAPI_URL') . "customers";
                    $FourDigitRandomNumber = rand(0,9999);

                    $customer_data = '{
                        "identifier": "'.trim($this->name).'",
                        "customer_number": "'.$FourDigitRandomNumber.'",
                        "first_name": "'.$fname.'",
                        "last_name": "'.$lname.'",
                        "email": "'.$this->email.'",
                        "billing_info": {
                            "first_name": "'.$fname.'",
                            "last_name": "'.$lname.'",
                            "street": "'.$this->address.'",
                            "state": "'.$this->state.'",
                            "city": "'.$this->city.'",
                            "zip": "'.$this->zipcode.'"
                        }
                    }';

                    $c_content = api_call($cust_api, $customer_data, 'POST');

                    if (isset($c_content['id'])) {
                        $this->api_customer_id = $c_content['id'];

                        $recurring_url = env('PAYAPI_URL') . 'customers/'.$this->api_customer_id.'/recurring-schedules';

                        $frequency = "monthly"; 
                        $time = strtotime(date('Y-m-d'));
                        $next_run_date = date('Y-m-d', strtotime("+1 month", $time));
                        if($this->plan_data['period'] == "month") { 
                            $frequency = "monthly"; 
                            $next_run_date = date('Y-m-d', strtotime("+1 month", $time));
                        }
                        elseif ($this->plan_data['period'] == "year") { 
                            $frequency = "annually"; 
                            $next_run_date = date('Y-m-d', strtotime("+1 year", $time));
                        }

                        $recurring_data = '{                            
                            "title": "Recurring charge for : '.$this->api_customer_id.'",
                            "frequency": "'.$frequency.'",
                            "amount": '.$this->amount.',
                            "next_run_date": "'.$next_run_date.'",
                            "num_left": 0,
                            "payment_method_id": 1,
                            "active": true,
                            "receipt_email": "'.$this->email.'",
                            "use_this_source_key": false
                        }';

                        $rec_content = api_call($recurring_url, $recurring_data, 'POST');
                        if (isset($rec_content['error_message'])) {
                            $messages = array_values($rec_content['error_details']);
                            $error_messages = implode("<br>",array_map(function($a) {return implode("~",$a);},$messages));
                            return redirect('company/payment')->with('error_message', $error_messages);
                        }
                    }
                }

                $_content = api_call($api_url, $body, 'POST');

                if (isset($_content['error_message'])) {
                    $messages = array_values($_content['error_details']);
                    $error_messages = implode("<br>",array_map(function($a) {return implode("~",$a);},$messages));
                    return redirect('company/payment')->with('error_message', $error_messages);
                } elseif ($_content['status'] == "Approved") {                    
                    $subscription = array(
                        'user_id' => Auth::user()->id,
                        'plan_amount' => $this->amount,
                        'plan_period' => $this->plan_data['period'],
                        'auto_renew' => $this->auto_renew,
                        'coupon_code' => $this->discount_code,
                        'discount' => $this->discount,
                        'tax' => $this->tax,
                        'subtotal' => $this->amount,
                        'total' => $this->fine_amount,
                        'transaction_id' => $_content['reference_number'],
                        'customer_id' => $this->api_customer_id,
                        'created_dt' => date('Y-m-d h:i:s'),
                    );

                    Subscription::create($subscription);

                    Auth::user()->status = 1;
                    Auth::user()->save();
                    $this->published = true;
                }
            }

        } catch(\GuzzleHttp\Exception\ClientException $e) {
            dd($e);
        }        
    }

    public function validate_cc()
    {
        if ($this->credit_card && $this->exp_month && $this->exp_year) {
            $api_url = env('PAYAPI_URL') . "transactions/verify";
            $body = '{
              "card": "'.$this->credit_card.'",
              "expiry_month": '.(int)$this->exp_month.',
              "expiry_year": '.$this->exp_year.'
            }';

            $content = api_call($api_url, $body, 'POST');
            if ($content['status'] == 'Error') {
                $this->cc_error = $content['error_message'];
                $this->cc_error_code = $content['error_code'];
                $this->is_cc_valid = false;
                die();
            } else {
                $this->is_cc_valid = true;
                die();
            }
        }
    }
}
