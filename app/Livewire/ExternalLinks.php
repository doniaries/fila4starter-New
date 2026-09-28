<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ExternalLink;
use Livewire\Attributes\Lazy;

#[Lazy]
class ExternalLinks extends Component
{

    public function placeholder()
    {
        return view('livewire.skeletons.external-links');
    }

    public function render()
    {
        $links = \Illuminate\Support\Facades\Cache::rememberForever('external_links', function () {
            return ExternalLink::orderBy('created_at', 'desc')->get();
        });

        return view('livewire.external-links', [
            'links' => $links
        ]);
    }
}
