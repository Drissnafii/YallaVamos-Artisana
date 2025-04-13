@extends('layouts.admin')

@section('title', $stadium->name)

@section('header', 'Stadium Details')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex justify-between">
        <a href="{{ route('admin.stadiums.index') }}" class="inline-flex items-center text-green-600 hover:text-green-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Stadiums
        </a>
        <div class="flex space-x-2">
            <a href="{{ route('admin.stadiums.edit', $stadium) }}" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md shadow transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit
            </a>
            <form action="{{ route('admin.stadiums.destroy', $stadium) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md shadow transition duration-150 ease-in-out" onclick="return confirm('Are you sure you want to delete this stadium?')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden" style="background: linear-gradient(to bottom, white, #f0fdf4);">
        <div class="md:flex">
            <!-- Stadium Image -->
            <div class="md:w-1/3 bg-green-50">
                @if($stadium->image)
                    <img src="{{ asset('storage/' . $stadium->image) }}" alt="{{ $stadium->name }}" class="w-full h-full object-cover">
                @else
                    <div class="h-full flex items-center justify-center p-8 bg-green-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                        {{ ucfirst(str_replace('_', ' ', $stadium->status)) }}
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
                        <h2 class="text-sm font-medium text-gray-500">Address</h2>
                        <p class="mt-1 text-md text-gray-900">{{ $stadium->address ?? 'Not specified' }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h2 class="text-sm font-medium text-gray-500">Description</h2>
                    <div class="mt-1 prose max-w-none text-gray-900">
                        {{ $stadium->description ?? 'No description available.' }}
                    </div>
                </div>

                @if($stadium->latitude && $stadium->longitude)
                <div class="mt-6">
                    <h2 class="text-sm font-medium text-gray-500">Location</h2>
                    <div class="mt-2 flex space-x-4">
                        <div>
                            <span class="text-gray-600">Latitude:</span>
                            <span class="ml-1 text-gray-900">{{ $stadium->latitude }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Longitude:</span>
                            <span class="ml-1 text-gray-900">{{ $stadium->longitude }}</span>
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

        <!-- Upcoming Matches in this Stadium -->
        <div class="border-t border-gray-200 px-6 py-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Upcoming Matches</h2>

            @if(isset($upcomingMatches) && $upcomingMatches->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-green-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Match</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($upcomingMatches as $match)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $match->date ? $match->date->format('M d, Y H:i') : 'TBD' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ $match->team1 ? $match->team1->name : 'TBD' }} vs {{ $match->team2 ? $match->team2->name : 'TBD' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $match->status == 'scheduled' ? 'green' : 'yellow' }}-100 text-{{ $match->status == 'scheduled' ? 'green' : 'yellow' }}-800">
                                        {{ ucfirst($match->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.matches.show', $match) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                    <a href="{{ route('admin.matches.edit', $match) }}" class="text-green-600 hover:text-green-900">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-gray-50 rounded-md p-4 text-center text-gray-500">
                    No upcoming matches scheduled for this stadium.
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('admin.matches.create') }}" class="inline-flex items-center text-sm text-green-600 hover:text-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Schedule a match at this stadium
                </a>
            </div>
        </div>

        <!-- Stadium Stats or Additional Information -->
        <div class="border-t border-gray-200 px-6 py-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Stadium Statistics</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Total Matches</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ isset($stats) && isset($stats->total_matches) ? $stats->total_matches : 0 }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Upcoming Matches</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ isset($stats) && isset($stats->upcoming_matches) ? $stats->upcoming_matches : 0 }}</p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Last Updated</h3>
                    <p class="text-md font-medium text-gray-900">{{ $stadium->updated_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
