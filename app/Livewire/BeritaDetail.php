<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;

class BeritaDetail extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->post->loadMissing(['categories', 'tags', 'user']);

        // Increment Views (Every Hit)
        $this->post->increment('views');
    }

    public function render()
    {
        $relatedPosts = \Illuminate\Support\Facades\Cache::remember('related_posts_' . $this->post->id, 60 * 60, function () {
            // Retrieve categories/tags attached to the current post
            $categoryIds = $this->post->categories->pluck('id')->toArray();

            return Post::where('status', 'published')
                ->where('id', '!=', $this->post->id)
                ->when(count($categoryIds) > 0, function ($query) use ($categoryIds) {
                    $query->whereHas('categories', function ($q) use ($categoryIds) {
                        $q->whereIn('tags.id', $categoryIds);
                    });
                })
                ->with(['tags', 'user'])
                ->latest('published_at')
                ->get();
        });

        return view('livewire.dinas.berita-detail', [
            'post' => $this->post,
            'relatedPosts' => $relatedPosts
        ]);
    }

    public function placeholder()
    {
        return view('livewire.skeletons.dinas.berita-detail');
    }
}
