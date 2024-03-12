<div>
    <div class="flex gap-2 justify-between mr-8">

        <div>
            {{ $this->continueTypingAction() }}
        </div>

        <div>
            <x-filament::input
                x-data="pasteAnImage()"
                placeholder="Paste an image here..."
            ></x-filament::input>
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

    @script
    <script>
        Alpine.data('pasteAnImage', () => ({
            init: () => {

                $el.addEventListener('paste', (e) => {

                    console.log('pasting... code below was generated by Copilot... CHECK THINGS!!');

                    const items = (e.clipboardData || e.originalEvent.clipboardData).items;
                    for (let index in items) {
                        const item = items[index];
                        if (item.kind === 'file') {
                            const blob = item.getAsFile();
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                console.log(e.target.result)
                                $dispatch('image-pasted', { data: e.target.result });
                            }
                            reader.readAsDataURL(blob);
                            console.log('aaa', blob)

                            console.log($wire)
                            $wire.onPasteImage()
                        }
                    }
                });
            }
        }))
        console.log(1111)
    </script>
    @endscript


    <x-filament-actions::modals/>
</div>
