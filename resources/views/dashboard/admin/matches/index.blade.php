@extends('layouts.admin')

@section('title', 'Manage Matches')

@section('header', 'Match Management')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manage Matches</h1>
        <a href="{{ route('admin.matches.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Schedule New Match
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden" style="background: linear-gradient(to bottom, white, #fff7ed);">
        <div class="p-4 border-b">
            <form action="{{ route('admin.matches.index') }}" method="GET" class="flex flex-wrap gap-3">
                <div class="flex-grow md:flex-grow-0">
                    <input type="text" name="search" placeholder="Search matches..." value="{{ request('search') }}"
                        class="border rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <div>
                    <select name="status" class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="">All Statuses</option>
                        <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="postponed" {{ request('status') == 'postponed' ? 'selected' : '' }}>Postponed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div>
                    <select name="stadium" class="border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="">All Stadiums</option>
                        @foreach($stadiums as $stadium)
                            <option value="{{ $stadium->id }}" {{ request('stadium') == $stadium->id ? 'selected' : '' }}>{{ $stadium->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>

                <a href="{{ route('admin.matches.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-medium py-2 px-4 rounded">
                    Reset
                </a>
            </form>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-orange-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teams</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stadium</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" style="background: linear-gradient(to bottom, white, #fff7ed);">
                @forelse($matches as $match)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $match->date ? date('M d, Y H:i', strtotime($match->date)) : 'TBD' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $match->team1 ? $match->team1->name : 'TBD' }} vs {{ $match->team2 ? $match->team2->name : 'TBD' }}
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $match->stadium ? $match->stadium->name : 'TBD' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($match->status == 'completed' || $match->status == 'in_progress')
                            <span class="font-medium">{{ $match->score_team1 ?? 0 }} - {{ $match->score_team2 ?? 0 }}</span>
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
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.matches.show', $match) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                            View
                        </a>
                        <a href="{{ route('admin.matches.edit', $match) }}" class="text-orange-600 hover:text-orange-900 mr-3">
                            Edit
                        </a>
                        <form action="{{ route('admin.matches.destroy', $match) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this match?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        No matches found. <a href="{{ route('admin.matches.create') }}" class="text-orange-600 hover:text-orange-900">Schedule your first match</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $matches->links() }}
        </div>
    </div>
</div>
@endsection
