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

class PaymentHistory extends Component
{
    public function mount() {
        // 86a2ggtje
        $deleted=Delete::where('user_id',Auth::id())->first();
        if(!empty($deleted->status)){
            session()->flash('error', 'Your account has been deactivated.');
            echo "<script>window.location.href = '" . url('/company/manage-account') . "';</script>";
        }
    }

    public function render() {
        // get payment details
        $payments = Transaction::where('user_id', Auth::user()->id)->paginate(10);
        return view('livewire.payment-history', compact('payments'));
    }
}