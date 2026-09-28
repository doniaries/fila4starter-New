<?php

namespace App\Observers;

use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;

class GalleryObserver
{
    public function created(Gallery $gallery): void
    {
        $this->clearCache();
    }

    public function updated(Gallery $gallery): void
    {
        $this->clearCache();
    }

    public function deleted(Gallery $gallery): void
    {
        $this->clearCache();
    }

    protected function clearCache(): void
    {
        Cache::forget('home_galleries');
    }
}
