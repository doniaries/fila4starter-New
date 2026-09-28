<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Post;

// #[Lazy]
class BeritaIndex extends Component
{
    use WithPagination;

    #[Url]
    public $category = '';

    public function render()
    {
        $query = Post::where('status', 'published')
            ->with(['tags', 'user']); // Eager load tags (accessed via getCategoryAttribute)

        if ($this->category) {
            $query->whereHas('categories', function ($q) {
                $q->where('slug', $this->category);
            });
        }

        $posts = $query->orderBy('published_at', 'desc')
            ->paginate(6);

        // Cache categories for 1 hour
        $categories = \Illuminate\Support\Facades\Cache::remember('berita_categories', 60 * 60, function () {
            // Use Tag model but refer to them as categories in logic
            return \App\Models\Tag::has('posts')->withCount('posts')->get();
        });

        return view('livewire.dinas.berita-index', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function placeholder()
    {
        return view('livewire.skeletons.dinas.berita-index');
    }
}
