@extends('layouts.app')

@section('title', 'Welcome to Morocco 2030')

@section('content')
<!-- Close container from layout to allow full-width sections -->
</div>

<!-- Hero Section with Video Background - KEPT UNCHANGED AS REQUESTED -->
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

<!-- Introduction Section with Morocco Map SVG on Right Side - Properly Contained -->
<section class="py-16 bg-gradient-to-b from-black to-gray-900 text-white overflow-hidden relative">
    <!-- Decorative blur effects -->
    <div class="absolute top-0 right-0 w-72 h-72 bg-red-500 rounded-full mix-blend-multiply filter blur-5xl opacity-20 animate-blob"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-5xl opacity-15 animate-blob animation-delay-2000"></div>

    <div class="container mx-auto px-4 relative">
        <div class="flex flex-col lg:flex-row items-start gap-8 relative">
            <!-- Content Side - Left -->
            <div class="w-full lg:w-1/2 z-10 lg:ml-24 flex flex-col justify-center lg:mt-16">
                <!-- Heading with subtle accent -->
                <div class="mb-8 flex items-center">
                    <div class="h-1 w-16 bg-red-500 mr-4"></div>
                    <h2 class="text-4xl font-bold">Welcome to Morocco's World Cup</h2>
                </div>

                <!-- Card with subtle glass effect -->
                <div class="p-6 rounded-lg bg-white bg-opacity-5 backdrop-blur-sm hover:bg-opacity-10 transition-all duration-300">
                    <p class="text-gray-300 mb-6 leading-relaxed">
                        Your comprehensive resource for exploring Morocco as it prepares to host the 2030 FIFA World Cup. Discover breathtaking venues, vibrant host cities, and everything you need to plan your unforgettable World Cup experience.
                    </p>

                    <!-- Interactive elements -->
                    <div class="flex flex-wrap gap-4 mt-8">
                        <a href="/about" class="inline-flex items-center px-5 py-2 rounded-full bg-red-500 bg-opacity-20 hover:bg-opacity-30 text-red-400 text-sm font-medium transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            About Morocco 2030
                        </a>
                        <a href="/explore" class="inline-flex items-center px-5 py-2 rounded-full bg-white bg-opacity-10 hover:bg-opacity-20 text-white text-sm font-medium transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            Interactive Map
                        </a>
                    </div>
                </div>

                <!-- Simple indicator for scrolling - Only visible on mobile -->
                <div class="mt-10 text-center lg:hidden">
                    <div class="inline-flex flex-col items-center text-gray-400 text-xs space-y-3">
                        <span>Scroll to explore</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Map Side - Right (Strictly contained) -->
            <div class="w-full lg:w-1/2 flex justify-center items-center mt-8 lg:mt-0 h-80 lg:h-96 relative overflow-hidden">
                <!-- The key is this wrapper with overflow-hidden and position relative -->
                <div class="absolute inset-0 flex items-start justify-center">
                    <!-- Decorative background for the map -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-transparent to-black opacity-30"></div>

                    <!-- Morocco Map with contained dimensions - zoomed by 30% and positioned higher -->
                    <div class="relative max-w-full max-h-full">
                        <img
                            src="{{ asset('images/ma.svg') }}"
                            alt="Morocco Map"
                            class="h-auto w-auto max-h-full max-w-full object-contain transform scale-130 -translate-y-12"
                            style="filter: brightness(1.3) contrast(1.4) drop-shadow(0 0 12px rgba(220, 38, 38, 0.4));">

                        <!-- City markers - repositioned to appear correctly on the map -->
                        <div class="absolute inset-0 pointer-events-none">
                            <!-- Casablanca marker - adjusted position -->
                            <div class="absolute top-[38%] left-[75%]">
                                <div class="h-3 w-3 bg-red-500 rounded-full animate-ping"></div>
                                <div class="h-2 w-2 bg-red-600 rounded-full absolute top-0.5 left-0.5"></div>
                            </div>

                            <!-- Marrakech marker - adjusted position -->
                            <div class="absolute top-[52%] left-[60%]">
                                <div class="h-3 w-3 bg-red-500 rounded-full animate-ping" style="animation-delay: 0.5s"></div>
                                <div class="h-2 w-2 bg-red-600 rounded-full absolute top-0.5 left-0.5"></div>
                            </div>

                            <!-- Rabat marker - adjusted position -->
                            <div class="absolute top-[32%] left-[53%]">
                                <div class="h-3 w-3 bg-red-500 rounded-full animate-ping" style="animation-delay: 1s"></div>
                                <div class="h-2 w-2 bg-red-600 rounded-full absolute top-0.5 left-0.5"></div>
                            </div>

                            <!-- Fez marker - new central point -->
                            <div class="absolute top-[45%] left-[65%]">
                                <div class="h-3 w-3 bg-green-500 rounded-full animate-ping" style="animation-delay: 1.5s"></div>
                                <div class="h-2 w-2 bg-green-600 rounded-full absolute top-0.5 left-0.5"></div>
                            </div>

                            <!-- Center point between all markers -->
                            <div class="absolute top-[40.6%] left-[62.6%]">
                                <div class="h-4 w-4 bg-yellow-500 rounded-full animate-pulse"></div>
                                <div class="h-3 w-3 bg-yellow-600 rounded-full absolute top-0.5 left-0.5"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Content Section - ALREADY UPDATED WITH SPOTIFY DESIGN -->
<section class="relative py-16 overflow-hidden bg-black">
    <!-- Video background with reduced opacity overlay -->
    <video class="absolute inset-0 w-full h-full object-cover z-0 opacity-30" autoplay loop muted playsinline>
        <source src="http://127.0.0.1:8000/videos/jemaaFenawebb.webm" type="video/webm">
        Your browser does not support the video tag.
    </video>

    <!-- Container for content -->
    <div class="container mx-auto px-4 relative z-20 max-w-5xl">
        <!-- Simple heading with Spotify-like spacing -->
        <h2 class="text-white text-3xl font-bold mb-12 text-center">Explore the Tournament</h2>

        <!-- Grid with cleaner layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Cities card -->
            <div class="p-6 rounded-lg bg-opacity-10 bg-white backdrop-blur-sm hover:bg-opacity-20 transition-all duration-300">
                <div class="flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-white">Host Cities</h3>
                </div>
                <p class="text-gray-400 mb-4 text-sm">Explore Morocco's vibrant cities hosting the tournament</p>
                <a href="/cities" class="inline-flex items-center text-red-400 hover:text-red-300 text-sm font-medium transition-colors duration-300">
                    Discover Cities
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>

            <!-- Stadiums card -->
            <div class="p-6 rounded-lg bg-opacity-10 bg-white backdrop-blur-sm hover:bg-opacity-20 transition-all duration-300">
                <div class="flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-white">World-Class Stadiums</h3>
                </div>
                <p class="text-gray-400 mb-4 text-sm">Tour the spectacular venues for the matches</p>
                <a href="/stadiums" class="inline-flex items-center text-red-400 hover:text-red-300 text-sm font-medium transition-colors duration-300">
                    View Stadiums
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>

            <!-- Schedule card -->
            <div class="p-6 rounded-lg bg-opacity-10 bg-white backdrop-blur-sm hover:bg-opacity-20 transition-all duration-300">
                <div class="flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-white">Match Schedule</h3>
                </div>
                <p class="text-gray-400 mb-4 text-sm">Plan your experience with the tournament calendar</p>
                <a href="/matches" class="inline-flex items-center text-red-400 hover:text-red-300 text-sm font-medium transition-colors duration-300">
                    Check Matches
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Latest News Section - IMPROVED WITH SPOTIFY DESIGN -->
<section class="py-16 bg-gradient-to-b from-gray-900 to-black text-white">
    <div class="container mx-auto px-4">
        <!-- Section heading with accent -->
        <div class="mb-12 flex items-center justify-center">
            <div class="h-1 w-12 bg-red-500 mr-4"></div>
            <h2 class="text-3xl font-bold">Latest Updates</h2>
            <div class="h-1 w-12 bg-red-500 ml-4"></div>
        </div>

        <div class="max-w-4xl mx-auto">
            @foreach($news as $index => $article)
                @if($index < 2)
                <div class="p-6 rounded-lg bg-white bg-opacity-5 backdrop-blur-sm hover:bg-opacity-10 transition-all duration-300 mb-6">
                    <div class="flex flex-col md:flex-row items-start gap-6">
                        <div class="md:w-1/3 w-full">
                            <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-40 object-cover rounded-md">
                        </div>
                        <div class="md:w-2/3 w-full">
                            <div class="text-xs text-red-400 mb-2">{{ $article['date'] }}</div>
                            <h3 class="text-xl font-semibold mb-3 text-white">{{ $article['title'] }}</h3>
                            <p class="text-gray-300 text-sm mb-4">{{ $article['excerpt'] }}</p>
                            <a href="/news/{{ $article['id'] }}" class="inline-flex items-center text-red-400 hover:text-red-300 text-sm font-medium transition-colors duration-300">
                                Read Full Story
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="/news" class="inline-flex items-center px-6 py-3 rounded-full bg-white bg-opacity-10 hover:bg-opacity-20 text-white text-sm font-medium transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                View All News
            </a>
        </div>
    </div>
</section>

<!-- Call to Action with Video Background - IMPROVED WITH SPOTIFY DESIGN -->
<section class="relative py-24 text-white overflow-hidden">
    <video class="absolute inset-0 w-full h-full object-cover z-0 opacity-40" autoplay loop muted playsinline>
        <source src="{{ asset('videos/gnawa.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="absolute inset-0 bg-black bg-opacity-70 z-10"></div>

    <div class="container mx-auto px-4 relative z-20">
        <div class="max-w-3xl mx-auto">
            <!-- Card with glass effect -->
            <div class="p-8 rounded-lg bg-white bg-opacity-5 backdrop-blur-sm text-center">
                <h2 class="text-3xl font-bold mb-6">Ready for the World Cup Experience?</h2>
                <p class="text-gray-300 text-lg mb-8">Create an account to save your favorite matches, stadiums, and plan your trip to Morocco.</p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="/register" class="inline-flex items-center px-8 py-3 rounded-full bg-red-500 hover:bg-red-600 text-white font-medium transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Join Us Now
                    </a>
                    <a href="/login" class="inline-flex items-center px-8 py-3 rounded-full bg-white bg-opacity-10 hover:bg-opacity-20 text-white font-medium transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Sign In
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container mx-auto px-4 sm:px-6 lg:px-8"><!-- Reopen container to properly close the section -->
@endsection
