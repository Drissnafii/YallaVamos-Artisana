@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Morocco 2030 FIFA World Cup</h1>
            <p class="text-xl text-muted-foreground">Experience the magic of football in the heart of North Africa</p>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-8 text-center">Host Cities</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cities as $city)
            <div class="card overflow-hidden">
                <img src="{{ $city['image'] }}" alt="{{ $city['name'] }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $city['name'] }}</h3>
                    <p class="text-muted-foreground mb-4">{{ $city['description'] }}</p>
                    <a href="/cities/{{ $city['id'] }}" class="btn-primary">Explore</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="/cities" class="btn-secondary">View All Cities</a>
        </div>
    </div>
</div>

<div class="bg-muted py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-8 text-center">Featured Stadiums</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($stadiums as $stadium)
            <div class="card overflow-hidden">
                <img src="{{ $stadium['image'] }}" alt="{{ $stadium['name'] }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $stadium['name'] }}</h3>
                    <p class="text-muted-foreground mb-4">{{ $stadium['description'] }}</p>
                    <a href="/stadiums/{{ $stadium['id'] }}" class="btn-primary">View Details</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="/stadiums" class="btn-secondary">View All Stadiums</a>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-8 text-center">Latest News</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($news as $article)
            <div class="card overflow-hidden">
                <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="text-sm text-muted-foreground mb-2">{{ $article['date'] }}</div>
                    <h3 class="text-xl font-semibold mb-2">{{ $article['title'] }}</h3>
                    <p class="text-muted-foreground mb-4">{{ $article['excerpt'] }}</p>
                    <a href="/news/{{ $article['id'] }}" class="text-primary hover:underline">Read More</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="/news" class="btn-secondary">View All News</a>
        </div>
    </div>
</div>

<div class="bg-primary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Ready for the World Cup?</h2>
            <p class="text-xl text-muted-foreground mb-8">Create an account to save your favorite matches, stadiums, and plan your trip to Morocco.</p>
            <a href="/register" class="btn-primary">Sign Up Now</a>
        </div>
    </div>
</div>
@endsection
