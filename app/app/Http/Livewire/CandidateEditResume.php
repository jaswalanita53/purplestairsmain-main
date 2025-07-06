<?php

namespace App\Http\Livewire;

use App\Models\Education;
use App\Models\Employment;
use App\Models\Language;
use App\Models\Personal;
use App\Models\Reference;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class CandidateEditResume extends Component
{
    use WithFileUploads;

    public $educations,
    $education_id,
    $program_name,
    $program_name_status,
    $organization_name,
    $organization_name_status,
    $course_description,
    $course_description_status,
    $start_year,
    $end_year,
    $end_year_error = [],
    $currently_studying,
    $start_year_status,

    //employments
    $employments,
    $employment_id,
    $company_name,
    $company_name_status,
    $position,
    $position_status,
    $responsibilities,
    $responsibilities_status,
    $employment_start_year,
    $employment_end_year,
    $employment_end_year_error = [],
    $employment_start_year_status,
    $accomplishments,
    $currently_working,
    $accomplishments_status,

    //skills
    $all_languages,
    $selectedLanguages,
    $all_soft_skills,
    $selectedSoftSkills,
    $all_hard_skills,
    $selectedHardSkills,
    $hard_skills,
    $hard_skills_status,
    $soft_skills,
    $soft_skills_status,

    //references
    $references,
    $reference_id,
    $name,
    $name_status,
    $relationship,
    $relationship_status,
    $phone,
    $phone_status,
    $email,
    $email_status,
    $reference_name_error = [];

    public $profile;
    public $profile_path;
    public $short_bio,
           $short_bio_status;
    public $profile_status;

    protected $listeners = ['update_pg' => '$refresh'];

    public function add()
    {
         //create a empty education row in database
         $added_edu = Education::create([
            'user_id' => Auth::user()->id
          ]);
          $this->educations = Education::where('user_id',Auth::user()->id)->get();

          // task - 86a0hxg00
          $added_edu = Education::find($added_edu->id);
          $this->program_name[$added_edu->id] = $added_edu->program_name;
          $this->program_name_status[$added_edu->id] = $added_edu->program_name_status;
          $this->organization_name[$added_edu->id] = $added_edu->organization_name;
          $this->organization_name_status[$added_edu->id] = $added_edu->organization_name_status;
          $this->course_description[$added_edu->id] = $added_edu->course_description;
          $this->course_description_status[$added_edu->id] = $added_edu->course_description_status;
          $this->start_year[$added_edu->id] = $added_edu->start_year;
          $this->end_year[$added_edu->id] = $added_edu->end_year;
          $this->end_year_error[$added_edu->id] = null;
          $this->currently_studying[$added_edu->id] = $added_edu->currently_studying;
          $this->start_year_status[$added_edu->id] = $added_edu->start_year_status;


        // Emit the 'newEducationAdded' event
        $this->emit('newEducationAdded');
    }

    public function addEmployment()
    {
        //create a empty employment row in database
        $employment = Employment::create([
            'user_id' => Auth::user()->id
          ]);
          $this->employments = Employment::where('user_id',Auth::user()->id)->get();

          // task - 86a0hxg00
          $employment = Employment::find($employment->id);
          $this->company_name[$employment->id] = $employment->company_name;
          $this->company_name_status[$employment->id] = $employment->company_name_status;
          $this->position[$employment->id] = $employment->position;
          $this->position_status[$employment->id] = $employment->position_status;
          $this->responsibilities[$employment->id] = $employment->responsibilities;
          $this->responsibilities_status[$employment->id] = $employment->responsibilities_status;
          $this->start_year[$employment->id] = $employment->start_year;
          $this->end_year[$employment->id] = $employment->end_year;
          $this->end_year_error[$employment->id] = null;
          $this->currently_working[$employment->id] = $employment->currently_working;
          $this->start_year_status[$employment->id] = $employment->start_year_status;
          $this->accomplishments[$employment->id] = $employment->accomplishments;
          $this->accomplishments_status[$employment->id] = $employment->accomplishments_status;
        $this->employments = Employment::where('user_id',Auth::user()->id)->get();


        // Emit the 'newEmploymentAdded' event
        $this->emit('newEmploymentAdded');
    }

    public function addReference()
    {
        //create a empty reference row in database
        Reference::create([
          'user_id' => Auth::user()->id
        ]);
        $this->references = Reference::where('user_id',Auth::user()->id)->get();
        if(!empty($this->references)){
        foreach($this->references as $reference){
            $this->name[$reference->id] = $reference->name;
            $this->name_status[$reference->id] = $reference->name_status;
            $this->relationship[$reference->id] = $reference->relationship;
            $this->relationship_status[$reference->id] = $reference->relationship_status;
            $this->phone[$reference->id] = $reference->phone;
            $this->phone_status[$reference->id] = $reference->phone_status;
            $this->email[$reference->id] = $reference->email;
            $this->email_status[$reference->id] = $reference->email_status;
        }
        }
        // Emit the 'newReferenceAdded' event
        $this->emit('newReferenceAdded');
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function mount(){
        $this->educations = Education::where('user_id',Auth::user()->id)->get();
        if ($this->educations->count() == 0) {
            //create a empty education row in database
            Education::create([
                'user_id' => Auth::user()->id
            ]);
        }
        else{
            foreach($this->educations as $education){
                $this->program_name[$education->id] = $education->program_name;
                $this->program_name_status[$education->id] = $education->program_name_status;
                $this->organization_name[$education->id] = $education->organization_name;
                $this->organization_name_status[$education->id] = $education->organization_name_status;
                $this->course_description[$education->id] = $education->course_description;
                $this->course_description_status[$education->id] = $education->course_description_status;
                $this->start_year[$education->id] = $education->start_year;
                $this->end_year[$education->id] = $education->end_year;
                $this->end_year_error[$education->id] = null;
                $start_dt = $this->start_year[$education->id];
                $end_dt = $this->end_year[$education->id];

                // task - 86a2nb3dm
                $start_yr = substr($start_dt, -4);
                $new_st_dt = str_replace($start_yr, '', $start_dt);
                $start_mon = substr($new_st_dt, 0, 3);
                if ($start_mon == "") {
                    $start_mon = "Jan";
                }
                $start_dt = $start_mon . " " . $start_yr;

                $end_yr = substr($end_dt, -4);
                $new_ed_dt = str_replace($start_yr, '', $end_dt);
                $end_mon = substr($new_ed_dt, 0, 3);
                if ($end_mon == "" && $education->currently_studying == 1) {
                    $end_mon = "Jan";
                }
                if($education->currently_studying == 1) { $end_dt = ""; } 
                else { $end_dt = $end_mon . " " . $end_yr; }

                $this->start_year[$education->id] = $start_dt;
                $this->end_year[$education->id] = $end_dt;

                $m_start = (int)date('m', strtotime($start_dt)); $m_end = (int)date('m', strtotime($end_dt));
                $y_start = (int)date('Y', strtotime($start_dt)); $y_end = (int)date('Y', strtotime($end_dt));
                $now=strtotime(now());
                if(strtotime($start_dt)>$now){
                   // $this->end_year_error[$education->id] = "Start Month can not be a future Month";
                    // return false; this line generating error
                }
                if(strtotime($end_dt)>$now){
                   // $this->end_year_error[$education->id] = "End Month can not be a future Month";
                    // return false; this line generating error
                }
                if ($start_dt == '' && ($end_dt != '' || $education->currently_studying == 1)) { // task - 8678eghrm
                   // $this->end_year_error[$education->id] = "You must select a start date.";
                }

                if (($y_start > $y_end && $end_dt) || ($y_start==$y_end && ($m_start > $m_end))) {
                    $this->end_year[$education->id] = '';
                   // $this->end_year_error[$education->id] = "End Month Can Not Be Before The Start Month.";
                }

                if($start_dt && (($end_dt == '' || $end_dt == null) && $education->currently_studying == 0)) {
                    //$this->end_year_error[$education->id] = "You must select an end year.";
                }

                $this->currently_studying[$education->id] = $education->currently_studying;
                $this->start_year_status[$education->id] = $education->start_year_status;
            }
        }

        //employments code goes here
        $this->employments = Employment::where('user_id',Auth::user()->id)->get();
        if ($this->employments->count() == 0) {
            //create a empty employment row in database
            Employment::create([
                'user_id' => Auth::user()->id
            ]);
        }
        else{
            foreach($this->employments as $employment){
                $this->company_name[$employment->id] = $employment->company_name;
                $this->company_name_status[$employment->id] = $employment->company_name_status;
                $this->position[$employment->id] = $employment->position;
                $this->position_status[$employment->id] = $employment->position_status;
                $this->responsibilities[$employment->id] = $employment->responsibilities;
                $this->responsibilities_status[$employment->id] = $employment->responsibilities_status;
                $this->employment_start_year[$employment->id] = $employment->start_year;
                $this->employment_end_year[$employment->id] = $employment->end_year;
                $this->employment_end_year_error[$employment->id] = null;
                $start_dt = $this->employment_start_year[$employment->id];
                $end_dt = $this->employment_end_year[$employment->id];

                // task - 86a2nb3dm
                $start_yr = substr($start_dt, -4);
                $new_st_dt = str_replace($start_yr, '', $start_dt);
                $start_mon = substr($new_st_dt, 0, 3);
                if ($start_mon == "") {
                    $start_mon = "Jan";
                }
                $start_dt = $start_mon . " " . $start_yr;

                $end_yr = substr($end_dt, -4);
                $new_ed_dt = str_replace($start_yr, '', $end_dt);
                $end_mon = substr($new_ed_dt, 0, 3);
                if ($end_mon == "" && $employment->currently_working == 1) {
                    $end_mon = "Jan";
                }
                if($employment->currently_working == 1) { $end_dt = ""; } 
                else { $end_dt = $end_mon . " " . $end_yr; }

                $this->employment_start_year[$employment->id] = $start_dt;
                $this->employment_end_year[$employment->id] = $end_dt;

                $m_start = (int)date('m', strtotime($start_dt)); $m_end = (int)date('m', strtotime($end_dt));
                $y_start = (int)date('Y', strtotime($start_dt)); $y_end = (int)date('Y', strtotime($end_dt));
                $now=strtotime(now());
                if(strtotime($start_dt)>$now){
                    $this->employment_end_year_error[$employment->id] = "Start Month can not be a future Month";
                    // return false; this line generating error
                }
                if(strtotime($end_dt)>$now){
                    $this->employment_end_year_error[$employment->id] = "End Month can not be a future Month";
                    // return false; this line generating error
                }

                if ($start_dt == '' && ($end_dt != '' || $employment->currently_working == 1)) { // task - 8678eghrm
                    $this->employment_end_year_error[$employment->id] = "You must select a start date.";
                }

                if (($y_start > $y_end && $end_dt) || ($y_start==$y_end && ($m_start > $m_end))) {
                    $this->employment_end_year[$employment->id] = '';
                    $this->employment_end_year_error[$employment->id] = "End Month Can Not Be Before The Start Month.";
                }

                if($start_dt && (($end_dt == '' || $end_dt == null) && $employment->currently_working == 0)) {
                    $this->employment_end_year_error[$employment->id] = "You must select an end year.";
                }

                $this->currently_working[$employment->id] = $employment->currently_working;
                $this->employment_start_year_status[$employment->id] = $employment->start_year_status;
                $this->accomplishments[$employment->id] = $employment->accomplishments;
                $this->accomplishments_status[$employment->id] = $employment->accomplishments_status;
            }
        }

        // dd($this->employment_end_year_error);
        //getting all languages and authenticated users languages
        $this->all_languages = Language::orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $this->selectedLanguages = Auth::user()->languages()->pluck('languages.id')->toArray();

        //getting all soft skills and authenticated users soft skills
        $this->all_soft_skills = Skill::where('skill_type', 'soft_skills')->orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $this->selectedSoftSkills = Auth::user()->softSkills->pluck('id')->toArray();

        //getting all hard skills and authenticated users hard skills
        $this->all_hard_skills = Skill::where('skill_type', 'hard_skills')->orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $this->selectedHardSkills = Auth::user()->hardSkills->pluck('id')->toArray();

        //references
        $this->references = Reference::where('user_id',Auth::user()->id)->get();
        if ($this->references->count() == 0) {
            //create a empty reference row in database
            Reference::create([
                'user_id' => Auth::user()->id
            ]);
        }
        else{
            foreach($this->references as $reference){
                $this->name[$reference->id] = $reference->name;
                $this->name_status[$reference->id] = $reference->name_status;
                $this->relationship[$reference->id] = $reference->relationship;
                $this->relationship_status[$reference->id] = $reference->relationship_status;
                $this->phone[$reference->id] = $reference->phone;
                $this->phone_status[$reference->id] = $reference->phone_status;
                $this->email[$reference->id] = $reference->email;
                $this->email_status[$reference->id] = $reference->email_status;
            }
        }

        $personal =Personal::where('user_id',Auth::user()->id)->first();
        if(isset($personal)){
            $this->short_bio = $personal->short_bio;
            $this->short_bio_status = $personal->short_bio_status;
            $this->profile_status = $personal->profile_status;
        }
    }

    public function render()
    {
        $this->educations = Education::where('user_id',Auth::user()->id)->get();
        $this->employments = Employment::where('user_id',Auth::user()->id)->get();
        return view('livewire.candidate-edit-resume');
    }

    /*public function updated($property)
    {
        $field_id = explode('.', $property);
        $current_field = $field_id[0];

        /* references updates
        $ref_fields = ['references','name','name_status','relationship','relationship_status','phone','phone_status','email','email_status','selectedHardSkills',
        'selectedSoftSkills',
        'selectedLanguages'];
        if (in_array($current_field, $ref_fields)) {
            if (array_key_exists($property, $this->rules())) {
                $this->validateOnly($property);
                if ($this->getErrorBag()->any()) {
                    // Validation failed, so don't auto-save
                    return;
                }
            }
        }*

        //auto save is not available in edit resume
        if($current_field == 'selectedLanguages') {
            $this->dispatchBrowserEvent('keep-open-language');
        } elseif($current_field == 'selectedSoftSkills') {
            $this->dispatchBrowserEvent('keep-open-soft');
        } elseif($current_field == 'selectedHardSkills') {
            $this->dispatchBrowserEvent('keep-open-hard');
        } else {
            $this->dispatchBrowserEvent('close-multiselect');
        }
    }*/

    protected function rules(){
        $rules = [];

        /*foreach($this->references as $reference){
            $email_rules = ['email' . '.' . $reference->id => ['required', 'string', 'email', 'max:255']];
            $rules = $rules + $email_rules;
            $phone_rules = ['phone' . '.' . $reference->id => ['regex:/^(\d{3}-|\(\d{3}\)[- ]?)?\d{3}[- ]?\d{4}$/']];
            $rules = $rules + $phone_rules;
        }*/
        // 'selectedIndustries' => ['required'],
            // 'selectedInterests' => ['required'],
            // 'salary_range' => ['required'],
            $rules['selectedHardSkills']=['required'];
            $rules['selectedSoftSkills']=['required'];
        // $rules['selectedLanguages']=['required'];

        return $rules;
    }

    public function validationAttributes()
    {
        $validation_attributes = [];

        foreach($this->references as $reference){
            $email_attributes = ['email' . '.' . $reference->id => 'email'];
            $validation_attributes = $validation_attributes + $email_attributes;
            $phone_attributes = ['phone' . '.' . $reference->id => 'phone'];
            $validation_attributes = $validation_attributes + $phone_attributes;
        }

        return $validation_attributes;
    }

    // public function autoSave($property)
    public function updated($property)
    {
        $field_id = explode('.', $property);
        $current_field = $field_id[0];
        $education_id = isset($field_id[1]) ? $field_id[1] : 0;

        // education updates
        $edu_fields = ['program_name','program_name_status','organization_name','organization_name_status','course_description','course_description_status','start_year','end_year','currently_studying','start_year_status'];

        // employement updates
        $emp_fields = ['employments','company_name','company_name_status','position','position_status','responsibilities','responsibilities_status','employment_start_year','employment_end_year','employment_start_year_status','accomplishments','currently_working','accomplishments_status'];

        // skill updates
        $skill_fields = ['all_languages','selectedLanguages','all_soft_skills','selectedSoftSkills','all_hard_skills','selectedHardSkills','hard_skills','hard_skills_status','soft_skills','soft_skills_status'];

        // references updates
        $ref_fields = ['references','name','name_status','relationship','relationship_status','phone','phone_status','email','email_status'];

        // profile updates
        $profile_fields = ['profile','profile_path','short_bio','short_bio_status','profile_status'];

        // update education details
        if(in_array($current_field, $edu_fields)) {
            $this->end_year_error[$education_id] = null;

            // task - 8678eghrm
            if ($current_field == 'start_year') {
                if ($this->$current_field[$education_id] == '' && ($this->end_year[$education_id] != '' || $this->currently_studying[$education_id] == 1)) {
                    $this->end_year_error[$education_id] = "You must select a start date.";
                    $this->dispatchBrowserEvent('load-switches');
                    return response()->json();
                    die();
                }
            }

            if ($current_field == 'end_year') {
                if(!empty($this->start_year[$education_id])){
                $start_dt = $this->start_year[$education_id];

                $end_dt = $this->$current_field[$education_id];
                $now=strtotime(now());
                if(strtotime($start_dt)>$now){
                    //$this->end_year_error[$education_id] = "Start Month can not be a future Month";
                    return false;
                }
                if(strtotime($end_dt)>$now){
                    //$this->end_year_error[$education_id] = "End Month can not be a future Month";
                    return false;
                }
                $m_start = (int)date('m', strtotime($start_dt)); $m_end = (int)date('m', strtotime($end_dt));
                $y_start = (int)date('Y', strtotime($start_dt)); $y_end = (int)date('Y', strtotime($end_dt));

                if ($start_dt == '' && ($end_dt != '' || $this->currently_studying[$education_id] == 1)) { // task - 8678eghrm
                   // $this->end_year_error[$education_id] = "You must select a start date.";
                    $this->dispatchBrowserEvent('load-switches');
                    return response()->json();
                    die();
                }

                if (($y_start > $y_end && $end_dt) || ($y_start==$y_end && ($m_start > $m_end))) {
                   // $this->$current_field[$education_id] = '';
                    //$this->end_year_error[$education_id] = "End Month Can Not Be Before The Start Month.";
                    $this->dispatchBrowserEvent('load-switches');
                    return response()->json();
                    die();
                }

                if($start_dt && (($end_dt == '' || $end_dt == null) && $this->currently_studying[$education_id] == 0)) {
                   // $this->end_year_error[$education_id] = "You must select an end year.";
                    $this->dispatchBrowserEvent('load-switches');
                    return response()->json();
                    die();
                }
            }
            }

            /*$education = Education::find($education_id);

            if($current_field == 'currently_studying'){
                  if($this->$current_field[$education_id]){
                      $education->end_year = '';
                  }
                  $education->$current_field = $this->$current_field[$education_id];
            } else {

                  $education->$current_field = $this->$current_field[$education_id];
            }*/

          // $education->save();

            // task - 86a0jby08
            if ($current_field == 'start_year' || $current_field == 'currently_studying') {
                $start_dt = $this->start_year[$education_id];
                if(!empty( $this->end_year[$education_id])){
                $end_dt = $this->end_year[$education_id];


                if ($start_dt == '' && ($end_dt != '' || $this->currently_studying[$education_id] == 1)) {
                  //  $this->end_year_error[$education_id] = "You must select a start date.";
                }

                if($start_dt && (($end_dt == '' || $end_dt == null) && $this->currently_studying[$education_id] == 0)) {
                  //  $this->end_year_error[$education_id] = "You must select an end year.";
                }
            }
            }
            // task - 86a0jby08 end
        }

        // update employement details
        $employment_id = isset($field_id[1]) ? $field_id[1] : 0;
        if (in_array($current_field, $emp_fields)) {
            $this->employment_end_year_error[$employment_id] = null;

            // task - 8678eghrm
            if ($current_field == 'employment_start_year') {
                if ($this->$current_field[$employment_id] == '' && ($this->employment_end_year[$employment_id] != '' || $this->currently_working[$employment_id] == 1)) {
                    $this->employment_end_year_error[$employment_id] = "You must select a start date.";
                    $this->dispatchBrowserEvent('load-switches');
                    return response()->json();
                    die();
                }
            }

            if ($current_field == 'employment_end_year') {
                if(!empty($this->employment_start_year[$employment_id])){
                $start_dt = $this->employment_start_year[$employment_id];
                $end_dt = $this->$current_field[$employment_id];
                $now=strtotime(now());
                if(strtotime($start_dt)>$now){
                    $this->end_year_error[$employment_id] = "Start Month can not be a future Month";
                    return false;
                }
                if(strtotime($end_dt)>$now){
                    $this->end_year_error[$employment_id] = "End Month can not be a future Month";
                    return false;
                }
                if ($start_dt == '' && ($end_dt != '' || $this->currently_working[$employment_id] == 1)) {
                    $this->employment_end_year_error[$employment_id] = "You must select a start date.";
                    $this->dispatchBrowserEvent('load-switches');
                    return response()->json();
                    die();
                }

                $m_start = (int)date('m', strtotime($start_dt)); $m_end = (int)date('m', strtotime($end_dt));
                $y_start = (int)date('Y', strtotime($start_dt)); $y_end = (int)date('Y', strtotime($end_dt));

                if (($y_start > $y_end && $end_dt) || ($y_start==$y_end && ($m_start > $m_end))) {
                    $this->$current_field[$employment_id] = '';
                    $this->employment_end_year_error[$employment_id] = "End Month Can Not Be Before The Start Month.";
                    $this->dispatchBrowserEvent('load-switches');
                    return response()->json();
                    die();
                }

                if($start_dt && (($end_dt == '' || $end_dt == null) && $this->currently_working[$employment_id] == 0)) {
                    $this->employment_end_year_error[$employment_id] = "You must select an end year.";
                    $this->dispatchBrowserEvent('load-switches');
                    return response()->json();
                    die();
                }
            }
            }

            /*$employment = Employment::find($employment_id);

            if($current_field == 'currently_working'){
                if($this->$current_field[$employment_id]){
                    $employment->end_year = '';
                }
                $employment->$current_field = $this->$current_field[$employment_id];
            }elseif($current_field == 'employment_start_year'){
                $employment->start_year =$this->$current_field[$employment_id];
            }elseif($current_field == 'employment_end_year'){
                $employment->end_year =$this->$current_field[$employment_id];
            }
            else{
                if($current_field=='employment_start_year_status'){
                $employment->start_year_status = $this->$current_field[$employment_id];
            }else{
                $employment->$current_field = $this->$current_field[$employment_id];
            }
            }*/
            // $employment->save();

            // task - 86a0jby08
            if ($current_field == 'employment_start_year' || $current_field == 'currently_working') {
                if(!empty($this->employment_start_year[$employment_id])){
                $this->employment_end_year_error[$employment_id] = null;
                $start_dt='';
                $end_dt='';
                if(!empty($this->employment_start_year[$employment_id])){
                $start_dt = $this->employment_start_year[$employment_id];
            }
            if(!empty($this->employment_end_year[$employment_id])){
                $end_dt = $this->employment_end_year[$employment_id];
            }

                if ($start_dt == '' && ($end_dt != '' || $this->currently_working[$employment_id] == 1)) {
                    $this->employment_end_year_error[$employment_id] = "You must select a start date.";
                }

                if($start_dt && (($end_dt == '' || $end_dt == null) && $this->currently_working[$employment_id] == 0)) {
                    $this->employment_end_year_error[$employment_id] = "You must select an end year.";
                }
            }
            }
            // task - 86a0jby08 end
        }

        /* task - 86a0hxg00
        // update skill details
        if (in_array($current_field, $skill_fields)) {
            if($current_field == 'selectedLanguages'){
                Auth::user()->languages()->sync($this->selectedLanguages);
            }

            if($current_field == 'selectedSoftSkills'){
                Auth::user()->softSkills()->detach(Auth::user()->softSkills->pluck('id')->toArray());
                Auth::user()->softSkills()->attach($this->selectedSoftSkills);
            }

            if($current_field == 'selectedHardSkills'){
                Auth::user()->hardSkills()->detach(Auth::user()->hardSkills->pluck('id')->toArray());
                Auth::user()->hardSkills()->attach($this->selectedHardSkills);
            }
        }

        // update reference fields
        $reference_id = isset($field_id[1]) ? $field_id[1] : 0;
        if (in_array($current_field, $ref_fields)) {
            $reference = Reference::find($reference_id);
            $reference->$current_field = $this->$current_field[$reference_id];
            $reference->save();
        }

        // update profile details
        if (in_array($current_field, $profile_fields)) {
            $personal =Personal::where('user_id',Auth::user()->id)->first();
            if(isset($personal)){
                if ($property === 'profile') {
                    $path = $this->save();

                    $file_path = str_replace('public/','storage/app/public/',$path);
                        Auth::user()->profile_photo_path = $file_path;

                    Auth::user()->save();
                    // $this->render();
                    $this->emit(event: 'update_pg');
                    $this->dispatchBrowserEvent('load-switches');
                    $this->dispatchBrowserEvent('temp-update-avatar', ['newPath' => $file_path]);
                }
                else{
                    $personal->$property = $this->$property;
                    $personal->save();
                }
            }
            else{
                Personal::create([
                    'short_bio' => $this->short_bio,
                    'short_bio_status' => $this->short_bio_status,
                    'profile_status' => $this->profile_status,
                    'user_id' => Auth::user()->id
                ]);
            }
        }

        $user = Auth::user();
        // $user->current_step = 4;
        $user->save();*/

        $this->dispatchBrowserEvent('load-switches');
        $this->dispatchBrowserEvent('init-dates');

        if($current_field == 'selectedLanguages') {
            $this->dispatchBrowserEvent('keep-open-language');
        } elseif($current_field == 'selectedSoftSkills') {
            $this->dispatchBrowserEvent('keep-open-soft');
        } elseif($current_field == 'selectedHardSkills') {
            $this->dispatchBrowserEvent('keep-open-hard');
        } else {
            $this->dispatchBrowserEvent('close-multiselect');
        }
    }

    public function updateResume(){
        $this->validate();

        foreach($this->educations as $education){
            $is_error = 0;
            if(!empty($this->program_name)){
            if(array_key_exists($education->id,$this->program_name))
            {
                $education->program_name = $this->program_name[$education->id];
            }
        }
if(!empty($this->program_name_status)){
            if(array_key_exists($education->id,$this->program_name_status)){
                $education->program_name_status = $this->program_name_status[$education->id];
            }
        }
        if(!empty($this->organization_name)){
            if(array_key_exists($education->id,$this->organization_name)){
                $education->organization_name = $this->organization_name[$education->id];
            }
        }
        if(!empty($this->organization_name_status)){
            if(array_key_exists($education->id,$this->organization_name_status)){
            $education->organization_name_status = $this->organization_name_status[$education->id];
            }
            }
            if(!empty($this->course_description)){
            if(array_key_exists($education->id,$this->course_description)){
            $education->course_description = $this->course_description[$education->id];
            }
        }
        if(!empty($this->course_description_status)){
            if(array_key_exists($education->id,$this->course_description_status)){
            $education->course_description_status = $this->course_description_status[$education->id];
            }
        }
        if(!empty($this->start_year)){
            if(array_key_exists($education->id,$this->start_year)){
                $education->start_year = $this->start_year[$education->id];
                if ($this->start_year[$education->id] == '' && ($this->end_year[$education->id] != '' || $this->currently_studying[$education->id] == 1)) {
                    $is_error = 1;
                    $this->end_year_error[$education->id] = "You must select a start date.";
                }
            }
            }
            if(!empty($this->end_year)){
            if(array_key_exists($education->id,$this->end_year)){
                $education->end_year = $this->currently_studying[$education->id] ? '' : $this->end_year[$education->id];

                $start_dt = $this->start_year[$education->id];
                $end_dt = $this->end_year[$education->id];
                $now=strtotime(now());
                if(strtotime($start_dt)>$now){
                    $this->end_year_error[$education->id] = "Start Month can not be a future Month";
                    return false;
                }
                if(strtotime($end_dt)>$now){
                    $this->end_year_error[$education->id] = "End Month can not be a future Month";
                    return false;
                }
                $m_start = (int)date('m', strtotime($start_dt)); $m_end = (int)date('m', strtotime($end_dt));
                $y_start = (int)date('Y', strtotime($start_dt)); $y_end = (int)date('Y', strtotime($end_dt));

                if ($start_dt == '' && ($end_dt != '' || $this->currently_studying[$education->id] == 1)) { // task - 8678eghrm
                    $this->end_year_error[$education->id] = "You must select a start date.";
                    return false;
                }

                if (($y_start > $y_end && $end_dt) || ($y_start==$y_end && ($m_start > $m_end))) {
                    $this->end_year[$education->id] = '';
                    $this->end_year_error[$education->id] = "End Month Can Not Be Before The Start Month.";
                    return false;
                }

                if($start_dt && (($end_dt == '' || $end_dt == null) && $this->currently_studying[$education->id] == 0)) {
                    $this->end_year_error[$education->id] = "You must select an end year.";
                    return false;
                }
            }
            }
            if(!empty($this->currently_studying)){
            if(array_key_exists($education->id,$this->currently_studying)){
            $education->currently_studying = $this->currently_studying[$education->id];
            }
            }
            if(!empty($this->start_year_status)){
            if(array_key_exists($education->id,$this->start_year_status)){
            $education->start_year_status = $this->start_year_status[$education->id];
            }
            }

            if($is_error == 0) { $education->save(); }

            // task - 86a0yjejb
            if ($education->program_name == '' && $education->organization_name == '' && $education->course_description == '' && $education->start_year == '' && $education->end_year == '') {
                $education->delete();
            }

        }

        foreach($this->employments as $employment){
            $is_emp_error = 0;
            if(!empty($this->company_name)){
            if(array_key_exists($employment->id,$this->company_name)){
                $employment->company_name = $this->company_name[$employment->id];
            }
        }
        if(!empty($this->company_name_status)){
            if(array_key_exists($employment->id,$this->company_name_status))
            {
                $employment->company_name_status = $this->company_name_status[$employment->id];
            }
            }
            if(!empty($this->position)){
            if(array_key_exists($employment->id,$this->position))
            {
                $employment->position = $this->position[$employment->id];
            }
            }
            if(!empty($this->position_status)){
            if(array_key_exists($employment->id,$this->position_status))
            {
                $employment->position_status = $this->position_status[$employment->id];
            }
            }
            if(!empty($this->responsibilities)){
            if(array_key_exists($employment->id,$this->responsibilities))
            {
                $employment->responsibilities = $this->responsibilities[$employment->id];
            }
            }
            if(!empty($this->responsibilities_status)){
            if(array_key_exists($employment->id,$this->responsibilities_status))
            {
                $employment->responsibilities_status = $this->responsibilities_status[$employment->id];
            }
            }
            if(!empty($this->employment_start_year)){
            if(array_key_exists($employment->id,$this->employment_start_year))
            {
                $employment->start_year = $this->employment_start_year[$employment->id];

                if ($this->employment_start_year[$employment->id] == '' && ($this->employment_end_year[$employment->id] != '' || $this->currently_working[$employment->id] == 1)) {
                    $is_emp_error = 1;
                    $this->employment_end_year_error[$employment->id] = "You must select a start date.";
                }
            }
            }
            if(!empty($this->employment_end_year)){
            if(array_key_exists($employment->id,$this->employment_end_year))
            {
                $employment->end_year='';
                if(!empty($this->currently_working[$employment->id])){
                $employment->end_year = $this->currently_working[$employment->id] ? '' : $this->employment_end_year[$employment->id];
            }
                $start_dt='';
                $$end_dt='';
                if(!empty($this->employment_start_year[$employment->id])){
                $start_dt = $this->employment_start_year[$employment->id];
            }
            if(!empty($this->employment_end_year[$employment->id])){
                $end_dt = $this->employment_end_year[$employment->id];
            }
                $now=strtotime(now());
                if(strtotime($start_dt)>$now){
                    $this->employment_end_year_error[$employment->id] = "Start Month can not be a future Month";
                    return false;
                }
                if(strtotime($end_dt)>$now){
                    $this->employment_end_year_error[$employment->id] = "End Month can not be a future Month";
                    return false;
                }
                $m_start = (int)date('m', strtotime($start_dt)); $m_end = (int)date('m', strtotime($end_dt));
                $y_start = (int)date('Y', strtotime($start_dt)); $y_end = (int)date('Y', strtotime($end_dt));

                if ($start_dt == '' && ($end_dt != '' || $this->currently_working[$employment->id] == 1)) { // task - 8678eghrm
                    $this->employment_end_year_error[$employment->id] = "You must select a start date.";
                }

                if (($y_start > $y_end && $end_dt) || ($y_start==$y_end && ($m_start > $m_end))) {
                    $this->employment_end_year[$employment->id] = '';
                    $this->employment_end_year_error[$employment->id] = "End Month Can Not Be Before The Start Month.";
                }

                if($start_dt && (($end_dt == '' || $end_dt == null) && $this->currently_working[$employment->id] == 0)) {
                    $this->employment_end_year_error[$employment->id] = "You must select an end year.";
                }
            }
            }
            if(!empty($this->currently_working)){
            if(array_key_exists($employment->id,$this->currently_working)){
                $employment->currently_working = $this->currently_working[$employment->id];
            }
            }
            if(!empty($this->employment_start_year_status)){
            if(array_key_exists($employment->id,$this->employment_start_year_status))
            {
                $employment->start_year_status = $this->employment_start_year_status[$employment->id];
            }
            }
            if(!empty($this->accomplishments)){
            if(array_key_exists($employment->id,$this->accomplishments))
            {
                $employment->accomplishments = $this->accomplishments[$employment->id];
            }
            }
            if(!empty($this->accomplishments_status)){
            if(array_key_exists($employment->id,$this->accomplishments_status))
            {
                $employment->accomplishments_status = $this->accomplishments_status[$employment->id];
            }
            }

            if($is_emp_error == 0) { $employment->save(); }

            // task - 86a0yjejb
            if ($employment->company_name == '' && $employment->position == '' && $employment->responsibilities == '' && $employment->start_year == '' && $employment->end_year == '' && $employment->accomplishments == '') {
                $employment->delete();
            }
        }

        if($this->selectedLanguages){
            Auth::user()->languages()->sync($this->selectedLanguages);
            // Auth::user()->languages()->sync($this->selectedLanguages);
        }

        if($this->selectedSoftSkills){
            Auth::user()->softSkills()->sync($this->selectedSoftSkills);
            Auth::user()->softSkills()->detach(Auth::user()->softSkills->pluck('id')->toArray());
            Auth::user()->softSkills()->attach($this->selectedSoftSkills);
        }

        if($this->selectedHardSkills){
            // Auth::user()->hardSkills()->sync($this->selectedHardSkills);
            Auth::user()->hardSkills()->detach(Auth::user()->hardSkills->pluck('id')->toArray());
            Auth::user()->hardSkills()->attach($this->selectedHardSkills);
        }

        foreach($this->references as $reference){
            if(array_key_exists($reference->id,$this->name))
            {
                $reference->name = $this->name[$reference->id];
                $reference->name_status = $this->name_status[$reference->id];
            }
            if(array_key_exists($reference->id,$this->relationship))
            {
                $reference->relationship = $this->relationship[$reference->id];
                $reference->relationship_status = $this->relationship_status[$reference->id];
            }
            if(array_key_exists($reference->id,$this->phone))
            {
                // $regex = '/^\d{3}-\d{3}-\d{4}$/';
                // if (!empty($this->phone[$reference->id])) {
                //     if (preg_match($regex, $this->phone[$reference->id])) {
                //         $reference->phone = $this->phone[$reference->id];
                //         // dd($reference->phone);
                //      }
                // }
                $reference->phone = $this->phone[$reference->id];
                $reference->phone_status = $this->phone_status[$reference->id];
            }
            if(array_key_exists($reference->id,$this->email))
            {
                $reference->email = $this->email[$reference->id];
                $reference->email_status = $this->email_status[$reference->id];
            }

            if((!empty($reference->relationship) || !empty($reference->email) || !empty($reference->phone)) && empty($reference->name)){

            $this->reference_name_error[$reference->id]='Name field required';
        }else{

            unset($this->reference_name_error[$reference->id]);
            $reference->save();
        }
        }



        //get the current user personal information
        $personal = Personal::where('user_id', Auth::user()->id)->first();
        //check if the personal information present create if not.
        if (isset($personal)) {
            if ($this->profile) {
                $path = $this->save();
                $file_path = str_replace('public/', 'storage/app/public/', $path);
                Auth::user()->profile_photo_path = $file_path;
                Auth::user()->save();
                // $this->render();
                $this->dispatchBrowserEvent('temp-update-avatar');
                $this->dispatchBrowserEvent('load-switches');
            }
            $personal->short_bio = $this->short_bio;
            $personal->short_bio_status = $this->short_bio_status;
            $personal->save();
        } else {
            Personal::create([
                'short_bio' => $this->short_bio,
                'short_bio_status' => $this->short_bio_status,
                'user_id' => Auth::user()->id
            ]);
        }

        if(empty($this->reference_name_error)){
        $employment=Reference::where('user_id',Auth::user()->id)->where(['name'=>null,'relationship'=>null,'phone'=>null,'email'=>null])->delete();
        request()->session()->flash('message', 'Profile updated!');
        return redirect(route("candidates.editresume"));}
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
        $this->validate([
            'profile' => 'max:1024|mimes:jpg,png,jpeg', // 1MB Max
        ]);
        $path = $this->profile->store('public/profile');
        return $path;
    }

    public function removeAvatar() {
        if (Auth::user()->profile_photo_path) {
            @unlink(Auth::user()->profile_photo_path);
            $user = Auth::user();
            $user->profile_photo_path = null;
            $user->save();
        }

        $this->dispatchBrowserEvent('load-switches');
        $this->dispatchBrowserEvent('update-avatar');
    }

    // task - 86a0d8bft
    public function removeEdu($eduID)
    {
        $education = Education::find($eduID);
        if ($education) {
            $education->delete();
        }
        $this->emit(event: 'update_pg');
    }
    public function removeRef($eduID)
    {
        $education = Reference::find($eduID);
        if ($education) {
            $education->delete();
        }
        $this->emit(event: 'update_pg');
    }

    public function removeEmp($empID) // Task #86a0hf5r4
    {
        $employment = Employment::find($empID);
        if ($employment) {
            $employment->delete();
        }
        $this->emit(event: 'update_pg');
    }
    // task - 86a0d8bft end

    //  task - 86a0jby08
    public function getValidated() {
        $this->mount();
        return ['end_year_error' => array_filter($this->end_year_error), 'employment_end_year_error' => array_filter($this->employment_end_year_error)];
    }
}
