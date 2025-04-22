@extends('layouts.member')

@section('title', 'Match Details')

@section('content')
<div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('member.matches.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Matches
        </a>
    </div>

    <!-- Match Header Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 mb-8">
        <div class="p-6 md:p-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <div class="flex items-center mb-4 md:mb-0">
                    <div class="px-3 py-1 {{ $match->date->isPast() ? 'bg-gray-100 text-gray-800' : 'bg-blue-100 text-blue-800' }} rounded-full text-xs font-medium mr-3">
                        {{ $match->date->isPast() ? 'Completed' : 'Upcoming' }}
                    </div>
                    <span class="text-sm text-gray-500 font-medium">{{ $match->date->format('l, d F Y') }} • {{ $match->time }}</span>
                </div>

                <div>
                    <button id="favorite-toggle"
                        class="flex items-center px-4 py-2 rounded-lg {{ $isFavorite ? 'bg-amber-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-colors"
                        onclick="toggleMatchFavorite()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="{{ $isFavorite ? 'currentColor' : 'none' }}" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span id="favorite-label">{{ $isFavorite ? 'Remove from Favorites' : 'Add to Favorites' }}</span>
                    </button>
                </div>
            </div>

            <div class="flex flex-col items-center">
                <div class="w-full flex flex-col md:flex-row md:items-center md:justify-center gap-4 md:gap-10 mb-8">
                    <!-- Team 1 -->
                    <div class="flex-1 flex flex-col items-center text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-3 overflow-hidden">
                            @if($match->team1->flag)
                                <img src="{{ asset($match->team1->flag) }}" alt="{{ $match->team1->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-3xl font-bold text-gray-400">{{ substr($match->team1->code, 0, 3) }}</div>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold mb-1">{{ $match->team1->name }}</h3>
                        <span class="text-sm text-gray-500">{{ $match->team1->code }}</span>
                    </div>

                    <!-- Score -->
                    <div class="flex flex-col items-center">
                        <div class="flex items-center bg-gray-100 rounded-lg px-6 py-3 mb-2">
                            @if($match->date->isPast() && isset($match->score_team1) && isset($match->score_team2))
                                <span class="text-3xl font-bold">{{ $match->score_team1 }}</span>
                                <span class="text-xl mx-3 text-gray-500">-</span>
                                <span class="text-3xl font-bold">{{ $match->score_team2 }}</span>
                            @else
                                <span class="text-xl text-gray-500">VS</span>
                            @endif
                        </div>
                        <span class="text-sm font-medium {{ $match->date->isPast() ? 'text-gray-500' : 'text-green-600' }}">
                            {{ $match->date->isPast() ? 'Final Score' : 'Match Scheduled' }}
                        </span>
                    </div>

                    <!-- Team 2 -->
                    <div class="flex-1 flex flex-col items-center text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-3 overflow-hidden">
                            @if($match->team2->flag)
                                <img src="{{ asset($match->team2->flag) }}" alt="{{ $match->team2->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-3xl font-bold text-gray-400">{{ substr($match->team2->code, 0, 3) }}</div>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold mb-1">{{ $match->team2->name }}</h3>
                        <span class="text-sm text-gray-500">{{ $match->team2->code }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stadium and City Information -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Stadium Information -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-6">
                <h3 class="text-lg font-bold mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm3 1h6v4H7V5zm8 8V7H5v6h10zm-6 2h2v1.5h-2V15z" clip-rule="evenodd" />
                    </svg>
                    Stadium Information
                </h3>

                <div class="flex items-center mb-6">
                    <div class="w-20 h-20 bg-gray-100 rounded-lg mr-4 flex-shrink-0 overflow-hidden">
                        @if($match->stadium->image)
                            <img src="{{ asset($match->stadium->image) }}" alt="{{ $match->stadium->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-xl font-bold">{{ $match->stadium->name }}</h4>
                        <p class="text-gray-600 mb-1">{{ $match->stadium->city->name }}, Morocco</p>
                        <p class="text-gray-500 text-sm">Capacity: {{ number_format($match->stadium->capacity) }} spectators</p>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700">{{ $match->stadium->description }}</p>
                </div>

                <a href="{{ route('member.stadiums.show', $match->stadium) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    View Stadium Details
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- City Information -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-6">
                <h3 class="text-lg font-bold mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    Host City
                </h3>

                <div class="flex items-center mb-6">
                    <div class="w-20 h-20 bg-gray-100 rounded-lg mr-4 flex-shrink-0 overflow-hidden">
                        @if($match->stadium->city->image)
                            <img src="{{ asset($match->stadium->city->image) }}" alt="{{ $match->stadium->city->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-green-50 text-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-xl font-bold">{{ $match->stadium->city->name }}</h4>
                        <p class="text-gray-600 mb-1">Morocco</p>
                        <p class="text-gray-500 text-sm">Population: {{ number_format($match->stadium->city->population ?? 0) }}</p>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700">{{ Str::limit($match->stadium->city->description ?? 'No description available', 150) }}</p>
                </div>

                <a href="{{ route('member.cities.show', $match->stadium->city) }}" class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                    Explore {{ $match->stadium->city->name }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Nearby Accommodations -->
    @if(isset($nearbyAccommodations) && $nearbyAccommodations->count() > 0)
    <div class="mb-8">
        <h3 class="text-xl font-bold mb-6 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
            </svg>
            Nearby Accommodations
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($nearbyAccommodations->take(3) as $accommodation)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all">
                <div class="h-40 bg-gray-200 overflow-hidden">
                    @if($accommodation->image)
                        <img src="{{ asset($accommodation->image) }}" alt="{{ $accommodation->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="p-4">
                    <div class="flex items-center justify-between mb-1">
                        <h4 class="font-bold">{{ $accommodation->name }}</h4>
                        <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">{{ $accommodation->type }}</span>
                    </div>
                    <p class="text-gray-500 text-sm mb-3">{{ $accommodation->address }}</p>
                    <div class="flex items-center text-sm text-gray-700 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.799-2.034c-.784-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span>{{ number_format($accommodation->rating ?? 0, 1) }}/5.0</span>
                        <span class="mx-2">•</span>
                        <span>{{ number_format($accommodation->price ?? 0) }} MAD/night</span>
                    </div>
                    <a href="#" class="text-purple-600 hover:text-purple-800 font-medium text-sm">View Details</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-6 text-center">
            <a href="{{ route('member.travel.accommodations') }}" class="inline-block px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                View All Accommodations
            </a>
        </div>
    </div>
    @endif

    <!-- Team Information -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Team 1 Information -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-6">
                <h3 class="text-lg font-bold mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    {{ $match->team1->name }} - Team Information
                </h3>

                <div class="flex items-center mb-6">
                    <div class="w-20 h-20 bg-gray-100 rounded-full mr-4 flex-shrink-0 overflow-hidden">
                        @if($match->team1->flag)
                            <img src="{{ asset($match->team1->flag) }}" alt="{{ $match->team1->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-3xl font-bold text-gray-400">{{ substr($match->team1->code, 0, 3) }}</div>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-xl font-bold">{{ $match->team1->name }}</h4>
                        <p class="text-gray-600 mb-1">{{ $match->team1->code }}</p>
                        <div class="flex items-center">
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full mr-2">Group {{ $match->team1->group ?: 'N/A' }}</span>
                            @if($match->team1->is_qualified)
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Qualified</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700">{{ $match->team1->description ?? 'No team description available.' }}</p>
                </div>
            </div>
        </div>

        <!-- Team 2 Information -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="p-6">
                <h3 class="text-lg font-bold mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    {{ $match->team2->name }} - Team Information
                </h3>

                <div class="flex items-center mb-6">
                    <div class="w-20 h-20 bg-gray-100 rounded-full mr-4 flex-shrink-0 overflow-hidden">
                        @if($match->team2->flag)
                            <img src="{{ asset($match->team2->flag) }}" alt="{{ $match->team2->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-3xl font-bold text-gray-400">{{ substr($match->team2->code, 0, 3) }}</div>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-xl font-bold">{{ $match->team2->name }}</h4>
                        <p class="text-gray-600 mb-1">{{ $match->team2->code }}</p>
                        <div class="flex items-center">
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full mr-2">Group {{ $match->team2->group ?: 'N/A' }}</span>
                            @if($match->team2->is_qualified)
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Qualified</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-gray-700">{{ $match->team2->description ?? 'No team description available.' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleMatchFavorite() {
        const matchId = {{ $match->id }};
        const url = '{{ url("member/matches") }}/' + matchId + '/toggle-favorite';
        const favoriteButton = document.getElementById('favorite-toggle');
        const favoriteLabel = document.getElementById('favorite-label');
        const starIcon = favoriteButton.querySelector('svg');

        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'added') {
                // Match was added to favorites
                favoriteButton.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                favoriteButton.classList.add('bg-amber-500', 'text-white');
                starIcon.setAttribute('fill', 'currentColor');
                favoriteLabel.textContent = 'Remove from Favorites';

                // Show toast notification
                showNotification('Match added to favorites', 'success');
            } else {
                // Match was removed from favorites
                favoriteButton.classList.remove('bg-amber-500', 'text-white');
                favoriteButton.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                starIcon.setAttribute('fill', 'none');
                favoriteLabel.textContent = 'Add to Favorites';

                // Show toast notification
                showNotification('Match removed from favorites', 'info');
            }
        })
        .catch(error => {
            console.error('Error toggling favorite:', error);
            showNotification('Error updating favorites: ' + error.message, 'error');
        });
    }

    function showNotification(message, type = 'success') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed bottom-4 right-4 z-50 px-4 py-2 rounded-lg shadow-lg flex items-center ${
            type === 'success' ? 'bg-green-500 text-white' :
            type === 'error' ? 'bg-red-500 text-white' :
            'bg-blue-500 text-white'
        }`;

        // Add icon based on type
        let iconSvg = '';
        if (type === 'success') {
            iconSvg = '<svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
        } else if (type === 'error') {
            iconSvg = '<svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';
        } else {
            iconSvg = '<svg class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
        }

        notification.innerHTML = iconSvg + message;

        // Add to DOM
        document.body.appendChild(notification);

        // Add entrance animation
        notification.style.transition = 'all 0.5s ease-in-out';
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
            }, 500);
        }, 3000);
    }
</script>
@endsection
