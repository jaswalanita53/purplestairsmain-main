<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Rules\ValidUSZipCode;
use App\Rules\ValidUrl;

class CompanyStep1 extends Component
{
    public $employer_name,
           $company_name,
           $company_city,
           $company_state,
           $company_email,
           $company_address,
           $zip_code,
           $company_phone,
           $website_url,
           $all_states,
           $social_media_url;

    public function mount(){
        $company = Company::where('user_id',Auth::user()->id)->first();
        $this->all_states = \DB::table('states')->pluck('code', 'name')->toArray();
        if(isset($company)){
            $this->employer_name = Auth::user()->name;
            $this->company_name = $company->company_name;
            $this->company_city = $company->company_city;
            $this->company_state = $company->company_state;
            $this->company_email = $company->company_email;
            $this->company_address = $company->company_address;
            $this->zip_code = $company->zip_code;
            $this->company_phone = $company->company_phone;
            $this->website_url = $company->website_url;
            $this->social_media_url = $company->social_media_url;
        }
    }

    public function updated($property)
    {
        $this->resetErrorBag($property);
        $this->resetValidation($property);
        // dd($property);
        /*if (array_key_exists($property, $this->rules())) {
            $this->validateOnly($property);
            if ($this->getErrorBag()->any()) {
                // Validation failed, so don't auto-save
                return;
            }
        }


        $this->autoSave($property);*/
    }

    protected function rules(){
        return [

            'employer_name' => ['required'],
            'company_name' => ['required'],
            'company_city' => ['required'],
            'company_state' => ['required'],
            'company_email' => ['required', 'string', 'email', 'max:255'],
            'company_address'=>['required'],
            'zip_code' => ['required', new ValidUSZipCode],
            'company_phone'=>['required','regex:/^(\d{3}-|\(\d{3}\)[- ]?)?\d{3}[- ]?\d{4}$/'],

            // 'website_url' => new ValidUrl,
            // 'social_media_url' => new ValidUrl,
        ];
    }

    /*public function autoSave($property){
        //get the current user company information
        $company = Company::where('user_id',Auth::user()->id)->first();
        $user = Auth::user();
        //check if the company information present
        if(isset($company)){

            // task - 8678ffjx0
            if($property == 'zip_code'){
                //get address from zip code
                $client = new Client(['base_uri' => 'https://api.zippopotam.us/']);
                try {
                    $response = $client->request('GET', 'US/'.$this->zip_code);
                    $data = json_decode($response->getBody(), true);
                } catch (\Throwable $th) {
                    //throw $th;
                }

                if(isset($data)){
                    $company->lat = $data['places'][0]['latitude'] ? $data['places'][0]['latitude'] : '';
                    $company->lng = $data['places'][0]['longitude'] ? $data['places'][0]['longitude'] : '';
                    $company->save();
                }
            }
            // task - 8678ffjx0 end

            if ($property == "employer_name") {
                $company->name = $this->employer_name;
                $user->name = $this->employer_name;

                    $user = User::find(Auth::id());
                    if($property == 'employer_name'){
                        $user->name=$company->name;
                    }
                    $user->save();

            } else {
                $company->$property = $this->$property;
                $company->save();
            }
        }
        $user->current_step = 1;
        if($user->step_reached<1){
            $user->step_reached=1;
        }
        $user->save();


    }*/

    public function saveProfile(){
        $this->resetErrorBag();
        $this->resetValidation();
        $this->validate();

        $company = Company::where('user_id',Auth::user()->id)->first();
        $user = Auth::user();
        if(isset($company)){
            // $personal->$property = $this->$property;
            // $company->employer_name = $this->employer_name;
            $company->company_name = $this->company_name;
            $company->company_city = $this->company_city;
            $company->company_state = $this->company_state;
            // $company->company_email = $this->company_email;
            $company->company_address = $this->company_address;
            $company->zip_code = $this->zip_code;
            if($this->zip_code){
                //get address from zip code
                $client = new Client(['base_uri' => 'https://api.zippopotam.us/']);
                try {
                    $response = $client->request('GET', 'US/'.$this->zip_code);
                    $data = json_decode($response->getBody(), true);
                } catch (\Throwable $th) {
                    //throw $th;
                }

                if(isset($data)){
                    $company->lat = $data['places'][0]['latitude'] ? $data['places'][0]['latitude'] : '';
                    $company->lng = $data['places'][0]['longitude'] ? $data['places'][0]['longitude'] : '';
                                   }
            }
            // task - 8678ffjx0 end
            $user = User::find(Auth::id());
            if ($this->employer_name) {
                // $company->company_name = $this->employer_name;
                $user->name = $this->employer_name;
                $user->save();


            }
            $company->company_phone = $this->company_phone;
            $company->website_url = $this->website_url;
            $company->social_media_url = $this->social_media_url;

            $company->save();



        }
        $user->current_step = 1;
        if($user->step_reached<1){
            $user->step_reached=1;
        }
        $user->save();

        create_employer_contact($user, true); // task - 86a3d37f9
        
        return redirect()->route('companystep2');
    }

    public function render()
    {
        return view('livewire.company-step1');
    }
}
