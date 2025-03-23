@extends('layouts.app')

@section('title', 'My Favorites')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">My Favorites</h1>
            <p class="text-xl text-muted-foreground">Keep track of your favorite matches, teams, and venues</p>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Favorites tabs -->
        <div class="mb-8 border-b border-gray-200">
            <div class="flex flex-wrap -mb-px">
                <button class="inline-block p-4 border-b-2 border-primary text-primary font-medium">
                    Matches
                </button>
                <button class="inline-block p-4 border-b-2 border-transparent hover:text-primary hover:border-primary font-medium">
                    Teams
                </button>
                <button class="inline-block p-4 border-b-2 border-transparent hover:text-primary hover:border-primary font-medium">
                    Venues
                </button>
            </div>
        </div>

        <!-- Matches tab content -->
        <div>
            @if(isset($favoriteMatches) && count($favoriteMatches) > 0)
                <div class="grid grid-cols-1 gap-4">
                    @foreach($favoriteMatches as $match)
                    <div class="card p-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-sm text-muted-foreground">{{ $match['date'] }} • {{ $match['time'] }}</div>
                                <h3 class="text-xl font-semibold my-2">{{ $match['teams'] }}</h3>
                                <div class="text-sm text-muted-foreground">{{ $match['venue'] }} • {{ $match['group'] }}</div>
                            </div>
                            <button class="text-primary hover:text-primary/80">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="card p-6 text-center">
                    <h3 class="font-medium mb-2">No favorite matches yet</h3>
                    <p class="text-sm text-muted-foreground mb-4">
                        Add matches to your favorites by clicking the heart icon on any match card.
                    </p>
                    <a href="/match-schedule" class="btn-primary">Browse Matches</a>
                </div>
            @endif
        </div>

        <!-- Teams tab content (hidden by default)  -->
        <div class="hidden">
            <div class="card p-6 text-center">
                <h3 class="font-medium mb-2">No favorite teams yet</h3>
                <p class="text-sm text-muted-foreground mb-4">
                    Add teams to your favorites by exploring the teams page.
                </p>
                <a href="/teams" class="btn-primary">Browse Teams</a>
            </div>
        </div>

        <!-- Venues tab content (hidden by default) -->
        <div class="hidden">
            <div class="card p-6 text-center">
                <h3 class="font-medium mb-2">No favorite venues yet</h3>
                <p class="text-sm text-muted-foreground mb-4">
                    Add venues to your favorites by exploring the venues page.
                </p>
                <a href="/stadiums" class="btn-primary">Browse Venues</a>
            </div>
        </div>

        <div class="bg-primary/10 p-6 rounded-lg mt-8">
            <div class="flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-primary mr-3 mt-0.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
                <div>
                    <h3 class="text-lg font-semibold mb-2">Login to save your favorites</h3>
                    <p class="text-muted-foreground mb-4">Create an account or log in to save your favorites and access them from any device.</p>
                    <a href="/login" class="btn-primary">Login or Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
