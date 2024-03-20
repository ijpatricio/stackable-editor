<?php

namespace App\Livewire\Blocks;

use App\Livewire\HasStackableContent;
use App\Livewire\InteractsWithStackableContent;
use App\Models\ContentBlock;
use App\Models\StackableContent;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class BasicTextBlock extends Component implements HasActions, HasForms, HasStackableContent
{
    use InteractsWithActions, InteractsWithForms;
    use InteractsWithStackableContent;

    public StackableContent $stackableContent;

    public string $uuid;

    public static $menuIcon = 'heroicon-o-plus';

    public static $menuTitle = 'Basic Text';

    public static $previewTemplate = 'livewire.block-templates.basic-text-block';

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
                TextInput::make('content')
                    ->id($this->uuid)
                    ->label(''),
            ])
            ->statePath('data');
    }

    public function save(int $order): void
    {
        ContentBlock::updateOrCreate(
            [
                'uuid' => $this->uuid,
                'stackable_content_id' => $this->stackableContent->id,
            ],
            [
                'block_type' => 'basic-text-block',
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
        return view('livewire.blocks.basic-text-block');
    }
}