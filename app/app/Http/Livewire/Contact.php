<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    public $name;
    public $email;
    public $phone_number;
    public $subject;
    public $message;

    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required','email'],
            //'phone_number' => ['required|numeric|min:10|regex:/^(\d{3}-|\(\d{3}\)[- ]?)?\d{3}[- ]?\d{4}$/'],
            // 'subject' => ['required'],
            // 'message' => ['required'],
        ];
    }

    public function updated($property)
    {
        if (array_key_exists($property, $this->rules())) {
            $this->validateOnly($property);
        }
    }

    public function saveContact(){
        $this->validate();
        //email notification to admin
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'subject' => $this->subject,
            'contact_message' => $this->message
        ];

        Mail::send('mail.contact',$data, function ($message) use ($data){
            $message->from($this->email, "purplestairs.com");
            $message->to('info@purplestairs.com');
            $message->subject('NEW FORM REQUEST');
        });

        $this->reset();

        session()->flash('message', 'Form Submitted.');
    }

    public function render()
    {
        return view('livewire.contact');
    }
}
