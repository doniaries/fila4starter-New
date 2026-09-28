<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        // 'favicon',
        'kepala_instansi',
        'jabatan_pimpinan',
        'foto_pimpinan',
        'alamat_instansi',
        'no_telp_instansi',
        'email_instansi',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'latitude',
        'longitude',
    ];

    protected $slugSource = 'name';
    protected $slugField = 'slug';
}
