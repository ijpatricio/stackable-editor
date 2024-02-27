<?php

namespace App\Livewire;

use App\Models\StackableContent;
use Livewire\Component;

class ContentManager extends Component
{
    public  StackableContent $stackableContent;

    public array $stack = [
         'uuid1',
    ];

    public function mount()
    {
        ray($this->stackableContent);
    }

    public function render()
    {
        return view('livewire.content-manager');
    }
}
