<?php

namespace App\Livewire;

interface HasStackableContent
{
    public function checkSaving(array $block_infos): void;

    public function save(int $order): void;
}
