<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

use Livewire\Attributes\Lazy;

// // #[Lazy]
class Slider extends Component

{
    public function placeholder()
    {
        return view('livewire.skeletons.slider');
    }

    public function render()
    {
        // Get featured posts for slider (following webopd_old pattern)
        $sliders = \Illuminate\Support\Facades\Cache::rememberForever('home_slider_posts', function () {
            return Post::select('id', 'title', 'slug', 'foto_utama', 'published_at', 'views', 'user_id', 'created_at')
                ->where('status', 'published')
                ->where('is_featured', true)
                ->with(['categories:id,name,slug,color', 'user:id,name'])
                ->latest('published_at')
                ->take(5)
                ->get();
        });

        // Get popular posts for overlay
        $popularPosts = \Illuminate\Support\Facades\Cache::rememberForever('home_popular_posts', function () {
            return Post::select('id', 'title', 'slug', 'foto_utama', 'published_at', 'views', 'user_id', 'created_at')
                ->where('status', 'published')
                ->with(['categories:id,name,slug,color', 'user:id,name'])
                ->orderBy('views', 'desc')
                ->take(4)
                ->get();
        });

        return view('livewire.slider', [
            'sliders' => $sliders,
            'popularPosts' => $popularPosts,
        ]);
    }
}
