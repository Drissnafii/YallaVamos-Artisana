@extends('layouts.admin')

@section('title', 'Manage Teams')

@section('header', 'Team Management')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manage Teams</h1>
        <a href="{{ route('admin.teams.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 px-4 rounded transition duration-150 ease-in-out flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Add New Team
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden" style="background: linear-gradient(to bottom, white, #f5f3ff);">
    <!-- Updated Search Bar - Google Style -->
    <div class="p-4">
        <form action="{{ route('admin.teams.index') }}" method="GET" class="">
            <div class="flex items-center bg-white border border-gray-300 rounded-full px-4 py-2 hover:shadow-sm focus-within:shadow-sm transition-shadow duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" placeholder="Search teams..." value="{{ request('search') }}"
                    class="w-full border-none focus:ring-0 outline-none text-gray-700 placeholder-gray-500">
                <button type="submit" class="ml-2">
                    <span class="sr-only">Search</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-purple-600 transition-colors duration-150" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

        <div class="p-4 border-b bg-purple-50">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.teams.index') }}" class="px-3 py-1 rounded-full text-sm {{ !request('group') ? 'bg-purple-600 text-white' : 'bg-gray-200 hover:bg-gray-300 text-gray-700' }}">
                    All Teams
                </a>
                @foreach(['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'] as $group)
                    <a href="{{ route('admin.teams.index', ['group' => $group]) }}" class="px-3 py-1 rounded-full text-sm {{ request('group') == $group ? 'bg-purple-600 text-white' : 'bg-gray-200 hover:bg-gray-300 text-gray-700' }}">
                        Group {{ $group }}
                    </a>
                @endforeach
            </div>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-purple-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Team</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Group</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matches</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" style="background: linear-gradient(to bottom, white, #f5f3ff);">
                @forelse($teams as $team)
                <tr class="hover:bg-purple-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($team->flag)
                            <div class="flex-shrink-0 h-10 w-14">
                                <img class="h-10 w-14 object-cover rounded-sm border border-gray-200" src="{{ asset('storage/' . $team->flag) }}" alt="{{ $team->name }}">
                            </div>
                            @endif
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $team->name }}</div>
                                <div class="text-sm text-gray-500">{{ $team->code }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        Group {{ $team->group ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $team->is_qualified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $team->is_qualified ? 'Qualified' : 'Pending' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $team->homeMatches()->count() + $team->awayMatches()->count() }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <!-- Updated Action Buttons - Google Style -->
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.teams.show', $team) }}" class="text-gray-500 hover:text-purple-600 p-1 rounded-full hover:bg-purple-50 transition-colors duration-150" title="View">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                            <a href="{{ route('admin.teams.edit', $team) }}" class="text-gray-500 hover:text-purple-600 p-1 rounded-full hover:bg-purple-50 transition-colors duration-150" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this team?')"
                                    class="text-gray-500 hover:text-red-600 p-1 rounded-full hover:bg-red-50 transition-colors duration-150" title="Delete">
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
                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        No teams found. <a href="{{ route('admin.teams.create') }}" class="text-purple-600 hover:text-purple-900">Add your first team</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $teams->links() }}
        </div>
    </div>
</div>
@endsection
