<?php

namespace App\Http\Livewire;

use App\Models\Reference;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CandidateStep7 extends Component
{
    public $references,
    $reference_id,
    $name,
    $name_status,
    $relationship,
    $relationship_status,
    $phone,
    $phone_status,
    $email,
    $email_status,
    $reference_name_error=[];
    public $profileSaved = false;

    public function add()
    {
        //create a empty reference row in database
        $reference = Reference::create([
          'user_id' => Auth::user()->id
        ]);

        // task - 86a0hxg00
        $this->name[$reference->id] = $reference->name;
        $this->name_status[$reference->id] = $reference->name_status;
        $this->relationship[$reference->id] = $reference->relationship;
        $this->relationship_status[$reference->id] = $reference->relationship_status;
        $this->phone[$reference->id] = $reference->phone;
        $this->phone_status[$reference->id] = $reference->phone_status;
        $this->email[$reference->id] = $reference->email;
        $this->email_status[$reference->id] = $reference->email_status;

        $this->references = Reference::where('user_id',Auth::user()->id)->get();
        // Emit the 'newReferenceAdded' event
        $this->emit('newReferenceAdded');
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    public function mount(){
        $this->references = Reference::where('user_id',Auth::user()->id)->get();
        if ($this->references->count() == 0) {
            //create a empty reference row in database
            $reference = Reference::create([
                'user_id' => Auth::user()->id
            ]);

            $this->name[$reference->id] = $reference->name;
            $this->name_status[$reference->id] = $reference->name_status;
            $this->relationship[$reference->id] = $reference->relationship;
            $this->relationship_status[$reference->id] = $reference->relationship_status;
            $this->phone[$reference->id] = $reference->phone;
            $this->phone_status[$reference->id] = $reference->phone_status;
            $this->email[$reference->id] = $reference->email;
            $this->email_status[$reference->id] = $reference->email_status;
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
                if(empty( $this->name[$reference->id])){
                    unset($this->reference_name_error[$reference->id]);
                }
            }
        }

        $user = User::find(Auth::user()->id);
        $user->current_step = 7;
        if($user->step_reached<7){
            $user->step_reached=7;
        }
        $user->save();
    }

    public function render()
    {
        $this->references = Reference::where('user_id',Auth::user()->id)->get();
        return view('livewire.candidate-step7');
    }

    /* task - 86a0hxg00 */
    public function updated($property)
    {

        $this->profileSaved = false;
        // if (array_key_exists($property, $this->rules())) {
        //     //$this->validateOnly($property);
        //     // if ($this->getErrorBag()->any()) {
        //     //     // Validation failed, so don't auto-save
        //     //     return;
        //     // }
        // }
        // $this->autoSave($property);
    }

    public function finish_later() { // task - 86a0hxg00
        $references = Reference::where('user_id',Auth::user()->id)->get();

        foreach($references as $reference){
            if($reference->name != "") { $reference->name = $this->name[$reference->id]; }
            if($reference->relationship != "") { $reference->relationship = $this->relationship[$reference->id]; }
            if($reference->phone != "") { $reference->phone = $this->phone[$reference->id]; }
            if($reference->email != "") { $reference->email = $this->email[$reference->id];             }
            $reference->name_status = $this->name_status[$reference->id];
            $reference->relationship_status = $this->relationship_status[$reference->id];
            $reference->phone_status = $this->phone_status[$reference->id];
            $reference->email_status = $this->email_status[$reference->id];
            $reference->save();
        }

        $user = User::find(Auth::user()->id);
        $user->current_step = 7;
        if($user->step_reached<7){
            $user->step_reached=7;
        }
        $this->profileSaved = true;
        $user->save();
        //return redirect()->route('candidatestep8');
    }

    public function saveReference() { // task - 86a0hxg00
        $references = Reference::where('user_id',Auth::user()->id)->get();

        foreach($references as $reference){
            $reference->name = $this->name[$reference->id];
            $reference->relationship = $this->relationship[$reference->id];
            $reference->phone = $this->phone[$reference->id];
            $reference->email = $this->email[$reference->id];
            $reference->name_status = $this->name_status[$reference->id];
            $reference->relationship_status = $this->relationship_status[$reference->id];
            $reference->phone_status = $this->phone_status[$reference->id];
            $reference->email_status = $this->email_status[$reference->id];
            if((!empty($reference->relationship) || !empty($reference->email) || !empty($reference->phone)) && empty($reference->name)){

                $this->reference_name_error[$reference->id]='Name field required';
            }else{
                $this->reference_name_error[$reference->id]='';
                unset($this->reference_name_error[$reference->id]);
                $reference->save();
            }

        }



        if(empty($this->reference_name_error)){
            $user = User::find(Auth::user()->id);
            $user->current_step = 7;
            if($user->step_reached<7){
                $user->step_reached=7;
            }

        $user->save();

        return redirect()->route('candidatestep8');
        }
    }

    protected function rules(){
        $rules = [];

        foreach($this->references as $reference){
            $email_rules = ['email' . '.' . $reference->id => ['required', 'string', 'email', 'max:255']];
            $rules = $rules + $email_rules;
            $phone_rules = ['phone' . '.' . $reference->id => ['regex:/^(\d{3}-|\(\d{3}\)[- ]?)?\d{3}[- ]?\d{4}$/']];
            $rules = $rules + $phone_rules;
        }

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

    /* task - 86a0hxg00 public function autoSave($property)
    {
        $field_id = explode('.', $property);
        $current_field = $field_id[0];
        $reference_id = $field_id[1];
        $reference = Reference::find($reference_id);
        $reference->$current_field = $this->$current_field[$reference_id];
        $reference->save();

        $user = Auth::user();
        $user->current_step = 7;
        if($user->step_reached<7){
            $user->step_reached=7;
        }
        $user->save();
    } */

    public function removeRef($empID) // Task #86a0hf5r4
    {
        $employment = Reference::find($empID);
        if ($employment) {
            $employment->delete();
        }
        $this->emit(event: 'update_pg');
    }
}
