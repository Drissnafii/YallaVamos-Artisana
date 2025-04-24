@extends('layouts.app')

@section('title', $article->title ?? 'Article Details')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <div class="flex items-center text-sm text-gray-600 mb-8">
            <a href="{{ route('home') }}" class="hover:text-red-600">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('news.index') }}" class="hover:text-red-600">News</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800">{{ $article->title }}</span>
        </div>

        <!-- Article Header -->
        <div class="mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $article->title }}</h1>
            <div class="flex items-center text-gray-600">
                <span>{{ $article->created_at->format('F d, Y') }}</span>
                @if($article->category)
                    <span class="mx-2">•</span>
                    <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-medium">
                        {{ $article->category }}
                    </span>
                @endif
            </div>
        </div>

        <!-- Article Content -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden mb-12">
            @if($article->image)
                <div class="w-full h-96 overflow-hidden">
                    <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                </div>
            @endif
            <div class="p-8">
                <div class="prose prose-lg max-w-none">
                    {!! $article->content !!}
                </div>
            </div>
        </div>

        <!-- Related Articles -->
        @if($relatedArticles && $relatedArticles->count() > 0)
            <div class="my-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $relatedArticle)
                        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                            @if($relatedArticle->image)
                                <div class="w-full h-48 overflow-hidden">
                                    <img src="{{ $relatedArticle->image }}" alt="{{ $relatedArticle->title }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $relatedArticle->title }}</h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit($relatedArticle->excerpt, 100) }}</p>
                                <a href="{{ route('news.show', $relatedArticle->id) }}" class="text-red-600 font-medium hover:text-red-800">
                                    Read More →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('news.index') }}" class="inline-flex items-center text-red-600 hover:text-red-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to all news
            </a>
        </div>
    </div>
</div>
@endsection