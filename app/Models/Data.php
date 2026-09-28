<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\SoftDeletes;

class Data extends Model
{
    use HasSlug, SoftDeletes;

    protected $table = 'datas';

    protected $fillable = [
        'nama_data',
        'slug',
        'kategori_data_id',
        'struktur_organisasi_id',
        'deskripsi',
        'cover',
        'tahun_terbit',
        'file',
        'is_public',
        'views',
        'downloads',
        'published_at',
    ];

    protected $casts = [
        'tahun_terbit' => 'integer',
        'is_public' => 'boolean',
        'published_at' => 'datetime',
        'views' => 'integer',
        'downloads' => 'integer',
    ];

    protected $slugSource = 'nama_data';
    protected $slugField = 'slug';

    public function kategoriData()
    {
        return $this->belongsTo(KategoriData::class, 'kategori_data_id');
    }

    public function strukturOrganisasi()
    {
        return $this->belongsTo(StrukturOrganisasi::class, 'struktur_organisasi_id');
    }
}
