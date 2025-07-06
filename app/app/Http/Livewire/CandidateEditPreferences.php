<?php

namespace App\Http\Livewire;

use App\Models\Industry;
use App\Models\Interest;
use App\Models\Personal;
use App\Models\Salary;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CandidateEditPreferences extends Component
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
        $distance,
        $work_env_error = null, // task - 86a0f55k0
        $schedule_error = null, // task - 86a0f55k0
        $compensation_error = null, // task - 86a0f55k0
        $prefered_benefits_error = null, // task - 86a0f55k0
        $all_salaries;

    public $is_save = false;

    public function mount()
    {
        //getting all industries and authenticated users industries
        $this->all_industries = Industry::where('status', 1)->orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $this->selectedIndustries = Auth::user()->industries()->where('primary_status', '0')->pluck('industries.id')->toArray();
        $this->selectedPrimaryIndustry = Auth::user()->industries()->where('primary_status', '1')->pluck('industries.id')->first();

        //getting all interests and authenticated users interests
        $this->all_interests = Interest::orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $this->selectedInterests = Auth::user()->interests()->pluck('interests.id')->toArray();
        //getting all salaries and authenticated users hard skills
        $this->all_salaries = Salary::where('status', 1)->pluck('id', 'name')->toArray();


        $personal = Personal::where('user_id', Auth::user()->id)->first();
        if (isset($personal)) {
            $this->salary_range = $personal->salary_range;
            $this->work_environment_remote = $personal->work_environment_remote;
            $this->work_environment_in_office = $personal->work_environment_in_office;
            $this->work_environment_hybrid = $personal->work_environment_hybrid;
            $this->schedule_full_time = $personal->schedule_full_time;
            $this->schedule_part_time = $personal->schedule_part_time;
            $this->schedule_no_preference = $personal->schedule_no_preference;
            $this->compensation_salary = $personal->compensation_salary;
            $this->compensation_hourly = $personal->compensation_hourly;
            $this->compensation_comission_based = $personal->compensation_comission_based;
            $this->prefered_benefits_insurance_benefits = $personal->prefered_benefits_insurance_benefits;
            $this->prefered_benefits_padi_holidays = $personal->prefered_benefits_padi_holidays;
            $this->prefered_benefits_paid_vacation_days = $personal->prefered_benefits_paid_vacation_days;
            $this->prefered_benefits_professional_environment = $personal->prefered_benefits_professional_environment;
            $this->prefered_benefits_casual_environment = $personal->prefered_benefits_casual_environment;
            $this->distance = $personal->distance;
        }
    }

    protected function rules()
    {
        return [
            'selectedIndustries' => ['required'],
            'selectedPrimaryIndustry' => ['required'],
            'selectedInterests' => ['required'],
            'salary_range' => ['required'],
        ];
    }

    public function updated($property)
    {   
        if($this->is_save) { $this->validateOnly($property); }
        // task - 86a0f55k0
        /*task - 86a0hxg00 if (in_array($property, ['work_environment_remote', 'work_environment_in_office', 'work_environment_hybrid'])) {
            $this->work_env_error = null;
            if (!$this->work_environment_remote && !$this->work_environment_in_office && !$this->work_environment_hybrid) {
                return $this->work_env_error = 'This field is required.';
                die();
            }
        }

        if (in_array($property, ['schedule_full_time', 'schedule_part_time', 'schedule_no_preference'])) {
            $this->schedule_error = null;
            if (!$this->schedule_full_time && !$this->schedule_part_time && !$this->schedule_no_preference) {
                return $this->schedule_error = 'This field is required.';
                die();
            }
        }

        if (in_array($property, ['compensation_salary', 'compensation_hourly', 'compensation_comission_based'])) {
            $this->compensation_error = null;
            if (!$this->compensation_salary && !$this->compensation_hourly && !$this->compensation_comission_based) {
                return $this->compensation_error = 'This field is required.';
                die();
            }
        }
        // task - 86a0f55k0 end

        if (array_key_exists($property, $this->rules())) {
            $this->validateOnly($property);
            if ($this->getErrorBag()->any()) {
                // Validation failed, so don't auto-save
                return;
            }
        }
        $this->autoSave($property);*/

        if($property == 'selectedIndustries'){
            $this->dispatchBrowserEvent('keep-open-industries');
        } elseif($property == 'selectedInterests'){
            $this->dispatchBrowserEvent('keep-open-interests');
        } else {
            $this->dispatchBrowserEvent('close-multiselect');
        }
        // dd($property);
        $this->dispatchBrowserEvent('init-select');
    }

    /* task - 86a0f55k0 public function autoSave($property)
    {
        //get the current user personal information
        $personal = Personal::where('user_id', Auth::user()->id)->first();
        //check if the personal information present create if not.
        if ($property == 'selectedIndustries') {
            Auth::user()->industries()->sync($this->selectedIndustries);
        }
        if ($property == 'selectedInterests') {
            Auth::user()->interests()->sync($this->selectedInterests);
        }
        if (isset($personal)) {
            if ($property !== 'selectedIndustries' && $property !== 'selectedInterests') {
                $personal->$property = $this->$property;
                $personal->save();
            }
        } else {
        }

        if($property == 'selectedIndustries'){
            $this->dispatchBrowserEvent('keep-open-industries');
        } elseif($property == 'selectedInterests'){
            $this->dispatchBrowserEvent('keep-open-interests');
        } else {
            $this->dispatchBrowserEvent('close-multiselect');
        }
    }*/
    public function savePreference()
    {
        $this->is_save = 1;
        // task - 86a0hxg00
        $this->validate();


        $this->work_env_error = null;
        if (!$this->work_environment_remote && !$this->work_environment_in_office && !$this->work_environment_hybrid) {
            return $this->work_env_error = 'This field is required.';
            die();
        }

        $this->schedule_error = null;
        if (!$this->schedule_full_time && !$this->schedule_part_time && !$this->schedule_no_preference) {
            return $this->schedule_error = 'This field is required.';
            die();
        }

        $this->compensation_error = null;
        if (!$this->compensation_salary && !$this->compensation_hourly && !$this->compensation_comission_based) {
            return $this->compensation_error = 'This field is required.';
            die();
        }

        $personal = Personal::where('user_id', Auth::user()->id)->first();

        Auth::user()->industries()->detach(Auth::user()->industries->pluck('id')->toArray());
        // dd(Auth::user()->industries->pluck('id')->toArray(), $this->selectedIndustries);
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

        Auth::user()->interests()->detach(Auth::user()->interests->pluck('id')->toArray());
        Auth::user()->interests()->sync($this->selectedInterests);

        if (isset($personal)) {
            $personal->work_environment_remote = $this->work_environment_remote;
            $personal->work_environment_in_office = $this->work_environment_in_office;
            $personal->work_environment_hybrid = $this->work_environment_hybrid;
            $personal->schedule_full_time = $this->schedule_full_time;
            $personal->schedule_part_time = $this->schedule_part_time;
            $personal->schedule_no_preference = $this->schedule_no_preference;
            $personal->compensation_salary = $this->compensation_salary;
            $personal->compensation_hourly = $this->compensation_hourly;
            $personal->compensation_comission_based = $this->compensation_comission_based;
            $personal->salary_range = $this->salary_range;
            $personal->prefered_benefits_insurance_benefits = $this->prefered_benefits_insurance_benefits;
            $personal->prefered_benefits_padi_holidays = $this->prefered_benefits_padi_holidays;
            $personal->prefered_benefits_paid_vacation_days = $this->prefered_benefits_paid_vacation_days;
            $personal->prefered_benefits_professional_environment = $this->prefered_benefits_professional_environment;
            $personal->prefered_benefits_casual_environment = $this->prefered_benefits_casual_environment;
            $personal->distance = $this->distance;
            $personal->save();

            $this->is_save = 0;
            request()->session()->flash('message', 'Profile updated!');
            // $this->dispatchBrowserEvent('close-multiselect'); // task - 86a0f56n4
            return redirect(route("candidates.editpreferences"));
        }
    }
    public function render()
    {
        return view('livewire.candidate-edit-preferences');
    }

    //task - 86a0jby08
    public function validateProfile() {
        $errors = (new CandidateEditResume)->getValidated();

        if(!empty($errors['end_year_error']) || !empty($errors['employment_end_year_error'])) {
            return redirect('/candidate/edit/resume?navigate=error');
        } else {
            return redirect(route("candidateProfile"));
        }
    }
}
