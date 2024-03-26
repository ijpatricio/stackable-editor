<div
    x-on:open-modal.window="$wire.$refresh()"
>
    <x-filament::modal
        id="content-preview"
        :width="$modalWidth"
    >
        <x-slot name="heading">
            <div class="flex items-center gap-4">
                <div>Preview</div>
                <div>
                    <x-filament::input.wrapper>
                        <x-filament::input.select wire:model.live="modalWidth">
                            <option value="max-w-screen-sm">Viewport: SM</option>
                            <option value="max-w-screen-md">Viewport: MD</option>
                            <option value="max-w-screen-lg">Viewport: LG</option>
                            <option value="max-w-screen-xl">Viewport: XL</option>
                            <option value="max-w-screen-2xl">Viewport: 3XL</option>
                        </x-filament::input.select>
                    </x-filament::input.wrapper>
                </div>
            </div>
        </x-slot>


        @foreach($this->stackableContent->content_blocks as $block)

            @php
                $classBasename = str($block->block_type)
                    ->title()
                    ->replace('-', '')
                    ->value();

                $class = "App\\Livewire\\Blocks\\{$classBasename}";

                $view = $class::renderTemplate($block->content);
            @endphp

            {{ $view }}

{{--            @livewire('blocks.'.$block->block_type,--}}
{{--            ['uuid' => $block->uuid, 'stackableContent' => $stackableContent],--}}
{{--            key($block->uuid , 'aaa')--}}
{{--            )--}}
        @endforeach

    </x-filament::modal>
</div>
