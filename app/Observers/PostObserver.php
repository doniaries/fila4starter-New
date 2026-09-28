<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $this->clearCache();
        
        if ($post->user_id) {
            \App\Models\User::query()->where('id', $post->user_id)->increment('posts_count');
        }
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        $this->clearCache();

        // Check if user changed
        if ($post->isDirty('user_id')) {
            $originalUserId = $post->getOriginal('user_id');
            if ($originalUserId) {
                \App\Models\User::query()->where('id', $originalUserId)->decrement('posts_count');
            }
            if ($post->user_id) {
                \App\Models\User::query()->where('id', $post->user_id)->increment('posts_count');
            }
        }

        // Clear specific related posts cache for this post
        Cache::forget('related_posts_' . $post->id);
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $this->clearCache();
        Cache::forget('related_posts_' . $post->id);
        
        if ($post->user_id) {
            \App\Models\User::query()->where('id', $post->user_id)->decrement('posts_count');
        }
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        $this->clearCache();
        
        if ($post->user_id) {
            \App\Models\User::query()->where('id', $post->user_id)->increment('posts_count');
        }
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        $this->clearCache();
        Cache::forget('related_posts_' . $post->id);
    }

    /**
     * Clear global post caches.
     */
    protected function clearCache(): void
    {
        Cache::forget('home_latest_posts');
        Cache::forget('home_slider_posts');
        Cache::forget('home_popular_posts');
        Cache::forget('badge_posts_count');
    }
}
