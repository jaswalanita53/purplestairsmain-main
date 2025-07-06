<?php

namespace App\Http\Livewire;

use App\Models\Education;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CandidateStep4 extends Component
{
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
    $end_year_error,
    $start_year_status,
    $currently_studying;
    public $profileSaved = false;
    protected $listeners = ['update_pg' => '$refresh']; // task - 86a0d8bft

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

        // $this->emit(event: 'update_pg');
        // Emit the 'newEducationAdded' event
        $this->emit('newEducationAdded');
        $this->dispatchBrowserEvent('reinitSwitch');
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function mount(){
        $this->educations = Education::where('user_id',Auth::user()->id)->get();
        $this->end_year_error = [];
        if ($this->educations->count() == 0) {
            //create a empty education row in database
            $added_edu = Education::create([
                'user_id' => Auth::user()->id
            ]);

            // task - 86a0pwr3u
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

                $m_start = (int)date('m', strtotime($start_dt)); $m_end = (int)date('m', strtotime($end_dt));
                $y_start = (int)date('Y', strtotime($start_dt)); $y_end = (int)date('Y', strtotime($end_dt));

                if ($start_dt == '' && ($end_dt != '' || $education->currently_studying == 1)) { // task - 8678eghrm
                    $this->end_year_error[$education->id] = "You must select a start date.";
                }

                if (($y_start > $y_end && $end_dt) || ($y_start==$y_end && ($m_start > $m_end))) {
                    $this->end_year[$education->id] = '';
                    $this->end_year_error[$education->id] = "End Month Can Not Be Before The Start Month.";
                }

                if($start_dt && (($end_dt == '' || $end_dt == null) && $education->currently_studying == 0)) {
                    $this->end_year_error[$education->id] = "You must select an end year.";
                }

                $this->currently_studying[$education->id] = $education->currently_studying;
                $this->start_year_status[$education->id] = $education->start_year_status;
            }

        }
        $user = User::find(Auth::user()->id);
        $user->current_step = 4;
        if($user->step_reached<4){
            $user->step_reached=4;
        }
        $user->save();
    }

    public function render()
    {
        $this->educations = Education::where('user_id',Auth::user()->id)->get();
        return view('livewire.candidate-step4');
    }

    public function updated($property)
    {
        // $this->autoSave($property);// task - 86a0hxg00
    //    if($property == $this->start_year[$education_id] || $property == 'program_name'||$property == 'organization_name'||$property == 'course_description'||$property == 'start_year'||$property == 'end_year'||$property == 'start_year_status'){
    //          $this->profileSaved = false;
    //     }
        $field_id = explode('.', $property);
        $current_field = $field_id[0];
        $education_id = $field_id[1];
        $this->end_year_error[$education_id] = null;
        $this->profileSaved = false;
        $start_dt = $this->start_year[$education_id];
        $end_dt = '';
        if(!empty($this->end_year[$education_id])){ //Task #86a0bn7yf.6
            $end_dt = $this->end_year[$education_id];
        }

        if($current_field == 'currently_studying'){ // task - 8678egmda
            if($this->$current_field[$education_id]){
                $this->end_year[$education_id] = '';
            }
            if($start_dt && (($end_dt == '' || $end_dt == null) && $this->currently_studying[$education_id] == 0)) {
                $this->end_year_error[$education_id] = "You must select an end year.";
            }
        }

        // task - 8678eghrm
        if ($current_field == 'start_year') {
            if ($this->$current_field[$education_id] == '') {
                if($this->end_year[$education_id] != '' || $this->currently_studying[$education_id] == 1){ //Task #86a0bn7yf.6
                    $this->end_year_error[$education_id] = "You must select a start date.";
                }
            }

            // task - 8678egmda
            $start_dt = $this->start_year[$education_id];
            $end_dt = '';
            if(!empty($this->end_year[$education_id])){ //Task #86a0bn7yf.6
                $end_dt = $this->end_year[$education_id];
            }
            $is_valid_dt = $this->validate_dates($start_dt, $end_dt, $education_id);

            /*if(!$is_valid_dt) {
                $this->dispatchBrowserEvent('load-switches');
                return response()->json();
                die();
            }*****/
        }

        if ($current_field == 'end_year') {
            $start_dt = '';
            if(!empty($this->start_year[$education_id])){ //Task #86a0bn7yf.6
                $start_dt = $this->start_year[$education_id];
            }
            $end_dt = $this->$current_field[$education_id];

            $is_valid_dt = $this->validate_dates($start_dt, $end_dt, $education_id);
            if(!$is_valid_dt) {
                /*$this->dispatchBrowserEvent('load-switches');
                return response()->json();
                die();*****/
            }
        }

        $start_dt = $this->start_year[$education_id];
        $end_dt = $this->end_year[$education_id];
        if ($start_dt == '' && ($end_dt != '' || $this->currently_studying[$education_id] == 1)) {
            $this->end_year_error[$education_id] = "You must select a start date.";
        }

        // $this->dispatchBrowserEvent('load-switches');
        $this->dispatchBrowserEvent('init-dates');
        /*return response()->json([]);
        die();*/
    }

    /*public function autoSave($property)
    {
        $field_id = explode('.', $property);
        $current_field = $field_id[0];
        $education_id = $field_id[1];
        $this->end_year_error[$education_id] = null;

        if($current_field == 'currently_studying'){ // task - 8678egmda
            if($this->$current_field[$education_id]){
                $this->end_year[$education_id] = '';
            }
        }

        // task - 8678eghrm
        if ($current_field == 'start_year') {
            if ($this->$current_field[$education_id] == '') {
                if($this->end_year[$education_id] != '' || $this->currently_studying[$education_id] == 1){ //Task #86a0bn7yf.6
                $this->end_year_error[$education_id] = "You must select a start date.";
            }
            }

            // task - 8678egmda
            $start_dt = $this->start_year[$education_id];
            $end_dt = '';
            if(!empty($this->end_year[$education_id])){ //Task #86a0bn7yf.6
                $end_dt = $this->end_year[$education_id];
            }
            $is_valid_dt = $this->validate_dates($start_dt, $end_dt, $education_id);

            // dd($is_valid_dt);
            if(!$is_valid_dt) {
                $this->dispatchBrowserEvent('load-switches');
                return response()->json();
                die();
            }
        }

        if ($current_field == 'end_year') {

            $start_dt = '';
            if(!empty($this->start_year[$education_id])){ //Task #86a0bn7yf.6
                $start_dt = $this->start_year[$education_id];
            }
            $end_dt = $this->$current_field[$education_id];

            // task - 8678egmda
            $is_valid_dt = $this->validate_dates($start_dt, $end_dt, $education_id);
            // dd($is_valid_dt);
            if(!$is_valid_dt) {
                $this->dispatchBrowserEvent('load-switches');
                return response()->json();
                die();
            }
        }

        $education = Education::find($education_id);
        if($current_field == 'currently_studying'){
            $this->emit('newEducationAdded');
            if($this->$current_field[$education_id]){
                $education->end_year = '';
            }
            $education->$current_field = $this->$current_field[$education_id];
        }
        else{
            $education->$current_field = $this->$current_field[$education_id];
        }
        $education->save();

        $user = Auth::user();
        $user->current_step = 4;
        if($user->step_reached<4){
            $user->step_reached=4;
        }
        $user->save();

        $this->dispatchBrowserEvent('load-switches');
    }*/

    public function finish_later()
    {
        $educations = Education::where('user_id',Auth::user()->id)->get();

        foreach ($educations as $key => $education) {
            $education->program_name = $this->program_name[$education->id];
            if($education->program_name_status != "") { $education->program_name_status = $this->program_name_status[$education->id]; }
            $education->organization_name = $this->organization_name[$education->id];
            if($education->organization_name_status != "") { $education->organization_name_status = $this->organization_name_status[$education->id]; }
            $education->course_description = $this->course_description[$education->id];
            if($education->course_description_status != "") { $education->course_description_status = $this->course_description_status[$education->id]; }
            $education->start_year = $this->start_year[$education->id];
            $education->end_year = $this->end_year[$education->id];
            if($education->currently_studying != "") { $education->currently_studying = $this->currently_studying[$education->id]; }
            if($education->start_year_status != "") { $education->start_year_status = $this->start_year_status[$education->id]; }
            $this->profileSaved = true;
            $education->save();
        }

        $user = Auth::user();
        $user->current_step = 4;
        if($user->step_reached<4){
            $user->step_reached=4;
        }
        $user->save();

        //return redirect()->route('candidatestep5');
    }

    // task - 86a0hxg00
    public function saveEducation()
    {
        $educations = Education::where('user_id',Auth::user()->id)->get();

        foreach ($educations as $key => $education) {
            $education->program_name = $this->program_name[$education->id];
            $education->program_name_status = $this->program_name_status[$education->id];
            $education->organization_name = $this->organization_name[$education->id];
            $education->organization_name_status = $this->organization_name_status[$education->id];
            $education->course_description = $this->course_description[$education->id];
            $education->course_description_status = $this->course_description_status[$education->id];
            $education->start_year = $this->start_year[$education->id];
            $education->end_year = $this->end_year[$education->id];
            $education->currently_studying = $this->currently_studying[$education->id];
            $education->start_year_status = $this->start_year_status[$education->id];

            $education->save();
        }

        $user = Auth::user();
        $user->current_step = 4;
        if($user->step_reached<4){
            $user->step_reached=4;
        }
        $user->save();

        return redirect()->route('candidatestep5');
    }

    public function validate_dates($start_dt, $end_dt, $id)
    {

        if(!empty($this->currently_studying[$id])){
            $this->currently_studying[$id]=$this->currently_studying[$id];
        }else{
            $this->currently_studying[$id]=0; // task #86a0f93az exception
        }
        if ($start_dt == '' && ($end_dt != '' || $this->currently_studying[$id] == 1)) { // task - 8678eghrm
            $this->end_year_error[$id] = "You must select a start date.";
            // return false;
        }

        $m_start = (int)date('m', strtotime($start_dt)); $m_end = (int)date('m', strtotime($end_dt));
        $y_start = (int)date('Y', strtotime($start_dt)); $y_end = (int)date('Y', strtotime($end_dt));
        $now=strtotime(now());
        if(strtotime($start_dt)>$now){
            $this->end_year_error[$id] = "Start Month can not be a future Month";
            return false;
        }
        if(strtotime($end_dt)>$now){
            $this->end_year_error[$id] = "End Month can not be a future Month";
            return false;
        }
        if (($y_start > $y_end && $end_dt) || ($y_start==$y_end && ($m_start > $m_end))) {
            // $this->end_year[$id] = '';
            $this->end_year_error[$id] = "End Month Can Not Be Before The Start Month.";
            return false;
        }

        return true;
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
    // task - 86a0d8bft end
}
