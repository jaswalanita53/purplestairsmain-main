<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;

class CompanyStep2 extends Component
{
    use WithFileUploads;

    public $profile;
    public $profile_path;

    public $number_of_employees,
           $insurance_benefits,
           $paid_holidays,
           $paid_vacation_days,
           $professional_environment,
           $casual_environment,
           $company_description;

    public function mount(){
        $company = Company::where('user_id',Auth::user()->id)->first();
        if(isset($company)){
            $this->number_of_employees = $company->number_of_employees;
            $this->insurance_benefits = $company->insurance_benefits;
            $this->paid_holidays = $company->paid_holidays;
            $this->paid_vacation_days = $company->paid_vacation_days;
            $this->professional_environment = $company->professional_environment;
            $this->casual_environment = $company->casual_environment;
            $this->company_description = $company->company_description;
        }

        if(empty($this->profile)){
            $this->profile='';
        }
        if(empty($this->company_description)){
            $this->company_description = '';
        }
        $user = Auth::user();
        $user->current_step = 2;
        if($user->step_reached<2){
            $user->step_reached=2;
        }
        $user->save();
    }

    public function updated($property)
    {
        // $this->autoSave($property);
    }
    protected function rules(){

        return [
            'profile' => 'max:1024|mimes:jpg,png,jpeg', // 1MB Max
            'company_description'=>'required'
        ];
    }
    public function autoSave($property){
        //get the current user company information
        $company = Company::where('user_id',Auth::user()->id)->first();
        //check if the company information present
        // if(isset($company)){
        //     if ($property === 'profile') {
        //         $path = $this->save();
        //         $file_path = str_replace('public/','storage/app/public/',$path);
        //         //$file_path = str_replace('public/','storage/',$path);
        //         Auth::user()->profile_photo_path = $file_path;
        //         Auth::user()->save();
        //         $this->render();
        //     }
        // }
        // $user = Auth::user();
        // $user->current_step = 2;
        // if($user->step_reached<2){
        //     $user->step_reached=2;
        // }
        // $user->save();
    }

    protected function messages() // task - 8678eggpf
    {
        return [
            'profile.mimes' => 'The :attribute image must be one of these file types: .jpg .bmp .png .gif',
            'profile.size' => 'The :attribute image may not be larger than 1MB',
            'profile.max' => 'The :attribute image may not be larger than 1MB',
        ];
    }

    public function save()
    {
        $path = $this->profile->store('public/profile');
        return $path;
    }

        public function saveProfile(){

        $this->validate([
            // 'profile' => 'max:1024|mimes:jpg,png,jpeg', // 1MB Max
            'company_description'=>['required']
        ]);

        $company = Company::where('user_id',Auth::user()->id)->first();
        $user = Auth::user();
        if(isset($company)){
            if ($this->profile) {


                $path = $this->save();
                // Extract the file extension
            $file_extension = pathinfo($path, PATHINFO_EXTENSION);
            $allowed_extensions = ['jpg',  'png', 'jpeg'];

            if (in_array($file_extension, $allowed_extensions)) {
                $file_path = str_replace('public/','storage/app/public/',$path);
                //$file_path = str_replace('public/','storage/',$path);
                $user=User::find(Auth::id());
                $user->profile_photo_path=$file_path;
                $user->save();
                Auth::user()->profile_photo_path = $file_path;
                Auth::user()->save();

            }else{
                $this->profile=null;
            }

                $this->render();
            }

            $company->number_of_employees=$this->number_of_employees ;
            $company->insurance_benefits=$this->insurance_benefits ;
            $company->paid_holidays=$this->paid_holidays ;
             $company->paid_vacation_days=$this->paid_vacation_days;
            $company->professional_environment=$this->professional_environment ;
            $company->casual_environment=$this->casual_environment ;
            $company->company_description=$this->company_description ;

            $company->save();

        }
        $user = Auth::user();
        $user->current_step = 2;
        if($user->step_reached<2){
            $user->step_reached=2;
        }
        $user->save();

        return redirect()->route('companystep4');
    }

    public function render()
    {
        return view('livewire.company-step2');
    }

    public function removeAvatar() {
        if (Auth::user()->profile_photo_path) {
            @unlink(Auth::user()->profile_photo_path);
            $user = Auth::user();
            $user->profile_photo_path = null;
            $user->save();
            $this->profile='';
        }

        $this->dispatchBrowserEvent('update-avatar');
    }
}
