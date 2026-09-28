<?php

namespace App\Livewire;

use App\Models\Gallery;
use Livewire\Component;

class GalleryDetail extends Component
{
    public Gallery $gallery;

    public function mount(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    public function render()
    {
        return view('livewire.dinas.gallery-detail', [
            'gallery' => $this->gallery,
            'pageTitle' => $this->gallery->title,
            'pageDescription' => $this->gallery->description,
        ]);
    }
}
