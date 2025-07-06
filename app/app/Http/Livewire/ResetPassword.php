<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Rules\MatchOldPassword;

class ResetPassword extends Component
{
    public $current_password;
    public $password;
    public $confirmPassword;

    public function rules()
    {
        return [
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required', 'string', 'min:8'] //Task #86a0fxftf
            // 'confirmPassword' => ['required','same:password'], task - 8678egn9b
        ];
    }

    public function updated($property)
    {
        $this->password=trim($this->password);
        if (array_key_exists($property, $this->rules())) {
            $this->validateOnly($property);
        }
    }

    public function updatePassword(){
        $this->password=trim($this->password);
        $this->validate();
        //email notification to admin
        User::find(auth()->user()->id)->update(['password'=> Hash::make($this->password)]);
        $this->reset();

        session()->flash('message', 'Password updated successfully.');
    }

    public function render()
    {
        return view('livewire.reset-password');
    }
}
