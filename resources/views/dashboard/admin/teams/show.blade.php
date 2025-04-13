@extends('layouts.admin')

@section('title', $team->name)

@section('header', 'Team Details')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6 flex justify-between">
        <a href="{{ route('admin.teams.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Teams
        </a>
        <div class="flex space-x-2">
            <a href="{{ route('admin.teams.edit', $team) }}" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-md shadow transition duration-150 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Edit
            </a>
            <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md shadow transition duration-150 ease-in-out" onclick="return confirm('Are you sure you want to delete this team?')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Delete
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden" style="background: linear-gradient(to bottom, white, #f5f3ff);">
        <div class="md:flex">
            <!-- Team Flag -->
            <div class="md:w-1/3 bg-purple-50 flex items-center justify-center p-6">
                @if($team->flag)
                    <img src="{{ asset('storage/' . $team->flag) }}" alt="{{ $team->name }}" class="max-w-full h-auto shadow-md rounded-md">
                @else
                    <div class="h-48 w-48 flex items-center justify-center bg-purple-100 rounded-md">
                        <span class="text-purple-300 text-4xl font-bold">{{ $team->code }}</span>
                    </div>
                @endif
            </div>

            <!-- Team Information -->
            <div class="md:w-2/3 p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">{{ $team->name }}</h1>
                        <p class="text-gray-500">{{ $team->code }}</p>
                    </div>
                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                        {{ $team->is_qualified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                        {{ $team->is_qualified ? 'Qualified' : 'Pending' }}
                    </span>
                </div>

                @if($team->group)
                <div class="mt-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                        Group {{ $team->group }}
                    </span>
                </div>
                @endif

                @if($team->description)
                <div class="mt-4">
                    <h2 class="text-sm font-medium text-gray-500 mb-2">Description</h2>
                    <p class="text-gray-700">{{ $team->description }}</p>
                </div>
                @endif

                <!-- Team Stats -->
                <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white p-3 rounded-lg border border-gray-200 text-center">
                        <div class="text-sm text-gray-500">Matches</div>
                        <div class="text-xl font-bold text-gray-900">{{ $team->getMatchesPlayed() }}</div>
                    </div>

                    <div class="bg-white p-3 rounded-lg border border-gray-200 text-center">
                        <div class="text-sm text-gray-500">Wins</div>
                        <div class="text-xl font-bold text-green-600">{{ $team->getWins() }}</div>
                    </div>

                    <div class="bg-white p-3 rounded-lg border border-gray-200 text-center">
                        <div class="text-sm text-gray-500">Draws</div>
                        <div class="text-xl font-bold text-gray-600">{{ $team->getDraws() }}</div>
                    </div>

                    <div class="bg-white p-3 rounded-lg border border-gray-200 text-center">
                        <div class="text-sm text-gray-500">Losses</div>
                        <div class="text-xl font-bold text-red-600">{{ $team->getLosses() }}</div>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="bg-white p-3 rounded-lg border border-gray-200 text-center">
                        <div class="text-sm text-gray-500">Goals Scored</div>
                        <div class="text-xl font-bold text-gray-900">{{ $team->getGoalsScored() }}</div>
                    </div>

                    <div class="bg-white p-3 rounded-lg border border-gray-200 text-center">
                        <div class="text-sm text-gray-500">Goals Conceded</div>
                        <div class="text-xl font-bold text-gray-900">{{ $team->getGoalsConceded() }}</div>
                    </div>

                    <div class="bg-white p-3 rounded-lg border border-gray-200 text-center">
                        <div class="text-sm text-gray-500">Goal Difference</div>
                        <div class="text-xl font-bold {{ $team->getGoalDifference() > 0 ? 'text-green-600' : ($team->getGoalDifference() < 0 ? 'text-red-600' : 'text-gray-900') }}">
                            {{ $team->getGoalDifference() > 0 ? '+' : '' }}{{ $team->getGoalDifference() }}
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                        <div class="text-sm text-gray-500">Points</div>
                        <div class="text-2xl font-bold text-purple-600">{{ $team->getPoints() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Matches -->
        <div class="border-t border-gray-200 px-6 py-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Matches</h2>

            @php
                $matches = $team->getAllMatches()->get();
            @endphp

            @if($matches->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-purple-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Match</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stadium</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Result</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($matches as $match)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $match->date ? date('M d, Y', strtotime($match->date)) : 'TBD' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="text-sm font-medium {{ $match->team1_id == $team->id ? 'text-purple-600 font-bold' : 'text-gray-900' }}">
                                            {{ $match->team1 ? $match->team1->name : 'TBD' }}
                                        </span>
                                        <span class="mx-2">vs</span>
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
                                        ($match->status == 'in_progress' ? 'bg-orange-100 text-orange-800' :
                                        ($match->status == 'completed' ? 'bg-green-100 text-green-800' :
                                        ($match->status == 'postponed' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'))) }}">
                                        {{ ucfirst(str_replace('_', ' ', $match->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                                    <a href="{{ route('admin.matches.show', $match) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                        View
                                    </a>
                                    <a href="{{ route('admin.matches.edit', $match) }}" class="text-purple-600 hover:text-purple-900">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-gray-50 rounded-md p-4 text-center text-gray-500">
                    No matches scheduled for this team yet.
                    <a href="{{ route('admin.matches.create') }}" class="text-purple-600 hover:text-purple-800 ml-1">Schedule a match</a>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('admin.matches.create') }}" class="inline-flex items-center text-sm text-purple-600 hover:text-purple-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Schedule a new match for {{ $team->name }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
