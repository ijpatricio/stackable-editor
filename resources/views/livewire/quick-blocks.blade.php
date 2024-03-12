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
                $el.addEventListener('paste', async (e) => {

                    const items = (e.clipboardData || e.originalEvent.clipboardData).items
                    for (let index in items) {
                        const item = items[index]
                        if (item.kind === 'file') {

                            let image  = item.getAsFile()
                            const uuid = await $wire.onPasteImage()

                            let success = false

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

                            setTimeout(() => {
                                clearInterval(interval)
                            }, 7000)


                            // Livewire.on('block-mounted', (e) => {
                            //     if(e.uuid !== uuid) {
                            //         return
                            //     }
                            //     console.log('block-mounted')
                            //     $nextTick(() => {
                            //         const uploadComponent = document.getElementById(uuid)
                            //         const instance = Alpine.$data(uploadComponent)
                            //         instance.pond.addFile(this.image)
                            //     })
                            // })

                            // This code is to get the file as a Base64 string.
                            //
                            // const blob = item.getAsFile()
                            // const reader = new FileReader()
                            // reader.onload = (e) => {
                                // File encoded as a Base64 string
                                // $dispatch('image-pasted', { data: e.target.result });
                            // }
                            // reader.readAsDataURL(blob)
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
