<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\Creditcard;
use App\Models\Company;
use App\Models\User;
use App\Models\Delete;
use App\Models\Invited_user;
// use App\Helpers\Api_helper;
use Auth;

class ManageAccount extends Component
{
    public function mount() {}

    public function render() {
        // get payment details
        $payments = Transaction::where('user_id', Auth::user()->id)->paginate(10);
        $delete=Delete::where('user_id',Auth::id())->first();
        return view('livewire.manage-account', compact('payments','delete'));
    }
    public function reactivateAccount() {

        $delete=Delete::where('user_id',Auth::id())->first();
        $deletedUser=$delete;
        if($delete->delete()){
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

            $createdAtString = $deletedUser->created_at->format('Y-m-d H:i:s');

            if ($nextDate < $createdAtString) {
                if (!empty($deletedUser->user_id)) {
                    if(!empty($subscription)){
                        $subscription->status=0;
                        $subscription->save();
                    }
                    session()->flash('message', 'Your account has been activated. To continue, click on a plan below.');
                    return redirect()->route('company.manage.subsciption');
                }
            }else{
                if (!empty($subscription->renewal_id)) {
                    $client = new \GuzzleHttp\Client();
                    $recurring_url = env('PAYAPI_URL') . "recurring-schedules/".$subscription->renewal_id;
                    $headers = [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . env('PAYAPI_TOKEN')
                    ];
                    $recurring_data = '{
                    "active": true
                    }';
                }

            $rec_response = $client->request('PATCH', $recurring_url, ['body' => $recurring_data, 'headers' => $headers]);
            }
            session()->flash('message', 'Your account has been reactivated and your previous subscription plan has been reinstated.');
        }
    }
}
