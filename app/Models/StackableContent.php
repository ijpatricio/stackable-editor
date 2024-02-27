<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StackableContent extends Model
{
    use HasFactory;

    public function content_blocks(): HasMany
    {
        return $this->hasMany(ContentBlock::class);
    }
}
