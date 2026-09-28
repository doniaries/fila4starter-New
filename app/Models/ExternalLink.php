<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalLink extends Model
{
    protected $fillable = [
        'nama_link',
        'url',
        'logo',
    ];


    protected $casts = [
        'logo' => 'string',
    ];

    protected static function booted()
    {
        static::saved(function () {
            \Illuminate\Support\Facades\Cache::forget('external_links');
        });

        static::deleted(function () {
            \Illuminate\Support\Facades\Cache::forget('external_links');
        });
    }
}
