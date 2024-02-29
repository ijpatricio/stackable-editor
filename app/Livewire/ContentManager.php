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
use Illuminate\Support\Str;
use Livewire\Component;

class ContentManager extends Component implements HasActions, HasForms
{
    use InteractsWithActions, InteractsWithForms;

    public StackableContent $stackableContent;

    public array $block_infos = []; //  [ uuid => block_type ]

    public function mount()
    {
        $this->block_infos = $this->stackableContent->content_blocks()
            ->orderBy('sort')
            ->pluck('block_type', 'uuid')
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
            $newUuid = str(Str::uuid())->prepend('_')->value();

            $this->block_infos[$newUuid] = 'basic-text-block';
        }
    }

    public function reorder($newBlockInfosOrder)
    {
        $this->block_infos = collect($this->block_infos)
            ->sortKeyByList($newBlockInfosOrder,)
            ->toArray();
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
