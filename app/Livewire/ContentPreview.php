<?php

namespace App\Livewire;

use App\Models\StackableContent;
use Livewire\Component;

class ContentPreview extends Component
{
    public StackableContent $stackableContent;

    public function render()
    {
        $this->stackableContent->load([
            'content_blocks' => fn($query) => $query->orderBy('sort')
        ]);

        return view('livewire.content-preview');
    }
}
