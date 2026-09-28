<?php

namespace App\Observers;

use App\Models\ExternalLink;
use Illuminate\Support\Facades\Cache;

class ExternalLinkObserver
{
    public function created(ExternalLink $link): void
    {
        $this->clearCache();
    }

    public function updated(ExternalLink $link): void
    {
        $this->clearCache();
    }

    public function deleted(ExternalLink $link): void
    {
        $this->clearCache();
    }

    protected function clearCache(): void
    {
        Cache::forget('external_links');
    }
}
