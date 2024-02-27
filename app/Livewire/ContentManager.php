<?php

namespace App\Livewire;

use Livewire\Component;

class ContentManager extends Component
{
    public array $stack = [];

    public function render()
    {
        return view('livewire.content-manager');
    }
}
