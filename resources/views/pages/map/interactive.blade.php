@extends('layouts.app')

@section('title', 'Interactive Map - Coming Soon')

@section('content')
<!-- Hero Header with iOS-inspired design -->
<section class="py-24 bg-white text-center">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-light tracking-tight mb-6">Interactive Map</h1>
        <p class="text-xl text-gray-500 font-light max-w-2xl mx-auto">Explore Morocco's 2030 World Cup host cities</p>
    </div>
</section>

<!-- Coming Soon Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Coming Soon Card -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden p-12 text-center">
                <div class="mb-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                </div>

                <h2 class="text-3xl font-light mb-6 tracking-tight">Coming Soon</h2>
                <p class="text-gray-600 mb-12 max-w-2xl mx-auto">We're working on an interactive map experience that will allow you to explore all the host cities, stadiums, and attractions for the Morocco 2030 FIFA World Cup. Check back soon!</p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="/cities" class="px-10 py-3 bg-[#E9272E] text-white rounded-full text-sm font-medium transition-all duration-300 hover:bg-[#C71F25]">
                        Explore Host Cities
                    </a>
                    <a href="/stadiums" class="px-10 py-3 bg-gray-100 text-gray-800 rounded-full text-sm font-medium transition-all duration-300 hover:bg-gray-200">
                        View Stadiums
                    </a>
                </div>
            </div>

            <!-- Features Preview -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm text-center">
                    <div class="w-12 h-12 bg-[#E9272E]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium mb-3">Interactive Locations</h3>
                    <p class="text-gray-600 text-sm">Explore detailed information about each host city with interactive pins and location guides.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm text-center">
                    <div class="w-12 h-12 bg-[#E9272E]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium mb-3">Stadium Tours</h3>
                    <p class="text-gray-600 text-sm">Preview each stadium with 360° views and detailed information about facilities and matches.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm text-center">
                    <div class="w-12 h-12 bg-[#E9272E]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium mb-3">Travel Planning</h3>
                    <p class="text-gray-600 text-sm">Plan your entire World Cup journey with travel times, accommodations, and local attractions.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Signup for Updates -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-light mb-6 tracking-tight">Stay Updated</h2>
            <p class="text-gray-600 mb-10">Be the first to know when our interactive map launches. Subscribe for updates on all Morocco 2030 FIFA World Cup developments.</p>

            <form class="flex flex-col sm:flex-row gap-4 max-w-xl mx-auto">
                <input type="email" placeholder="Your email address" class="flex-grow px-6 py-3 bg-gray-100 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#E9272E]/20">
                <button type="submit" class="px-6 py-3 bg-[#E9272E] text-white rounded-full text-sm font-medium transition-all duration-300 hover:bg-[#C71F25]">
                    Subscribe
                </button>
            </form>

            <p class="mt-6 text-xs text-gray-500">We respect your privacy. Unsubscribe at any time.</p>
        </div>
    </div>
</section>
@endsection
