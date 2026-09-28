<?php

namespace App\Observers;

use App\Models\AgendaKegiatan;
use Illuminate\Support\Facades\Cache;

class AgendaKegiatanObserver
{
    public function created(AgendaKegiatan $agendaKegiatan): void
    {
        $this->clearCache();
    }

    public function updated(AgendaKegiatan $agendaKegiatan): void
    {
        $this->clearCache();
    }

    public function deleted(AgendaKegiatan $agendaKegiatan): void
    {
        $this->clearCache();
    }

    protected function clearCache(): void
    {
        Cache::forget('home_agendas');
        Cache::forget('badge_agenda_kegiatans_count');
    }
}
