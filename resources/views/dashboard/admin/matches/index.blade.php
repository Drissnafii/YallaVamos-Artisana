@extends('layouts.admin')

@section('title', 'Manage Matches')

@section('header', 'Match Management')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <h1 class="text-2xl font-light text-gray-900">Manage Matches</h1>
            <a href="{{ route('admin.matches.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-full shadow-sm hover:shadow-md transition-all duration-200 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Schedule New Match
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white shadow-sm rounded-2xl overflow-hidden">
            <!-- Filter Section -->
            <div class="p-6 border-b border-gray-100">
                <form action="{{ route('admin.matches.index') }}" method="GET" class="flex flex-wrap gap-4 items-center">
                    <div class="flex-grow md:flex-grow-0">
                        <input type="text" 
                               name="search" 
                               placeholder="Search matches..." 
                               value="{{ request('search') }}"
                               class="w-full bg-gray-50 rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition-colors">
                    </div>

                    <div>
                        <select name="status" 
                                class="bg-gray-50 rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition-colors">
                            <option value="">All Statuses</option>
                            <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="postponed" {{ request('status') == 'postponed' ? 'selected' : '' }}>Postponed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <select name="stadium" 
                                class="bg-gray-50 rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition-colors">
                            <option value="">All Stadiums</option>
                            @foreach($stadiums as $stadium)
                                <option value="{{ $stadium->id }}" {{ request('stadium') == $stadium->id ? 'selected' : '' }}>{{ $stadium->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center space-x-2">
                        <button type="submit" 
                                class="bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium p-2 rounded-full border border-gray-300 inline-flex items-center justify-center transition-colors w-10 h-10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>

                        <a href="{{ route('admin.matches.index') }}" 
                           class="bg-gray-50 hover:bg-gray-100 text-gray-700 font-medium px-4 py-2 rounded-full border border-gray-300 inline-flex items-center transition-colors">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teams</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stadium</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($matches as $match)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $match->date ? date('M d, Y H:i', strtotime($match->date)) : 'TBD' }}
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $match->team1 ? $match->team1->name : 'TBD' }} vs {{ $match->team2 ? $match->team2->name : 'TBD' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $match->stadium ? $match->stadium->name : 'TBD' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @if($match->status == 'completed' || $match->status == 'in_progress')
                                    <span class="font-medium">{{ $match->score_team1 ?? 0 }} - {{ $match->score_team2 ?? 0 }}</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs font-medium rounded-full
                                    {{ $match->status == 'scheduled' ? 'bg-blue-100 text-blue-800' :
                                      ($match->status == 'in_progress' ? 'bg-blue-100 text-blue-800' :
                                      ($match->status == 'completed' ? 'bg-green-100 text-green-800' :
                                      ($match->status == 'postponed' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'))) }}">
                                    {{ ucfirst(str_replace('_', ' ', $match->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.matches.show', $match) }}" 
                                       class="bg-gray-50 hover:bg-gray-100 text-blue-600 p-2 rounded-full border border-gray-200 inline-flex items-center justify-center transition-colors w-8 h-8"
                                       title="View Match">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    
                                    <a href="{{ route('admin.matches.edit', $match) }}" 
                                       class="bg-gray-50 hover:bg-gray-100 text-blue-600 p-2 rounded-full border border-gray-200 inline-flex items-center justify-center transition-colors w-8 h-8"
                                       title="Edit Match">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    
                                    <form action="{{ route('admin.matches.destroy', $match) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-gray-50 hover:bg-gray-100 text-red-600 p-2 rounded-full border border-gray-200 inline-flex items-center justify-center transition-colors w-8 h-8"
                                                title="Delete Match"
                                                onclick="return confirm('Are you sure you want to delete this match?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-sm text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-gray-500 mb-2">No matches found</p>
                                    <a href="{{ route('admin.matches.create') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                                        Schedule your first match
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
                {{ $matches->links() }}
            </div>
        </div>
    </div>
</div>
@endsection