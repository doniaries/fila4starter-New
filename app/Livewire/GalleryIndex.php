<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\WithPagination;

// #[Lazy]
class GalleryIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $galleries = \App\Models\Gallery::query()
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return view('livewire.dinas.gallery-index', [
            'galleries' => $galleries
        ]);
    }

    public function placeholder()
    {
        return view('livewire.skeletons.dinas.gallery-index');
    }
}
