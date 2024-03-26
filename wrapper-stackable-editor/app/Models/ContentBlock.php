<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContentBlock extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'content' => 'json',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($instance){
            $instance->uuid = $instance->uuid ?? (string) Str::uuid();
        });
    }
}
