<?php

namespace App\Http\Livewire;

use App\Models\Personal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CandidatesProfile extends Component
{
    public $personal;
    public $industries;
    public $interests;
    public $educations;
    public $employments;
    public $skills;
    public $soft_skills;
    public $hard_skills;
    public $languages;
    public $references;
    public $mode = true;
    public $never_mode = false; // task - 86a1tzdqv - POINT - 7 (before false)

    public function mount(){
        $this->personal = Personal::where('user_id',Auth::user()->id)->first();
        $this->industries = Auth::user()->industries->pluck('name')->toArray();
        $this->interests = Auth::user()->interests->pluck('name')->toArray();
        $this->educations = Auth::user()->educations;
        $this->employments = Auth::user()->employments;
        $this->skills = Auth::user()->skills;
        $this->soft_skills = Auth::user()->softSkills->pluck('name')->toArray();
        $this->hard_skills = Auth::user()->hardSkills->pluck('name')->toArray();
        $this->languages = Auth::user()->languages->pluck('name')->toArray();
        $this->references = Auth::user()->references;
    }

    public function render()
    {
        return view('livewire.candidates-profile');
    }
}
