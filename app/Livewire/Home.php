<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\AgendaKegiatan;
use App\Models\Pengumuman;

class Home extends Component
{
    public function render()
    {
        $infografis = \Illuminate\Support\Facades\Cache::rememberForever('home_infografis', function () {
            return \App\Models\Infografis::where('is_active', true)
                ->latest()
                ->get();
        });

        // Mengambil kategori (tags) yang memiliki postingan, diurutkan berdasarkan jumlah postingan terbanyak
        $categories = \Illuminate\Support\Facades\Cache::remember('home_categories', 3600, function () {
            return \App\Models\Tag::withCount('posts')
                ->having('posts_count', '>', 0)
                ->orderByDesc('posts_count')
                ->take(8)
                ->get();
        });

        return view('livewire.home', [
            'infografis' => $infografis,
            'categories' => $categories,
            'pageTitle' => config('app.name'),
            'pageDescription' => 'Website Resmi ' . config('app.name'),
        ]);
    }
}
