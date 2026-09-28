<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SambutanPimpinan extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'judul',
        'slug',
        'isi_sambutan',
        'nama_pimpinan',
        'foto_pimpinan',
    ];

    protected $slugSource = 'judul';

    protected $appends = ['foto_pimpinan_url'];

    public function getFotoPimpinanUrlAttribute()
    {
        if (!$this->foto_pimpinan) {
            return null;
        }

        if (filter_var($this->foto_pimpinan, FILTER_VALIDATE_URL)) {
            return $this->foto_pimpinan;
        }

        if (\Illuminate\Support\Str::startsWith($this->foto_pimpinan, 'http')) {
            return $this->foto_pimpinan;
        }

        return asset('storage/' . $this->foto_pimpinan);
    }
    public static function booted()
    {
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('sambutan_pimpinan');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('sambutan_pimpinan');
        });
    }
}
