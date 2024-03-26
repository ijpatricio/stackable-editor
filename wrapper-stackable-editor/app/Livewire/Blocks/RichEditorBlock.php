<?php

namespace App\Livewire\Blocks;

use App\Livewire\BaseBlock;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;

class RichEditorBlock extends BaseBlock
{
    public static $menuIcon = 'heroicon-o-pencil';

    public static $menuTitle = 'Rich Editor';

    public static $previewTemplate = 'livewire.block-templates.rich-editor-block';

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

    public static function transformDataOnLoad($data)
    {
        //

        return $data;
    }
}
