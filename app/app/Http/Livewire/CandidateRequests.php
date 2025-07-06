<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Invited_user;
use App\Models\CompanyUser;

class CandidateRequests extends Component
{
    public $company_id;
    public $currentNote = '';
    public $currentEmployer;

    //mode 0 for non archive and 1 for archive
    public $mode = false;

    public function render()
    {
        if($this->mode){
            $unmaskRequests = Auth::user()->archive_companies()->get();
        } else {
            $unmaskRequests = Auth::user()->companies()->get();
        }
        $this->dispatchBrowserEvent('initTable');
        return view('livewire.candidate-requests',compact('unmaskRequests'));
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
        // task - 8678fkau6 end

        $this->emit('refreshComponent');
        $this->emit('updateCounts'); // task - 86a0yjymm
        $this->emit('updateFavorites'); // task - 86a0yjymm
    }

    public function viewNote($unmasked){
        $this->currentNote = $unmasked['pivot']['message'];
        $this->currentEmployer = $unmasked['company_name'];
        return response()->json([]);
    }

    public function delete($company_id){
        $com_user = DB::table('company_user')->where('company_id', $company_id)
                                 ->where('user_id', Auth::user()->id);
        $com_user->update(['deleted_at' => now()]);
    }

    // task - 86a0unh6f
    public function restore($company_id){
        $com_user = DB::table('company_user')->where('company_id', $company_id)
                                 ->where('user_id', Auth::user()->id);
        $com_user->update(['deleted_at' => null]);
    }
}
