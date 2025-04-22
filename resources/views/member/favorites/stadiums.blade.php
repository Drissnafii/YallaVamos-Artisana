@extends('layouts.member')

@section('title', 'Favorite Stadiums')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Navigation Tabs -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="flex space-x-6" aria-label="Tabs">
            <a href="{{ route('member.favorites.index') }}" class="py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap">
                All Favorites
            </a>
            <a href="{{ route('member.favorites.matches') }}" class="py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap">
                Matches
            </a>
            <a href="{{ route('member.favorites.cities') }}" class="py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap">
                Cities
            </a>
            <a href="{{ route('member.favorites.stadiums') }}" class="py-4 px-1 text-center border-b-2 border-amber-500 font-medium text-sm text-amber-600 whitespace-nowrap">
                Stadiums
            </a>
        </nav>
    </div>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Favorite Stadiums</h1>
        <p class="text-gray-600">Your collection of favorite stadiums for the World Cup 2030</p>
    </div>

    @if(isset($favoriteStadiums) && $favoriteStadiums->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($favoriteStadiums as $stadium)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 overflow-hidden relative">
                    <div class="absolute top-0 right-0 p-2 z-10">
                        <button onclick="removeFavorite('stadium', {{ $stadium->id }})" class="p-1.5 bg-white rounded-full shadow-md hover:bg-red-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <!-- Stadium Image -->
                    <div class="h-48 overflow-hidden">
                        @if($stadium->image)
                            <img src="{{ asset($stadium->image) }}" alt="{{ $stadium->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="p-5">
                        <h3 class="font-bold text-xl text-gray-800 mb-1">{{ $stadium->name }}</h3>
                        <p class="text-sm text-gray-500 mb-3">{{ $stadium->city->name }}, Morocco</p>

                        <div class="mb-4">
                            <div class="flex items-center mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="text-gray-700">Capacity: {{ number_format($stadium->capacity) }}</span>
                            </div>

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                @if(isset($stadium->upcomingMatches) && $stadium->upcomingMatches->count() > 0)
                                    <span class="text-gray-700">{{ $stadium->upcomingMatches->count() }} upcoming matches</span>
                                @else
                                    <span class="text-gray-700">No upcoming matches</span>
                                @endif
                            </div>
                        </div>

                        @if($stadium->description)
                        <div class="mb-4">
                            <p class="text-gray-600 text-sm line-clamp-3">{{ Str::limit($stadium->description, 120) }}</p>
                        </div>
                        @endif

                        <div class="flex space-x-2">
                            <a href="{{ route('member.stadiums.show', $stadium) }}" class="flex-1 py-2 text-center bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg transition-colors">
                                View Details
                            </a>

                            @if(isset($stadium->matches) && $stadium->matches->count() > 0)
                            <a href="{{ route('member.matches.index', ['stadium' => $stadium->id]) }}" class="px-3 py-2 text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination if available -->
        @if($favoriteStadiums instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-6">
                {{ $favoriteStadiums->links() }}
            </div>
        @endif
    @else
        <div class="bg-gray-50 rounded-xl p-8 text-center border border-gray-200">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                <h2 class="text-xl font-bold text-gray-800 mb-2">No Favorite Stadiums</h2>
                <p class="text-gray-600 mb-6">You haven't added any stadiums to your favorites yet.</p>
                <a href="{{ route('member.stadiums.index') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg transition-colors">
                    Browse Stadiums
                </a>
            </div>
        </div>
    @endif
</div>

<!-- JavaScript for handling favorite toggling -->
<script>
    function removeFavorite(type, id) {
        // For stadiums, we only need the stadium endpoint
        const endpoint = '{{ url("member/stadiums") }}/' + id + '/toggle-favorite';

        // Send the request to toggle the favorite (which will remove it)
        fetch(endpoint, {
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
            // Show a notification
            showNotification('Stadium removed from favorites', 'info');

            // Reload the page to reflect the changes
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        })
        .catch(error => {
            console.error('Error removing favorite:', error);
            showNotification('Error: ' + error.message, 'error');
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
