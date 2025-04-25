@extends('layouts.app')

@section('title', 'Host Cities')

@section('content')
<!-- Hero Header with iOS-inspired design -->
<section class="py-24 bg-white text-center">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-light tracking-tight mb-6">Host Cities</h1>
        <p class="text-xl text-gray-500 font-light max-w-2xl mx-auto">Explore the vibrant cities hosting the 2030 FIFA World Cup in Morocco</p>
    </div>
</section>

<!-- City Grid with iOS-style cards -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($cities as $city)
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition-all duration-300">
                <div class="h-56 overflow-hidden">
                    <img src="{{ asset('storage/' . $city->image) }}" alt="{{ $city->name }}" class="w-full h-full object-cover">
                </div>
                <div class="p-8">
                    <h3 class="text-xl font-medium text-gray-900 mb-3">{{ $city->name }}</h3>
                    <p class="text-gray-600 mb-6 text-sm leading-relaxed">{{ \Illuminate\Support\Str::limit($city->description, 150) }}</p>
                    <div class="flex justify-between items-center">
                        <a href="/cities/{{ $city->id }}" class="px-6 py-2 bg-[#E9272E] text-white rounded-full text-sm font-medium transition-all duration-300 hover:bg-[#C71F25]">
                            Explore
                        </a>
                        <button class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 hover:bg-gray-200 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if(isset($showLoginMessage) && $showLoginMessage)
        <!-- iOS-style login prompt -->
        <div class="mt-20 bg-white p-10 rounded-2xl shadow-sm text-center max-w-3xl mx-auto">
            <h3 class="text-2xl font-light mb-4">Want to see all host cities?</h3>
            <p class="text-gray-600 mb-8 max-w-xl mx-auto">Sign in or create an account to explore all cities hosting the 2030 FIFA World Cup in Morocco.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('login') }}" class="px-10 py-3 bg-[#E9272E] text-white rounded-full text-sm font-medium transition-all duration-300 hover:bg-[#C71F25]">
                    Sign In
                </a>
                <a href="{{ route('register') }}" class="px-10 py-3 bg-gray-100 text-gray-800 rounded-full text-sm font-medium transition-all duration-300 hover:bg-gray-200">
                    Create Account
                </a>
            </div>
        </div>
        @endif

        @if(isset($isAuthenticated) && $isAuthenticated)
        <!-- iOS-style pagination -->
        <div class="mt-12 flex justify-center">
            {{ $cities->links() }}
        </div>
        @endif
    </div>
</section>

<!-- About Morocco section with iOS design -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-light mb-10 text-center tracking-tight">About Morocco</h2>

            <div class="space-y-6 text-gray-600">
                <p class="leading-relaxed">
                    Morocco is a country located in North Africa, known for its rich culture, diverse landscapes, and warm hospitality. From the bustling markets of Marrakech to the coastal charm of Casablanca, each city offers a unique experience.
                </p>
                <p class="leading-relaxed">
                    The 2030 FIFA World Cup will be hosted across multiple cities in Morocco, showcasing the country's modern infrastructure alongside its traditional heritage. Visitors will have the opportunity to explore ancient medinas, enjoy delicious cuisine, and experience the passion of Moroccan football.
                </p>
                <p class="leading-relaxed">
                    Each host city has been carefully selected to provide the best possible experience for players and fans alike, with state-of-the-art stadiums and excellent transportation links.
                </p>
            </div>

            <!-- iOS-style CTA button -->
            <div class="mt-12 text-center">
                <a href="/about-morocco" class="px-8 py-3 bg-gray-100 text-gray-800 rounded-full text-sm font-medium transition-all duration-300 hover:bg-gray-200 inline-flex items-center">
                    Learn more about Morocco
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Map Feature - iOS-style bonus section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-light mb-6 tracking-tight">Discover Host Cities on the Map</h2>
            <p class="text-gray-600 mb-12 max-w-2xl mx-auto">Explore the geographical distribution of all World Cup host cities across Morocco</p>

            <!-- Map placeholder with iOS-style design -->
            <div class="bg-white p-4 rounded-2xl shadow-sm overflow-hidden h-96 mb-10">
                <div class="w-full h-full bg-gray-100 rounded-xl flex items-center justify-center">
                    <p class="text-gray-500">Interactive map will be displayed here</p>
                </div>
            </div>

            <a href="{{ route('interactive-map') }}" class="px-10 py-3 bg-[#E9272E] text-white rounded-full text-sm font-medium transition-all duration-300 hover:bg-[#C71F25]">
                Open Interactive Map
            </a>
        </div>
    </div>
</section>
@endsection
