@extends('layouts.admin')

@section('title', $team->name)

@section('header', 'Team Details')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Top action bar -->
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.teams.index') }}" class="flex items-center p-2 text-purple-600 hover:text-purple-800 rounded-full hover:bg-purple-50 transition-colors duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span class="ml-1">Back</span>
        </a>
        <div class="flex space-x-2">
            <a href="{{ route('admin.teams.edit', $team) }}" class="flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-full shadow-sm transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit
            </a>
            <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-full shadow-sm transition duration-150 ease-in-out" onclick="return confirm('Are you sure you want to delete this team?')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Delete
                </button>
            </form>
        </div>
    </div>

    <!-- Main content card -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8" style="background: linear-gradient(to bottom, white, #f5f3ff);">
        <!-- Team header with flag and info -->
        <div class="relative">
            <!-- Banner/background with gradient -->
            <div class="h-32 bg-gradient-to-r from-purple-600 to-purple-500"></div>

            <div class="px-6 -mt-16">
                <div class="flex flex-col md:flex-row">
                    <!-- Flag in card format -->
                    <div class="md:w-1/4">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden p-2 border border-gray-100">
                            @if($team->flag)
                                <img src="{{ asset('storage/' . $team->flag) }}" alt="{{ $team->name }}" class="w-full h-auto object-contain">
                            @else
                                <div class="h-40 flex items-center justify-center bg-purple-100 rounded-md">
                                    <span class="text-purple-300 text-4xl font-bold">{{ $team->code }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Team basic info -->
                    <div class="md:w-3/4 md:pl-6 mt-4 md:mt-16">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">{{ $team->name }}</h1>
                                <p class="text-gray-500">{{ $team->code }}</p>

                                @if($team->group)
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        Group {{ $team->group }}
                                    </span>
                                </div>
                                @endif
                            </div>

                            <span class="mt-2 md:mt-0 px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                                {{ $team->is_qualified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $team->is_qualified ? 'Qualified' : 'Pending' }}
                            </span>
                        </div>

                        @if($team->description)
                        <div class="mt-4 bg-gray-50 p-4 rounded-lg border border-gray-100">
                            <h2 class="text-sm font-medium text-gray-500 mb-2">About</h2>
                            <p class="text-gray-700">{{ $team->description }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Stats -->
        <div class="px-6 mt-6">
            <h2 class="text-lg font-medium text-gray-800 mb-4">Team Statistics</h2>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Matches</div>
                        <div class="text-xl font-bold text-gray-900">{{ $team->getMatchesPlayed() }}</div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Wins</div>
                        <div class="text-xl font-bold text-green-600">{{ $team->getWins() }}</div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Draws</div>
                        <div class="text-xl font-bold text-gray-600">{{ $team->getDraws() }}</div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Losses</div>
                        <div class="text-xl font-bold text-red-600">{{ $team->getLosses() }}</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Goals Scored</div>
                        <div class="text-xl font-bold text-gray-900">{{ $team->getGoalsScored() }}</div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Goals Conceded</div>
                        <div class="text-xl font-bold text-gray-900">{{ $team->getGoalsConceded() }}</div>
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 flex items-center">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-gray-500">Goal Difference</div>
                        <div class="text-xl font-bold {{ $team->getGoalDifference() > 0 ? 'text-green-600' : ($team->getGoalDifference() < 0 ? 'text-red-600' : 'text-gray-900') }}">
                            {{ $team->getGoalDifference() > 0 ? '+' : '' }}{{ $team->getGoalDifference() }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Points card with prominence -->
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6 rounded-lg shadow-md text-white mb-8">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-white bg-opacity-20 flex items-center justify-center mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-sm text-white text-opacity-80">Total Points</div>
                        <div class="text-3xl font-bold">{{ $team->getPoints() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Matches -->
        <div class="px-6 py-6 border-t border-gray-200">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-medium text-gray-900">Team Matches</h2>
                <a href="{{ route('admin.matches.create') }}" class="inline-flex items-center text-sm text-purple-600 hover:text-purple-800 px-3 py-1 rounded-full hover:bg-purple-50 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Schedule Match
                </a>
            </div>

            @php
                $matches = $team->getAllMatches()->get();
            @endphp

            @if($matches->count() > 0)
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Match</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stadium</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Result</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($matches as $match)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $match->date ? date('M d, Y', strtotime($match->date)) : 'TBD' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @if($match->team1 && $match->team1->flag)
                                                <img src="{{ asset('storage/' . $match->team1->flag) }}" class="h-6 w-8 object-cover mr-2 border border-gray-200 rounded-sm" alt="{{ $match->team1->name }}">
                                            @endif
                                            <span class="text-sm font-medium {{ $match->team1_id == $team->id ? 'text-purple-600 font-bold' : 'text-gray-900' }}">
                                                {{ $match->team1 ? $match->team1->name : 'TBD' }}
                                            </span>
                                            <span class="mx-2 text-gray-400">vs</span>
                                            @if($match->team2 && $match->team2->flag)
                                                <img src="{{ asset('storage/' . $match->team2->flag) }}" class="h-6 w-8 object-cover mr-2 border border-gray-200 rounded-sm" alt="{{ $match->team2->name }}">
                                            @endif
                                            <span class="text-sm font-medium {{ $match->team2_id == $team->id ? 'text-purple-600 font-bold' : 'text-gray-900' }}">
                                                {{ $match->team2 ? $match->team2->name : 'TBD' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $match->stadium ? $match->stadium->name : 'TBD' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($match->status == 'completed' || $match->status == 'in_progress')
                                            <span class="font-medium {{
                                                ($match->team1_id == $team->id && $match->score_team1 > $match->score_team2) ||
                                                ($match->team2_id == $team->id && $match->score_team2 > $match->score_team1)
                                                    ? 'text-green-600' :
                                                ($match->score_team1 == $match->score_team2
                                                    ? 'text-gray-600' : 'text-red-600')
                                            }}">
                                                {{ $match->score_team1 ?? 0 }} - {{ $match->score_team2 ?? 0 }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $match->status == 'scheduled' ? 'bg-blue-100 text-blue-800' :
                                            ($match->status == 'in_progress' ? 'bg-amber-100 text-amber-800' :
                                            ($match->status == 'completed' ? 'bg-green-100 text-green-800' :
                                            ($match->status == 'postponed' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'))) }}">
                                            {{ ucfirst(str_replace('_', ' ', $match->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('admin.matches.show', $match) }}" class="text-gray-500 hover:text-purple-600 p-1 rounded-full hover:bg-purple-50 transition-colors duration-150" title="View">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.matches.edit', $match) }}" class="text-gray-500 hover:text-purple-600 p-1 rounded-full hover:bg-purple-50 transition-colors duration-150" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="bg-gray-50 rounded-lg border border-gray-200 p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-500 mb-4">No matches scheduled for this team yet.</p>
                    <a href="{{ route('admin.matches.create') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Schedule a match
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
