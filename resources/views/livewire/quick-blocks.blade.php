<div>
    <div class="flex gap-2 justify-between mr-8">

        <div>
            {{ ($this->continueTypingAction())(['before_uuid' => 'append']) }}
        </div>

        <div>
            <x-filament::input placeholder="Paste an image here..."></x-filament::input>
        </div>

        <div>
            <x-filament::button wire:click="delegateSave"> Save </x-filament::button>
        </div>

    </div>

    <x-filament-actions::modals/>
</div>
