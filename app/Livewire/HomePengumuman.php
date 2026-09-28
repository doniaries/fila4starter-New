<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use App\Models\Pengumuman;

// #[Lazy]
class HomePengumuman extends Component

{


    public function placeholder()
    {
        return view('livewire.skeletons.pengumuman');
    }

    public function render()
    {
        $pengumuman = \Illuminate\Support\Facades\Cache::rememberForever('home_pengumuman', function () {
            return Pengumuman::query()
                ->select('id', 'judul', 'slug', 'isi', 'file', 'published_at')

                ->latest('published_at')
                ->take(3)
                ->get();
        });

        return view('livewire.home-pengumuman', [
            'pengumuman' => $pengumuman,
        ]);
    }
}
