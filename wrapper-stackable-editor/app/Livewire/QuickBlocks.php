<?php

namespace App\Livewire;

use App\Models\StackableContent;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class QuickBlocks extends Component implements HasActions, HasForms
{
    use InteractsWithActions, InteractsWithForms;

    public StackableContent $stackableContent;

    protected function continueTypingAction()
    {
        return Action::make('continueTypingAction')
            ->label('Continue typing...')
            ->icon('heroicon-o-pencil-square')
            ->action($this->appendBlockForContinueTyping(...));
    }

    public function appendBlockForContinueTyping(): void
    {
        $newUuid = str(Str::uuid())->value();

        // Later can be configurable to RichEditor or MarkdownEditor
        $block_type = 'rich-editor-block';

        $this->js(<<<JS
        \$wire.\$parent.appendBlock('{$newUuid}', '{$block_type}')
        JS);
    }

    public function delegateSave(): void
    {
        $this->js(<<<JS
        \$wire.\$parent.save()
        JS);
    }

    public function onPasteImage(): string
    {
        $uuid = (string) Str::uuid();
        $block_type = 'image-block';

        $this->dispatch('append-block', uuid: $uuid, block_type: $block_type);

        return $uuid;
    }

    protected function chooseNewBlockMenuAction()
    {
        return Action::make('chooseNewBlockMenuAction')
            ->label('Choose new block')
            ->icon('heroicon-o-plus')
            ->slideOver()
            ->modalWidth(MaxWidth::Small)
            ->action(fn() => $this->dispatch('open-modal', id: 'chooseNewBlockModal'));
    }

    public function newBlockMenu($data)
    {
        ray('newBlockMenu', $data);
    }

    public function render()
    {
        return view('livewire.quick-blocks');
    }
}
