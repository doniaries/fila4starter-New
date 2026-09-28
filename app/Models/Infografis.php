<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Infografis extends Model
{
    use SoftDeletes;

    protected $table = 'infografis';

    protected $fillable = [
        'judul',
        'gambar',
        'kategori',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if (empty($this->gambar)) {
            return asset('assets/images/placeholder.jpg'); // Or any default placeholder
        }

        if (filter_var($this->gambar, FILTER_VALIDATE_URL)) {
            return $this->gambar;
        }

        if (\Illuminate\Support\Str::startsWith($this->gambar, 'http')) {
            return $this->gambar;
        }

        return asset('storage/' . $this->gambar);
    }
}
