<?php

namespace App\Observers;

use App\Models\Pengumuman;
use Illuminate\Support\Facades\Cache;

class PengumumanObserver
{
    public function created(Pengumuman $pengumuman): void
    {
        $this->clearCache();
    }

    public function updated(Pengumuman $pengumuman): void
    {
        $this->clearCache();
    }

    public function deleted(Pengumuman $pengumuman): void
    {
        $this->clearCache();
    }

    protected function clearCache(): void
    {
        Cache::forget('home_pengumuman');
    }
}
