<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscription;
use App\Models\Transaction;
use App\Models\Creditcard;
use App\Models\Company;
use App\Models\User;
use App\Models\Invited_user;
// use App\Helpers\Api_helper;
use Auth;

class CandidateManageAccount extends Component
{
    public function mount() {}

    public function render() {
        // get payment details
        $payments = Transaction::where('user_id', Auth::user()->id)->paginate(10);
        return view('livewire.candidate-manage-account');
    }
}