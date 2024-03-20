<?php

namespace App\Livewire;

use App\Models\ContentBlock;
use App\Models\StackableContent;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

abstract class BaseBlock extends Component implements HasActions, HasForms, HasStackableContent
{
    use InteractsWithActions, InteractsWithForms;
    use InteractsWithStackableContent;

    public StackableContent $stackableContent;

    public string $uuid;

    public array $data;

    public function mount()
    {
        $this->form->fill(
            ContentBlock::where('uuid', $this->uuid)->value('content')
        );
    }

    public static function transformDataOnLoad($data)
    {
        //

        return $data;
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
