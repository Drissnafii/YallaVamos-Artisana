@extends('layouts.admin')

@section('title', 'Accommodations')

@section('header', 'Accommodations Management')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Page Header with Title and Action Button -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h1 class="text-2xl font-bold text-gray-900 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-2 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            Accommodations Management
        </h1>
        <a href="{{ route('admin.accommodations.create') }}" class="ml-auto flex items-center px-4 py-2 bg-amber-600 text-white rounded-md hover:bg-amber-700 transition-colors duration-200 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Accommodation
        </a>
    </div>

    <!-- Search and Filters Panel -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-amber-100 mb-6">
        <div class="bg-amber-50 px-6 py-4 border-b border-amber-100 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-800">Search & Filters</h3>
        </div>

        <div class="p-6 space-y-6">
            <!-- Search Bar -->
            <div class="mb-4">
                <form action="{{ route('admin.accommodations.index') }}" method="GET" class="flex flex-col md:flex-row gap-2">
                    <div class="flex-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, address, or city..." class="focus:ring-amber-500 focus:border-amber-500 block w-full pl-10 pr-12 py-2 border border-gray-300 rounded-md">
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-amber-600 text-white rounded-md hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Search
                    </button>
                </form>
            </div>

            <!-- Advanced Filters -->
            <div class="border-t border-gray-200 pt-4">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-sm font-medium text-gray-700">Advanced Filters</h4>
                    <button type="button" id="toggleFilters" class="text-amber-600 hover:text-amber-800 text-sm font-medium flex items-center">
                        <span id="filterText">Show Filters</span>
                        <svg id="filterIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>

                <div id="filterOptions" class="hidden">
                    <form action="{{ route('admin.accommodations.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <input type="hidden" name="search" value="{{ request('search') }}">

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Accommodation Type</label>
                            <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                <option value="">All Types</option>
                                <option value="hotel" {{ request('type') == 'hotel' ? 'selected' : '' }}>Hotel</option>
                                <option value="apartment" {{ request('type') == 'apartment' ? 'selected' : '' }}>Apartment</option>
                                <option value="riad" {{ request('type') == 'riad' ? 'selected' : '' }}>Riad</option>
                                <option value="guesthouse" {{ request('type') == 'guesthouse' ? 'selected' : '' }}>Guesthouse</option>
                                <option value="other" {{ request('type') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div>
                            <label for="price_range" class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                            <select name="price_range" id="price_range" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                <option value="">All Price Ranges</option>
                                <option value="budget" {{ request('price_range') == 'budget' ? 'selected' : '' }}>Budget</option>
                                <option value="mid-range" {{ request('price_range') == 'mid-range' ? 'selected' : '' }}>Mid-Range</option>
                                <option value="luxury" {{ request('price_range') == 'luxury' ? 'selected' : '' }}>Luxury</option>
                            </select>
                        </div>

                        <div>
                            <label for="city_id" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                            <select name="city_id" id="city_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                <option value="">All Cities</option>
                                @foreach($cities ?? [] as $city)
                                @if(is_object($city))
                                    <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-3 flex justify-end">
                            <a href="{{ route('admin.accommodations.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Reset
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                Apply Filters
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Accommodations Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Total Accommodations -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-amber-100">
            <div class="flex items-center p-4">
                <div class="bg-amber-100 rounded-full p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Total Accommodations</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $accommodationsCount ?? $accommodations->total() }}</p>
                </div>
            </div>
        </div>

        <!-- Accommodation Types -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-amber-100">
            <div class="flex items-center p-4">
                <div class="bg-amber-100 rounded-full p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Accommodation Types</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $typeCount ?? 5 }}</p>
                </div>
            </div>
        </div>

        <!-- Cities with Accommodations -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden border border-amber-100">
            <div class="flex items-center p-4">
                <div class="bg-amber-100 rounded-full p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Cities with Accommodations</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $citiesCount ?? $cities->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Accommodations List -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-amber-100">
        <div class="bg-amber-50 px-6 py-4 border-b border-amber-100 flex justify-between items-center">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="text-lg font-medium text-gray-800">All Accommodations</h3>
            </div>
            <div class="text-sm text-gray-600">
                {{ $accommodations->firstItem() ?? 0 }}-{{ $accommodations->lastItem() ?? 0 }} of {{ $accommodations->total() ?? 0 }} results
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-amber-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Details
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            City
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Price Range
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($accommodations as $accommodation)
                    <tr class="hover:bg-amber-50 transition-colors duration-150">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($accommodation->image)
                                    <img src="{{ asset('storage/' . $accommodation->image) }}" alt="{{ $accommodation->name }}" class="h-14 w-20 rounded object-cover mr-4 border border-gray-200">
                                @else
                                    <div class="h-14 w-20 rounded bg-amber-100 flex items-center justify-center mr-4 border border-amber-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-7-7v14" />
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $accommodation->name }}</div>
                                    <div class="text-sm text-gray-500 mt-1 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $accommodation->address }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                {{ ucfirst($accommodation->type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $accommodation->city->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $accommodation->price_range === 'luxury' ? 'bg-purple-100 text-purple-800' :
                                       ($accommodation->price_range === 'mid-range' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800') }}">
                                    {{ ucfirst($accommodation->price_range) }}
                                </span>
                                <div class="mt-1 text-xs text-gray-500">
                                    ${{ number_format($accommodation->price_min, 2) }} - ${{ number_format($accommodation->price_max, 2) }}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.accommodations.show', $accommodation) }}" class="text-gray-600 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 p-2 rounded-md transition-colors duration-150" title="View Details">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <a href="{{ route('admin.accommodations.edit', $accommodation) }}" class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 p-2 rounded-md transition-colors duration-150" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.accommodations.destroy', $accommodation) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this accommodation?')" class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 p-2 rounded-md transition-colors duration-150" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-amber-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-gray-500 text-lg mb-2">No accommodations found</p>
                                <p class="text-gray-400 mb-4">Try adjusting your search or filter criteria</p>
                                <a href="{{ route('admin.accommodations.create') }}" class="text-amber-600 hover:text-amber-800 bg-amber-100 hover:bg-amber-200 px-4 py-2 rounded-md transition-colors duration-150 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Create New Accommodation
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $accommodations->links() }}
        </div>
    </div>
</div>

<!-- JavaScript for Toggle Filters -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleFilters = document.getElementById('toggleFilters');
        const filterOptions = document.getElementById('filterOptions');
        const filterText = document.getElementById('filterText');
        const filterIcon = document.getElementById('filterIcon');

        toggleFilters.addEventListener('click', function() {
            filterOptions.classList.toggle('hidden');

            if (filterOptions.classList.contains('hidden')) {
                filterText.textContent = 'Show Filters';
                filterIcon.classList.remove('rotate-180');
            } else {
                filterText.textContent = 'Hide Filters';
                filterIcon.classList.add('rotate-180');
            }
        });

        // If there are active filters, show the filter section automatically
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('type') || urlParams.has('price_range') || urlParams.has('city_id')) {
            filterOptions.classList.remove('hidden');
            filterText.textContent = 'Hide Filters';
            filterIcon.classList.add('rotate-180');
        }
    });
</script>
@endsection
