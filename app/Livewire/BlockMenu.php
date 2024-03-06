<?php

namespace App\Livewire;

use File;
use Livewire\Component;
use Symfony\Component\Finder\SplFileInfo;

class BlockMenu extends Component
{
    public string $stackable_content_uuid;

    public array $blocks = [];

    public function mount(): void
    {
        $this->hydrateBlocks();

        ray($this->blocks);
    }

    public function render()
    {
        return view('livewire.block-menu');
    }

    private function hydrateBlocks()
    {
        $this->blocks =  collect(File::files(app_path('Livewire/Blocks')))
            ->map(function (SplFileInfo $file) {
                $filenameWithoutExtension = $file->getFilenameWithoutExtension();
                return "App\\Livewire\\Blocks\\{$filenameWithoutExtension}";
            })
            ->toArray();
    }
}
