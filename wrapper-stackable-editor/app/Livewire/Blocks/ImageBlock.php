<?php

namespace App\Livewire\Blocks;

use App\Livewire\BaseBlock;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Storage;

class ImageBlock extends BaseBlock
{
    public static $menuIcon = 'heroicon-o-photo';

    public static $menuTitle = 'Image';

    public static $previewTemplate = 'livewire.block-templates.image-block';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('image')
                    ->id($this->uuid)
                    ->imageEditor()
                    ->label(''),
            ])
            ->statePath('data');
    }

    public static function transformDataOnLoad($data)
    {
        $imageLink = asset(
            Storage::url($data['image'])
        );

        data_set($data, 'image', $imageLink);

        return $data;
    }
}
