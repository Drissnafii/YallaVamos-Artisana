@extends('layouts.app')

@section('title', 'Access Forbidden')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full text-center">
        <div class="text-primary text-9xl font-bold">403</div>
        <h2 class="mt-6 text-3xl font-bold">Access Forbidden</h2>
        <p class="mt-2 text-lg text-muted-foreground">
            You don't have permission to access this resource. Please contact the administrator if you believe this is an error.
        </p>
        <div class="mt-6">
            <a href="/" class="btn-primary">Return to Home</a>
        </div>

        <div class="mt-12">
            <h3 class="text-lg font-semibold mb-4">Looking for something?</h3>
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
