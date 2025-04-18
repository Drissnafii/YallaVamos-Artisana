<?php

namespace App\Observers;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleObserver
{
    /**
     * Handle the Article "created" event.
     */
    public function created(Article $article): void
    {
        // Automatically generate slug from title if not already set
        if (empty($article->slug)) {
            $article->slug = Str::slug($article->title);
        }
    }

    /**
     * Handle the Article "updated" event.
     */
    public function updated(Article $article): void
    {
        // Automatically update slug if the title field has changed
        if ($article->isDirty('title')) { // isDirty checks if 'title' is among the fields being updated
            $article->slug = Str::slug($article->title);
        }
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Article $article): void
    {
        if (!empty($article->image)) {
            Storage::disk('public')->delete($article->image);
        }
    }

    /**
     * Handle the Article "restored" event.
     */
    public function restored(Article $article): void
    {
        //
    }

    /**
     * Handle the Article "force deleted" event.
     */
    public function forceDeleted(Article $article): void
    {
        //
    }
}
