<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class StackableContent extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($instance){
            $instance->uuid = $instance->uuid ?? (string) Str::uuid();
        });
    }

    public function content_blocks(): HasMany
    {
        return $this->hasMany(ContentBlock::class);
    }
}
