<?php

namespace App\Livewire\Blocks;

use App\Livewire\HasStackableContent;
use App\Livewire\InteractsWithStackableContent;
use App\Models\ContentBlock;
use App\Models\StackableContent;
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

    public StackableContent $stackableContent;

    public static $previewTemplate = 'livewire.block-templates.rich-editor-block';

    public string $uuid;

    public array $data;

    public static $menuIcon = 'heroicon-o-pencil';

    public static $menuTitle = 'Rich Editor';

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
                RichEditor::make('content')
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
            [
                'stackable_content_id' => $this->stackableContent->id,
                'uuid' => $this->uuid,
            ],
            [
                'block_type' => 'rich-editor-block',
                'sort' => $order,
                'content' => $this->form->getState(),
            ]
        );
    }

    public static function transformDataOnLoad($data)
    {
        //

        return $data;
    }

    public static function renderTemplate($data)
    {
        return view(
            view: static::$previewTemplate,
            data: [
                'block_data' => static::transformDataOnLoad($data),
            ],
        );
    }

    public function render()
    {
        return view('livewire.blocks.rich-editor-block');
    }

}
