<?php

namespace App\Observers;

use App\Models\Infografis;
use Illuminate\Support\Facades\Cache;

class InfografisObserver
{
    public function created(Infografis $infografis): void
    {
        $this->clearCache();
    }

    public function updated(Infografis $infografis): void
    {
        $this->clearCache();
    }

    public function deleted(Infografis $infografis): void
    {
        $this->clearCache();
    }

    protected function clearCache(): void
    {
        Cache::forget('home_infografis');
    }
}
