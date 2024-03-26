<?php

namespace App\Livewire;

use File;
use Illuminate\Support\Str;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Symfony\Component\Finder\SplFileInfo;

class BlockMenu extends Component
{
    public string $stackable_content_uuid;

    public array $blocks = [];

    public function mount(): void
    {
        $this->getBlocks();
    }

    public function append(string $blockClass)
    {
        $block_type = str($blockClass)->classBasename()->kebab()->value();
        $uuid = (string) Str::uuid();

        $this->dispatch('append-block', uuid: $uuid, block_type: $block_type);
    }

    private function getBlocks(): void
    {
        $this->blocks = collect(File::files(app_path('Livewire/Blocks')))
            ->map(function (SplFileInfo $file) {
                $filenameWithoutExtension = $file->getFilenameWithoutExtension();
                return "App\\Livewire\\Blocks\\{$filenameWithoutExtension}";
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.block-menu');
    }
}
