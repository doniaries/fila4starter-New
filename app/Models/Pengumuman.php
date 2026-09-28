<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengumuman extends Model
{
    use HasSlug, SoftDeletes;

    protected $table = 'pengumumen';

    protected $fillable = [

        'judul',
        'slug',
        'isi',
        'file',
        'views',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views' => 'integer',
    ];

    protected $slugSource = 'judul';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getLampiranAttribute()
    {
        return $this->file;
    }
}
