<x-filament-panels::page>
    <div class="text-2xl">
        Hello world!
    </div>
    <div>

        @php
            $stackableContent = \App\Models\StackableContent::find(1);
        @endphp

        @livewire(\App\Livewire\ContentManager::class, [
            'stackableContent' => $stackableContent,
        ], key('content-manager'))

    </div>
</x-filament-panels::page>
