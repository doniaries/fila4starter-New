<?php

namespace App\Observers;

use App\Models\PelakuEkraf;

class PelakuEkrafObserver
{
    /**
     * Handle the PelakuEkraf "created" event.
     */
    public function created(PelakuEkraf $pelakuEkraf): void
    {
        \Illuminate\Support\Facades\Cache::forget('badge_pelaku_ekrafs_count');
        
        if ($pelakuEkraf->kategori_ekraf_id) {
            \App\Models\KategoriEkraf::where('id', $pelakuEkraf->kategori_ekraf_id)->increment('pelaku_ekrafs_count');
        }
    }

    /**
     * Handle the PelakuEkraf "updated" event.
     */
    public function updated(PelakuEkraf $pelakuEkraf): void
    {
        // Check if category changed
        if ($pelakuEkraf->isDirty('kategori_ekraf_id')) {
            $originalKategoriId = $pelakuEkraf->getOriginal('kategori_ekraf_id');
            if ($originalKategoriId) {
                \App\Models\KategoriEkraf::where('id', $originalKategoriId)->decrement('pelaku_ekrafs_count');
            }
            if ($pelakuEkraf->kategori_ekraf_id) {
                \App\Models\KategoriEkraf::where('id', $pelakuEkraf->kategori_ekraf_id)->increment('pelaku_ekrafs_count');
            }
        }
    }

    /**
     * Handle the PelakuEkraf "deleted" event.
     */
    public function deleted(PelakuEkraf $pelakuEkraf): void
    {
        \Illuminate\Support\Facades\Cache::forget('badge_pelaku_ekrafs_count');
        
        if ($pelakuEkraf->kategori_ekraf_id) {
            \App\Models\KategoriEkraf::where('id', $pelakuEkraf->kategori_ekraf_id)->decrement('pelaku_ekrafs_count');
        }
    }

    /**
     * Handle the PelakuEkraf "restored" event.
     */
    public function restored(PelakuEkraf $pelakuEkraf): void
    {
        \Illuminate\Support\Facades\Cache::forget('badge_pelaku_ekrafs_count');
        
        if ($pelakuEkraf->kategori_ekraf_id) {
            \App\Models\KategoriEkraf::where('id', $pelakuEkraf->kategori_ekraf_id)->increment('pelaku_ekrafs_count');
        }
    }

    /**
     * Handle the PelakuEkraf "force deleted" event.
     */
    public function forceDeleted(PelakuEkraf $pelakuEkraf): void
    {
        \Illuminate\Support\Facades\Cache::forget('badge_pelaku_ekrafs_count');
        
        if ($pelakuEkraf->kategori_ekraf_id) {
            \App\Models\KategoriEkraf::where('id', $pelakuEkraf->kategori_ekraf_id)->decrement('pelaku_ekrafs_count');
        }
    }
}
