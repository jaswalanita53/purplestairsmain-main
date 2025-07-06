<?php

namespace App\Http\Livewire;

use App\Models\Industry;
use App\Models\Interest;
use App\Models\Personal;
use App\Models\Salary;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;

class CandidateStep2 extends Component
{
    public
    $all_industries,
    $selectedIndustries,
    $selectedPrimaryIndustry,
    $all_interests,
    $selectedInterests,
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
    $salary_range,
    $work_environment_remote,
    $work_environment_in_office,
    $work_environment_hybrid,
    $schedule_full_time,
    $schedule_part_time,
    $schedule_no_preference,
    $compensation_salary,
    $compensation_hourly,
    $compensation_comission_based,
    $prefered_benefits_insurance_benefits,
    $prefered_benefits_padi_holidays,
    $prefered_benefits_paid_vacation_days,
    $prefered_benefits_professional_environment,
    $prefered_benefits_casual_environment,
    $all_salaries,
    $distance;
    public $profileSaved = false;
    public function mount()
    {
        //getting all industries and authenticated users industries
        $this->all_industries = Industry::where('status', 1)->orderBy('name', 'asc')->pluck('id', 'name')->toArray();;
        $this->selectedIndustries = Auth::user()->industries()->pluck('industries.id')->toArray();
        $this->selectedPrimaryIndustry = Auth::user()->industries()->where('primary_status', '1')->pluck('industries.id')->first();

        //getting all interests and authenticated users interests
        $this->all_interests = Interest::orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $this->selectedInterests = Auth::user()->interests()->pluck('interests.id')->toArray();

        //getting all salaries and authenticated users hard skills
        $this->all_salaries = Salary::where('status', 1)->pluck('id', 'name')->toArray();


        $personal = Personal::where('user_id', Auth::user()->id)->first();
        if (isset($personal)) {
            $this->salary_range = $personal->salary_range;
            $this->work_environment_remote = $personal -> work_environment_remote;
            $this->work_environment_in_office = $personal -> work_environment_in_office;
            $this->work_environment_hybrid = $personal -> work_environment_hybrid;
            $this->schedule_full_time = $personal -> schedule_full_time;
            $this->schedule_part_time = $personal -> schedule_part_time;
            $this->schedule_no_preference = $personal -> schedule_no_preference;
            $this->compensation_salary = $personal -> compensation_salary;
            $this->compensation_hourly = $personal -> compensation_hourly;
            $this->compensation_comission_based = $personal -> compensation_comission_based;
            $this->prefered_benefits_insurance_benefits = $personal -> prefered_benefits_insurance_benefits;
            $this->prefered_benefits_padi_holidays = $personal -> prefered_benefits_padi_holidays;
            $this->prefered_benefits_paid_vacation_days = $personal -> prefered_benefits_paid_vacation_days;
            $this->prefered_benefits_professional_environment = $personal -> prefered_benefits_professional_environment;
            $this->prefered_benefits_casual_environment = $personal -> prefered_benefits_casual_environment;
            $this->distance = $personal->distance;
        }

        $user = User::find(Auth::user()->id); // Task #86a0hfczk
        $user->current_step = 2;
        if($user->step_reached<2){
            $user->step_reached=2;
        }
        $user->save();
    }

    public function updated($property)
    {
        // $this->autoSave($property);  task - 86a0hxg00
        $this->profileSaved = false;
        if($property == 'selectedIndustries'){
            $this->dispatchBrowserEvent('keep-open-industries');
        } elseif ($property == 'selectedInterests') {
            $this->dispatchBrowserEvent('keep-open-interests');
        } else {
            $this->dispatchBrowserEvent('close-multiselect');
        }
    }

    protected function rules(){
        return [
            'selectedIndustries' => ['required'],
            'selectedInterests' => ['required'],
            'salary_range' => ['required'],
            'selectedPrimaryIndustry' => ['required'],
        ];
    }

    public function finish_later() {
        $personal =Personal::where('user_id',Auth::user()->id)->first();


        Auth::user()->industries()->sync($this->selectedIndustries);
        Auth::user()->interests()->sync($this->selectedInterests);

        // dd($this);
        if(isset($personal)){
            $personal->salary_range = $this->salary_range;
            if($personal->work_environment_remote != "") { $personal->work_environment_remote = $this->work_environment_remote; }
            if($personal->work_environment_in_office != "") { $personal->work_environment_in_office = $this->work_environment_in_office; }
            if($personal->work_environment_hybrid != "") { $personal->work_environment_hybrid = $this->work_environment_hybrid; }
            if($personal->schedule_full_time != "") { $personal->schedule_full_time = $this->schedule_full_time; }
            if($personal->schedule_part_time != "") { $personal->schedule_part_time = $this->schedule_part_time; }
            if($personal->schedule_no_preference != "") { $personal->schedule_no_preference = $this->schedule_no_preference; }
            if($personal->compensation_salary != "") { $personal->compensation_salary = $this->compensation_salary; }
            if($personal->compensation_hourly != "") { $personal->compensation_hourly = $this->compensation_hourly; }
            if($personal->compensation_comission_based != "") { $personal->compensation_comission_based = $this->compensation_comission_based; }
            if($personal->prefered_benefits_insurance_benefits != "") { $personal->prefered_benefits_insurance_benefits = $this->prefered_benefits_insurance_benefits; }
            if($personal->prefered_benefits_padi_holidays != "") { $personal->prefered_benefits_padi_holidays = $this->prefered_benefits_padi_holidays; }
            if($personal->prefered_benefits_paid_vacation_days != "") { $personal->prefered_benefits_paid_vacation_days = $this->prefered_benefits_paid_vacation_days; }
            if($personal->prefered_benefits_professional_environment != "") { $personal->prefered_benefits_professional_environment = $this->prefered_benefits_professional_environment ; }
            if($personal->prefered_benefits_casual_environment != "") { $personal->prefered_benefits_casual_environment = $this->prefered_benefits_casual_environment; }
            if($personal->distance != "") { $personal->distance = $this->distance; }
            $this->profileSaved = true;
            $personal->save();
        }

        //return redirect()->route('candidatestep3');
    }

// public function autoSave($property){ task - 86a0hxg00
public function savePreference(){
    // $this->validate();
    //get the current user personal information
    $personal =Personal::where('user_id',Auth::user()->id)->first();
    $user = Auth::user();
        $selectedIndustries = $this->selectedIndustries;
        $user->industries()->detach();
        if(!empty($this->selectedPrimaryIndustry)){
                   $user->industries()->attach($this->selectedPrimaryIndustry, ['primary_status' => '1']);
          }
        foreach ($selectedIndustries as $industryId) {
                    $indUser=\DB::table('industry_user')
                    ->where('user_id',$user->id)
                    ->where('industry_id', $industryId)
                    ->first();
                    if(empty($indUser)){
                   $user->industries()->attach($industryId, ['primary_status' => '0']);
                }
        }
    // }
    // if($property == 'selectedInterests'){
        Auth::user()->interests()->sync($this->selectedInterests);
    // }

    if(isset($personal)){
        /*if($property !== 'selectedIndustries' && $property !== 'selectedInterests'){
            $personal->$property = $this->$property;
            $personal->save();
        }*/
        $personal->salary_range = $this->salary_range;
        $personal->work_environment_remote = $this->work_environment_remote;
        $personal->work_environment_in_office = $this->work_environment_in_office;
        $personal->work_environment_hybrid = $this->work_environment_hybrid;
        $personal->schedule_full_time = $this->schedule_full_time;
        $personal->schedule_part_time = $this->schedule_part_time;
        $personal->schedule_no_preference = $this->schedule_no_preference;
        $personal->compensation_salary = $this->compensation_salary;
        $personal->compensation_hourly = $this->compensation_hourly;
        $personal->compensation_comission_based = $this->compensation_comission_based;
        $personal->prefered_benefits_insurance_benefits = $this->prefered_benefits_insurance_benefits;
        $personal->prefered_benefits_padi_holidays = $this->prefered_benefits_padi_holidays;
        $personal->prefered_benefits_paid_vacation_days = $this->prefered_benefits_paid_vacation_days;
        $personal->prefered_benefits_professional_environment = $this->prefered_benefits_professional_environment ;
        $personal->prefered_benefits_casual_environment = $this->prefered_benefits_casual_environment;
        $personal->distance = $this->distance;
        $personal->save();
    } else {
    //  Personal::create([
    //      'name' => $this->name,
    //      // 'name_status' => $this->name_status,
    //      // 'email' => $this->email,
    //      // 'email_status' => $this->email_status,
    //      // 'phone' => $this->phone,
    //      // 'phone_status' => $this->phone_status,
    //      // 'current_title' => $this->current_title,
    //      // 'current_title_status' => $this->current_title_status,
    //      // 'zip_code' => $this->zip_code,
    //      // 'zip_code_status' => $this->zip_code_status,
    //      // 'linkedin_url' => $this->linkedin_url,
    //      // 'linkedin_url_status' => $this->linkedin_url_status,
    //      // 'additional_url' => $this->additional_url,
    //      // 'additional_url_status' => $this->additional_url_status
    //      'user_id' => Auth::user()->id
    //      ]);
    }

    return redirect()->route('candidatestep3');
    /*if($property == 'selectedIndustries'){
        $this->dispatchBrowserEvent('keep-open-industries');
    } elseif ($property == 'selectedInterests') {
        $this->dispatchBrowserEvent('keep-open-interests');
    } else {
        $this->dispatchBrowserEvent('close-multiselect');
    }*/
}
    public function render()
    {   $user_country = $this->get_user_country();
        // task - 86a2ggc6v
        if (auth()->user()->id == 1572) {
            $user_country = 'US';
        }
        // task - 86a2ggc6v end
        if($user_country!='US'){
            $this->work_environment_remote=true;
            $this->work_environment_in_office=false;
            $this->work_environment_hybrid=false;
        }
        return view('livewire.candidate-step2',compact('user_country'));
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
