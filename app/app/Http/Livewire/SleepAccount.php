<?php

namespace App\Http\Livewire;

use App\Models\Delete;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class SleepAccount extends Component
{
    public $other;
    public $password;
    public $reason;

    public function render()
    {
        return view('livewire.sleep-account');
    }

    public function sleepAccount(){
        if(Auth::user()->provider_id == '')
        {
            if (Hash::check($this->password, Auth::user()->password)) {
                Delete::create([
                    'reason' => $this->reason,
                    'other'  => $this->other,
                    'user_id' => Auth::user()->id,
                    'type' => 'sleep'
                ]);
                // The passwords match...
                // Auth::user()->delete(); task - 86a32nrge
                Auth::user()->status = 0;
                Auth::logout();
                 session()->flash('error', 'Your account has been put to sleep.');
                return redirect()->route('login');
            }
            else{
                session()->flash('error', 'Invalid password.');
            }
        }
        else{
            Delete::create([
                'reason' => $this->reason,
                'other'  => $this->other,
                'user_id' => Auth::user()->id,
                'type' => 'sleep'
            ]);
            // The passwords match...
            // Auth::user()->delete(); task - 86a32nrge
                Auth::user()->status = 0;
            Auth::logout();
             session()->flash('error', 'Your account has been put to sleep.');
            return redirect()->route('login');
        }
    }
}
