@extends('layouts.app')

@section('title', 'Match Schedule')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-4">Match Schedule</h1>
            <p class="text-xl text-muted-foreground">Plan your World Cup experience with our comprehensive match schedule</p>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <div class="flex flex-wrap border-b border-gray-200">
                <button class="px-4 py-2 text-sm font-medium border-b-2 border-primary text-primary">
                    All Matches
                </button>
                <button class="px-4 py-2 text-sm font-medium border-b-2 border-transparent hover:text-primary hover:border-primary">
                    Group Stage
                </button>
                <button class="px-4 py-2 text-sm font-medium border-b-2 border-transparent hover:text-primary hover:border-primary">
                    Round of 16
                </button>
                <button class="px-4 py-2 text-sm font-medium border-b-2 border-transparent hover:text-primary hover:border-primary">
                    Quarter Finals
                </button>
                <button class="px-4 py-2 text-sm font-medium border-b-2 border-transparent hover:text-primary hover:border-primary">
                    Semi Finals
                </button>
                <button class="px-4 py-2 text-sm font-medium border-b-2 border-transparent hover:text-primary hover:border-primary">
                    Final
                </button>
            </div>
        </div>

        <div class="space-y-6">
            <h2 class="text-2xl font-bold mb-4">Group Stage</h2>

            @foreach($groupMatches as $date => $matches)
            <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4">{{ $date }}</h3>
                <div class="space-y-4">
                    @foreach($matches as $match)
                    <div class="card p-6">
                        <div class="flex justify-between items-center">
                            <div>
                                <div class="text-sm text-muted-foreground">{{ $match['time'] }} • {{ $match['stadium'] }}</div>
                                <h4 class="text-xl font-semibold my-2">{{ $match['teams'] }}</h4>
                                <div class="text-sm text-muted-foreground">{{ $match['group'] }}</div>
                            </div>
                            <button class="text-muted-foreground hover:text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-4">Knockout Stage</h2>
            <p class="text-muted-foreground mb-8">The knockout stage schedule will be determined after the completion of the group stage matches.</p>
        </div>
    </div>
</div>

<div class="bg-muted py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Stay Updated</h2>
            <p class="text-lg mb-8">Sign up to receive match schedule updates, ticket information, and exclusive content.</p>
            <form class="max-w-md mx-auto">
                <div class="flex">
                    <input type="email" placeholder="Enter your email" class="flex-grow px-4 py-2 rounded-l-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary">
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded-r-md hover:bg-primary/90">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
