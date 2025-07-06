<?php

namespace App\Http\Livewire;

use App\Models\Employment;
use App\Models\Education;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CandidateStep5 extends Component
{
    public $employments,
    $employment_id,
    $company_name,
    $company_name_status,
    $position,
    $position_status,
    $responsibilities,
    $responsibilities_status,
    $start_year,
    $end_year,
    $end_year_error = [],
    $start_year_status,
    $accomplishments,
    $accomplishments_status,
    $currently_working;
    public $profileSaved = false;
    protected $listeners = ['updateErrors', 'updateValidation', 'update_pg' => '$refresh'];


    public function add()
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

        // Emit the 'newEmploymentAdded' event
        $this->emit('newEmploymentAdded');
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function mount(){
        $education=Education::where('user_id',Auth::user()->id)->where(['program_name'=>null,'organization_name'=>null,'course_description'=>null,'start_year'=>null,'end_year'=>null,'currently_studying'=>0])->delete(); // Task #86a0d8e1v

        $this->employments = Employment::where('user_id',Auth::user()->id)->get();
        if ($this->employments->count() == 0) {
            //create a empty employment row in database
            $newEmp=Employment::create([
                'user_id' => Auth::user()->id
            ]);

            $newEmp = Employment::find($newEmp->id);
            $this->company_name[$newEmp->id] = $newEmp->company_name;
            $this->company_name_status[$newEmp->id] = $newEmp->company_name_status;
            $this->position[$newEmp->id] = $newEmp->position;
            $this->position_status[$newEmp->id] = 1;
            $this->responsibilities[$newEmp->id] = $newEmp->responsibilities;
            $this->responsibilities_status[$newEmp->id] = $newEmp->responsibilities_status;
            $this->start_year[$newEmp->id] = null;
            $this->start_year_status[$newEmp->id] = 1;
            $this->end_year[$newEmp->id] = null;
            $this->end_year_error[$newEmp->id] = null;
            $this->currently_working[$newEmp->id] = $newEmp->currently_working;
            $this->accomplishments[$newEmp->id] = $newEmp->accomplishments;
            $this->accomplishments_status[$newEmp->id] = $newEmp->accomplishments_status;
            // dd($newEmp);
        }
        else{
            foreach($this->employments as $employment){
                $this->company_name[$employment->id] = $employment->company_name;
                $this->company_name_status[$employment->id] = $employment->company_name_status;
                $this->position[$employment->id] = $employment->position;
                $this->position_status[$employment->id] = $employment->position_status;
                $this->responsibilities[$employment->id] = $employment->responsibilities;
                $this->responsibilities_status[$employment->id] = $employment->responsibilities_status;
                $this->start_year[$employment->id] = $employment->start_year;
                $this->end_year[$employment->id] = $employment->end_year;
                $this->end_year_error[$employment->id] = null;
                $start_dt = $this->start_year[$employment->id];
                $end_dt = $this->end_year[$employment->id];

                $m_start = (int)date('m', strtotime($start_dt)); $m_end = (int)date('m', strtotime($end_dt));
                $y_start = (int)date('Y', strtotime($start_dt)); $y_end = (int)date('Y', strtotime($end_dt));

                if ($start_dt == '' && ($end_dt != '' && $employment->currently_working == 1)) { // task - 8678eghrm
                    $this->end_year_error[$employment->id] = "You must select a start date.";
                }

                if (($y_start > $y_end && $end_dt) || ($y_start==$y_end && ($m_start > $m_end))) {
                    $this->end_year[$employment->id] = '';
                    $this->end_year_error[$employment->id] = "End Month Can Not Be Before The Start Month.";
                }

                if($start_dt && (($end_dt == '' || $end_dt == null) && $employment->currently_working == 0)) {
                    $this->end_year_error[$employment->id] = "You must select an end year.";
                }

                $this->currently_working[$employment->id] = $employment->currently_working;
                $this->start_year_status[$employment->id] = $employment->start_year_status;
                $this->accomplishments[$employment->id] = $employment->accomplishments;
                $this->accomplishments_status[$employment->id] = $employment->accomplishments_status;
            }
        }
        $user = User::find(Auth::user()->id);
        $user->current_step = 5;
        if($user->step_reached<5){
            $user->step_reached=5;
        }
        $user->save();
    }

    public function render()
    {
        $this->employments = Employment::where('user_id',Auth::user()->id)->get();
        return view('livewire.candidate-step5');
    }

    public function updated($property)
    {
        // $this->autoSave($property); task - 86a0hxg00

        $field_id = explode('.', $property);
        $current_field = $field_id[0];
        $employment_id = $field_id[1];
        $this->end_year_error[$employment_id] = null;
        $this->profileSaved = false;
        if($current_field == 'currently_working'){ // task - 8678egmda
            if($this->$current_field[$employment_id]){
                $this->end_year[$employment_id] = '';
            }

            $start_dt = $this->start_year[$employment_id];
            $end_dt = $this->end_year[$employment_id];
            if($start_dt && (($end_dt == '' || $end_dt == null) && $this->currently_working[$employment_id] == 0)) {
                $this->end_year_error[$employment_id] = "You must select an end year.";
            }
        }

        // task - 8678eghrm
        if ($current_field == 'start_year') {
            if ($this->$current_field[$employment_id] == '' && ($this->end_year[$employment_id] != '' || $this->currently_working[$employment_id] == 1)) {
                $this->end_year_error[$employment_id] = "You must select a start date.";
                /*$this->dispatchBrowserEvent('load-switches');
                return response()->json();
                die();*/
            }

            // task - 8678egmda
            $start_dt = $this->start_year[$employment_id];
            $end_dt = '';
            if(!empty($this->end_year[$employment_id])){
                $end_dt = $this->end_year[$employment_id];
            }
            $is_valid_dt = $this->validate_dates($start_dt, $end_dt, $employment_id);

            if(!$is_valid_dt) {
                /*$this->dispatchBrowserEvent('load-switches');
                return response()->json();
                die();*/
            }
        }

        if ($current_field == 'end_year') {
            if(!empty($this->start_year[$employment_id])){
                $start_dt = $this->start_year[$employment_id];
            }else{
                $start_dt = '';
            }

            $end_dt = $this->$current_field[$employment_id];

            // task - 8678egmda
            $is_valid_dt = $this->validate_dates($start_dt, $end_dt, $employment_id);

            if(!$is_valid_dt) {
               /* $this->dispatchBrowserEvent('load-switches');
                return response()->json();
                die();*/
            }
        }

        $start_dt = $this->start_year[$employment_id];
        $end_dt = $this->end_year[$employment_id];
        if ($start_dt == '' && ($end_dt != '' || $this->currently_working[$employment_id] == 1)) {
            $this->end_year_error[$employment_id] = "You must select a start date.";
        }

        // $this->dispatchBrowserEvent('load-switches');
        $this->dispatchBrowserEvent('init-dates');
        // dd($this->end_year_error);
        // return response()->json([]);
    }

    /*public function autoSave($property)
    {
        $field_id = explode('.', $property);
        $current_field = $field_id[0];
        $employment_id = $field_id[1];
        $this->end_year_error[$employment_id] = null;

        if($current_field == 'currently_working'){ // task - 8678egmda
            if($this->$current_field[$employment_id]){
                $this->end_year[$employment_id] = '';
            }
        }

        // task - 8678eghrm
        if ($current_field == 'start_year') {
            if ($this->$current_field[$employment_id] == '' && ($this->end_year[$employment_id] != '' || $this->currently_working[$employment_id] == 1)) {
                $this->end_year_error[$employment_id] = "You must select a start date.";
                $this->dispatchBrowserEvent('load-switches');
                return response()->json();
                die();
            }

            // task - 8678egmda
            $start_dt = $this->start_year[$employment_id];
            $end_dt = '';
            if(!empty($this->end_year[$employment_id])){
                $end_dt = $this->end_year[$employment_id];
            }
            $is_valid_dt = $this->validate_dates($start_dt, $end_dt, $employment_id);

            if(!$is_valid_dt) {
                $this->dispatchBrowserEvent('load-switches');
                return response()->json();
                die();
            }
        }

        if ($current_field == 'end_year') {
            if(!empty($this->start_year[$employment_id])){
                $start_dt = $this->start_year[$employment_id];
            }else{
                $start_dt = '';
            }

            $end_dt = $this->$current_field[$employment_id];

            // task - 8678egmda
            $is_valid_dt = $this->validate_dates($start_dt, $end_dt, $employment_id);

            if(!$is_valid_dt) {
                $this->dispatchBrowserEvent('load-switches');
                return response()->json();
                die();
            }
        }

        $employment = Employment::find($employment_id);
        if($current_field == 'currently_working'){
            $this->emit('newEmploymentAdded');
            if($this->$current_field[$employment_id]){
                $employment->end_year = '';
            }
            $employment->$current_field = $this->$current_field[$employment_id];
        }
        else{
            $employment->$current_field = $this->$current_field[$employment_id];
        }
        $employment->save();

        $user = Auth::user();
        $user->current_step = 5;
        if($user->step_reached<5){
            $user->step_reached=5;
        }
        $user->save();
    }*/

    public function finish_later()
    {
        $employments = Employment::where('user_id',Auth::user()->id)->get();

        foreach ($employments as $key => $employment) {
            $employment->company_name = $this->company_name[$employment->id];
            if($employment->company_name_status != "") { $employment->company_name_status = $this->company_name_status[$employment->id]; }
            $employment->position = $this->position[$employment->id];
            if($employment->position_status != "") { $employment->position_status = $this->position_status[$employment->id]; }
            $employment->responsibilities = $this->responsibilities[$employment->id];
            if($employment->responsibilities_status != "") { $employment->responsibilities_status = $this->responsibilities_status[$employment->id]; }
            $employment->start_year = $this->start_year[$employment->id];
            $employment->end_year = $this->end_year[$employment->id];
            if($employment->currently_working != "") { $employment->currently_working = $this->currently_working[$employment->id]; }
            if($employment->start_year_status != "") { $employment->start_year_status = $this->start_year_status[$employment->id]; }
            $employment->accomplishments = $this->accomplishments[$employment->id];
            if($employment->accomplishments_status != "") { $employment->accomplishments_status = $this->accomplishments_status[$employment->id]; }
            $this->profileSaved = true;
            $employment->save();
        }

        $user = Auth::user();
        $user->current_step = 5;
        if($user->step_reached<5){
            $user->step_reached=5;
        }
        $user->save();

        //return redirect()->route('candidatestep6');
    }

    // task - 86a0hxg00
    public function saveEmployement()
    {
        $employments = Employment::where('user_id',Auth::user()->id)->get();

        foreach ($employments as $key => $employment) {
            $employment->company_name = $this->company_name[$employment->id];
            $employment->company_name_status = $this->company_name_status[$employment->id];
            $employment->position = $this->position[$employment->id];
            $employment->position_status = $this->position_status[$employment->id];
            $employment->responsibilities = $this->responsibilities[$employment->id];
            $employment->responsibilities_status = $this->responsibilities_status[$employment->id];
            $employment->start_year = $this->start_year[$employment->id];
            $employment->end_year = $this->end_year[$employment->id];
            $employment->currently_working = $this->currently_working[$employment->id];
            $employment->start_year_status = $this->start_year_status[$employment->id];
            $employment->accomplishments = $this->accomplishments[$employment->id];
            $employment->accomplishments_status = $this->accomplishments_status[$employment->id];

            $employment->save();
        }

        $user = Auth::user();
        $user->current_step = 5;
        if($user->step_reached<5){
            $user->step_reached=5;
        }
        $user->save();

        return redirect()->route('candidatestep6');
    }

    public function validate_dates($start_dt, $end_dt, $id)
    {
         // task #86a0f93az exception
        if(!empty($this->currently_working[$id])){
            $this->currently_working[$id]=$this->currently_working[$id];
        }else{
            $this->currently_working[$id]=0;
        }
        if ($start_dt == '' && ($end_dt != '' || $this->currently_working[$id] == 1)) { // task - 8678eghrm
            $this->end_year_error[$id] = "You must select a start date.";
            // return false;
        }

        if($start_dt && (($end_dt == '' || $end_dt == null) && $this->currently_working[$id] == 0)) {
            $this->end_year_error[$id] = "You must select an end year.";
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
            $this->end_year[$id] = '';
            $this->end_year_error[$id] = "End Month Can Not Be Before The Start Month.";
            return false;
        }

        return true;
    }

    function updateErrors($employment_id) {
        $this->end_year_error[$employment_id] = "You must select an end year.";
        return response()->json();
    }

    function updateValidation($employment_id) { // task - 86a0d8f9t
        // $this->end_year_error[$employment_id] = "You must select a start date."; // Task #86a0d8e1v
        // return response()->json();
    }

    // task - 86a0d8bft
    public function removeEmp($empID)
    {
        $employment = Employment::find($empID);
        if ($employment) {
            $employment->delete();
        }
        $this->emit(event: 'update_pg');
    }
    // task - 86a0d8bft end
}
