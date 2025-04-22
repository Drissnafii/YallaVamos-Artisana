@extends('layouts.member')

@section('title', 'Favorite Matches')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Navigation Tabs -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="flex space-x-6" aria-label="Tabs">
            <a href="{{ route('member.favorites.index') }}" class="py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap">
                All Favorites
            </a>
            <a href="{{ route('member.favorites.matches') }}" class="py-4 px-1 text-center border-b-2 border-amber-500 font-medium text-sm text-amber-600 whitespace-nowrap">
                Matches
            </a>
            <a href="{{ route('member.favorites.cities') }}" class="py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap">
                Cities
            </a>
            <a href="{{ route('member.favorites.stadiums') }}" class="py-4 px-1 text-center border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap">
                Stadiums
            </a>
        </nav>
    </div>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Favorite Matches</h1>
        <p class="text-gray-600">Your collection of favorite matches for the World Cup 2030</p>
    </div>

    @if(isset($favoriteMatches) && $favoriteMatches->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($favoriteMatches as $match)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 overflow-hidden relative">
                    <div class="absolute top-0 right-0 p-2">
                        <button onclick="removeFavorite('match', {{ $match->id }})" class="p-1.5 bg-white rounded-full shadow-md hover:bg-red-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <div class="p-5">
                        <!-- Match Date and Status -->
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm font-medium text-gray-500">{{ $match->date->format('d M Y') }} • {{ $match->time }}</span>
                            <span class="px-2 py-1 text-xs font-medium {{ $match->date->isPast() ? 'bg-gray-100 text-gray-800' : 'bg-blue-100 text-blue-800' }} rounded-full">
                                {{ $match->date->isPast() ? 'Completed' : 'Upcoming' }}
                            </span>
                        </div>

                        <!-- Teams -->
                        <div class="flex items-center justify-between mb-5">
                            <!-- Team 1 -->
                            <div class="flex flex-col items-center text-center w-1/3">
                                <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center mb-2">
                                    @if($match->team1->flag)
                                        <img src="{{ asset('storage/' . $match->team1->flag) }}" alt="{{ $match->team1->name }}" class="w-full h-full object-cover rounded-full">
                                    @else
                                        <span class="text-sm font-bold text-gray-500">{{ substr($match->team1->code, 0, 3) }}</span>
                                    @endif
                                </div>
                                <span class="text-sm font-medium text-gray-800">{{ $match->team1->name }}</span>
                            </div>

                            <!-- Score -->
                            <div class="flex items-center justify-center w-1/3">
                                @if($match->date->isPast() && isset($match->score_team1) && isset($match->score_team2))
                                    <span class="text-lg font-bold text-gray-800">{{ $match->score_team1 }}</span>
                                    <span class="mx-2 text-gray-400">-</span>
                                    <span class="text-lg font-bold text-gray-800">{{ $match->score_team2 }}</span>
                                @else
                                    <span class="text-lg font-medium text-gray-400">VS</span>
                                @endif
                            </div>

                            <!-- Team 2 -->
                            <div class="flex flex-col items-center text-center w-1/3">
                                <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center mb-2">
                                    @if($match->team2->flag)
                                        <img src="{{ asset('storage/' . $match->team2->flag) }}" alt="{{ $match->team2->name }}" class="w-full h-full object-cover rounded-full">
                                    @else
                                        <span class="text-sm font-bold text-gray-500">{{ substr($match->team2->code, 0, 3) }}</span>
                                    @endif
                                </div>
                                <span class="text-sm font-medium text-gray-800">{{ $match->team2->name }}</span>
                            </div>
                        </div>

                        <!-- Stadium Info -->
                        <div class="text-sm text-gray-600 mb-4 border-t border-gray-100 pt-3">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ $match->stadium->name }}, {{ $match->stadium->city->name }}</span>
                            </div>
                        </div>

                        <!-- View Details Link -->
                        <a href="{{ route('member.matches.show', $match) }}" class="block w-full py-2 text-center bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg transition-colors">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination if available -->
        @if($favoriteMatches instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-6">
                {{ $favoriteMatches->links() }}
            </div>
        @endif
    @else
        <div class="bg-gray-50 rounded-xl p-8 text-center border border-gray-200">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h2 class="text-xl font-bold text-gray-800 mb-2">No Favorite Matches</h2>
                <p class="text-gray-600 mb-6">You haven't added any matches to your favorites yet.</p>
                <a href="{{ route('member.matches.index') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg transition-colors">
                    Browse Match Schedule
                </a>
            </div>
        </div>
    @endif
</div>

<!-- JavaScript for handling favorite toggling -->
<script>
    function removeFavorite(type, id) {
        // For matches, we only need the match endpoint
        const endpoint = '{{ url("member/matches") }}/' + id + '/toggle-favorite';

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
            showNotification('Match removed from favorites', 'info');

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
