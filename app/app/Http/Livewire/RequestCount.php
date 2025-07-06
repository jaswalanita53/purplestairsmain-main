<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RequestCount extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];
    
    public function render()
    {
        return view('livewire.request-count');
    }
}
