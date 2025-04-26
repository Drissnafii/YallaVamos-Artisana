@extends('layouts.member')

@section('title', 'Accommodations')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold text-gray-800 mb-2">Accommodations</h1>
    <p class="text-gray-600">Find and book accommodations for your Morocco 2030 World Cup experience.</p>
</div>

<!-- Navigation Tabs -->
<div class="mb-8">
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <a href="{{ route('member.travel.index') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium border-b-2">
                Overview
            </a>
            <a href="{{ route('member.travel.transportation') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium border-b-2">
                Transportation
            </a>
            <a href="{{ route('member.travel.accommodations') }}" class="border-primary text-primary hover:text-primary hover:border-primary px-1 py-4 text-sm font-medium border-b-2">
                Accommodations
            </a>
            <a href="{{ route('member.travel.tips') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-1 py-4 text-sm font-medium border-b-2">
                Travel Tips
            </a>
        </nav>
    </div>
</div>

<!-- Accommodation Content -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-5">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Find Accommodations</h2>
        <p class="text-gray-600 mb-4">Search for hotels, apartments, and other lodging options.</p>
        <!-- Add search/filter form here -->
    </div>

    <div class="bg-white rounded-lg shadow-md p-5">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">My Bookings</h2>
        <p class="text-gray-600 mb-4">View and manage your accommodation bookings.</p>
        <!-- Add bookings list here -->
    </div>
</div>

<!-- Featured Accommodations -->
<div class="mb-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold text-gray-800">Featured Accommodations</h2>
        <div class="flex space-x-2">
            <a href="#" class="text-primary hover:text-primary/80 transition-colors text-sm font-medium">
                Filter Options
            </a>
            <span class="text-gray-300">|</span>
            <a href="#" class="text-primary hover:text-primary/80 transition-colors text-sm font-medium">
                View Map
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @if($accommodations && $accommodations->count() > 0)
            @foreach($accommodations as $accommodation)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="h-48 bg-gray-200 relative">
                    @if($accommodation->image)
                    <img
                        src="{{ asset('storage/' . $accommodation->image) }}"
                        alt="{{ $accommodation->name }}"
                        class="w-full h-full object-cover"
                    >
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="text-gray-400">No image available</span>
                    </div>
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3">
                        <span class="text-white font-medium">{{ $accommodation->city->name ?? 'Unknown Location' }}</span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $accommodation->name }}</h3>
                    <p class="text-gray-500 text-sm mb-2">{{ $accommodation->type }}</p>

                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="h-4 w-4 {{ $i <= ($accommodation->rating ?? 3) ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>
                        <span class="text-gray-700 font-medium">${{ number_format($accommodation->price_min ?? 0) }}/night</span>
                    </div>

                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ $accommodation->distance_to_stadium ?? '' }} km to nearest stadium</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('member.travel.accommodation.show', $accommodation->id) }}" class="text-primary font-medium hover:text-primary/80 transition-colors text-sm">
                            View Details
                        </a>
                        <button class="px-3 py-1 bg-primary text-white text-sm rounded hover:bg-primary/90 transition-colors">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        @else
        <div class="col-span-3 p-6 text-center bg-gray-50 rounded-lg">
            <p class="text-gray-600">No accommodations available at this time.</p>
        </div>
        @endif
    </div>
</div>

<!-- Accommodation Types -->
<div class="mb-8">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Accommodation Types</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-lg shadow-md text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2 text-primary" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
            </svg>
            <h3 class="font-medium text-gray-800">Hotels</h3>
            <p class="text-sm text-gray-500 mt-1">Luxury and budget options</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2 text-primary" viewBox="0 0 20 20" fill="currentColor">
                <path d="M7 3a1 1 0 011-1h10a1 1 0 110 2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z" />
            </svg>
            <h3 class="font-medium text-gray-800">Apartments</h3>
            <p class="text-sm text-gray-500 mt-1">Self-catering options</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2 text-primary" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
            </svg>
            <h3 class="font-medium text-gray-800">Guest Houses</h3>
            <p class="text-sm text-gray-500 mt-1">Local authentic stays</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2 text-primary" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
            </svg>
            <h3 class="font-medium text-gray-800">Hostels</h3>
            <p class="text-sm text-gray-500 mt-1">Budget-friendly options</p>
        </div>
    </div>
</div>

<!-- Booking Tips -->
<div class="bg-blue-50 border border-blue-100 rounded-lg p-5">
    <h2 class="text-xl font-semibold text-blue-800 mb-3">Member Booking Tips</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Best Practices</h3>
            <ul class="space-y-2 text-gray-600">
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>Book accommodations near match venues or transportation hubs</span>
                </li>
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>Consider booking accommodations early to secure better rates</span>
                </li>
                <li class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span>Check for special World Cup accommodation packages</span>
                </li>
            </ul>
        </div>

        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Member Benefits</h3>
            <div class="p-4 bg-white rounded-lg">
                <p class="text-gray-600 mb-3">YallaDiscover members receive special rates and priority booking at select accommodations!</p>
                <a href="#" class="inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary/90 transition-colors">
                    Join Our Partner Program
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
