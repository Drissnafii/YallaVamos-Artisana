@extends('layouts.member')

@section('title', 'Member Dashboard')

@section('full-width-content')
<!-- Hero Section with Background Image -->
<div class="relative bg-gradient-to-r from-amber-500 to-amber-600 h-80 overflow-hidden w-full">
    <div class="absolute inset-0 bg-pattern opacity-10"></div>
    <img src="{{ asset('images/world-cup-pattern.png') }}" alt="World Cup Pattern" class="absolute inset-0 object-cover mix-blend-overlay opacity-20 w-full h-full">
    <div class="absolute inset-0 w-screen bg-gradient-to-t from-[#FAF9F5] via-transparent to-transparent"></div>

    <!-- Full-width greeting div -->
    <div class="w-full h-full flex items-end">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8" style="padding-left: 120px; padding-bottom: 150px; padding-top: 60px;">
            <p class="text-white/80 text-sm font-medium mb-1">{{ now()->format('l, d F Y') }}</p>
            <h1 class="text-4xl font-bold text-white mb-2">Bonjour, {{ Auth::user()->name }}</h1>
            <p class="text-white/90">Bienvenue sur votre tableau de bord Coupe du Monde 2030</p>
        </div>
    </div>
</div>
@endsection

@section('content')
<!-- Main Content -->
<div class="max-w-7xl mx-auto -mt-20">
    <!-- Quick Stats Cards Row - Spotify-style rounded cards with hover effects -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Favorites Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 -mr-8 -mt-8 bg-[#FFF7E1] rounded-full opacity-70 transition-transform duration-300 group-hover:scale-110"></div>
            <div class="relative">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-full bg-[#FFF7E1] mr-4 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Favoris</p>
                        <p class="text-3xl font-bold">{{ $favoriteCount ?? 0 }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-2 mb-4">
                    <div class="bg-[#FFF7E1] bg-opacity-50 p-2 rounded-lg text-center">
                        <p class="text-xs text-gray-600">Villes</p>
                        <p class="font-bold text-amber-600">{{ $favoriteCitiesCount ?? 0 }}</p>
                    </div>
                    <div class="bg-[#FFF7E1] bg-opacity-50 p-2 rounded-lg text-center">
                        <p class="text-xs text-gray-600">Stades</p>
                        <p class="font-bold text-amber-600">{{ $favoriteStadiumsCount ?? 0 }}</p>
                    </div>
                    <div class="bg-[#FFF7E1] bg-opacity-50 p-2 rounded-lg text-center">
                        <p class="text-xs text-gray-600">Matchs</p>
                        <p class="font-bold text-amber-600">{{ $favoriteMatchesCount ?? 0 }}</p>
                    </div>
                </div>

                <a href="{{ route('member.favorites.index') }}" class="inline-flex items-center text-sm font-medium text-amber-600 hover:text-amber-700">
                    Gérer vos favoris
                    <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Articles Card -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 -mr-8 -mt-8 bg-[#F2F1EC] rounded-full opacity-70 transition-transform duration-300 group-hover:scale-110"></div>
            <div class="relative">
                <div class="flex items-center mb-4">
                    <div class="p-3 rounded-full bg-[#F2F1EC] mr-4 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Articles</p>
                        <p class="text-3xl font-bold">{{ $articleCount ?? 0 }}</p>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-xs text-gray-600">Articles publiés ce mois</span>
                        <span class="text-xs font-medium">{{ $monthlyArticleCount ?? 0 }}/5</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ min(($monthlyArticleCount ?? 0) / 5 * 100, 100) }}%"></div>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <a href="{{ route('member.articles.index') }}" class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-700">
                        Voir mes articles
                        <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <span class="text-gray-300">|</span>
                    <a href="{{ route('member.articles.create') }}" class="inline-flex items-center text-sm font-medium text-green-600 hover:text-green-700">
                        Créer
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Rest of the content from the original file -->
        <!-- ... continue with the rest of the existing content ... -->
    </div>

    <!-- Additional content continues... -->
</div>

<!-- Initialize JS for the page -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add subtle hover effects to cards with animation
    const cards = document.querySelectorAll('.hover-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.classList.add('shadow-md');
            this.classList.remove('shadow-sm');
        });
        card.addEventListener('mouseleave', function() {
            this.classList.remove('shadow-md');
            this.classList.add('shadow-sm');
        });
    });

    // Update countdown in real-time if needed
    function updateCountdown() {
        const countdownElement = document.getElementById('countdown');
        if (countdownElement) {
            // This is where you would calculate the remaining time
            // For now, we'll just keep it static
        }
    }

    // Initial call and set interval if needed
    updateCountdown();
    // setInterval(updateCountdown, 86400000); // Update once per day

    // Add smooth scroll behavior
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Add animation to progress bars
    const progressBars = document.querySelectorAll('[style*="width"]');
    setTimeout(() => {
        progressBars.forEach(bar => {
            bar.style.transition = 'width 1s ease-in-out';
        });
    }, 200);
});
</script>
@endsection
