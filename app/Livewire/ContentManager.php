<?php

namespace App\Livewire;

use App\Models\StackableContent;
use Livewire\Component;

class ContentManager extends Component
{
    public  StackableContent $stackableContent;

    public array $uuids = [];

    public function mount()
    {
        $this->uuids = $this->stackableContent->content_blocks
            ->pluck('id')
            ->toArray();
    }

    public function render()
    {
        return view('livewire.content-manager');
    }
}
