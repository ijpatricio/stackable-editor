<?php

namespace App\Livewire\Blocks;

use App\Livewire\HasStackableContent;
use App\Livewire\InteractsWithStackableContent;
use App\Models\ContentBlock;
use App\Models\StackableContent;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ImageBlock extends Component implements HasActions, HasForms, HasStackableContent
{
    use InteractsWithActions, InteractsWithForms;
    use InteractsWithStackableContent;

    public static $menuIcon = 'heroicon-o-photo';

    public static $menuTitle = 'Image';

    public static $previewTemplate = 'livewire.block-templates.image-block';

    public StackableContent $stackableContent;

    public string $uuid;

    public array $data;

    public function mount()
    {
        $this->form->fill(
            ContentBlock::where('uuid', $this->uuid)->value('content')
        );

        $this->dispatch('block-mounted', uuid: $this->uuid);
    }

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

    public function save(int $order): void
    {
        ContentBlock::updateOrCreate(
            [
                'stackable_content_id' => $this->stackableContent->id,
                'uuid' => $this->uuid,
            ],
            [
                'block_type' => 'image-block',
                'sort' => $order,
                'content' => $this->form->getState(),
            ]
        );
    }

    public static function transformDataOnLoad($data)
    {
        $imageLink = asset(
            Storage::url($data['image'])
        );

        data_set($data, 'image', $imageLink);

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
        return view('livewire.blocks.image-block');
    }

}
