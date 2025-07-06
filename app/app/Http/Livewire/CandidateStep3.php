<?php

namespace App\Http\Livewire;

use App\Models\Personal;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class CandidateStep3 extends Component
{
    use WithFileUploads;
    public $resume;
    public $resume_path;
    public $upload_type = '';

    public function mount()
    {
        $personal = Personal::where('user_id', Auth::user()->id)->first();
        if (isset($personal)) {
            $this->resume_path = $personal->resume;
        }
        $user = User::find(Auth::user()->id);
        $user->current_step = 3;
        if($user->step_reached<3){
            $user->step_reached=3;
        }
        $user->save();

    }

    public function updated($property)
    {
        $this->autoSave($property);
    }

    public function autoSave($property)
    {
        //get the current user personal information
        $personal = Personal::where('user_id', Auth::user()->id)->first();
        //check if the personal information present
        if (isset($personal)) {
            if ($property === 'resume') {
                $path = $this->save();
                $file_path = str_replace('public/','storage/',$path);
                $personal->resume = $file_path;
                $personal->save();

                //update resume path
                $this->resume_path = $personal->resume;

                //data retrived from resume commented until client confirmation
                // $resume_data = $this->getResumeData(public_path($file_path));
            }
        }
        $user = Auth::user();
        $user->current_step = 3;
        if($user->step_reached<3){
            $user->step_reached=3;
        }
        $user->save();
    }

    public function save()
    {
        $this->validate([
            'resume' => 'max:1024', // 1MB Max
        ]);
        $path = $this->resume->store('public/resumes');
        return $path;
    }

    //get resume data using third party api
    public function getResumeData($file_path){
        //for testing adding this public path
        $file_path = "https://laravelhelper.monster/abouts/originals/rajvarman.pdf";
        $response = Http::withHeaders([
            'apikey' => "qZZnvT2KIH461BxooSHC6RvqN9xLXikW",
        ])
        ->withOptions(["verify"=>false])
        ->get("https://api.apilayer.com/resume_parser/url?url=" . $file_path);
        //getting array of data
        return json_decode($response->body(),true);
    }

    public function updateUploadType($upload_type){
        if($upload_type == 'manual'){
          $this->next();
        }
        $this->upload_type = $upload_type;
    }

    public function next(){
      return redirect('/candidate/education');
    }

    public function render()
    {
        return view('livewire.candidate-step3');
    }


}
