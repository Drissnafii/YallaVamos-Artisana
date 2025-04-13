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
        <div class="p-4 border-b">
            <form action="{{ route('admin.teams.index') }}" method="GET" class="flex items-center">
                <input type="text" name="search" placeholder="Search teams..." value="{{ request('search') }}"
                    class="border rounded-lg px-3 py-2 w-full md:w-80 focus:outline-none focus:ring-2 focus:ring-purple-500">
                <button type="submit" class="ml-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" style="background: linear-gradient(to bottom, white, #f5f3ff);">
                @forelse($teams as $team)
                <tr>
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
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.teams.show', $team) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                            View
                        </a>
                        <a href="{{ route('admin.teams.edit', $team) }}" class="text-purple-600 hover:text-purple-900 mr-3">
                            Edit
                        </a>
                        <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this team?')">
                                Delete
                            </button>
                        </form>
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
