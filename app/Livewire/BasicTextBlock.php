<?php

namespace App\Livewire;

use App\Models\ContentBlock;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Support\Str;
use Livewire\Component;

class BasicTextBlock extends Component implements HasActions, HasForms, HasStackableContent
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
                TextInput::make('content')
                    ->label(''),
            ])
            ->statePath('data');
    }

    public function save(int $order): void
    {
        ContentBlock::updateOrCreate(
            ['uuid' => $this->uuid],
            [
                'block_type' => 'basic-text-block',
                'sort' => $order,
                'content' => $this->form->getState(),
            ]
        );
    }

    public function render()
    {
        return view('livewire.basic-text-block');
    }
}
