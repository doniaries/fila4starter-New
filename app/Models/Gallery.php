<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'images',
        'published_at',
    ];

    protected $casts = [
        'images' => 'array',
        'published_at' => 'date',
    ];

    protected $slugSource = 'title';
    protected $slugField = 'slug';

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getThumbnailUrlAttribute()
    {
        if (empty($this->images) || count($this->images) === 0) {
            return null;
        }

        $firstImage = $this->images[0];

        if (filter_var($firstImage, FILTER_VALIDATE_URL)) {
            return $firstImage;
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($firstImage);
    }

    public function getImageUrlsAttribute()
    {
        if (empty($this->images)) {
            return [];
        }

        return collect($this->images)->map(function ($image) {
            if (filter_var($image, FILTER_VALIDATE_URL)) {
                return $image;
            }
            return \Illuminate\Support\Facades\Storage::disk('public')->url($image);
        })->toArray();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'gallery_tag');
    }
}
