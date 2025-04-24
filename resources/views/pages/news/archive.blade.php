@extends('layouts.app')

@section('title', 'News Archive')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="section-title">News Archive</h1>
            <p class="section-subtitle">Browse all news and updates about the 2030 World Cup in Morocco</p>
        </div>
    </div>
</div>

<!-- News Archive Grid -->
<div class="py-12">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">All News Articles</h2>
            <div class="flex items-center">
                <span class="text-gray-600 mr-2">Sort by:</span>
                <select class="form-select rounded border-gray-300 focus:border-primary focus:ring focus:ring-primary/20">
                    <option>Latest first</option>
                    <option>Oldest first</option>
                    <option>Most viewed</option>
                </select>
            </div>
        </div>

        <!-- News Filter -->
        <div class="mb-8 bg-white p-4 rounded-lg shadow-sm">
            <div class="flex flex-wrap items-center gap-4">
                <div class="font-medium text-gray-700">Filter by:</div>
                <div class="flex flex-wrap gap-2">
                    <button class="px-3 py-1 rounded-full bg-primary text-white text-sm">All</button>
                    <button class="px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">Stadiums</button>
                    <button class="px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">Infrastructure</button>
                    <button class="px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">Teams</button>
                    <button class="px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">Tickets</button>
                    <button class="px-3 py-1 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">Travel</button>
                </div>
            </div>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($news as $article)
                <div class="card">
                    <div class="relative">
                        <img src="{{ $article->image ?? asset('images/news_placeholder.jpg') }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                        @if($article->category)
                            <div class="absolute top-0 right-0 bg-blue-500 text-white px-3 py-1 m-2 text-sm font-medium rounded">
                                {{ $article->category }}
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="text-sm text-muted-foreground mb-2">
                            {{ $article->created_at->format('F d, Y') }}
                        </div>
                        <h3 class="text-xl font-semibold mb-2">{{ $article->title }}</h3>
                        <p class="text-muted-foreground mb-4">
                            {{ Str::limit($article->excerpt ?? Str::words(strip_tags($article->content), 20), 100) }}
                        </p>
                        <a href="{{ route('news.show', $article->id) }}" class="text-primary hover:underline inline-flex items-center">
                            Read more
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 py-8 text-center">
                    <p class="text-lg text-gray-600">No news articles found.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $news->links() }}
        </div>
    </div>
</div>

<!-- Newsletter Section -->
<div class="mt-12 bg-primary/10 p-8 rounded-lg max-w-4xl mx-auto mb-12">
    <h2 class="text-xl font-bold mb-4">Subscribe to Updates</h2>
    <p class="mb-4">Stay informed with the latest news and updates about the 2030 World Cup in Morocco.</p>
    <form class="relative w-full" id="newsletter-form">
        <input type="email" placeholder="Enter your email" class="w-full px-6 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 pr-20">
        <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 px-6 py-2 rounded-full bg-primary text-white font-semibold text-sm hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary transition duration-300 ease-in-out">
            Subscribe
        </button>
    </form>

    <p class="text-sm text-muted-foreground mt-4">By subscribing, you agree to receive email communications from Morocco 2030.</p>
</div>
@endsection
