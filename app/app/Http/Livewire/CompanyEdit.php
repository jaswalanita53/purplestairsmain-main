<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\User;
use App\Models\Delete;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithFileUploads;
use App\Rules\ValidUSZipCode;


class CompanyEdit extends Component
{
    use WithFileUploads;

    public $profile;
    public $profile_path;
    public $company_name,
        $company_email,
        $company_address,
        $zip_code,
        $company_city,
           $company_state,
        $company_phone,
        $website_url,
        $social_media_url,

        $all_states,
        $number_of_employees,
        $insurance_benefits,
        $paid_holidays,
        $paid_vacation_days,
        $professional_environment,
        $casual_environment,
        $company_description;
    public $showImage = true;


    public function mount()
    {
        $company = Company::where('user_id', Auth::user()->id)->first();
        $this->all_states = \DB::table('states')->pluck('code', 'name')->toArray();
        if (isset($company)) {
            $this->company_name = $company->company_name;
            $this->company_email = $company->company_email;
            $this->company_address = $company->company_address;
            $this->zip_code = $company->zip_code;
            $this->company_city = $company->company_city;
            $this->company_state = $company->company_state;
            $this->company_phone = $company->company_phone;
            $this->website_url = $company->website_url;
            $this->social_media_url = $company->social_media_url;

            $this->number_of_employees = $company->number_of_employees;
            $this->insurance_benefits = $company->insurance_benefits;
            $this->paid_holidays = $company->paid_holidays;
            $this->paid_vacation_days = $company->paid_vacation_days;
            $this->professional_environment = $company->professional_environment;
            $this->casual_environment = $company->casual_environment;
            $this->company_description = $company->company_description;
            if(empty($this->profile)){
                $this->profile='';
            }
            if(empty($this->company_description)){
                $this->company_description = '';
            }
        }
        $deleted=Delete::where('user_id',Auth::id())->first();
        // 86a2ggtje
        if(!empty($deleted->status)){
            session()->flash('error', 'Your account has been deactivated.');
            echo "<script>window.location.href = '" . url('/company/manage-account') . "';</script>";
        }
     }

    public function updated($property)
    {
        if (array_key_exists($property, $this->rules())) {
            $this->validateOnly($property);
            if ($this->getErrorBag()->any()) {
                // Validation failed, so don't auto-save
                return;
            }
        }

        $this->autoSave($property);
    }

    protected function rules()
    {
        return [
            'company_name' => ['required'],
            // 'company_email' => ['required', 'string', 'email', 'max:255'],
            'company_address'=>['required'],
            'zip_code' => ['required'],
            'company_city' => ['required'],
            'company_state' => ['required'],
            'company_phone'=>['required','regex:/^(\d{3}-|\(\d{3}\)[- ]?)?\d{3}[- ]?\d{4}$/'],
            'company_description'=>['required'],
            'profile' => ['max:1024'],
            //'company_phone' => ['regex:/^(\d{3}-|\(\d{3}\)[- ]?)?\d{3}[- ]?\d{4}$/'],
            // 'website_url' => 'url',
            // 'social_media_url' => 'url',
        ];
    }

    protected function messages() // task - 8678eggpf
    {
        return [
            'profile.mimes' => 'The :attribute image must be one of these file types: .jpg .bmp .png .gif',
            'profile.size' => 'The :attribute image may not be larger than 1MB',
            'profile.max' => 'The :attribute image may not be larger than 1MB',
        ];
    }

    public function autoSave($property)
    {

        // //get the current user company information
        // $company = Company::where('user_id', Auth::user()->id)->first();
        // //check if the company information present
        // if (isset($company)) {
        //     // $company->$property = $this->$property;
        //     // $company->save();

        //     // task - 8678ffjx0
        //     if($property == 'zip_code'){
        //         //get address from zip code
        //         $client = new Client(['base_uri' => 'https://api.zippopotam.us/']);
        //         try {
        //             $response = $client->request('GET', 'US/'.$this->zip_code);
        //             $data = json_decode($response->getBody(), true);
        //         } catch (\Throwable $th) {
        //             //throw $th;
        //         }

        //         if(isset($data)){
        //             $company->lat = $data['places'][0]['latitude'] ? $data['places'][0]['latitude'] : '';
        //             $company->lng = $data['places'][0]['longitude'] ? $data['places'][0]['longitude'] : '';
        //             $company->save();
        //         }
        //     }
        //     // task - 8678ffjx0 end

        //     if ($property === 'profile') {
        //         //echo 'if';
        //         $path = $this->save();
        //         $file_path = str_replace('public/','storage/app/public/',$path);
        //         //$file_path = str_replace('public/','storage/',$path);
        //         Auth::user()->profile_photo_path = $file_path;
        //         Auth::user()->save();
        //         $this->render();

        //     }
        //     else{
        //         //echo 'else';
        //         // $this->validate();
        //         $company->$property = $this->$property;
        //         if ($property != 'company_email') {
        //         $company->save();
        //         }
        //     }

        // }

        // // $user = Auth::user();
        // // // $user->current_step = 2;
        // // $user->save();
        // $user = User::find(Auth::id());
        // if($property == 'company_name'){
        //     $user->name=$company->company_name;
        // }
        // $user->save();

    }


    public function saveProfile()
    {

        $this->validate([
            'company_name' => ['required'],
            // 'company_email' => ['required', 'string', 'email', 'max:255'],
            'company_address'=>['required'],
            'zip_code' => ['required'],
            'company_city' => ['required'],
            'company_state' => ['required'],
            'company_phone'=>['required','regex:/^(\d{3}-|\(\d{3}\)[- ]?)?\d{3}[- ]?\d{4}$/'],
            'company_description'=>['required'],
            // 'profile' => ['max:1024'],
            //'company_phone' => ['regex:/^(\d{3}-|\(\d{3}\)[- ]?)?\d{3}[- ]?\d{4}$/'],
            // 'website_url' => 'url',
            // 'social_media_url' => 'url',
        ]);
        //get the current user company information
        $company = Company::where('user_id', Auth::user()->id)->first();
        //check if the company information present

        if (isset($company)) {
            // $company->$property = $this->$property;
            // $company->save();

            // task - 8678ffjx0
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
                    $company->save();
                }
            }

            if($this->showImage){
                @unlink(Auth::user()->profile_photo_path);
                    $user = Auth::user();
                        $user->profile_photo_path = null;
                    $user->save();
            }
            // task - 8678ffjx0 end
               // Check if a new profile image has been uploaded
            if ($this->profile) {
                // Remove the existing profile photo from storage and database
                if (Auth::user()->profile_photo_path) {
                    @unlink(Auth::user()->profile_photo_path);
                    Auth::user()->profile_photo_path = null;
                    Auth::user()->save();
                }

                // Save the new profile photo
                $path = $this->save();
                // Extract the file extension
                $file_extension = pathinfo($path, PATHINFO_EXTENSION);
                $allowed_extensions = ['jpg', 'png', 'jpeg'];

                if (in_array($file_extension, $allowed_extensions)) {
                    $file_path = str_replace('public/', 'storage/app/public/', $path);
                    $user = User::find(Auth::id());
                    $user->profile_photo_path = $file_path;
                    $user->save();
                } else {
                    $this->profile = null;
                }
            }

            $company->company_name=$this->company_name ;
            $company->company_address=$this->company_address ;
            $company->zip_code=$this->zip_code ;

            $company->company_city=$this->company_city ;
            $company->company_state=$this->company_state ;
            $company->company_phone=$this->company_phone ;
            $company->website_url=$this->website_url ;
            $company->social_media_url=$this->social_media_url ;

            $company->number_of_employees=$this->number_of_employees ;
            $company->insurance_benefits=$this->insurance_benefits ;
            $company->paid_holidays=$this->paid_holidays ;
            $company->paid_vacation_days=$this->paid_vacation_days ;
            $company->professional_environment=$this->professional_environment ;
            $company->casual_environment=$this->casual_environment ;
            $company->company_description=$this->company_description;

            if($company->save()){
                request()->session()->flash('message', 'Profile updated!');
                $this->dispatchBrowserEvent('scroll-to-success');
                // return redirect(route("company.editprofile"));
            }

        }

        // $user = Auth::user();
        // // $user->current_step = 2;
        // $user->save();
        $user = User::find(Auth::id());
        // if($property == 'company_name'){
        //     $user->name=$company->company_name;
        // }
        $user->save();

    }
    public function save()
    {
        $path = $this->profile->store('public/profile');
        return $path;
    }


    public function render()
    {
        return view('livewire.company-edit');
    }


    public function removeAvatar() {
        if (Auth::user()->profile_photo_path) {
            $showImage = false;


             // $user->profile_photo_path = null;
        //    @unlink(Auth::user()->profile_photo_path);
        //     $user = Auth::user();
        //     $user->profile_photo_path = null;
        //     $user->save();

            // $user=User::find(Auth::id());
            // $user->profile_photo_path=null;
            // $user->save();
        }

        $this->dispatchBrowserEvent('update-avatar');
    }
}
