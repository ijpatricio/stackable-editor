<?php

namespace App\Livewire;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Str;
use Livewire\Component;

class QuickBlocks extends Component implements HasActions, HasForms
{
    use InteractsWithActions, InteractsWithForms;

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

    public function render()
    {
        return view('livewire.quick-blocks');
    }
}
