<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PelakuEkraf extends Model
{
    protected $guarded = [];

    protected $casts = [
        'gallery' => 'array',
        'tanggal_lahir' => 'date',
        'tanggal_haki' => 'date',
    ];

    public function kategoriEkraf()
    {
        return $this->belongsTo(KategoriEkraf::class, 'kategori_ekraf_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
