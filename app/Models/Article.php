<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'author_id',
        'publication_date',
        'image',
        'slug',
        'published',
        'category_id'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Adding a method alias for clarity
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the category that owns the article.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
