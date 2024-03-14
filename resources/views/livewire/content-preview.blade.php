<div
    x-on:open-modal.window="$wire.$refresh()"
>
    <x-filament::modal
        id="content-preview"
    >
        <x-slot name="heading">
            Preview
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
