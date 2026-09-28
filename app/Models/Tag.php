<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasSlug, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected $slugSource = 'name';
    protected $slugField = 'slug';

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getColorAttribute($value)
    {
        if (!empty($value)) {
            return $value;
        }

        // Definitive vibrant 22-color palette (No grays/slates)
        $fallbackColors = [
            '#ef4444',
            '#f97316',
            '#f59e0b',
            '#eab308',
            '#84cc16',
            '#22c55e',
            '#10b981',
            '#14b8a6',
            '#06b6d4',
            '#0ea5e9',
            '#3b82f6',
            '#6366f1',
            '#8b5cf6',
            '#a855f7',
            '#d946ef',
            '#ec4899',
            '#f43f5e',
            '#0ea5e9',
            '#3b82f6',
            '#6366f1',
            '#8b5cf6',
            '#a855f7'
        ];

        // Specific mappings for common categories for better initial impression
        $specificMappings = [
            'Teknologi' => '#3b82f6',
            'Teknologi Informasi' => '#3b82f6',
            'Kesehatan' => '#ef4444',
            'Pendidikan' => '#f97316',
            'Olahraga' => '#f97316',
            'Politik' => '#8b5cf6', // Changed from Slate to Violet
            'Sosial' => '#f59e0b',
            'Lingkungan' => '#10b981',
            'Pariwisata' => '#06b6d4',
            'Otomotif' => '#eab308',
            'Agama' => '#a855f7',
            'Pemerintahan' => '#0ea5e9',
            'Peraturan' => '#6366f1',
        ];

        if (array_key_exists($this->name, $specificMappings)) {
            return $specificMappings[$this->name];
        }

        // Use deterministic fallback based on ID
        $index = $this->id % count($fallbackColors);
        return $fallbackColors[$index];
    }
}
