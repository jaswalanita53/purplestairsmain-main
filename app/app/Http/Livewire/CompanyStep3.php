<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\User;
use App\Models\CompanyUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CompanyStep3 extends Component
{
    public $company;
    public $company_profile; // task - 8678fkau6
    public $published;

    public function mount(){
        $userId=Auth::user()->id;

        if (!empty(request()->query('id'))) {
            $userId = request()->get('id');
         }
         if(isset($_GET['id'])){
            $userId = $_GET['id'];
        }
        $this->company = Company::where('user_id',$userId)->with('companyUsersRequest')->first();

        if(empty($this->company)) {
            echo "<script>window.location.href='".route('candidates.requests')."'</script>";
            die();
        }

        $this->company_profile = User::where('id',$userId)->pluck('profile_photo_path')->first(); // task - 8678fkau6
    }

    public function render()
    {
        return view('livewire.company-step3');
    }

    public function approveProfile()
    {
        /* task - 862k2tb3v Auth::user()->status = 1;
        Auth::user()->save();*/
        $this->published = true;
    }

    public function viewProfileApprove()
    {
        /* task - 862k2tb3v Auth::user()->status = 1;
        Auth::user()->save();*/
        $this->published = true;

        redirect()->route('company.editprofile');
    }
    public function unmaskProfile($company_id,$status)
    {
        $sender="";
        $this->company_id = $company_id;
        $unrequest = CompanyUser::where('company_id', $company_id)
            ->where('user_id', Auth::user()->id)->first();
            $unrequest->status=$status;
            $unrequest->updated_at=now();
            if($unrequest->save()){
                $sender=User::find($unrequest->sender_id);
                if(!empty($sender)){
                    $sender=$sender;
                }
            };



        // task - 8678fkau6
        if($status) {
            $company = Company::find($company_id);
            $name = explode(' ', trim($company->company_name)); // task - 86a15vje7
            $data = array('name' => $name[0]/*company->company_name*/, 'candidate_id' => Auth::user()->id);
            $to_mail = $company->company_email;
            // 86a314ztu
            if(!empty($sender)){
            $name = explode(' ', trim($sender->name));
            $data = array('name' => $name[0], 'candidate_id' => Auth::user()->id);
            $to_mail = $sender->email;
            }
               \Mail::send(['html'=>'mail.notify_unmask_candidate_profile'], $data, function($message) use ($to_mail) {
                $message->to($to_mail, 'Purple Stairs')->subject
                   ('Unmask Request Granted');
                $message->from('info@purplestairs.com','Purple Stairs');
           });

        }
        redirect()->route('candidates.requests');
    }
}
