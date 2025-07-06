<?php

namespace App\Http\Livewire;

use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CandidateStep9 extends Component
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
    public $published = false;
    protected $listeners = ['publish'];

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

        $user = User::find(Auth::user()->id); // Task #86a0hfczk
        $user->current_step = 9;
        if($user->step_reached<9){
            $user->step_reached=9;
        }
        $user->save();
    }


    public function publish(){
        Auth::user()->status = 1;
        Auth::user()->approved_date = date('Y-m-d H:i:s'); // task - 86a2kkdyc
        Auth::user()->current_step = 8;
        Auth::user()->save();

        // task - 86a1hvf1m
        $user = Auth::user();
        \Mail::send(['html' => 'mail.candidate_published_profle'], [], function ($message) use ($user) {
            $message->to($user->email, 'Purple Stairs')->subject('Candidate Profile Complete');
            $message->from('info@purplestairs.com', 'Purple Stairs');
        });

        $this->published = true;
    }


    public function editProf(){
        $user = Auth::user();
        $user->current_step = 9;
        if($user->step_reached<9){
            $user->step_reached=9;
        }
        if($user->save()){
            return redirect('/candidate/edit/personal');
        }
    }

    public function render()
    {
        return view('livewire.candidate-step9');
    }
}
