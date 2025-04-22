@extends('layouts.member')

@section('title', 'Stadiums')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-2">World Cup Stadiums</h1>
    <p class="text-gray-600">Explore the state-of-the-art stadiums hosting the Morocco 2030 World Cup matches with enhanced member features.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    @foreach($stadiums as $stadium)
    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:scale-[1.01]">
        <div class="relative h-48 overflow-hidden">
            @if($stadium->image)
            <img
                src="{{ asset('storage/' . $stadium->image) }}"
                alt="{{ $stadium->name }}"
                class="w-full h-full object-cover"
            >
            @else
            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                <span class="text-gray-400">No image available</span>
            </div>
            @endif

            <!-- Favorite Button -->
            <button
                class="absolute top-3 right-3 bg-white rounded-full p-2 shadow favorite-btn"
                data-stadium-id="{{ $stadium->id }}"
                data-is-favorite="{{ in_array($stadium->id, $favoriteStadiums) ? 'true' : 'false' }}"
                onclick="toggleFavorite({{ $stadium->id }})"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ in_array($stadium->id, $favoriteStadiums) ? 'text-red-500' : 'text-gray-400' }}" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div class="p-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-1">{{ $stadium->name }}</h2>
            <p class="text-gray-600 text-sm mb-3">{{ $stadium->city->name }}</p>
            <div class="flex justify-between items-center mb-3">
                <span class="text-sm text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Capacity: {{ number_format($stadium->capacity) }}
                </span>
                <span class="text-sm text-primary font-medium px-2 py-1 bg-primary/10 rounded-full">
                    {{ $stadium->status ?? 'Ready' }}
                </span>
            </div>
            <p class="text-gray-600 mb-4 line-clamp-2 text-sm">{{ $stadium->description }}</p>
            <a href="{{ route('member.stadiums.show', $stadium) }}" class="text-primary font-medium hover:text-primary/80 transition-colors">
                View Stadium Details
            </a>
        </div>
    </div>
    @endforeach
</div>

<!-- Member Exclusive Section -->
<div class="bg-blue-50 border border-blue-100 rounded-lg p-5 mb-8">
    <h2 class="text-xl font-semibold text-blue-800 mb-3">Member Exclusive Content</h2>
    <p class="text-blue-700 mb-4">As a member, you have access to exclusive stadium information, including:</p>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Interactive Stadium Tours</h3>
            <p class="text-gray-600 text-sm">Access virtual tours of all World Cup stadiums</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Seating Charts</h3>
            <p class="text-gray-600 text-sm">Detailed seating information with best views</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Stadium Facilities</h3>
            <p class="text-gray-600 text-sm">Information about amenities and accessibility</p>
        </div>
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
                icon.classList.add('text-red-500');
            } else {
                button.setAttribute('data-is-favorite', 'false');
                icon.classList.remove('text-red-500');
                icon.classList.add('text-gray-400');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>
@endpush
