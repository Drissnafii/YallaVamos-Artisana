@extends('layouts.admin')

@section('title', $city->name)

@section('header', 'City Details')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex justify-between">
        <a href="{{ route('admin.cities.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Cities
        </a>
        <div class="flex space-x-2">
            <a href="{{ route('admin.cities.edit', $city) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit
            </a>
            <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md shadow transition duration-150 ease-in-out" onclick="return confirm('Are you sure you want to delete this city?')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden" style="background: linear-gradient(to bottom, white, #f0f7ff);">
        <div class="md:flex">
            <!-- City Image -->
            <div class="md:w-1/3 bg-blue-50">
                @if($city->image)
                    <img src="{{ asset('storage/' . $city->image) }}" alt="{{ $city->name }}" class="w-full h-full object-cover">
                @else
                    <div class="h-full flex items-center justify-center p-8 bg-blue-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                @endif
            </div>

            <!-- City Information -->
            <div class="md:w-2/3 p-6">
                <h1 class="text-2xl font-bold text-gray-800">{{ $city->name }}</h1>

                <div class="mt-4 prose max-w-none text-gray-700">
                    {{ $city->description ?? 'No description available.' }}
                </div>

                @if($city->latitude && $city->longitude)
                <div class="mt-6">
                    <h2 class="text-sm font-medium text-gray-500">Location</h2>
                    <div class="mt-2 flex space-x-4">
                        <div>
                            <span class="text-gray-600">Latitude:</span>
                            <span class="ml-1 text-gray-900">{{ $city->latitude }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Longitude:</span>
                            <span class="ml-1 text-gray-900">{{ $city->longitude }}</span>
                        </div>
                    </div>
                    <!-- Map placeholder - You could integrate with a maps API here -->
                    <div class="mt-3 h-48 bg-gray-100 rounded-md flex items-center justify-center">
                        <span class="text-gray-500 text-sm">Map view would be shown here</span>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Stadiums in this City -->
        <div class="border-t border-gray-200 px-6 py-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Stadiums in {{ $city->name }}</h2>

            @if($city->stadiums->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($city->stadiums as $stadium)
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition duration-150">
                        @if($stadium->image)
                            <img src="{{ asset('storage/' . $stadium->image) }}" alt="{{ $stadium->name }}" class="w-full h-32 object-cover">
                        @else
                            <div class="w-full h-32 bg-green-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ $stadium->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">Capacity: {{ number_format($stadium->capacity) }}</p>
                            <div class="mt-3 flex justify-between items-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $stadium->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($stadium->status) }}
                                </span>
                                <a href="{{ route('admin.stadiums.show', $stadium) }}" class="text-blue-600 hover:text-blue-900 text-sm">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.stadiums.create') }}" class="inline-flex items-center text-sm text-green-600 hover:text-green-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add a new stadium in {{ $city->name }}
                    </a>
                </div>
            @else
                <div class="bg-gray-50 rounded-md p-4 text-center text-gray-500">
                    No stadiums in this city yet.
                    <a href="{{ route('admin.stadiums.create') }}" class="text-blue-600 hover:text-blue-800 ml-1">Add a stadium</a>
                </div>
            @endif
        </div>

        <!-- Accommodations in this City -->
        <div class="border-t border-gray-200 px-6 py-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Accommodations in {{ $city->name }}</h2>

            @if($city->accommodations->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($city->accommodations as $accommodation)
                    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden hover:shadow-md transition duration-150">
                        @if(isset($accommodation->image))
                            <img src="{{ asset('storage/' . $accommodation->image) }}" alt="{{ $accommodation->name }}" class="w-full h-32 object-cover">
                        @else
                            <div class="w-full h-32 bg-blue-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ $accommodation->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ isset($accommodation->type) ? ucfirst($accommodation->type) : 'Accommodation' }}
                            </p>
                            <div class="mt-3 text-right">
                                <a href="{{ route('admin.accommodations.show', $accommodation) }}" class="text-blue-600 hover:text-blue-900 text-sm">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    <a href="{{ route('admin.accommodations.create') }}" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Add a new accommodation in {{ $city->name }}
                    </a>
                </div>
            @else
                <div class="bg-gray-50 rounded-md p-4 text-center text-gray-500">
                    No accommodations in this city yet.
                    <a href="{{ route('admin.accommodations.create') }}" class="text-blue-600 hover:text-blue-800 ml-1">Add an accommodation</a>
                </div>
            @endif
        </div>

        <!-- City Stats -->
        <div class="border-t border-gray-200 px-6 py-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">City Statistics</h2>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Stadiums</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $city->stadiums->count() }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Accommodations</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $city->accommodations->count() }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Total Capacity</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($city->stadiums->sum('capacity')) }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Favorites</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $city->favoriteCities->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
