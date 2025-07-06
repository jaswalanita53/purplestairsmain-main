<?php

namespace App\Http\Livewire;

use App\Models\Personal;
use App\Models\User;
use App\Models\ZipCode;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Rules\ValidUSZipCode;



class CandidateStep1 extends Component
{
    public $name,
           $name_status,
           $email,
           $email_status,
           $phone,
           $phone_status,
           $current_title,
           $current_title_status,
           $zip_code,
           $zip_code_status,
           $linkedin_url,
           $linkedin_url_status,
           $additional_url,
           $additional_url_status,
           $country,
           $country_name_status;
    public $inputValue;
    public $finish_btn = "Finish Later";
    public $profileSaved = false;

    public function mount(){
        $personal =Personal::where('user_id',Auth::user()->id)->first();
        if(isset($personal)){
            $this->name = $personal->name;
            $this->name_status = $personal->name_status;
            $this->email = $personal->email;
            $this->email_status = $personal->email_status;
            $this->phone = $personal->phone;
            $this->phone_status = $personal->phone_status;
            $this->current_title = $personal->current_title;
            $this->current_title_status = $personal->current_title_status;
            $this->zip_code = $personal->zip_code;
            $this->zip_code_status = $personal->zip_code_status;
            $this->linkedin_url = $personal->linkedin_url;
            $this->linkedin_url_status = $personal->linkedin_url_status;
            $this->additional_url = $personal->additional_url;
            $this->additional_url_status = $personal->additional_url_status;
            $this->country = $personal->country;
            $this->country_name_status = $personal->country_name_status;

        }
        $user = User::find(Auth::user()->id);
        $user->current_step = 1;
        if($user->step_reached<1){
            $user->step_reached=1;
        }
        $user->save();
        // $this->profileSaved = true;
    }
    public function updated($property)
    {
        $this->profileSaved = false;
        // Set $profileSaved to false whenever any property is updated
        if($property == 'name' || $property == 'email'||$property == 'phone'||$property == 'current_title'||$property == 'zip_code'||$property == 'linkedin_url'||$property == 'additional_url'){
        }
    }
    // public function updatedemail()
    // {
    //     // Set $profileSaved to false whenever any property is updated
    //     $this->profileSaved = false;
    // }
    // public function updatedphone()
    // {
    //     // Set $profileSaved to false whenever any property is updated
    //     $this->profileSaved = false;
    // }
    // public function updatedcurrent_title()
    // {
    //     // Set $profileSaved to false whenever any property is updated
    //     $this->profileSaved = false;
    // }
    // public function updatedzip_code()
    // {
    //     // Set $profileSaved to false whenever any property is updated
    //     $this->profileSaved = false;
    // }
    // public function updatedlinkedin_url()
    // {
    //     // Set $profileSaved to false whenever any property is updated
    //     $this->profileSaved = false;
    // }
    /* task - 86a0hxg00 public function updated($property)
    {
        if (array_key_exists($property, $this->rules())) {
            $this->validateOnly($property);
            if ($this->getErrorBag()->any()) {
                // Validation failed, so don't auto-save
                return;
            }
        }
        if($property!="email"){
            $this->autoSave($property);
        }
    }*/

    protected $messages = [
        'name.required' => 'This field is required.',
        'email.required' => 'This field is required.',
        'zip_code.required' => 'This field is required.',
        'phone.required' => 'This field is required.',
        'current_title.required' => 'This field is required.', // task - 86a2vwxam
    ];

    protected function rules()
    {
        $user_country = $this->get_user_country();
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'current_title' => ['required', 'string', 'max:255'], // task - 86a2vwxam
        ];

        // Check if the user's country is the US
        if ($user_country === 'US') {
            // If yes, add the zip code rule
            $rules['zip_code'] = ['required', new ValidUSZipCode];
            $rules['phone'] = ['required', 'regex:/^(\+1\s\d{3}-\d{3}-\d{4}|\d{3}-\d{3}-\d{4})$/'];
        }else{
            $rules['country'] = ['required','string', 'max:255']; // task - 86a23kgyw
            $rules['phone'] = ['required'];
        }

        return $rules;
    }

    public function finish_later()
    {
        $this->finish_btn = "Finish Later";

        $personal =Personal::where('user_id',Auth::user()->id)->first();
        //check if the personal information present create if not.
        if(isset($personal)){
            $personal->name = $this->name;
            $personal->name_status = $this->name_status;
            $personal->email = $this->email;
            $personal->email_status = $this->email_status;
            $personal->phone = $this->phone;
            $personal->phone_status = $this->phone_status;
            $personal->current_title = $this->current_title;
            $personal->current_title_status = $this->current_title_status;
            $personal->zip_code = $this->zip_code;
            $personal->zip_code_status = $this->zip_code_status;
            $personal->linkedin_url = $this->linkedin_url;
            $personal->linkedin_url_status = $this->linkedin_url_status;
            $personal->additional_url = $this->additional_url;
            $personal->additional_url_status = $this->additional_url_status;
            $personal->country = $this->country;
            $personal->country_name_status = $this->country_name_status;
            $personal->save();
            $this->profileSaved = true;
            $user_country = $this->get_user_country();
            // task - 86a2ggc6v
            if (auth()->user()->id == 1572) {
                $user_country = 'US';
            }
            // task - 86a2ggc6v end
            if ($user_country === 'US') {
            if($this->zip_code){

                //get address from zip code
                $client = new Client(['base_uri' => 'https://api.zippopotam.us/']);
                try {
                    $response = $client->request('GET', 'US/'.$this->zip_code);
                    $data = json_decode($response->getBody(), true);
                    // $address = $data['places'][0]['address'];
                } catch (\Throwable $th) {
                    //throw $th;
                }
                if(isset($data)){
                    $personal->country = $data['country'] ? $data['country'] : '';
                    $personal->country_abbr = $data['country abbreviation'] ? $data['country abbreviation'] : '';
                    $personal->state = $data['places'][0]['state'] ? $data['places'][0]['state'] : '';
                    $personal->state_abbr = $data['places'][0]['state abbreviation'] ? $data['places'][0]['state abbreviation'] : '';
                    $personal->address = $data['places'][0]['place name'] ? $data['places'][0]['place name'] : '';

                    // task - 8678ffjx0
                    $personal->lat = $data['places'][0]['latitude'] ? $data['places'][0]['latitude'] : '';
                    $personal->lng = $data['places'][0]['longitude'] ? $data['places'][0]['longitude'] : '';
                    if(!empty($data['country']) && $personal->country_abbr=='US'){
                        $zipCode = ZipCode::withTrashed()->where('zip_code', $this->zip_code)->first();
                        if (empty($zipCode)) {
                            $zipCode = new ZipCode();
                            $zipCode->state =$data['places'][0]['state'] ?? '';
                            $zipCode->zip_code = $this->zip_code;
                            $zipCode->save();
                        }
                    }
                }
                else{
                    $personal->country = '';
                    $personal->country_abbr = '';
                    $personal->state = '';
                    $personal->state_abbr = '';
                    $personal->address = '';
                    // task - 8678ffjx0
                    $personal->lat = '';
                    $personal->lng = '';
                }
            }
        }

            $personal->save();
        }
        $user = Auth::user();

        $user->current_step = 1;
        if($user->step_reached<1){
            $user->step_reached=1;
        }
        $user->save();

        $user = User::find(Auth::id());
        $user->name=$personal->name;
        $user->save();

        //return redirect()->route('candidatestep2');
    }

    // public function autoSave($property){ task - 86a0hxg00
    public function saveProfile(){
        $this->resetErrorBag();
        $this->resetValidation();

        $this->validate();
        // exit();
        //get the current user personal information
        $personal =Personal::where('user_id',Auth::user()->id)->first();
        //check if the personal information present create if not.
        if(isset($personal)){
            // $personal->$property = $this->$property;
            $personal->name = $this->name;
            $personal->name_status = $this->name_status;
            $personal->email = $this->email;
            $personal->email_status = $this->email_status;
            $personal->phone = $this->phone;
            $personal->phone_status = $this->phone_status;
            $personal->current_title = $this->current_title;
            $personal->current_title_status = $this->current_title_status;
            $personal->zip_code = $this->zip_code;
            $personal->zip_code_status = $this->zip_code_status;
            $personal->linkedin_url = $this->linkedin_url;
            $personal->linkedin_url_status = $this->linkedin_url_status;
            $personal->additional_url = $this->additional_url;
            $personal->additional_url_status = $this->additional_url_status;
            $personal->country = $this->country;

            $personal->country_name_status = $this->country_name_status;
            $personal->save();


            $user_country = $this->get_user_country();

            // task - 86a2ggc6v
            if (auth()->user()->id == 1572) {
                $user_country = 'US';
            }
            // task - 86a2ggc6v end

            if ($user_country === 'US') {

            // if($property == 'zip_code'){

            //get address from zip code
            $client = new Client(['base_uri' => 'https://api.zippopotam.us/']);
            try {
                $response = $client->request('GET', 'US/'.$this->zip_code);
                $data = json_decode($response->getBody(), true);
                // $address = $data['places'][0]['address'];
            } catch (\Throwable $th) {
                //throw $th;
            }
            if(isset($data)){
                $personal->country = $data['country'] ? $data['country'] : '';
                $personal->country_abbr = $data['country abbreviation'] ? $data['country abbreviation'] : '';
                $personal->state = $data['places'][0]['state'] ? $data['places'][0]['state'] : '';
                $personal->state_abbr = $data['places'][0]['state abbreviation'] ? $data['places'][0]['state abbreviation'] : '';
                $personal->address = $data['places'][0]['place name'] ? $data['places'][0]['place name'] : '';

                // task - 8678ffjx0
                $personal->lat = $data['places'][0]['latitude'] ? $data['places'][0]['latitude'] : '';
                $personal->lng = $data['places'][0]['longitude'] ? $data['places'][0]['longitude'] : '';
                if(!empty($data['country']) && $personal->country_abbr=='US'){
                    $zipCode = ZipCode::withTrashed()->where('zip_code', $this->zip_code)->first();
                    if (empty($zipCode)) {
                        $zipCode = new ZipCode();
                        $zipCode->state =$data['places'][0]['state'] ?? '';
                        $zipCode->zip_code = $this->zip_code;
                        $zipCode->save();
                    }
                }
            }
            else{
                $personal->country = '';
                $personal->country_abbr = '';
                $personal->state = '';
                $personal->state_abbr = '';
                $personal->address = '';
                // task - 8678ffjx0
                $personal->lat = '';
                $personal->lng = '';
            }
        }
            // }

            $personal->save();
        }
        $user = Auth::user();

        $user->current_step = 1;
        if($user->step_reached<1){
            $user->step_reached=1;
        }
        $user->save();

        $user = User::find(Auth::id());
        // if($property == 'name'){
            $user->name=$personal->name;
        // }
        $user->save();

        create_candidate_contact($user, true);  // task - 86a3d37f9

        return redirect()->route('candidatestep2');
    }

    public function render()
    {
        $user_country = $this->get_user_country();
        $countries=\DB::table('countries')->get();
        $countries = json_decode($countries, true);
        $countryNames = array_column($countries, 'name','iso');
        return view('livewire.candidate-step1', compact('user_country','countryNames'));
    }



    public function get_user_country()
    {
        // US 69.162.81.157
        // IN 122.176.57.163
        $ip = $_SERVER['REMOTE_ADDR'];

        // Construct the API URL
        $apiUrl = "http://ipinfo.io/" . $ip . "/json";

        // Make a request to ipinfo.io
        $response = file_get_contents($apiUrl);

        // Decode the JSON response
        $data = json_decode($response, true);


        return isset($data['country']) ? $data['country'] : 'Unknown';
    }
}
