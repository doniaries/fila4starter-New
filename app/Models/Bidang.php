<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Bidang::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Bidang::class, 'parent_id');
    }

    public function strukturOrganisasis()
    {
        return $this->hasMany(StrukturOrganisasi::class);
    }
}
