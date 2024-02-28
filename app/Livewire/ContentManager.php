<?php

namespace App\Livewire;

use App\Models\StackableContent;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class ContentManager extends Component implements HasActions, HasForms
{
    use InteractsWithActions, InteractsWithForms;

    public StackableContent $stackableContent;

    public array $uuids = [];

    public function mount()
    {
        $this->uuids = $this->stackableContent->content_blocks()
            ->orderBy('sort')
            ->pluck('id')
            ->toArray();
    }

    protected function appendBasicTextBlockAction()
    {
        return Action::make('appendBasicTextBlockAction')
            ->label('Append Basic Text')
            ->icon('heroicon-o-plus')
            ->action($this->appendBasicTextBlock(...));
    }

    public function appendBasicTextBlock($arguments)
    {
        $before_uuid = data_get($arguments, 'before_uuid');

        if ($before_uuid === 'append') {
            // add in memmory
        }
    }

    public function save()
    {
        Notification::make()->success()->color('success')->title('TODO: Save')->body('Your changes are almost saved. :)')->send();
    }

    public function render()
    {
        return view('livewire.content-manager');
    }
}
