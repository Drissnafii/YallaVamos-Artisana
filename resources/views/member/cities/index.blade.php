@extends('layouts.member')

@section('title', 'Host Cities')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-2">Host Cities</h1>
    <p class="text-gray-600">Explore the vibrant host cities of the Morocco 2030 World Cup with enhanced member features.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    @foreach($cities as $city)
    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:scale-[1.01]">
        <div class="relative h-48 overflow-hidden">
            @if($city->image)
            <img
                src="{{ asset('storage/' . $city->image) }}"
                alt="{{ $city->name }} City"
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
                data-city-id="{{ $city->id }}"
                data-is-favorite="{{ in_array($city->id, $favoriteCities) ? 'true' : 'false' }}"
                onclick="toggleFavorite({{ $city->id }})"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ in_array($city->id, $favoriteCities) ? 'text-red-500' : 'text-gray-400' }}" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div class="p-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $city->name }}</h2>
            <p class="text-gray-600 mb-3 line-clamp-2">{{ $city->description }}</p>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    {{ $city->location }}
                </span>
                <a href="{{ route('member.cities.show', $city) }}" class="text-primary font-medium hover:text-primary/80 transition-colors">
                    View Details
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

@push('scripts')
<script>
    function toggleFavorite(cityId) {
        const button = document.querySelector(`.favorite-btn[data-city-id="${cityId}"]`);
        const isFavorite = button.getAttribute('data-is-favorite') === 'true';
        const icon = button.querySelector('svg');

        fetch(`/member/cities/${cityId}/toggle-favorite`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ city_id: cityId })
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
