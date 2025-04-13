@extends('layouts.admin')

@section('title', 'Match Details')

@section('header', 'Match Details')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex justify-between">
        <a href="{{ route('admin.matches.index') }}" class="inline-flex items-center text-orange-600 hover:text-orange-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Matches
        </a>
        <div class="flex space-x-2">
            <a href="{{ route('admin.matches.edit', $match) }}" class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-md shadow transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit
            </a>
            <form action="{{ route('admin.matches.destroy', $match) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md shadow transition duration-150 ease-in-out" onclick="return confirm('Are you sure you want to delete this match?')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden" style="background: linear-gradient(to bottom, white, #fff7ed);">
        <!-- Match Header -->
        <div class="p-6 border-b border-gray-200 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center">
                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                    {{ $match->status == 'scheduled' ? 'bg-blue-100 text-blue-800' :
                      ($match->status == 'in_progress' ? 'bg-orange-100 text-orange-800' :
                      ($match->status == 'completed' ? 'bg-green-100 text-green-800' :
                      ($match->status == 'postponed' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'))) }}">
                    {{ ucfirst(str_replace('_', ' ', $match->status)) }}
                </span>
                <span class="ml-3 text-gray-600">
                    {{ $match->date ? date('M d, Y H:i', strtotime($match->date)) : 'Date TBD' }}
                </span>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('admin.stadiums.show', $match->stadium_id) }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    {{ $match->stadium ? $match->stadium->name : 'Stadium TBD' }}
                </a>
            </div>
        </div>

        <!-- Match Scoreboard -->
        <div class="py-8 px-4 flex flex-col items-center">
            <div class="w-full max-w-xl bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg shadow-sm p-6">
                <div class="flex justify-between items-center">
                    <div class="text-center w-2/5">
                        <div class="text-lg font-semibold text-gray-900">{{ $match->team1 ? $match->team1->name : 'Team 1 TBD' }}</div>
                        @if($match->team1 && $match->team1->flag)
                            <img src="{{ asset('storage/' . $match->team1->flag) }}" alt="{{ $match->team1->name }}" class="h-12 w-auto mx-auto my-2">
                        @endif
                    </div>

                    <div class="text-center">
                        @if($match->status == 'completed' || $match->status == 'in_progress')
                            <div class="text-4xl font-bold text-gray-900">
                                {{ $match->score_team1 ?? 0 }} - {{ $match->score_team2 ?? 0 }}
                            </div>
                            @if($match->status == 'in_progress')
                                <div class="text-sm text-orange-600 animate-pulse font-medium mt-1">LIVE</div>
                            @endif
                        @else
                            <div class="text-2xl font-medium text-gray-400">VS</div>
                        @endif
                    </div>

                    <div class="text-center w-2/5">
                        <div class="text-lg font-semibold text-gray-900">{{ $match->team2 ? $match->team2->name : 'Team 2 TBD' }}</div>
                        @if($match->team2 && $match->team2->flag)
                            <img src="{{ asset('storage/' . $match->team2->flag) }}" alt="{{ $match->team2->name }}" class="h-12 w-auto mx-auto my-2">
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Match Details -->
        <div class="border-t border-gray-200 px-6 py-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Match Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Date & Time</h3>
                    <p class="text-md text-gray-900">
                        {{ $match->date ? date('F d, Y', strtotime($match->date)) : 'Date TBD' }}
                    </p>
                    <p class="text-md text-gray-900">
                        {{ $match->date ? date('h:i A', strtotime($match->date)) : 'Time TBD' }}
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Stadium</h3>
                    <p class="text-md text-gray-900">
                        {{ $match->stadium ? $match->stadium->name : 'Stadium TBD' }}
                    </p>
                    <p class="text-sm text-gray-600">
                        {{ $match->stadium && $match->stadium->city ? $match->stadium->city->name : 'Location TBD' }}
                    </p>
                </div>

                @if($match->status == 'completed')
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Result</h3>
                    <p class="text-md text-gray-900 font-medium">
                        @if($match->score_team1 > $match->score_team2)
                            {{ $match->team1 ? $match->team1->name : 'Team 1' }} won
                        @elseif($match->score_team2 > $match->score_team1)
                            {{ $match->team2 ? $match->team2->name : 'Team 2' }} won
                        @else
                            Draw
                        @endif
                    </p>
                </div>
                @endif

                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Match Status</h3>
                    <p class="text-md text-gray-900">
                        {{ ucfirst(str_replace('_', ' ', $match->status)) }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Match Statistics (Optional) -->
        @if($match->status == 'completed')
        <div class="border-t border-gray-200 px-6 py-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Match Statistics</h2>

            <div class="space-y-4">
                <!-- Example statistics - replace with actual data if available -->
                <div class="flex items-center">
                    <span class="w-1/5 text-right text-sm text-gray-900">65%</span>
                    <div class="w-3/5 mx-4">
                        <div class="flex items-center">
                            <div class="bg-orange-500 h-2 rounded-l" style="width: 65%"></div>
                            <div class="bg-blue-500 h-2 rounded-r" style="width: 35%"></div>
                        </div>
                        <div class="text-xs text-gray-500 text-center mt-1">Possession</div>
                    </div>
                    <span class="w-1/5 text-left text-sm text-gray-900">35%</span>
                </div>

                <div class="flex items-center">
                    <span class="w-1/5 text-right text-sm text-gray-900">8</span>
                    <div class="w-3/5 mx-4">
                        <div class="flex items-center">
                            <div class="bg-orange-500 h-2 rounded-l" style="width: 80%"></div>
                            <div class="bg-blue-500 h-2 rounded-r" style="width: 20%"></div>
                        </div>
                        <div class="text-xs text-gray-500 text-center mt-1">Shots on Goal</div>
                    </div>
                    <span class="w-1/5 text-left text-sm text-gray-900">2</span>
                </div>

                <div class="flex items-center">
                    <span class="w-1/5 text-right text-sm text-gray-900">5</span>
                    <div class="w-3/5 mx-4">
                        <div class="flex items-center">
                            <div class="bg-orange-500 h-2 rounded-l" style="width: 50%"></div>
                            <div class="bg-blue-500 h-2 rounded-r" style="width: 50%"></div>
                        </div>
                        <div class="text-xs text-gray-500 text-center mt-1">Corner Kicks</div>
                    </div>
                    <span class="w-1/5 text-left text-sm text-gray-900">5</span>
                </div>
            </div>

            <div class="mt-4 text-center text-sm text-gray-500">
                Note: These are example statistics and may not reflect actual match data.
            </div>
        </div>
        @endif

        <!-- Admin Actions -->
        <div class="border-t border-gray-200 px-6 py-6">
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('admin.matches.edit', $match) }}" class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-md shadow transition duration-150 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                    Edit Match
                </a>

                @if($match->status == 'scheduled')
                <form action="{{ route('admin.matches.update', $match) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="in_progress">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md shadow transition duration-150 ease-in-out" onclick="return confirm('Are you sure you want to start this match?')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                        </svg>
                        Start Match
                    </button>
                </form>
                @elseif($match->status == 'in_progress')
                <form action="{{ route('admin.matches.update', $match) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="completed">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow transition duration-150 ease-in-out" onclick="return confirm('Are you sure you want to mark this match as completed?')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Complete Match
                    </button>
                </form>
                @endif

                @if($match->status != 'cancelled' && $match->status != 'completed')
                <form action="{{ route('admin.matches.update', $match) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md shadow transition duration-150 ease-in-out" onclick="return confirm('Are you sure you want to cancel this match?')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        Cancel Match
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
