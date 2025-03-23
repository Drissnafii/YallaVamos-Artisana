@extends('layouts.app')

@section('title', 'Host Cities')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Host Cities</h1>
            <p class="text-xl text-muted-foreground">Explore the vibrant cities hosting the 2030 FIFA World Cup</p>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cities as $city)
            <div class="card overflow-hidden">
                <img src="{{ $city['image'] }}" alt="{{ $city['name'] }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $city['name'] }}</h3>
                    <p class="text-muted-foreground mb-4">{{ $city['description'] }}</p>
                    <div class="flex justify-between items-center">
                        <a href="/cities/{{ $city['id'] }}" class="btn-primary">Explore</a>
                        <button class="text-muted-foreground hover:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="bg-muted py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold mb-6 text-center">About Morocco</h2>
            <p class="text-lg mb-4">
                Morocco is a country located in North Africa, known for its rich culture, diverse landscapes, and warm hospitality. From the bustling markets of Marrakech to the coastal charm of Casablanca, each city offers a unique experience.
            </p>
            <p class="text-lg mb-4">
                The 2030 FIFA World Cup will be hosted across multiple cities in Morocco, showcasing the country's modern infrastructure alongside its traditional heritage. Visitors will have the opportunity to explore ancient medinas, enjoy delicious cuisine, and experience the passion of Moroccan football.
            </p>
            <p class="text-lg">
                Each host city has been carefully selected to provide the best possible experience for players and fans alike, with state-of-the-art stadiums and excellent transportation links.
            </p>
        </div>
    </div>
</div>
@endsection
