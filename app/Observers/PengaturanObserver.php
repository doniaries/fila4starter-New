<?php

namespace App\Observers;

use App\Models\Pengaturan;
use Illuminate\Support\Facades\Cache;

class PengaturanObserver
{
    public function updated(Pengaturan $pengaturan): void
    {
        Cache::forget('app_settings');
    }

    // Usually Pengaturan is only updated, but just in case:
    public function created(Pengaturan $pengaturan): void
    {
        Cache::forget('app_settings');
    }
}
