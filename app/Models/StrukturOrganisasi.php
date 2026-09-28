<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;

class StrukturOrganisasi extends Model
{
    use HasSlug;

    protected $table = 'struktur_organisasis';

    protected $fillable = [
        'name',
        'bidang_id',
        'user_id',
        'pimpinan',
        'foto',
        'slug',
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::saved(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('struktur_organisasi');
            \Illuminate\Support\Facades\Cache::forget('badge_struktur_organisasis_count');
        });

        static::deleted(function ($model) {
            \Illuminate\Support\Facades\Cache::forget('struktur_organisasi');
            \Illuminate\Support\Facades\Cache::forget('badge_struktur_organisasis_count');
        });
    }

    /**
     * The field that should be used for generating the slug.
     *
     * @var string
     */
    protected $slugSource = 'name';

    /**
     * The field where the slug is stored.
     *
     * @var string
     */
    protected $slugField = 'slug';
}
