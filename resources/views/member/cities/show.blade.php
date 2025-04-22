@extends('layouts.member')

@section('title', $city->name)

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <div>
            <a href="{{ route('member.cities.index') }}" class="text-primary font-medium flex items-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to Cities
            </a>
            <h1 class="text-3xl font-bold text-gray-800">{{ $city->name }}</h1>
        </div>
        <button
            class="bg-white rounded-full p-2.5 shadow-md border border-gray-100 favorite-btn"
            data-city-id="{{ $city->id }}"
            data-is-favorite="{{ $isFavorite ? 'true' : 'false' }}"
            onclick="toggleFavorite({{ $city->id }})"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $isFavorite ? 'text-red-500' : 'text-gray-400' }}" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
            </svg>
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- City Image -->
        <div class="md:col-span-2">
            <div class="rounded-lg overflow-hidden shadow-md h-96">
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
            </div>
        </div>

        <!-- City Info -->
        <div class="bg-white rounded-lg shadow-md p-5 flex flex-col justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-3">City Information</h2>
                <div class="mb-3">
                    <p class="text-sm font-semibold text-gray-600 mb-1">Location</p>
                    <p class="text-gray-800">{{ $city->location }}</p>
                </div>
                <div class="mb-3">
                    <p class="text-sm font-semibold text-gray-600 mb-1">Population</p>
                    <p class="text-gray-800">{{ number_format($city->population) }}</p>
                </div>
                <div class="mb-3">
                    <p class="text-sm font-semibold text-gray-600 mb-1">Climate</p>
                    <p class="text-gray-800">{{ $city->climate }}</p>
                </div>
                <div class="mb-3">
                    <p class="text-sm font-semibold text-gray-600 mb-1">Stadiums</p>
                    <p class="text-gray-800">{{ $city->stadiums->count() }} stadium(s)</p>
                </div>
            </div>

            <!-- Member-only weather info -->
            <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-100">
                <h3 class="text-sm font-semibold text-blue-800 mb-2">Member Exclusive</h3>
                <p class="text-blue-700 text-sm">Weather forecast and match day planning information available for members.</p>
            </div>
        </div>
    </div>

    <!-- City Description -->
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">About {{ $city->name }}</h2>
        <div class="prose max-w-none">
            {{ $city->description }}
        </div>
    </div>

    <!-- Stadiums in this City -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Stadiums in {{ $city->name }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($city->stadiums as $stadium)
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:scale-[1.01]">
                <div class="h-40 overflow-hidden">
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
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $stadium->name }}</h3>
                    <p class="text-gray-600 mb-3 text-sm">Capacity: {{ number_format($stadium->capacity) }}</p>
                    <a href="{{ route('member.stadiums.show', $stadium) }}" class="text-primary font-medium hover:text-primary/80 transition-colors">
                        View Stadium Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Accommodations Section - Member Exclusive -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Member Exclusive - Accommodation Options</h2>

        @if($city->accommodations && $city->accommodations->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($city->accommodations as $accommodation)
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $accommodation->name }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $accommodation->type }}</p>
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm font-medium text-gray-800">
                            From ${{ number_format($accommodation->price_per_night) }}/night
                        </span>
                        <span class="text-sm text-gray-600">Rating: {{ $accommodation->rating }}/5</span>
                    </div>
                    <p class="text-gray-700 text-sm mb-3">{{ Str::limit($accommodation->description, 100) }}</p>
                    <a href="#" class="text-primary font-medium hover:text-primary/80 transition-colors text-sm">
                        View Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="bg-gray-50 rounded-lg p-6 text-center">
            <p class="text-gray-600">No accommodation information available for this city yet.</p>
        </div>
        @endif
    </div>

    <!-- Member Notes Section -->
    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">My Notes About This City</h2>
        <form id="notes-form" class="space-y-4">
            <div>
                <textarea
                    id="city-notes"
                    class="w-full h-32 border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-primary/50 focus:border-primary"
                    placeholder="Add your personal notes about this city, travel plans, etc..."
                ></textarea>
            </div>
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="bg-primary hover:bg-primary/90 text-white font-medium py-2 px-4 rounded-md transition-colors"
                >
                    Save Notes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleFavorite(cityId) {
        const button = document.querySelector(`.favorite-btn[data-city-id="${cityId}"]`);
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

    // Handle notes form submission
    document.getElementById('notes-form').addEventListener('submit', function(e) {
        e.preventDefault();
        // This would typically make an AJAX call to save the notes
        // For now, we'll just show a success message
        alert('Note saving functionality will be implemented in a future update!');
    });
</script>
@endpush
