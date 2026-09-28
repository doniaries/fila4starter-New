<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Post extends Model
{
    use HasSlug, SoftDeletes, LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'source_link',
        'content',
        'foto_utama',
        'caption_foto_utama',
        'gallery',
        'user_id',
        'status',
        'published_at',
        'views',
        'is_featured',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    /**
     * Get the gallery attribute and ensure it's in the new format
     * Auto-convert old format (array of strings) to new format (array of objects)
     */
    public function getGalleryAttribute($value)
    {
        if (empty($value)) {
            return [];
        }

        $gallery = json_decode($value, true);

        if (!is_array($gallery)) {
            return [];
        }

        // Check if it's already in new format (array of objects with 'image' key)
        if (!empty($gallery) && isset($gallery[0]['image'])) {
            return $gallery;
        }

        // Convert old format (array of strings) to new format
        if (!empty($gallery) && is_string($gallery[0])) {
            return array_map(function ($img) {
                return ['image' => $img, 'caption' => null];
            }, $gallery);
        }

        return $gallery;
    }

    /**
     * Set the gallery attribute
     */
    public function setGalleryAttribute($value)
    {
        $this->attributes['gallery'] = is_array($value) ? json_encode($value) : $value;
    }

    protected $slugSource = 'title';
    protected $slugField = 'slug';

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Alias tags as categories for compatibility
     */
    public function categories()
    {
        return $this->tags();
    }

    /**
     * Get the first category (tag) as a single object
     */
    public function getCategoryAttribute()
    {
        return $this->tags->first();
    }

    /**
     * Get category_id attribute for compatibility
     */
    public function getCategoryIdAttribute()
    {
        return $this->category?->id;
    }



    public function getFotoUtamaUrlAttribute()
    {
        if (empty($this->foto_utama)) {
            return null;
        }

        if (filter_var($this->foto_utama, FILTER_VALIDATE_URL)) {
            return $this->foto_utama;
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($this->foto_utama);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
    }
}
