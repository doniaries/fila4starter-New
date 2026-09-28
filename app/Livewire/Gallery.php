<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Gallery as GalleryModel;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Lazy;

#[Lazy]
class Gallery extends Component
{
    public function render()
    {
        $galleries = Cache::rememberForever('home_galleries', function () {
            return GalleryModel::latest()->take(5)->get();
        });

        return view('livewire.gallery', [
            'galleries' => $galleries
        ]);
    }

    public function placeholder()
    {
        return view('livewire.skeletons.gallery');
    }
}
