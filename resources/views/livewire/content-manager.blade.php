<div>
    <div class="my-12"> Fun begins</div>

    <ul
        x-sortable
    >
        @php foreach($uuids as $uuid): @endphp
        <div
            wire:key="drag-{{ $uuid }}"
            x-sortable-item="{{ $uuid }}"
            class="my-4"
        >
            @php
            $content_block = \App\Models\ContentBlock::where('id', $uuid)->sole();
            @endphp
            @livewire($content_block->block_type, ['uuid' => $uuid], key($uuid))
        </div>
        @php endforeach; @endphp
    </ul>

</div>
