@extends('layouts.app')

@section('title', 'Welcome to Morocco 2030')

@section('content')
<!-- Break out of container for full-width videos -->
</div><!-- Close the container div from app.blade.php -->

<!-- Hero Section with Video Background -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <video class="absolute inset-0 w-full h-full object-cover z-0" autoplay loop muted playsinline>
        <source src="{{ asset('videos/Morocco  Cinematic Video - SONY A7SIII.mp4') }}" type="video/webm">
        Your browser does not support the video tag.
    </video>

    <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>

    <div class="absolute left-1/2 top-[105px] w-full max-w-[901px] h-[173px] z-20 text-center transform -translate-x-1/2">
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-12">Morocco 2030 FIFA World Cup</h1>
        <p class="text-xl md:text-2xl text-white">Experience the magic of football in the heart of North Africa</p>
        <div class="mt-12 absolute top-[300px] left-0 right-0 mx-auto w-[275px] h-[82px]">
            <a href="/explore" class="inline-flex items-center justify-center px-6 py-3 bg-[#B80012] hover:bg-[#B80012]/90 active:bg-[#B80012]/80 active:translate-y-0.5 text-white font-sans font-semibold rounded-full shadow-md shadow-[0_4px_14px_rgba(184,0,18,0.3)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#B80012]/50 transition-transform transition-colors duration-150 ease-in-out">
            Begin Your Journey
            </a>
        </div>
    </div>
</section>

<!-- Introduction Section -->
<div class="container mx-auto px-4"><!-- Reopen container for normal sections -->
    <section class="py-20 bg-white">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-6">Welcome to Morocco's World Cup Guide</h2>
            <p class="text-lg text-gray-700 mb-8">Your comprehensive resource for exploring Morocco as it prepares to host the 2030 FIFA World Cup. Discover breathtaking venues, vibrant host cities, and everything you need to plan your unforgettable World Cup experience.</p>
        </div>
    </section>
</div><!-- Close container for normal sections -->

<!-- Featured Content with Video Background -->
    <section class="relative py-24 overflow-hidden">
        <video class="absolute inset-0 w-full h-full object-cover z-0" autoplay loop muted playsinline>
            <source src="{{ asset('videos/jemaaFenawebb.webm') }}" type="video/webm">
            Your browser does not support the video tag.
        </video>

        <div class="absolute inset-0 bg-black bg-opacity-70 z-10"></div>

        <div class="container mx-auto px-4 relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-600 text-white mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-white mb-4">Host Cities</h3>
                    <p class="text-gray-300 mb-6">Explore Morocco's vibrant cities that will host the world's greatest football tournament</p>
                    <a href="/cities" class="text-white hover:text-red-300 font-medium transition-colors duration-300">Discover Cities →</a>
                </div>

                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-600 text-white mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-white mb-4">World-Class Stadiums</h3>
                    <p class="text-gray-300 mb-6">Tour the spectacular venues where football history will be made</p>
                    <a href="/stadiums" class="text-white hover:text-red-300 font-medium transition-colors duration-300">View Stadiums →</a>
                </div>

                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-600 text-white mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-semibold text-white mb-4">Match Schedule</h3>
                    <p class="text-gray-300 mb-6">Plan your experience with the complete tournament calendar</p>
                    <a href="/matches" class="text-white hover:text-red-300 font-medium transition-colors duration-300">Check Matches →</a>
                </div>
            </div>
        </div>
    </section>

<!-- Latest News Section -->
<div class="container mx-auto px-4"><!-- Reopen container for normal sections -->
    <section class="py-20 bg-gray-50">
        <h2 class="text-3xl font-bold mb-12 text-center">Latest Updates</h2>

        <div class="max-w-4xl mx-auto">
            @foreach($news as $index => $article)
                @if($index < 2)
                <div class="flex flex-col md:flex-row items-start gap-6 mb-10 pb-10 {{ $index < count($news) - 1 ? 'border-b border-gray-200' : '' }}">
                    <div class="md:w-1/3 w-full">
                        <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-40 object-cover rounded-lg">
                    </div>
                    <div class="md:w-2/3 w-full">
                        <div class="text-sm text-gray-500 mb-2">{{ $article['date'] }}</div>
                        <h3 class="text-xl font-semibold mb-3">{{ $article['title'] }}</h3>
                        <p class="text-gray-700 mb-4">{{ $article['excerpt'] }}</p>
                        <a href="/news/{{ $article['id'] }}" class="text-red-600 hover:text-red-800 font-medium">Read Full Story →</a>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a href="/news" class="inline-flex items-center justify-center rounded-md px-6 py-3 text-base font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 transition-colors duration-300">
                View All News
            </a>
        </div>
    </section>
</div><!-- Close container for normal sections -->

<!-- Call to Action with Video Background -->
<section class="relative py-24 text-white overflow-hidden">
    <video class="absolute inset-0 w-full h-full object-cover z-0" autoplay loop muted playsinline>
        <source src="{{ asset('videos/gnawa.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="absolute inset-0 bg-black bg-opacity-60 z-10"></div>

    <div class="container mx-auto px-4 relative z-20">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Ready for the World Cup Experience?</h2>
            <p class="text-xl mb-8">Create an account to save your favorite matches, stadiums, and plan your trip to Morocco.</p>
            <a href="/register" class="inline-flex items-center justify-center rounded-md px-6 py-3 text-base font-medium text-red-700 bg-white hover:bg-gray-100 transition-colors duration-300 shadow-lg">
                Join Us Now
            </a>
        </div>
    </div>
</section>

<div class="container mx-auto px-4"><!-- Reopen container for end of content section -->
@endsection
