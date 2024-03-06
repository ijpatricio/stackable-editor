<div>
    <div class="flex gap-2 justify-between mr-8">

        <div>
            {{ ($this->continueTypingAction())(['before_uuid' => 'append']) }}
        </div>

        <div>
            <x-filament::input placeholder="Paste an image here..."></x-filament::input>
        </div>

        <div id="quickBlocksSaveTarget"></div>

    </div>

    <x-filament-actions::modals/>
</div>
