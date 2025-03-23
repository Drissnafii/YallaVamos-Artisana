@extends('layouts.app')

@section('title', 'Stadiums')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">World Cup Stadiums</h1>
            <p class="text-xl text-muted-foreground">Discover the magnificent venues hosting the 2030 FIFA World Cup matches</p>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($stadiums as $stadium)
            <div class="card overflow-hidden">
                <img src="{{ $stadium['image'] }}" alt="{{ $stadium['name'] }}" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ $stadium['name'] }}</h3>
                    <div class="flex items-center text-sm text-muted-foreground mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        {{ $stadium['city'] }}
                    </div>
                    <p class="text-muted-foreground mb-4">{{ $stadium['description'] }}</p>
                    <div class="flex justify-between items-center">
                        <a href="/stadiums/{{ $stadium['id'] }}" class="btn-primary">View Details</a>
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
            <h2 class="text-3xl font-bold mb-6 text-center">Stadium Information</h2>
            <p class="text-lg mb-4">
                Morocco has invested significantly in developing world-class stadiums for the 2030 FIFA World Cup. Each venue has been designed to provide an exceptional experience for players and spectators alike.
            </p>
            <p class="text-lg mb-4">
                The stadiums feature state-of-the-art facilities, including modern seating, excellent visibility from all areas, and advanced technology. Many of the venues incorporate elements of traditional Moroccan architecture, creating a unique blend of modern functionality and cultural heritage.
            </p>
            <p class="text-lg">
                All stadiums are equipped with excellent transportation links, making them easily accessible for fans from around the world. Visitors can expect a comfortable and memorable experience at each venue.
            </p>
        </div>
    </div>
</div>
@endsection
