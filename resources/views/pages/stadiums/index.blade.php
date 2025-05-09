@extends('layouts.app')

@section('title', 'Stadiums')

@section('content')
<!-- Hero Section with Apple-inspired minimalism -->
<div class="relative h-[80vh] overflow-hidden bg-white dark:bg-black">
    <div class="absolute inset-0 bg-gradient-to-b from-gray-50/30 to-white/80 dark:from-gray-900/30 dark:to-black/80 z-10"></div>
    <div class="absolute inset-0 bg-[url('/img/stadium-hero.jpg')] bg-center bg-cover"></div>
    <div class="absolute inset-0 flex items-center justify-center z-20">
        <div class="text-center p-6 max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-7xl font-medium tracking-tight text-black dark:text-white mb-6 leading-none">
                World Cup Stadiums
            </h1>
            <p class="text-xl md:text-2xl font-light text-gray-800 dark:text-gray-200 max-w-2xl mx-auto leading-relaxed">
                Discover the magnificent venues hosting the 2030 FIFA World Cup matches
            </p>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-white dark:from-black to-transparent z-10"></div>
    <div class="absolute bottom-12 left-0 right-0 flex justify-center z-20">
        <a href="#stadiums" class="text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white transition-colors duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </a>
    </div>
</div>

<!-- Filter Bar (Apple-style) -->
<div class="sticky top-0 bg-white/80 dark:bg-black/80 backdrop-blur-lg z-30 py-4 border-b border-gray-100 dark:border-gray-900">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="text-xl font-medium text-gray-900 dark:text-white">Explore Stadiums</div>
            <div class="flex items-center space-x-4">
                <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                    All Stadiums
                </button>
                <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                    By Capacity
                </button>
                <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                    By City
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Stadium Grid with Apple-inspired minimalism -->
<div id="stadiums" class="py-24 bg-white dark:bg-black">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($stadiums as $stadium)
            <div class="group relative overflow-hidden rounded-2xl transition-all duration-500 cursor-pointer">
                <!-- Stadium Image with Overlay -->
                <div class="aspect-[4/3] w-full overflow-hidden">
                    <img src="{{ asset('storage/' . $stadium->image) }}" alt="{{ $stadium->name }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>

                <!-- Stadium Info (Hidden until hover) -->
                <div class="absolute inset-0 flex flex-col justify-end p-8 opacity-0 group-hover:opacity-100 transition-all duration-500">
                    <h3 class="text-2xl font-medium text-white mb-2">{{ $stadium->name }}</h3>
                    <div class="flex items-center text-sm text-white/80 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        {{ $stadium->city->name ?? 'Location not available' }}
                    </div>
                    <p class="text-sm text-white/70 mb-4 line-clamp-2">
                        {{ \Illuminate\Support\Str::limit($stadium->description, 120) }}
                    </p>
                    <a href="/stadiums/{{ $stadium->id }}"
                       class="inline-flex items-center text-sm font-medium text-white hover:text-white/80 transition-colors">
                        View Details
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>

                <!-- Stadium Name (Always Visible) -->
                <div class="absolute top-0 left-0 right-0 p-6 group-hover:opacity-0 transition-opacity duration-300">
                    <h3 class="text-lg font-medium text-white drop-shadow-md">{{ $stadium->name }}</h3>
                </div>
            </div>
            @endforeach
        </div>

        @if(isset($showLoginMessage) && $showLoginMessage)
        <div class="mt-24 bg-gray-50 dark:bg-gray-900 rounded-3xl overflow-hidden">
            <div class="grid md:grid-cols-2 items-center">
                <div class="p-12 md:p-16">
                    <h3 class="text-3xl font-medium text-gray-900 dark:text-white mb-4">Unlock All Stadiums</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-8 text-lg font-light leading-relaxed">
                        Sign in to explore all venues hosting the 2030 FIFA World Cup with exclusive content and features.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('login') }}"
                           class="inline-flex justify-center items-center px-8 py-3 rounded-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors duration-300">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}"
                           class="inline-flex justify-center items-center px-8 py-3 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-300">
                            Create Account
                        </a>
                    </div>
                </div>
                <div class="hidden md:block h-full bg-[url('/img/stadium-access.jpg')] bg-cover bg-center min-h-[400px]">
                </div>
            </div>
        </div>
        @endif

        @if(isset($isAuthenticated) && $isAuthenticated)
        <div class="mt-16 flex justify-center">
            {{ $stadiums->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Stadium Features Section (Apple-inspired) -->
<div class="py-32 bg-gray-50 dark:bg-gray-950">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center mb-16">
            <h2 class="text-4xl font-medium text-gray-900 dark:text-white mb-6">Designed for Excellence</h2>
            <p class="text-xl font-light text-gray-600 dark:text-gray-300 leading-relaxed">
                Morocco's World Cup stadiums combine cutting-edge technology with traditional design elements to create unforgettable experiences.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-16">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-500 dark:text-blue-400 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-3">Global Accessibility</h3>
                <p class="text-gray-600 dark:text-gray-400 font-light leading-relaxed">
                    All stadiums are equipped with excellent transportation links, making them easily accessible for fans from around the world.
                </p>
            </div>

            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-50 dark:bg-green-900/20 text-green-500 dark:text-green-400 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-3">Modern Technology</h3>
                <p class="text-gray-600 dark:text-gray-400 font-light leading-relaxed">
                    State-of-the-art facilities include advanced technology, modern seating, and excellent visibility from all areas.
                </p>
            </div>

            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-amber-50 dark:bg-amber-900/20 text-amber-500 dark:text-amber-400 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-3">Cultural Heritage</h3>
                <p class="text-gray-600 dark:text-gray-400 font-light leading-relaxed">
                    Many venues incorporate elements of traditional Moroccan architecture, creating a unique blend of modern functionality and cultural heritage.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Key Figures Section (Apple-style) -->
<div class="py-24 bg-white dark:bg-black overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="relative group">
                <div class="text-8xl font-light text-black dark:text-white mb-2 transition-transform duration-500 group-hover:translate-y-[-10px]">12</div>
                <div class="text-gray-600 dark:text-gray-400 text-lg font-light">Stadiums</div>
            </div>
            <div class="relative group">
                <div class="text-8xl font-light text-black dark:text-white mb-2 transition-transform duration-500 group-hover:translate-y-[-10px]">1.2M<span class="text-4xl align-top">+</span></div>
                <div class="text-gray-600 dark:text-gray-400 text-lg font-light">Total Capacity</div>
            </div>
            <div class="relative group">
                <div class="text-8xl font-light text-black dark:text-white mb-2 transition-transform duration-500 group-hover:translate-y-[-10px]">9</div>
                <div class="text-gray-600 dark:text-gray-400 text-lg font-light">Host Cities</div>
            </div>
        </div>
    </div>
</div>

<!-- Minimalist Newsletter Section (Apple-style) -->
<div class="py-24 bg-gray-50 dark:bg-gray-950">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl mx-auto text-center">
            <h3 class="text-3xl font-medium text-gray-900 dark:text-white mb-6">Stay Updated</h3>
            <p class="text-gray-600 dark:text-gray-300 mb-8 font-light">Receive the latest news about stadium developments and match schedules</p>
            <form class="flex gap-4">
                <input type="email" placeholder="Your email address"
                       class="flex-1 px-6 py-4 rounded-full border-none ring-1 ring-gray-200 dark:ring-gray-800 bg-white dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:outline-none">
                <button type="submit"
                        class="px-8 py-4 rounded-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors shadow-sm font-medium">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Add custom JS for animations -->
@push('scripts')
<script>
    // Initialize animations when page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Add scroll reveal animations
        const items = document.querySelectorAll('.grid > div');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('opacity-100');
                        entry.target.classList.remove('opacity-0', 'translate-y-8');
                    }, i * 100);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        items.forEach((item, i) => {
            item.classList.add('opacity-0', 'translate-y-8', 'transition-all', 'duration-700', 'ease-out');
            observer.observe(item);
        });

        // Animate hero text
        const heroTitle = document.querySelector('h1');
        const heroText = document.querySelector('h1 + p');

        if (heroTitle) {
            heroTitle.classList.add('opacity-0', 'translate-y-4');
            setTimeout(() => {
                heroTitle.classList.add('transition-all', 'duration-1000', 'ease-out');
                heroTitle.classList.remove('opacity-0', 'translate-y-4');
            }, 300);
        }

        if (heroText) {
            heroText.classList.add('opacity-0', 'translate-y-4');
            setTimeout(() => {
                heroText.classList.add('transition-all', 'duration-1000', 'ease-out');
                heroText.classList.remove('opacity-0', 'translate-y-4');
            }, 600);
        }
    });
</script>
@endpush
@endsection
