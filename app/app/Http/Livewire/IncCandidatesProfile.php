<?php

namespace App\Http\Livewire;

use App\Models\Note;
use App\Models\Personal;
use App\Models\User;
use App\Models\Search; // task - 86a2vx5er
use App\Models\Company;
use App\Models\CompanyUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
// use Illuminate\Support\Facades\Schema; // task - 86a1tzdqv

class IncCandidatesProfile extends Component
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
    public $never_mode = true; // task - 86a1tzdqv - POINT - 7 (before false)
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

    public $favorites = []; // task - 86a2vx5er
    public $search_id = 0; // task - 86a2vx5er
    public $saved_searches = 0; // task - 86a2vx5er

    protected $listeners = ['updatePopup' => '$refresh', 'deleteNote']; // task - 86a2ykzx3

    public $relevants = [], $non_relevants = [];

    public function mount($user_id, $candidate_user, $favorites, $search_id, $saved_searches, $company_id=null, $relevants=null, $non_relevants=null){
        $this->auth_user = Auth::user();
        $this->login_user = $this->auth_user->id;

        if (is_null($company_id)) {
            $this->auth_user = Auth::user();
            $this->login_user = $this->auth_user->id;

            if ($this->auth_user->reference > 0) {
                $ref_user = $this->auth_user->reference;
                $this->company = User::find($ref_user)->company->id;
            } else {
                $this->company = $this->auth_user->company->id;
            }
        } else {
            $this->company = $company_id;
        }

        $this->user_id = $user_id;
        $this->candidate_user = $candidate_user;
        $this->personal = $candidate_user->personal;
        if(!empty($this->candidate_user->industries)){
            $this->industries = $this->candidate_user->industries->pluck('pivot.primary_status','name')->toArray();
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

        if ($this->auth_user->reference > 0) {
            $this->company_id = Company::where('user_id', $this->auth_user->reference)->pluck('id')->first();
        } else {
            $this->company_id = Company::where('user_id', $this->auth_user->id)->pluck('id')->first();
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

            // task - 86a2enuvn
            if ($company_user->status == 1) {
                $this->mode = false;
            }

            if ($company_user->status == 1) { // task - 86a0xw4t8
                $this->never_mode = true;
            }
        } else {
            $this->name_mode = false; // task - 86a0xw4t8 | task - 86a1tzdqv - POINT - 7 (before false)
        }
        $this->requestCompany = $company_user ? true : false;

        $this->favorites = $favorites; // task - 86a2vx5er
        $this->search_id= $search_id; // task - 86a2vx5er
        $this->saved_searches= $saved_searches; // task - 86a2vx5er

        if (is_null($relevants)) {
            if ($search_id) {
                $this->relevants = \DB::table('relevant')->where(['company_id' => $this->company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            } else {
                $this->relevants = \DB::table('relevant')->where('company_id', $this->company_id)->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            }
        } else {
            $this->relevants = $relevants;
        }

        if (is_null($non_relevants)) {
            if ($search_id) {
                $this->non_relevants = \DB::table('non_relevant')->where(['company_id' => $this->company_id, 'search_id' => $search_id])->pluck('candidate_id')->toArray();
            } else {
                $this->non_relevants = \DB::table('non_relevant')->where('company_id', $this->company_id)->whereRaw('(search_id IS NULL OR search_id=0)')->pluck('candidate_id')->toArray();
            }
        } else {
            $this->non_relevants = $non_relevants;
        }
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
        $this->dispatchBrowserEvent('close-note', ['hide_id' => $this->user_id]); // task - 86a22j70y
        $this->dispatchBrowserEvent('save-note-update', ['username' => ucwords(Auth::user()->name), 'note' => $temp_note, 'date' => date('m-d-Y')]);
        $this->notes = Note::where('user_id', $this->user_id)->where('company_id', $this->company_id)->latest()->get();
        $this->note = '';

        $this->initSearches();
    }

    // task - 86a39a7q5
    public function deleteNote($note_id)
    {
        $note = Note::find($note_id);
        if ($note) {
            $note->delete();
        }

        $this->initSearches();
    }

    public function initSearches()
    {
        foreach ($this->saved_searches as $k => $search_) {
            $search_candidate = $search_->users->toArray();
            $this->saved_searches[$k]['candidate_ids'] = array_column($search_candidate, 'id');
        }
    }
    // task - 86a39a7q5 end

    public function incsendRequest(){

        $this->validate([
            'position_hiring' => ['required', 'string'],
            'message' => ['required', 'string']
        ]);
        $auth_user = Auth::user();
        $company_id = 0; $company_name = null;
        if ($this->auth_user->reference > 0) {
            $user_id = $this->auth_user->reference;
            $company_id = Company::where('user_id', $this->auth_user->reference)->pluck('id')->first();
            $company_name = Company::where('user_id', $this->auth_user->reference)->pluck('company_name')->first();
        } else {
            $user_id = $auth_user->id;
            $company_id = Company::where('user_id', $auth_user->id)->pluck('id')->first();
            $company_name = Company::where('user_id', $auth_user->id)->pluck('company_name')->first();
        }
        $existingRequest = CompanyUser::where('user_id', $this->user_id)
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

            $company_user = DB::table('company_user')
                          ->where('user_id', $this->user_id)
                          ->where('company_id', $this->company_id)
                          ->first();
            $this->requestCompany = $company_user ? true : false;

            if ($company_user) { // task - 862k30j85
                if ($company_user->status == 2) {
                    $this->mode = true;
                }

                // task - 86a2enuvn
                if ($company_user->status == 1) {
                    $this->mode = false;
                }

                if ($company_user->status == 1) { // task - 86a0xw4t8
                    $this->name_mode = true;
                }
                $this->requestCompany = $company_user ? true : false;
                // $this->emit(event: 'updatePage');
                // $this->dispatchBrowserEvent('close-request-modal');

            } else {
                $this->name_mode = false; // task - 86a0xw4t8
            }
        }
        }
        $this->candidate_user = User::find($this->user_id);
        // task - 86a32ur5v
        $this->initSearches();
        $this->dispatchBrowserEvent('updateReqModal');
    }

    public function render()
    {
        $company_user = DB::table('company_user')
                          ->where('user_id', $this->user_id)
                          ->where('company_id', $this->company_id)
                          ->first();
        $this->mode = $company_user ? $company_user->status : false;
        $this->mode = !$this->mode;

        if ($company_user) { // task - 862k30j85
            if ($company_user->status == 2) {
                $this->mode = true;
            }

            // task - 86a2enuvn
            if ($company_user->status == 1) {
                $this->mode = false;
            }

            if ($company_user->status == 1) { // task - 86a0xw4t8
                $this->never_mode = true;
            }
        } else {
            $this->name_mode = false; // task - 86a0xw4t8 | task - 86a1tzdqv - POINT - 7 (before false)
        }
        $this->requestCompany = $company_user ? true : false;
        return view('livewire.inc-candidates-profile');
    }

    // task - 86a2vx5er
    public function changeEvent($is_checked, $search_id, $candidate_id)
    {
        $search_user = \DB::table('search_user')->where(['search_id' => $search_id, 'user_id' => $candidate_id])->first();
        // if already in saved search user
        if (!empty($search_user) && $is_checked == 1) {
            \DB::table('search_user')->where(['search_id' => $search_id, 'user_id' => $candidate_id])->delete();
        } elseif (empty($search_user) && $is_checked == 0) {
            \DB::table('search_user')->insert([
                'search_id' => $search_id,
                'user_id' => $candidate_id
            ]);
        }

        $search = Search::withTrashed()->find($search_id);

        if ($is_checked == 0) {
            $userIds=json_decode($search->synced_users, true);
            if(!in_array($candidate_id, $userIds)) { $userIds[]=$candidate_id; };

            $userIds2 = json_decode($search->old_synced_users, true);
            if(!in_array($candidate_id, $userIds2)) { $userIds2[]=$candidate_id; };
            $search->synced_users=$userIds;
            $search->old_synced_users=$userIds2;
        } elseif ($is_checked == 1) {
            $userIds=json_decode($search->synced_users, true);
             $index = array_search($candidate_id, $userIds);
            if ($index !== false) {
                array_splice($userIds, $index, 1);
            }

            // task - 86a2rvvjz
            $userIds2 = json_decode($search->old_synced_users, true);
            if(!in_array($candidate_id, $userIds2)) { $userIds2[]=$candidate_id; };
            $search->old_synced_users=$userIds2;
            
            $search->synced_users=$userIds;
        }
        $search->save();

        $search_count = \DB::table('search_user')->where(['search_id' => $search_id])->count();
        $search = Search::find($search_id);
        $search->old_match_count = $search_count;
        if ($search->save()) {
            foreach ($this->saved_searches as $k => $search_) {
                $search_candidate = $search_->users->toArray();
                $this->saved_searches[$k]['candidate_ids'] = array_column($search_candidate, 'id');
            } 

            $this->dispatchBrowserEvent('loadAfterload');
            $this->emit(event: 'updateSeraches');
        }
    }
}
