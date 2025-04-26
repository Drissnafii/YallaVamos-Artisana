@extends('layouts.member')

@section('title', $stadium->name)

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex justify-between">
        <a href="{{ route('member.stadiums.index') }}" class="inline-flex items-center text-primary font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Stadiums
        </a>
        <button
            class="rounded-full p-2.5 bg-white shadow-md border border-gray-100 favorite-btn"
            data-stadium-id="{{ $stadium->id }}"
            data-is-favorite="{{ $isFavorite ? 'true' : 'false' }}"
            onclick="toggleFavorite({{ $stadium->id }})"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $isFavorite ? 'text-red-500' : 'text-gray-400' }}" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="md:flex">
            <!-- Stadium Image -->
            <div class="md:w-1/3">
                @if($stadium->image)
                    <img src="{{ asset('storage/' . $stadium->image) }}" alt="{{ $stadium->name }}" class="w-full h-full object-cover">
                @else
                    <div class="h-64 md:h-full flex items-center justify-center p-8 bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                @endif
            </div>

            <!-- Stadium Information -->
            <div class="md:w-2/3 p-6">
                <div class="flex justify-between items-start">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $stadium->name }}</h1>
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                        {{ $stadium->status == 'active' ? 'bg-green-100 text-green-800' :
                           ($stadium->status == 'under_construction' ? 'bg-blue-100 text-blue-800' :
                           ($stadium->status == 'renovation' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800')) }}">
                        {{ ucfirst(str_replace('_', ' ', $stadium->status ?? 'Ready')) }}
                    </span>
                </div>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h2 class="text-sm font-medium text-gray-500">City</h2>
                        <p class="mt-1 text-md text-gray-900">{{ $stadium->city ? $stadium->city->name : 'N/A' }}</p>
                    </div>

                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Capacity</h2>
                        <p class="mt-1 text-md text-gray-900">{{ number_format($stadium->capacity) }} spectators</p>
                    </div>

                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Year Built</h2>
                        <p class="mt-1 text-md text-gray-900">{{ $stadium->year_built ?? 'Unknown' }}</p>
                    </div>

                    <div>
                        <h2 class="text-sm font-medium text-gray-500">Location</h2>
                        <p class="mt-1 text-md text-gray-900">{{ $stadium->location ?? $stadium->address ?? 'Not specified' }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h2 class="text-sm font-medium text-gray-500">Description</h2>
                    <div class="mt-1 prose max-w-none text-gray-900">
                        {{ $stadium->description ?? 'No description available.' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Matches in this Stadium -->
        <div class="border-t border-gray-200 px-6 py-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Upcoming Matches</h2>

            @if(isset($upcomingMatches) && $upcomingMatches->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($upcomingMatches as $match)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm text-gray-500">{{ $match->date->format('M d, Y') }} • {{ $match->date->format('H:i') }}</span>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ ucfirst($match->status ?? 'Scheduled') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-full overflow-hidden bg-gray-100">
                                    @if($match->team1 && $match->team1->flag)
                                    <img src="{{ asset('storage/' . $match->team1->flag) }}" class="w-full h-full object-cover" alt="{{ $match->team1->name }}">
                                    @endif
                                </div>
                                <span class="text-sm font-medium">{{ $match->team1 ? $match->team1->name : 'TBD' }}</span>
                            </div>

                            <div class="px-3 py-1 bg-gray-100 rounded text-center">
                                <span class="text-gray-800 font-semibold">VS</span>
                            </div>

                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-medium">{{ $match->team2 ? $match->team2->name : 'TBD' }}</span>
                                <div class="w-8 h-8 rounded-full overflow-hidden bg-gray-100">
                                    @if($match->team2 && $match->team2->flag)
                                    <img src="{{ asset('storage/' . $match->team2->flag) }}" class="w-full h-full object-cover" alt="{{ $match->team2->name }}">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 flex justify-end">
                            <a href="{{ route('member.matches.show', $match) }}" class="text-primary hover:text-primary/80 text-sm font-medium">
                                Match Details
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-gray-50 rounded-md p-4 text-center text-gray-500">
                    No upcoming matches scheduled for this stadium.
                </div>
            @endif
        </div>

        <!-- Member Exclusive Access -->
        <div class="border-t border-gray-200 px-6 py-6 bg-blue-50">
            <h2 class="text-lg font-medium text-blue-900 mb-2">Member Exclusive Access</h2>
            <p class="text-blue-700 mb-4">As a YallaDiscover member, you have access to these stadium features:</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-sm border border-blue-100">
                    <h3 class="font-medium text-gray-900 mb-2">Priority Entrance</h3>
                    <p class="text-sm text-gray-600">Show your membership to access priority entry lanes at all stadium gates</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm border border-blue-100">
                    <h3 class="font-medium text-gray-900 mb-2">Travel Planning</h3>
                    <p class="text-sm text-gray-600">View transportation options and suggested arrival timelines</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFavorite(stadiumId) {
        const button = document.querySelector(`.favorite-btn[data-stadium-id="${stadiumId}"]`);
        const icon = button.querySelector('svg');
        const isFavorite = button.getAttribute('data-is-favorite') === 'true';

        fetch(`/member/stadiums/${stadiumId}/toggle-favorite`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'added') {
                button.setAttribute('data-is-favorite', 'true');
                icon.classList.remove('text-gray-400');
                icon.classList.add('text-red-500');

                // Show toast notification
                showNotification('Stadium added to favorites', 'success');
            } else {
                button.setAttribute('data-is-favorite', 'false');
                icon.classList.remove('text-red-500');
                icon.classList.add('text-gray-400');

                // Show toast notification
                showNotification('Stadium removed from favorites', 'info');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error updating favorites', 'error');
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
