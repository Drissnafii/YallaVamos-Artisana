@extends('layouts.member')

@section('title', 'Stadiums')

@section('content')
<!-- Header Section with iOS-inspired design -->
<div class="mb-12">
    <h1 class="text-3xl font-light tracking-tight text-gray-900 mb-3">World Cup Stadiums</h1>
    <p class="text-lg text-gray-500 font-light">Explore the state-of-the-art stadiums hosting the Morocco 2030 World Cup matches</p>
</div>

<!-- Filter Options -->
<div class="bg-white rounded-2xl shadow-sm p-6 mb-10 flex flex-wrap items-center gap-4">
    <div class="mr-auto text-sm text-gray-500 font-light">{{ count($stadiums) }} stadiums available</div>

    <div class="flex gap-2">
        <button class="px-4 py-2 bg-[#E9272E] text-white rounded-full text-sm font-medium transition-all hover:bg-[#C71F25] flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            Filter
        </button>

        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full text-sm font-medium transition-all hover:bg-gray-200 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Sort
        </button>

        <button class="px-4 py-2 bg-gray-100 text-gray-800 rounded-full text-sm font-medium transition-all hover:bg-gray-200 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
            View
        </button>
    </div>
</div>

<!-- Stadium Grid with iOS-style cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
    @foreach($stadiums as $stadium)
    <div class="bg-white rounded-2xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
        <div class="relative h-56 overflow-hidden">
            @if($stadium->image)
            <img
                src="{{ asset('storage/' . $stadium->image) }}"
                alt="{{ $stadium->name }}"
                class="w-full h-full object-cover"
            >
            @else
            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            @endif

            <!-- Favorite Button with iOS styling -->
            <button
                class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-full p-2 shadow-sm favorite-btn"
                data-stadium-id="{{ $stadium->id }}"
                data-is-favorite="{{ in_array($stadium->id, $favoriteStadiums) ? 'true' : 'false' }}"
                onclick="toggleFavorite({{ $stadium->id }})"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ in_array($stadium->id, $favoriteStadiums) ? 'text-[#E9272E]' : 'text-gray-400' }}" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                </svg>
            </button>

            <!-- City Tag -->
            <div class="absolute bottom-4 left-4 bg-black/50 backdrop-blur-sm rounded-full px-3 py-1 text-white text-xs">
                {{ $stadium->city->name }}
            </div>
        </div>

        <div class="p-6">
            <h2 class="text-xl font-medium text-gray-900 mb-2">{{ $stadium->name }}</h2>

            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center text-sm text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    {{ number_format($stadium->capacity) }}
                </div>
                <span class="text-xs font-medium px-3 py-1 {{ $stadium->status == 'Complete' ? 'bg-green-100 text-green-800' : 'bg-[#E9272E]/10 text-[#E9272E]' }} rounded-full">
                    {{ $stadium->status ?? 'Under Construction' }}
                </span>
            </div>

            <p class="text-gray-600 mb-6 line-clamp-2 text-sm leading-relaxed">{{ $stadium->description }}</p>

            <div class="flex justify-between items-center">
                <a href="{{ route('member.stadiums.show', $stadium) }}" class="inline-flex items-center px-5 py-2 rounded-full bg-gray-100 text-gray-800 text-sm font-medium transition-all hover:bg-gray-200">
                    View Details
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>

                <a href="#" class="text-[#E9272E] hover:text-[#C71F25] text-sm font-medium transition-all">
                    3D Tour
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!-- Member Exclusive Section with Apple-inspired design -->
<div class="bg-gradient-to-r from-[#E9272E]/10 to-[#E9272E]/5 rounded-2xl p-8 mb-16">
    <h2 class="text-2xl font-light text-gray-900 mb-6">Member Exclusive Features</h2>
    <p class="text-gray-600 mb-10 max-w-3xl">As a member, you have access to exclusive stadium information and interactive features to enhance your World Cup experience.</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-[#E9272E]/10 rounded-full flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Interactive Stadium Tours</h3>
            <p class="text-gray-600 text-sm">Explore every corner of World Cup stadiums with immersive 360° virtual tours</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-[#E9272E]/10 rounded-full flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Seating Charts</h3>
            <p class="text-gray-600 text-sm">Access detailed seating information with view previews from different sections</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition-all">
            <div class="w-12 h-12 bg-[#E9272E]/10 rounded-full flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#E9272E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Stadium Information</h3>
            <p class="text-gray-600 text-sm">Comprehensive details about facilities, amenities, and accessibility features</p>
        </div>
    </div>

    <div class="text-center mt-10">
        <a href="/member/stadiums/features" class="inline-flex items-center px-8 py-3 bg-[#E9272E] text-white rounded-full text-sm font-medium transition-all hover:bg-[#C71F25]">
            Explore Premium Features
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</div>

<!-- Stadium Map Section -->
<div class="bg-white rounded-2xl shadow-sm p-8 mb-16">
    <h2 class="text-2xl font-light text-gray-900 mb-6">Stadium Locations</h2>
    <p class="text-gray-600 mb-8">View the geographical distribution of all World Cup stadiums across Morocco</p>

    <div class="bg-gray-100 rounded-xl h-96 flex items-center justify-center">
        <p class="text-gray-500">Interactive map will be displayed here</p>
    </div>

    <div class="text-center mt-8">
        <a href="/member/interactive-map" class="inline-flex items-center px-6 py-2 bg-gray-100 text-gray-800 rounded-full text-sm font-medium transition-all hover:bg-gray-200">
            Open Full Interactive Map
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function toggleFavorite(stadiumId) {
        const button = document.querySelector(`.favorite-btn[data-stadium-id="${stadiumId}"]`);
        const isFavorite = button.getAttribute('data-is-favorite') === 'true';
        const icon = button.querySelector('svg');

        fetch(`/member/stadiums/${stadiumId}/toggle-favorite`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ stadium_id: stadiumId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'added') {
                button.setAttribute('data-is-favorite', 'true');
                icon.classList.remove('text-gray-400');
                icon.classList.add('text-[#E9272E]');
                showNotification('Stadium added to favorites', 'success');
            } else {
                button.setAttribute('data-is-favorite', 'false');
                icon.classList.remove('text-[#E9272E]');
                icon.classList.add('text-gray-400');
                showNotification('Stadium removed from favorites', 'info');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error updating favorites', 'error');
        });
    }

    function showNotification(message, type = 'success') {
        // Create notification element with iOS-style design
        const notification = document.createElement('div');
        notification.className = `fixed bottom-4 right-4 z-50 px-6 py-3 rounded-2xl shadow-lg flex items-center ${
            type === 'success' ? 'bg-[#E9272E] text-white' :
            type === 'error' ? 'bg-red-500 text-white' :
            'bg-gray-800 text-white'
        }`;

        // Add icon based on type
        let iconSvg = '';
        if (type === 'success') {
            iconSvg = '<svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
        } else if (type === 'error') {
            iconSvg = '<svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
        } else {
            iconSvg = '<svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
        }

        notification.innerHTML = iconSvg + '<span class="text-sm font-medium">' + message + '</span>';

        // Add to DOM
        document.body.appendChild(notification);

        // Add entrance animation
        notification.style.transition = 'all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
        notification.style.transform = 'translateY(20px)';
        notification.style.opacity = '0';

        setTimeout(() => {
            notification.style.transform = 'translateY(0)';
            notification.style.opacity = '1';
        }, 10);

        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.transform = 'translateY(20px)';
            notification.style.opacity = '0';

            // Remove from DOM after animation completes
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 400);
        }, 3000);
    }
</script>
@endpush
