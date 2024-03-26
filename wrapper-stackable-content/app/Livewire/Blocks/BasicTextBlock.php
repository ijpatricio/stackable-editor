<?php

namespace App\Livewire\Blocks;

use App\Livewire\BaseBlock;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;

class BasicTextBlock extends BaseBlock
{
    public static $menuIcon = 'heroicon-o-plus';

    public static $menuTitle = 'Basic Text';

    public static $previewTemplate = 'livewire.block-templates.basic-text-block';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('content')
                    ->id($this->uuid)
                    ->label(''),
            ])
            ->statePath('data');
    }

    public static function transformDataOnLoad($data)
    {
        //

        return $data;
    }
}
