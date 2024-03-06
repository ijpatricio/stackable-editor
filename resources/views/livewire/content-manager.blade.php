<div>
    <div class="my-12"> Stackable Content Editor </div>

    <ul
        x-data="{
       }"
        x-sortable
        x-on:end.stop="$wire.reorder($event.target.sortable.toArray())"
    >
        @php foreach($block_infos as $uuid => $block_type): @endphp
        <div
            wire:key="drag-{{ $uuid }}"
            x-sortable-item="{{ $uuid }}"
            class="my-4 flex items-center gap-4"
        >
            <div class="cursor-move" x-sortable-handle>
                ☰
            </div>
            <div class="w-full">
                @livewire($block_type, ['uuid' => $uuid, 'stackableContent' => $stackableContent], key($uuid))
            </div>
            <div>
                {{ ($this->deleteBlockAction())(['uuid' => $uuid])}}
            </div>
        </div>
        @php endforeach; @endphp
    </ul>

    <div class="mt-8 ml-7 ">
        @livewire(\App\Livewire\QuickBlocks::class)
    </div>

{{--    Development Purposes --}}
{{--    <div class="flex gap-3 justify-end mr-8">--}}
{{--        <x-filament::button wire:click="$refresh"> Refresh </x-filament::button>--}}
{{--    </div>--}}

    <x-filament-actions::modals/>
</div>
