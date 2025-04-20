<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicArticleController extends Controller
{
    /**
     * Display a listing of published articles.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $articles = Article::where('status', 'published')
            ->latest()
            ->with('user', 'category')
            ->paginate(10);

        $categories = Category::all();

        return view('articles.index', compact('articles', 'categories'));
    }

    /**
     * Display the specified article.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Article $article)
    {
        // Only show published articles to the public
        if ($article->status !== 'published') {
            abort(404);
        }

        // Load related categories and user information
        $article->load('category', 'user');

        // Get related articles from the same category
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
