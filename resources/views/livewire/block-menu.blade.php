<div x-init class="flex flex-col gap-6">
    @foreach($blocks as $blockClass)

        @ray($blockClass)
        <button
            class="flex items-center gap-x-8 p-4 border border-gray-200 rounded-lg hover:bg-primary-200"
            @click="
                $dispatch('close-modal', {id: 'chooseNewBlockModal'})
                $wire.append(@js($blockClass))
            "
        >
            <div>
                <x-filament::icon :icon="$blockClass::$menuIcon" class="size-6" />
            </div>

            <x-filament::section.heading class="flex items-center ">
                <p>{{ $blockClass::$menuTitle }}</p>
            </x-filament::section.heading>

        </button>
    @endforeach
</div>
