<div>
    <div class="flex gap-2 justify-between mr-8">

        <div>
            {{ $this->continueTypingAction() }}
        </div>

        <div>

            <x-filament::input.wrapper>
                <x-filament::input
                    type="text"
                    x-data="pasteAnImage()"
                    placeholder="Paste an image here..."
                ></x-filament::input>
            </x-filament::input.wrapper>

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
                $el.addEventListener('paste', async (e) => {

                    const items = (e.clipboardData || e.originalEvent.clipboardData).items
                    for (let index in items) {
                        const item = items[index]
                        if (item.kind === 'file') {

                            let image  = item.getAsFile()
                            const uuid = await $wire.onPasteImage()

                            let success = false

                            // Wait for the upload component (Filepond) to be initialized
                            // Didn't find a way to listen to when that happens.
                            const interval = setInterval(() => {
                                const uploadComponent = document.getElementById(uuid)
                                if (uploadComponent === null || success === true) {
                                    return
                                }

                                const instance = Alpine.$data(uploadComponent)
                                if (instance.pond === null) {
                                    return
                                }
                                instance.pond.addFile(image)
                                success = true
                            }, 300)

                            // If the upload component is not initialized after 7 seconds, stop trying
                            setTimeout(() => {
                                clearInterval(interval)
                            }, 7000)
                        }
                    }
                });
            }
        }))
    </script>
    @endscript


    <x-filament-actions::modals/>
</div>
