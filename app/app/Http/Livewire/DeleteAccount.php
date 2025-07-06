<?php

namespace App\Http\Livewire;

use App\Models\Delete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;
use App\Models\Subscription;
use App\Http\Controllers\Backend\EmployersController;

class DeleteAccount extends Component
{
    public $other;
    public $password;
    public $reason;

    protected $listeners = ['deleteAccount'];
    public function mount()
    {
        $redirect_to = \Session::has('redirect') ? \Session::get('redirect') : null;
        if (request()->input('re') == "account/delete" || $redirect_to == "account/delete") {
            $this->reason = "I found a job";
        }
    }
    public function render()
    {
        $subscription = Subscription::where('user_id', Auth::id())->where('status', 1)->first();


            $nextDate = "";

            if (!empty($subscription->renewal_id)) {

                try {
                    $client = new \GuzzleHttp\Client();
                    $api_url = env('PAYAPI_URL') . "transactions/charge";
                    $headers = [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
                    ];
                    $hist_url = env('PAYAPI_URL') . "recurring-schedules/" . $subscription->renewal_id;
                    $h_reposnse = $client->request('GET', $hist_url, ['headers' => $headers]);
                    $h_statusCode = $h_reposnse->getStatusCode();
                    $h_content = json_decode($h_reposnse->getBody(), true);
                    $recurring = $h_content;

                    if (!empty($recurring['next_run_date'])) {
                        $nextDate = $recurring['next_run_date'];
                    }
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    // dd($e->getMessage());
                    session()->flash('message', $e->getMessage());
                    // return response()->json();
                }
            }
        return view('livewire.delete-account',compact('nextDate'));
    }

    public function deleteAccount()
    {
        if (Auth::user()->provider_id == '') {
            if (Hash::check($this->password, Auth::user()->password)) {
                if (Delete::create([
                    'reason' => $this->reason,
                    'other'  => $this->other,
                    'user_id' => Auth::user()->id,
                    'type' => 'delete'
                ])) {
                    // $user=User::find(Auth::id()); //Task 86a0gehgg
                    // $email=$user->email.'deleted';
                    // $user->email=$email;
                    // $user->save();
                }
                // The passwords match...
                Auth::user()->delete();
                Auth::logout();
                session()->flush();
                session()->regenerate(true);
                $subscription = Subscription::where('user_id', Auth::id())->where('status', 1)->first();
                if (!empty($subscription->renewal_id)) {
                    $this->recurringOff($subscription->renewal_id, $subscription->id);
                }
                session()->flash('error', 'Your account has been deleted.');
                return redirect()->route('login');
            } else {
                $this->addError('password', 'Invalid password.');
            }
        } else {
            Delete::create([
                'reason' => $this->reason,
                'other'  => $this->other,
                'user_id' => Auth::user()->id,
                'type' => 'delete'
            ]);
            // The passwords match...
            // $user=User::find(Auth::id()); //Task 86a0gehgg
            // $email=$user->email.'deleted';
            // $user->email=$email;
            // $user->save();
            if(Auth::user()->user_type=='employer'){
                if (!empty($subscription->renewal_id)) {
                    $employersController = new EmployersController();
                    $employersController->recurringOff($subscription->renewal_id, $subscription->id);
                }

            }else{
                Auth::user()->delete();
            }

            // Auth::user()->delete();
            session()->flash('error', 'Your account has been deleted.');
            if(Auth::user()->user_type=='employer'){
                session()->flash('error', 'Your account has been deactivated.');
                return redirect()->route('company.manageaccount');
            }
            Auth::logout();
            return redirect()->route('login');
        }
    }
    public function restrictDeletedAccount()
    {

        $deleted = Delete::where('status', 0)->get();

        foreach ($deleted as $deletedUser) {
            $user=User::find($deletedUser->user_id);
            if(!empty($user->id)){
            $subsUser=$user->id;
            if(!empty($user->reference)){
                $subsUser=$user->reference;
            }
            $subscription = Subscription::where('user_id', $subsUser)->where('status', 1)->first();


            $nextDate = "";

            if (!empty($subscription->renewal_id)) {

                try {
                    $client = new \GuzzleHttp\Client();
                    $api_url = env('PAYAPI_URL') . "transactions/charge";
                    $headers = [
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
                    ];
                    $hist_url = env('PAYAPI_URL') . "recurring-schedules/" . $subscription->renewal_id;
                    $h_reposnse = $client->request('GET', $hist_url, ['headers' => $headers]);
                    $h_statusCode = $h_reposnse->getStatusCode();
                    $h_content = json_decode($h_reposnse->getBody(), true);
                    $recurring = $h_content;

                    if (!empty($recurring['next_run_date'])) {
                        $nextDate = $recurring['next_run_date'];
                    }
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    // dd($e->getMessage());
                    session()->flash('message', $e->getMessage());
                    // return response()->json();
                }
            }

            $createdAtString = $deletedUser->created_at->format('Y-m-d H:i:s');

            if ($nextDate < $createdAtString) {
                if (!empty($deletedUser->user_id)) {
                    $user = User::find($deletedUser->user_id);
                    if (!empty($user)) {
                        // $user->delete();
                        Delete::find($deletedUser->id)->update(['status' => 1]);
                        if(!empty($user->reference)){
                            $join_user = User::find($user->id);
                            $join_user->reference = 0;
                            $join_user->save();
                        }

                    }
                }
            }
            }

        }

     }
}
