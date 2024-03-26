<?php

namespace App\Livewire;

use Livewire\Attributes\On;

trait InteractsWithStackableContent
{
    #[On('update:content-manager')]
    public function checkSaving(array $block_infos): void
    {
        if (collect($block_infos)->keys()->doesntContain($this->uuid)) {
            return;
        }

        $order = 1 + collect($block_infos)->keys()->search($this->uuid);

        $this->save($order);
    }

}
