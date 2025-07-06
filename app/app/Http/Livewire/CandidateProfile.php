<?php

namespace App\Http\Livewire;

use App\Models\Note;
use App\Models\Personal;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CandidateProfile extends Component
{
    public $candidate_user;
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

    public $user_id;

    //note section
    public $notes;
    public $note;

    //unmask requests
    public $position_hiring;
    public $message;
    public $messageSent = false;
    public $requestCompany = false;

    public $company_id;
    public $auth_user = '';
    public $login_user = '';
    public $company = '';
    protected $listeners = ['updatePage' => '$refresh'];

    public function mount($user_id){
        $this->auth_user = Auth::user();
        $this->login_user = Auth::user()->id;

        if ($this->auth_user->reference > 0) {
            $this->company = Company::where('user_id', $this->auth_user->reference)->pluck('id')->first();
        } else {
            $this->company = Company::where('user_id', $this->login_user)->pluck('id')->first();
        }
        $this->user_id = $user_id;
        $this->candidate_user = User::find($user_id);
        $this->personal = Personal::where('user_id',$user_id)->first();
        if(!empty($this->candidate_user->industries)){
        $this->industries = $this->candidate_user->industries->pluck('name')->toArray();
    }
    if(!empty($this->candidate_user->interests)){
        $this->interests = $this->candidate_user->interests->pluck('name')->toArray();
    }
    if(!empty($this->candidate_user->educations)){
        $this->educations = $this->candidate_user->educations;
    }
    if(!empty($this->candidate_user->employments)){
        $this->employments = $this->candidate_user->employments;
    }
    if(!empty($this->candidate_user->skills)){
        $this->skills = $this->candidate_user->skills;
    }
    if(!empty($this->candidate_user->softSkills)){
        $this->soft_skills = $this->candidate_user->softSkills->pluck('name')->toArray();
    }
        if(!empty($this->candidate_user->hardSkills)){
        $this->hard_skills = $this->candidate_user->hardSkills->pluck('name')->toArray();
        }
        if(!empty($this->candidate_user->languages)){
        $this->languages = $this->candidate_user->languages->pluck('name')->toArray();
        }
        if(!empty($this->candidate_user->references)){
        $this->references = $this->candidate_user->references;
        }

        if (Auth::user()->reference > 0) {
            $this->company_id = Company::where('user_id', Auth::user()->reference)->pluck('id')->first();
        } else {
            $this->company_id = Company::where('user_id', Auth::user()->id)->pluck('id')->first();
        }

        $this->notes = Note::where('user_id', $user_id)->where('company_id', $this->company_id)->latest()->get();

        $company_user = DB::table('company_user')
                          ->where('user_id', $user_id)
                          ->where('company_id', $this->company_id)
                          ->first();
        $this->mode = $company_user ? $company_user->status : false;
        $this->mode = !$this->mode;

        if ($company_user) { // task - 862k30j85
            if ($company_user->status == 2) {
                $this->mode = true;
            }

            if ($company_user->status == 1) { // task - 86a0xw4t8
                $this->never_mode = true;
            }
        } else {
            $this->never_mode = false; // task - 86a0xw4t8
        }
        $this->requestCompany = $company_user ? true : false;

    }

    public function publish(){
        Auth::user()->status = 1;
        Auth::user()->save();
        $this->published = true;
    }

    public function saveNote(){
        $this->validate([
            'note' => ['required'],

        ]);
        Note::create([
            'user_id' => $this->user_id,
            'company_id' => $this->company_id,
            'created_by' => Auth::user()->id,
            'note' => $this->note
        ]);
        $this->dispatchBrowserEvent('close-note');
        $this->notes = Note::where('user_id', $this->user_id)->where('company_id', $this->company_id)->latest()->get();
        $this->note = '';
    }

    public function sendRequest(){

        $this->validate([
            'position_hiring' => ['required', 'string'],
            'message' => ['required', 'string']
        ]);

        $company_id = 0; $company_name = null;
        if ($this->auth_user->reference > 0) {
            $user_id = $this->auth_user->reference;
            $company_id = Company::where('user_id', $this->auth_user->reference)->pluck('id')->first();
            $company_name = Company::where('user_id', $this->auth_user->reference)->pluck('company_name')->first();
        } else {
            $user_id = Auth::user()->id;
            $company_id = Company::where('user_id', Auth::user()->id)->pluck('id')->first();
            $company_name = Company::where('user_id', Auth::user()->id)->pluck('company_name')->first();
        }
        $existingRequest = CompanyUser::where('user_id', $id)
    ->where('company_id', $company_id)
    ->first();
    if(!$existingRequest){
        $requested=new CompanyUser;
        $requested->company_id=$company_id;
        $requested->sender_id=Auth::id();
        $requested->user_id=$this->user_id;
        $requested->position_hiring=$this->position_hiring;
        $requested->message=$this->message;
        if($requested->save()){
            // task - 8678fd0em
            $tracking = \DB::table('employer_tracking')->where('employer_id', $user_id)->first();
            $track_arr = array(
                'employer_id' => $user_id,
                'last_unmask_req' => date('Y-m-d H:i:s'),
            );
            if ($tracking) {
                \DB::table('employer_tracking')->where('employer_id', $user_id)->update($track_arr);
            } else {
                $track_arr['last_matches_on'] = date('Y-m-d H:i:s');
                \DB::table('employer_tracking')->insert($track_arr);
            }
            // task - 8678fd0em end

            // task - 8678fkau6
            $candidate = User::find($this->user_id);
            $name = explode(' ', trim($candidate->name)); // task - 86a15vje7
            $data = array('name' => $name[0]/*candidate->name*/, 'company' => $company_name, 'hiring_position' => $this->position_hiring, 'message_txt' => $this->message, 'date' => date('m-d-Y'));
            $to_mail = $candidate->email;

            \Mail::send(['html'=>'mail.notify_request_unmask'], $data, function($message) use ($to_mail) {
                 $message->to($to_mail, 'Purple Stairs')->subject
                    ('Congrats! An Employer is Interested');
                 $message->from('info@purplestairs.com','Purple Stairs');
            });
            // task - 8678fkau6 end

            $this->position_hiring = '';
            $this->message = '';

            $this->mode = $requested ? $requested->status : false;
            $this->mode = !$this->mode;

            if ($requested) { // task - 862k30j85
                if ($requested->status == 2) {
                    $this->mode = true;
                }

                if ($requested->status == 1) { // task - 86a0xw4t8
                    $this->name_mode = true;
                }
                $this->requestCompany = $requested ? true : false;
                // $this->emit(event: 'updatePage');
                // $this->dispatchBrowserEvent('close-request-modal');

            } else {
                $this->name_mode = false; // task - 86a0xw4t8
            }
        }
        }else{
        $this->emit(event: 'updatePage');
        $this->dispatchBrowserEvent('close-request-modal');
    }

        // User::find($this->user_id)->companies()->syncWithPivotValues(
        //     [
        //         'company_id' => $this->company_id
        //     ],
        //     [
        //         'position_hiring' => $this->position_hiring,
        //         'message' => $this->message
        //     ]
        // );
        // $this->messageSent = true;
        // $this->position_hiring = '';
        // $this->message = '';

        // $company_user = DB::table('company_user')
        //                   ->where('user_id', $this->user_id)
        //                   ->where('company_id', $this->company_id)
        //                   ->first();
        // $this->mode = $company_user ? $company_user->status : false;
        // $this->mode = !$this->mode;

        // if ($company_user) { // task - 862k30j85
        //     if ($company_user->status == 2) {
        //         $this->mode = true;
        //     }
        // }
        // $this->requestCompany = $company_user ? true : false;
        // // $this->emit(event: 'updatePage');
        // // return response()->json();
    }

    public function render()
    {
        return view('livewire.candidate-profile');
    }

}
