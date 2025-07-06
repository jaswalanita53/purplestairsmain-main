<?php

namespace App\Http\Livewire;

use App\Models\Language;
use App\Models\Skill;
use App\Models\User;
use App\Models\Employment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CandidateStep6 extends Component
{
    public
    $all_languages,
    $selectedLanguages,
    $all_soft_skills,
    $selectedSoftSkills,
    $all_hard_skills,
    $selectedHardSkills,
    $hard_skills,
    $hard_skills_status,
    $soft_skills,
    $soft_skills_status;
    public $profileSaved = false;
    public function mount()
    {

        $employment=Employment::where('user_id',Auth::user()->id)->where(['company_name'=>null,'position'=>null,'responsibilities'=>null,'start_year'=>null,'end_year'=>null,'currently_working'=>0,'accomplishments'=>null])->delete(); // Task #86a0d8e1v

        //getting all languages and authenticated users languages
        // task - 86a1zbdp7
        // $this->all_languages = Language::orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $this->all_languages = Language::orderByRaw('id=1 DESC,id=4 DESC, `name` ASC')->pluck('id', 'name')->toArray();
        $this->selectedLanguages = Auth::user()->languages()->pluck('languages.id')->toArray();

        //getting all soft skills and authenticated users soft skills
        $this->all_soft_skills = Skill::where('skill_type', 'soft_skills')->orderBy('name', 'asc')->pluck('id', 'name')->toArray();

        $this->selectedSoftSkills = Auth::user()->softSkills->pluck('id')->toArray();

        //getting all hard skills and authenticated users hard skills
        $this->all_hard_skills = Skill::where('skill_type', 'hard_skills')->orderBy('name', 'asc')->pluck('id', 'name')->toArray();
        $this->selectedHardSkills = Auth::user()->hardSkills->pluck('id')->toArray();

        $user = User::find(Auth::user()->id);
        $user->current_step = 6;
        if($user->step_reached<6){
            $user->step_reached=6;
        }
        $user->save();

    }

public function updated($property)
{
    // $this->autoSave($property); task - 86a0hxg00

    if($property == 'selectedLanguages'){
        // $this->dispatchBrowserEvent('keep-open-language');
    }

    if($property == 'selectedSoftSkills'){
        // $this->dispatchBrowserEvent('keep-open-soft');
    }

    if($property == 'selectedHardSkills'){


        // $this->dispatchBrowserEvent('keep-open-hard');
    }
}
    public function finish_later() { // task - 86a0hxg00
        Auth::user()->languages()->sync($this->selectedLanguages);

        Auth::user()->softSkills()->detach(Auth::user()->softSkills->pluck('id')->toArray());
        Auth::user()->softSkills()->attach($this->selectedSoftSkills);

        Auth::user()->hardSkills()->detach(Auth::user()->hardSkills->pluck('id')->toArray());
        Auth::user()->hardSkills()->attach($this->selectedHardSkills);

        $user = Auth::user();
        $user->current_step = 6;
        if($user->step_reached<6){
            $user->step_reached=6;
        }
        $this->profileSaved = true;
        $user->save();

        $this->dispatchBrowserEvent('init-select');
        //return redirect()->route('candidatestep7');
    }

    public function saveSkills() { // task - 86a0hxg00
        dd($this->selectedHardSkills);
        Auth::user()->languages()->sync($this->selectedLanguages);

        Auth::user()->softSkills()->detach(Auth::user()->softSkills->pluck('id')->toArray());
        Auth::user()->softSkills()->attach($this->selectedSoftSkills);

        Auth::user()->hardSkills()->detach(Auth::user()->hardSkills->pluck('id')->toArray());
        Auth::user()->hardSkills()->attach($this->selectedHardSkills);

        $user = Auth::user();
        $user->current_step = 6;
        if($user->step_reached<6){
            $user->step_reached=6;
        }
        $user->save();

        return redirect()->route('candidatestep7');
    }

public function autoSave($property){
 //check if the skill information present create if not.
 if($property == 'selectedLanguages'){
    Auth::user()->languages()->sync($this->selectedLanguages);
 }

 if($property == 'selectedSoftSkills'){
    // dd($this->selectedSoftSkills);
    Auth::user()->softSkills()->detach(Auth::user()->softSkills->pluck('id')->toArray());
    Auth::user()->softSkills()->attach($this->selectedSoftSkills);
 }

 if($property == 'selectedHardSkills'){
    Auth::user()->hardSkills()->detach(Auth::user()->hardSkills->pluck('id')->toArray());
    Auth::user()->hardSkills()->attach($this->selectedHardSkills);
 }

 $user = Auth::user();
 $user->current_step = 6;
 if($user->step_reached<6){
    $user->step_reached=6;
}
 $user->save();

    if($property == 'selectedLanguages'){
        $this->dispatchBrowserEvent('keep-open-language');
    }

    if($property == 'selectedSoftSkills'){
        $this->dispatchBrowserEvent('keep-open-soft');
    }

    if($property == 'selectedHardSkills'){
        $this->dispatchBrowserEvent('keep-open-hard');
    }
}
    public function render()
    {
        Auth::user()->languages()->sync($this->selectedLanguages);
        Auth::user()->softSkills()->detach(Auth::user()->softSkills->pluck('id')->toArray());
        Auth::user()->softSkills()->attach($this->selectedSoftSkills);
        Auth::user()->hardSkills()->detach(Auth::user()->hardSkills->pluck('id')->toArray());
        Auth::user()->hardSkills()->attach($this->selectedHardSkills);
        return view('livewire.candidate-step6');
    }
}
