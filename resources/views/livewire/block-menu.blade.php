<div class="flex flex-col gap-6 divide-y">
    @foreach($blocks as $blockClass)
        <div class="flex items-center gap-x-8 pt-6">

            <div>
                <x-filament::icon :icon="$blockClass::$menuIcon" class="size-6" />
            </div>

            <x-filament::section.heading class="flex items-center ">
                <p>{{ $blockClass::$menuTitle }}</p>
            </x-filament::section.heading>

        </div>
    @endforeach
</div>
