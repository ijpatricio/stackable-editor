<?php

namespace App\Livewire;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class BasicTextBlock extends Component implements HasActions, HasForms
{
    use InteractsWithActions, InteractsWithForms;

    public array $data;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('content')
                    ->label(''),
            ])
            ->statePath('data');
    }

    public function render()
    {
        return view('livewire.text-basic');
    }
}