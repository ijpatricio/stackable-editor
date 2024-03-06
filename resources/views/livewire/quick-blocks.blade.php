<div>
    <div class="flex gap-2 justify-between mr-8">

        <div>
            {{ $this->continueTypingAction() }}
        </div>

        <div>
            <x-filament::input placeholder="Paste an image here..."></x-filament::input>
        </div>

        <div>
            {{ $this->chooseNewBlockMenuAction() }}
        </div>

        <div>
            <x-filament::button wire:click="delegateSave"> Save </x-filament::button>
        </div>

    </div>

    <x-filament::modal
        id="chooseNewBlockModal"
        slide-over
    >
        <div>
            @livewire(\App\Livewire\BlockMenu::class, ['stackable_content_uuid' => $stackableContent->uuid], key($stackableContent->uuid))
        </div>
    </x-filament::modal>



    <x-filament-actions::modals/>
</div>
