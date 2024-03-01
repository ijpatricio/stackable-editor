<?php

namespace App\Livewire;

use App\Models\ContentBlock;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class RichEditorBlock extends Component implements HasActions, HasForms, HasStackableContent
{
    use InteractsWithActions, InteractsWithForms;
    use InteractsWithStackableContent;

    public string $uuid;

    public array $data;

    public function mount()
    {
        $this->form->fill(
            ContentBlock::where('uuid', $this->uuid)->value('content')
        );
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('data')
                    ->id($this->uuid)
                    ->toolbarButtons(static::availableToolbarButtons())
                    ->label(''),
            ])
            ->statePath('data');
    }

    public static function availableToolbarButtons(): array
    {
        return [
            'blockquote',
            'bold',
            'bulletList',
            'codeBlock',
            'h2',
            'h3',
            'italic',
            'link',
            'orderedList',
            'redo',
            'strike',
            'underline',
            'undo',
        ];
    }

    public function save(int $order): void
    {
        ContentBlock::updateOrCreate(
            ['uuid' => $this->uuid],
            [
                'block_type' => 'rich-editor-block',
                'sort' => $order,
                'content' => $this->form->getState(),
            ]
        );
    }

    public function render()
    {
        return view('livewire.rich-editor-block');
    }

}
