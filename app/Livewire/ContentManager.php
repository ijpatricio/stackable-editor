<?php

namespace App\Livewire;

use App\Models\StackableContent;
use Filament\Notifications\Notification;
use Livewire\Component;

class ContentManager extends Component
{
    public  StackableContent $stackableContent;

    public array $uuids = [];

    public function mount()
    {
        $this->uuids = $this->stackableContent->content_blocks()
            ->orderBy('sort')
            ->pluck('id')
            ->toArray();
    }

    public function save()
    {
        ray($this->uuids);

        Notification::make()->success()->color('success')->title('TODO: Save')->body('Your changes are almost saved. :)')->send();
    }

    public function render()
    {
        return view('livewire.content-manager');
    }
}
