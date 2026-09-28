<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriEkraf extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Jika ingin me-load relasi PelakuEkraf
    public function pelakuEkrafs()
    {
        return $this->hasMany(PelakuEkraf::class, 'kategori_ekraf_id');
    }
}
