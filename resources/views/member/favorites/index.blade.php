@extends('layouts.member')

@section('title', 'My Favorites')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-2">My Favorites</h1>
    <p class="text-gray-600">Manage all your favorite content from Morocco 2030 World Cup in one place.</p>
</div>

<!-- Navigation Tabs -->
<div class="mb-8">
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <a href="{{ route('member.favorites.index') }}" class="border-primary text-primary hover:text-primary hover:border-primary px-1 py-4 text-sm font-medium border-b-2">
                All Favorites
            </a>
            <a href="{{ route('member.favorites.matches') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium border-b-2">
                Matches
            </a>
            <a href="{{ route('member.favorites.cities') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium border-b-2">
                Cities
            </a>
            <a href="{{ route('member.favorites.stadiums') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium border-b-2">
                Stadiums
            </a>
        </nav>
    </div>
</div>

<!-- Favorite Matches Section -->
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Favorite Matches</h2>
        <a href="{{ route('member.favorites.matches') }}" class="text-primary hover:text-primary/80 transition-colors text-sm font-medium">
            View All Matches
        </a>
    </div>

    @if(isset($favoriteMatches) && $favoriteMatches->count() > 0)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="divide-y divide-gray-200">
            @foreach($favoriteMatches->take(3) as $favoriteMatch)
            @php $match = $favoriteMatch->match; @endphp
            <div class="p-4 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between">
                    <div class="flex flex-col md:flex-row items-center md:space-x-6 w-full">
                        <!-- Match Date -->
                        <div class="text-center mb-3 md:mb-0 md:w-24">
                            <div class="text-sm font-medium text-gray-500">{{ \Carbon\Carbon::parse($match->match_date)->format('M d') }}</div>
                            <div class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($match->match_time)->format('H:i') }}</div>
                        </div>

                        <!-- Teams -->
                        <div class="flex flex-1 items-center justify-center space-x-3">
                            <!-- Home Team -->
                            <div class="flex flex-col items-center w-24">
                                <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden mb-1">
                                    @if($match->homeTeam && $match->homeTeam->logo_path)
                                    <img src="{{ asset('storage/' . $match->homeTeam->logo_path) }}" alt="{{ $match->homeTeam->name }} logo" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <span class="text-xs font-medium text-gray-800 text-center">{{ $match->homeTeam ? $match->homeTeam->name : 'TBD' }}</span>
                            </div>

                            <!-- Score -->
                            <div class="flex items-center justify-center">
                                <span class="text-sm font-semibold text-gray-800">
                                    {{ $match->home_score !== null ? $match->home_score : '-' }}
                                    <span class="mx-1 text-gray-400">:</span>
                                    {{ $match->away_score !== null ? $match->away_score : '-' }}
                                </span>
                            </div>

                            <!-- Away Team -->
                            <div class="flex flex-col items-center w-24">
                                <div class="w-8 h-8 bg-gray-200 rounded-full overflow-hidden mb-1">
                                    @if($match->awayTeam && $match->awayTeam->logo_path)
                                    <img src="{{ asset('storage/' . $match->awayTeam->logo_path) }}" alt="{{ $match->awayTeam->name }} logo" class="w-full h-full object-cover">
                                    @endif
                                </div>
                                <span class="text-xs font-medium text-gray-800 text-center">{{ $match->awayTeam ? $match->awayTeam->name : 'TBD' }}</span>
                            </div>
                        </div>

                        <!-- Stadium and City -->
                        <div class="md:w-48 text-center md:text-right">
                            <p class="text-xs font-medium text-gray-800">{{ $match->stadium ? $match->stadium->name : 'TBD' }}</p>
                            <p class="text-xs text-gray-500">{{ $match->stadium && $match->stadium->city ? $match->stadium->city->name : '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <a href="{{ route('member.matches.show', $match) }}" class="text-primary hover:text-primary/80">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <button
                            class="text-gray-400 hover:text-red-500"
                            onclick="removeFavorite('match', {{ $match->id }})"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="bg-gray-50 rounded-lg p-6 text-center border border-gray-200">
        <p class="text-gray-600 mb-2">You haven't added any matches to your favorites yet.</p>
        <a href="{{ route('member.matches.index') }}" class="text-primary hover:text-primary/80 transition-colors font-medium">
            Browse Match Schedule
        </a>
    </div>
    @endif
</div>

<!-- Favorite Cities Section -->
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Favorite Cities</h2>
        <a href="{{ route('member.favorites.cities') }}" class="text-primary hover:text-primary/80 transition-colors text-sm font-medium">
            View All Cities
        </a>
    </div>

    @if(isset($favoriteCities) && $favoriteCities->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach($favoriteCities->take(4) as $favoriteCity)
        @php $city = $favoriteCity->city; @endphp
        <div class="bg-white rounded-lg shadow-md overflow-hidden relative">
            <div class="h-32 bg-gray-200">
                @if($city->image_path)
                <img src="{{ asset('storage/' . $city->image_path) }}" alt="{{ $city->name }}" class="w-full h-full object-cover">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            </div>
            <div class="absolute bottom-0 left-0 right-0 p-3 text-white">
                <h3 class="font-semibold">{{ $city->name }}</h3>
                <div class="flex justify-between items-center mt-1">
                    <span class="text-xs opacity-90">{{ $city->stadiums->count() }} stadium(s)</span>
                    <div class="flex space-x-2">
                        <a href="{{ route('member.cities.show', $city) }}" class="text-white hover:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <button
                            class="text-white hover:text-red-500"
                            onclick="removeFavorite('city', {{ $city->id }})"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-gray-50 rounded-lg p-6 text-center border border-gray-200">
        <p class="text-gray-600 mb-2">You haven't added any cities to your favorites yet.</p>
        <a href="{{ route('member.cities.index') }}" class="text-primary hover:text-primary/80 transition-colors font-medium">
            Browse Host Cities
        </a>
    </div>
    @endif
</div>

<!-- Favorite Stadiums Section -->
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Favorite Stadiums</h2>
        <a href="{{ route('member.favorites.stadiums') }}" class="text-primary hover:text-primary/80 transition-colors text-sm font-medium">
            View All Stadiums
        </a>
    </div>

    @if(isset($favoriteStadiums) && $favoriteStadiums->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($favoriteStadiums->take(3) as $favoriteStadium)
        @php $stadium = $favoriteStadium->stadium; @endphp
        <div class="bg-white rounded-lg shadow-md overflow-hidden flex">
            <div class="w-1/3 bg-gray-200">
                @if($stadium->image_path)
                <img src="{{ asset('storage/' . $stadium->image_path) }}" alt="{{ $stadium->name }}" class="w-full h-full object-cover">
                @endif
            </div>
            <div class="w-2/3 p-4">
                <h3 class="font-semibold text-gray-800">{{ $stadium->name }}</h3>
                <p class="text-xs text-gray-500 mb-2">{{ $stadium->city ? $stadium->city->name : '-' }}</p>
                <p class="text-xs text-gray-600">Capacity: {{ number_format($stadium->capacity) }}</p>
                <div class="flex justify-end space-x-2 mt-3">
                    <a href="{{ route('member.stadiums.show', $stadium) }}" class="text-primary hover:text-primary/80">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <button
                        class="text-gray-400 hover:text-red-500"
                        onclick="removeFavorite('stadium', {{ $stadium->id }})"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="bg-gray-50 rounded-lg p-6 text-center border border-gray-200">
        <p class="text-gray-600 mb-2">You haven't added any stadiums to your favorites yet.</p>
        <a href="{{ route('member.stadiums.index') }}" class="text-primary hover:text-primary/80 transition-colors font-medium">
            Browse Stadiums
        </a>
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
    function removeFavorite(type, id) {
        let url = '';

        switch(type) {
            case 'match':
                url = `/member/matches/${id}/toggle-favorite`;
                break;
            case 'city':
                url = `/member/cities/${id}/toggle-favorite`;
                break;
            case 'stadium':
                url = `/member/stadiums/${id}/toggle-favorite`;
                break;
        }

        if (url) {
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ [type + '_id']: id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'removed') {
                    // Reload the page to reflect the changes
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    }
</script>
@endpush
