<?php

namespace App\Livewire;

use Livewire\Component;

class CategoryIndex extends Component
{
    public function render()
    {
        $categories = \Illuminate\Support\Facades\Cache::remember('all_categories_page_' . request('page', 1), 3600, function () {
            return \App\Models\Tag::has('posts')
                ->withCount('posts')
                ->orderByDesc('posts_count')
                ->paginate(24); // Show 24 categories per page
        });

        return view('livewire.category-index', [
            'categories' => $categories,
            'pageTitle' => 'Semua Kategori Berita - ' . config('app.name'),
            'pageDescription' => 'Daftar seluruh kategori berita yang tersedia di ' . config('app.name')
        ]);
    }
}
