@extends('app')

@section('title', '404 - Page Not Found')

@section('content')
<div class="bg-gradient-to-r from-primary/10 to-secondary/10 py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="section-title">404</h1>
            <p class="section-subtitle">Page Not Found</p>
        </div>
    </div>
</div>

<div class="py-16">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-md">
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <svg class="h-24 w-24 text-primary mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h2 class="text-2xl font-bold mb-4">Oops! We couldn't find that page.</h2>
            <p class="text-muted-foreground mb-6">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
            <a href="/" class="btn-primary">
                Return to Home
            </a>
        </div>

        <div class="mt-8 bg-primary/10 p-6 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Looking for something?</h3>
            <p class="text-muted-foreground mb-4">Check out these popular pages:</p>
            <ul class="space-y-2">
                <li><a href="/cities" class="text-primary hover:underline">Host Cities</a></li>
                <li><a href="/stadiums" class="text-primary hover:underline">Stadiums</a></li>
                <li><a href="/match-schedule" class="text-primary hover:underline">Match Schedule</a></li>
                <li><a href="/travel" class="text-primary hover:underline">Travel Information</a></li>
                <li><a href="/news" class="text-primary hover:underline">Latest News</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
