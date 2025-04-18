<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

// requestes
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;


class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index()
    {
        $articles = Article::latest()->simplePaginate(10);
        return view('dashboard.admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $validated = $request->validated();

        // Generate slug from title
        $validated['slug'] = Str::slug($validated['title']);

        // Set author_id to current authenticated user
        $validated['author_id'] = Auth::id();

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = $imagePath;
        } else {
            $validated['image'] = null;
        }
        
        // Properly handle the published status checkbox
        $validated['published'] = isset($validated['published']) ? true : false;

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Article created successfully!');
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        return view('dashboard.admin.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('dashboard.admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified article in storage.
     */
    // Change Request to UpdateArticleRequest here
    public function update(UpdateArticleRequest $request, Article $article)
    {
        // Get the validated data:
        $validated = $request->validated();

        // Access validated title directly
        if (isset($validated['title']) && $validated['title'] !== $article->title) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Remove old image if exists
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            // Use the validated image data if needed, but hasFile checks the original request
            $imagePath = $request->file('image')->store('articles', 'public');
            $validated['image'] = $imagePath;
        }

        // Properly handle the published status checkbox
        // If the checkbox is not checked, the value won't be in the request
        $validated['published'] = isset($validated['published']) ? true : false;

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully!');
    }

    /**
     * Remove the specified article from storage.
     */
    public function destroy(Article $article)
    {
        // Delete the image if exists
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article deleted successfully!');
    }
    
    /**
     * Toggle the publication status of the article.
     */
    public function toggleStatus(Article $article)
    {
        // Toggle the published status
        $article->published = !$article->published;
        $article->save();
        
        $status = $article->published ? 'published' : 'set to draft';
        return redirect()->route('admin.articles.index')->with('success', "Article {$status} successfully!");
    }
}
