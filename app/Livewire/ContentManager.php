<?php

namespace App\Livewire;

use App\Models\ContentBlock;
use App\Models\StackableContent;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Support\Enums\ActionSize;
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

    protected function deleteBlockAction()
    {
        return Action::make('deleteBlockAction')
            ->requiresConfirmation()
            ->modalIcon('heroicon-o-trash')
            ->icon('heroicon-o-trash')
            ->iconButton()
            ->color('danger')
            ->size(ActionSize::Small)
            ->action($this->deleteBlock(...));
    }

    public function deleteBlock($arguments)
    {
        $uuid = data_get($arguments, 'uuid');

        ContentBlock::whereUuid($uuid)->delete();

        $this->block_infos = collect($this->block_infos)
            ->forget($uuid)
            ->toArray();
    }

    public function reorder($newBlockInfosOrder): void
    {
        $this->block_infos = collect($this->block_infos)
            ->sortKeyByList($newBlockInfosOrder,)
            ->toArray();
    }

    public function appendBlock(string $uuid, string $block_type): void
    {
        $this->block_infos[$uuid] = $block_type;

        $this->js(<<<JS
        \$nextTick(() => {
            document.getElementById('{$uuid}').focus()
            document.getElementById('{$uuid}').scrollIntoView({ behavior: 'smooth' })
        });
        JS);
    }

    public function save(): void
    {
        $this->dispatch('update:content-manager', block_infos: $this->block_infos);

        Notification::make()->success()->color('success')->title('TODO: Save')->body('Your changes are almost saved. :)')->send();
    }

    public function render()
    {
        return view('livewire.content-manager');
    }
}
