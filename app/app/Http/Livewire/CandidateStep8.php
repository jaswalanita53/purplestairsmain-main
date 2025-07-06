<?php

namespace App\Http\Livewire;

use App\Models\Personal;
use App\Models\Reference;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
class CandidateStep8 extends Component
{
    use WithFileUploads;

    public $profile;
    public $profile_path;
    public $profile_status;
    public $short_bio,
           $allow_recruters_yes,
           $allow_recruters_no,
           $short_bio_status,
           $ad_source_linked_in,
           $ad_source_print_ad,
           $ad_source_online_ad,
           $ad_source_friend_family,
           $ad_source_whats_app_chat,
           $ad_source_whats_app_status,
           $ad_source_other,
           $other_ad_source_text,
           $ad_source;

    protected $listeners = ['update_pg' => '$refresh'];
    public $profileSaved = false;

    public function mount(){
        $employment=Reference::where('user_id',Auth::user()->id)->where(['name'=>null,'relationship'=>null,'phone'=>null,'email'=>null])->delete(); // Task #86a0d8e1v
        $personal =Personal::where('user_id',Auth::user()->id)->first();
        if(isset($personal)){
            $this->short_bio = $personal->short_bio;
            $this->short_bio_status = $personal->short_bio_status;
            $this->profile_status = $personal->profile_status;
        }
        $user = User::find(Auth::user()->id);
        $user->current_step = 8;
        if($user->allow_recuiters!==null){
        if($user->allow_recuiters==1){
            $this->allow_recruters_no=false;
            $this->allow_recruters_yes=true;

        }else{
            $this->allow_recruters_no=true;
            $this->allow_recruters_yes=false;

        }
    }
        if($user->step_reached<8){
            $user->step_reached=8;
        }

        // $user->ad_source=$this->ad_source;
        $user->save();
    }

    public function updated($property)
    {
        $this->profileSaved = false;
        // $this->autoSave($property);
    }

    public function finish_later()
    {

        $personal =Personal::where('user_id',Auth::user()->id)->first();
        if($this->profile) {
            $path = $this->save();
            $file_path = str_replace('public/','storage/app/public/',$path);
            $user = Auth::user();
            $user->profile_photo_path = $file_path;
            $user->save();

            $this->dispatchBrowserEvent('temp-update-avatar', ['newPath' => $file_path]);
        }

        if(isset($personal)){
            $personal->short_bio = ($this->short_bio != "" ? $this->short_bio : 0);
            $personal->short_bio_status = ($this->short_bio_status != "" ? $this->short_bio_status : 0);
            $personal->profile_status = ($this->profile_status != "" ? $this->profile_status : 0);
            $personal->save();
        } else {
            Personal::create([
                'short_bio' => ($this->short_bio!="" ? $this->short_bio : null),
                'short_bio_status' => ($this->short_bio_status!="" ? $this->short_bio_status : 0),
                'profile_status' => ($this->profile_status!="" ? $this->profile_status : 0),
                'user_id' => Auth::user()->id
            ]);
        }
        $this->profileSaved = true;
        $user = Auth::user();
        $user->current_step = 8;
        if($this->allow_recruters_yes===true){
            $this->allow_recruters_no=false;
            $this->allow_recruters_yes=true;
              $user->allow_recuiters = 1;
        }else{
            $this->allow_recruters_no=true;
            $this->allow_recruters_yes=false;
            $user->allow_recuiters = 0;
        }

        if($this->allow_recruters_no===true){
            $this->allow_recruters_no=true;
            $this->allow_recruters_yes=false;
              $user->allow_recuiters = 0;
        }else{
            $this->allow_recruters_no=false;
            $this->allow_recruters_yes=true;
            $user->allow_recuiters = 1;
        }
        if($user->step_reached<8){
            $user->step_reached=8;
        }
        if(!empty($this->ad_source_linked_in)){

            $this->ad_source=$this->ad_source_linked_in;
        }
        if(!empty($this->ad_source_print_ad)){
            $this->ad_source=$this->ad_source_print_ad;
        }
        if(!empty($this->ad_source_online_ad)){
            $this->ad_source=$this->ad_source_online_ad;
        }
        if(!empty($this->ad_source_friend_family)){
            $this->ad_source=$this->ad_source_friend_family;
        }
        if(!empty($this->ad_source_whats_app_chat)){
            $this->ad_source=$this->ad_source_whats_app_chat;
        }
        if(!empty($this->ad_source_whats_app_status)){
            $this->ad_source=$this->ad_source_whats_app_status;
        }
        if(!empty($this->ad_source_other)){
            $this->ad_source=$this->ad_source_other;
        }
        $user->ad_source=$this->ad_source;
        $user->other_ad_source_text=$this->other_ad_source_text;
        $user->save();

        //return redirect()->route('candidatestep9');
    }

    public function saveAbout()
    {
        // $this->validate([
        //     'allow_recruters_yes' => ['required'],// 1MB Max
        // ]);
        $personal =Personal::where('user_id',Auth::user()->id)->first();
        if($this->profile) {
            $path = $this->save();
            $file_path = str_replace('public/','storage/app/public/',$path);
            $user = Auth::user();
            $user->profile_photo_path = $file_path;
            $user->save();

            $this->dispatchBrowserEvent('temp-update-avatar', ['newPath' => $file_path]);
        }

        if(isset($personal)){
            $personal->short_bio = $this->short_bio;
            $personal->short_bio_status = $this->short_bio_status;
            $personal->profile_status = $this->profile_status;
            $personal->save();
        } else {
            Personal::create([
                'short_bio' => $this->short_bio,
                'short_bio_status' => $this->short_bio_status,
                'profile_status' => $this->profile_status,
                'user_id' => Auth::user()->id
            ]);
        }

        $user = Auth::user();
        $user->current_step = 8;
        if($this->allow_recruters_yes===true){
            $this->allow_recruters_no=false;
            $this->allow_recruters_yes=true;
              $user->allow_recuiters = 1;
        }else{
            $this->allow_recruters_no=true;
            $this->allow_recruters_yes=false;
            $user->allow_recuiters = 0;
        }

        if($this->allow_recruters_no===true){
            $this->allow_recruters_no=true;
            $this->allow_recruters_yes=false;
              $user->allow_recuiters = 0;
        }else{
            $this->allow_recruters_no=false;
            $this->allow_recruters_yes=true;
            $user->allow_recuiters = 1;
        }

        if($user->step_reached<8){
            $user->step_reached=8;
        }
        if(!empty($this->ad_source_linked_in)){

            $this->ad_source=$this->ad_source_linked_in;
        }
        if(!empty($this->ad_source_print_ad)){
            $this->ad_source=$this->ad_source_print_ad;
        }
        if(!empty($this->ad_source_online_ad)){
            $this->ad_source=$this->ad_source_online_ad;
        }
        if(!empty($this->ad_source_friend_family)){
            $this->ad_source=$this->ad_source_friend_family;
        }
        if(!empty($this->ad_source_whats_app_chat)){
            $this->ad_source=$this->ad_source_whats_app_chat;
        }
        if(!empty($this->ad_source_whats_app_status)){
            $this->ad_source=$this->ad_source_whats_app_status;
        }
        if(!empty($this->ad_source_other)){
            $this->ad_source=$this->ad_source_other;
        }
        $user->other_ad_source_text=$this->other_ad_source_text;
          $user->ad_source=$this->ad_source;
        $user->save();


        return redirect()->route('candidatestep9');
    }

    public function autoSave($property){
        /* task - 86a1tzdqv - POINT - 6
        //get the current user personal information
        $personal =Personal::where('user_id',Auth::user()->id)->first();
        //check if the personal information present create if not.
        if(isset($personal)){
            if ($property === 'profile') {
                $path = $this->save();
                $file_path = str_replace('public/','storage/app/public/',$path);
                $user = Auth::user();
                $user->profile_photo_path = $file_path;
                $user->save();
                // $this->render();
                $this->dispatchBrowserEvent('load-switches');
                $this->dispatchBrowserEvent('temp-update-avatar', ['newPath' => $file_path]);
            }
            else{
                $personal->$property = $this->property;
                $personal->save();
            }
        }
        else{
            Personal::create([
                'short_bio' => $this->short_bio,
                'short_bio_status' => $this->short_bio_status,
                'profile_status' => $this->profile_status,
                'allow_recruters'=> ($this->allow_recruters !="no"? 1:0),
                'user_id' => Auth::user()->id
                ]);
        }
        $user = Auth::user();
        $user->current_step = 8;
        if($user->step_reached<8){
            $user->step_reached=8;
        }
        $user->save();

        $this->dispatchBrowserEvent('load-switches');*/
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
            'profile' => 'max:1024|mimes:jpg,bmp,png,jpeg,gif', // 1MB Max
        ]);
        $path = $this->profile->store('public/profile');

        return $path;
    }

    public function render()
    {
          return view('livewire.candidate-step8');
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
}
