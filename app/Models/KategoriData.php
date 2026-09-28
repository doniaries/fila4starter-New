<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\HasSlug;

class KategoriData extends Model
{
    use HasSlug;

    protected $table = 'kategori_data';
    protected $fillable = ['nama', 'slug'];

    protected $slugSource = 'nama';
    protected $slugField = 'slug';

    public function datas()
    {
        return $this->hasMany(Data::class);
    }
}
