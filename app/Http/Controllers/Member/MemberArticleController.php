<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MemberArticleController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        /** @var \App\Models\User|\Illuminate\Contracts\Auth\Authenticatable $user */
        $user = Auth::user();
        $articles = $user->articles()->latest()->get();
        return view('dashboard.member.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('dashboard.member.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'required|string|max:255|unique:articles'
        ]);

        // Don't strip HTML tags from content - Summernote needs HTML preserved
        $validated['content'] = $request->input('content');

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $article = $user->articles()->create($validated);

        if ($request->hasFile('image')) {
            $article->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route('member.articles.index')->with('success', 'Article created successfully!');
    }

    public function show(Article $article)
    {
        $this->authorize('view', $article);
        return view('dashboard.member.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        $categories = \App\Models\Category::all();
        return view('dashboard.member.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Don't strip HTML tags from content - Summernote needs HTML preserved
        $validated['content'] = $request->input('content');

        $article->update($validated);

        if ($request->hasFile('image')) {
            $article->clearMediaCollection('images');
            $article->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route('member.articles.index')->with('success', 'Article updated successfully!');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->route('member.articles.index')->with('success', 'Article deleted successfully!');
    }
}
