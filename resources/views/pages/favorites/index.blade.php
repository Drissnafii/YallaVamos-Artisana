@extends('layouts.app')

@section('title', 'Your Favorites')

@section('content')
<!-- Hero Header with iOS-inspired design -->
<section class="py-24 bg-white text-center">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-light tracking-tight mb-6">Your Favorites</h1>
        <p class="text-xl text-gray-500 font-light max-w-2xl mx-auto">Save and organize your World Cup preferences</p>
    </div>
</section>

<!-- Favorites Content Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <!-- Empty State Card (for non-subscribers) -->
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden p-16 text-center">
                <!-- Empty state illustration -->
                <div class="mb-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>

                <h2 class="text-3xl font-light mb-6 tracking-tight">Create Your Collection</h2>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Sign in or create an account to save your favorite cities, stadiums, and matches. Build your personalized Morocco 2030 World Cup experience.</p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="/register" class="px-10 py-3 bg-[#E9272E] text-white rounded-full text-sm font-medium transition-all duration-300 hover:bg-[#C71F25]">
                        Create Account
                    </a>
                    <a href="/login" class="px-10 py-3 bg-gray-100 text-gray-800 rounded-full text-sm font-medium transition-all duration-300 hover:bg-gray-200">
                        Sign In
                    </a>
                </div>
            </div>

            <!-- Features of Favorites -->
            <div class="mt-20">
                <h3 class="text-2xl font-light mb-12 text-center tracking-tight">What You Can Save</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Cities Feature -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm text-center">
                        <div class="w-14 h-14 bg-[#E9272E]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-medium mb-3">Host Cities</h4>
                        <p class="text-gray-600 text-sm">Save cities you want to visit during the tournament for easy access to local information.</p>
                    </div>

                    <!-- Stadiums Feature -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm text-center">
                        <div class="w-14 h-14 bg-[#E9272E]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-medium mb-3">Stadiums</h4>
                        <p class="text-gray-600 text-sm">Bookmark your preferred venues and get notifications about matches played there.</p>
                    </div>

                    <!-- Matches Feature -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm text-center">
                        <div class="w-14 h-14 bg-[#E9272E]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-medium mb-3">Match Schedule</h4>
                        <p class="text-gray-600 text-sm">Save matches you want to attend and create your personal tournament itinerary.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Premium Features Section -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-light mb-16 text-center tracking-tight">More with an Account</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div>
                    <div class="space-y-8">
                        <!-- Feature 1 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#E9272E]/10 rounded-full flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-medium mb-2">Match Alerts</h4>
                                <p class="text-gray-600 text-sm">Receive timely notifications about your favorite teams and matches.</p>
                            </div>
                        </div>

                        <!-- Feature 2 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#E9272E]/10 rounded-full flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-medium mb-2">Trip Planning</h4>
                                <p class="text-gray-600 text-sm">Create a personalized schedule based on your saved matches and venues.</p>
                            </div>
                        </div>

                        <!-- Feature 3 -->
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-10 h-10 bg-[#E9272E]/10 rounded-full flex items-center justify-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-lg font-medium mb-2">Community Features</h4>
                                <p class="text-gray-600 text-sm">Engage with other fans and share your World Cup experiences.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Device Mockup -->
                <div class="relative mx-auto" style="max-width: 400px;">
                    <div class="bg-gray-900 rounded-[40px] p-3 shadow-xl">
                        <div class="rounded-[32px] overflow-hidden">
                            <img src="{{ asset('images/favorites-app-mockup.jpg') }}" alt="Favorites on Mobile" class="w-full" onerror="this.src='https://via.placeholder.com/375x700/f5f5f7/E9272E?text=Morocco+2030+App';this.onerror='';">
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 transform translate-x-1/4 -translate-y-1/6">
                        <div class="w-24 h-24 bg-[#E9272E] rounded-full flex items-center justify-center text-white shadow-lg">
                            <span class="font-medium">Coming Soon</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Final CTA -->
            <div class="mt-20 text-center">
                <a href="/register" class="px-10 py-4 bg-[#E9272E] text-white rounded-full text-sm font-medium transition-all duration-300 hover:bg-[#C71F25]">
                    Create Your Account
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
