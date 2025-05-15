@extends('layouts.admin') {{-- Assuming your admin area uses the same base layout --}}
{{-- If you create a separate admin layout (e.g., layouts.admin), extend that instead --}}

@section('title', 'Admin Dashboard - Morocco 2030')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Dashboard Content (Updated for Project) -->
    <div class="py-4">
        <!-- Stats cards -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-5"> {{-- Changed to 5 columns for teams --}}
            <!-- Card 1: Host Cities -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6" style="background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Total Host Cities
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                        {{ $cityCount ?? '0' }} {{-- Replace with dynamic data --}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <div class="text-sm">
                        <a href="{{ url('/admin/cities') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Manage Cities
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 2: Stadiums -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6" style="background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 11.714L12 4.286l-7.428 7.428M6 14.571v5.715h12v-5.715M9.429 14.571v-2.857a2.571 2.571 0 115.142 0v2.857" /> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21.429c-5.714 0-10.286-4.571-10.286-10.286S6.286.857 12 .857s10.286 4.571 10.286 10.286c0 2.38-.821 4.578-2.207 6.286" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Total Stadiums
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                        {{ $stadiumCount ?? '0' }} {{-- Replace with dynamic data --}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <div class="text-sm">
                        <a href="{{ url('/admin/stadiums') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Manage Stadiums
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 3: Teams -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6" style="background: linear-gradient(135deg, #EDE9FE 0%, #DDD6FE 100%);">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Participating Teams
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                        {{ $teamCount ?? '0' }} {{-- Replace with dynamic data --}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <div class="text-sm">
                        <a href="{{ url('/admin/teams') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Manage Teams
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 4: Matches Scheduled -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6" style="background: linear-gradient(135deg, #FEF3C7 0%, #FDE68A 100%);">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Matches Scheduled
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                        {{ $matchCount ?? '0' }} {{-- Replace with dynamic data --}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <div class="text-sm">
                        <a href="{{ url('/admin/matches') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Manage Matches
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card 5: Articles Published -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6" style="background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%);">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3"> {{-- Changed color --}}
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h6m-4 8H7" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Articles Published
                                </dt>
                                <dd>
                                    <div class="text-lg font-medium text-gray-900">
                                        {{ $articleCount ?? '0' }} {{-- Replace with dynamic data --}}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-4 sm:px-6">
                    <div class="text-sm">
                        <a href="{{ route('admin.articles.index') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            Manage Articles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Management Section -->
    <div class="mt-8 bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Teams Management</h3>
            <div class="flex items-center space-x-4">
                <a href="{{ url('/admin/teams') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all</a>
                <a href="{{ url('/admin/teams/create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Add New Team
                </a>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Team
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="relative px-6 py-3 text-right">
                            <span class="sr-only">Actions</span>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($teams ?? [] as $team)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="{{ $team->flag ? asset('storage/' . $team->flag) : asset('images/flags/placeholder.png') }}" alt="{{ $team->name }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $team->name }}</div>
                                    @if($team->description)
                                    <div class="text-sm text-gray-500">{{ \Illuminate\Support\Str::limit($team->description, 30) }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($team->name == 'Morocco')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Host Nation
                            </span>
                            @elseif($team->is_qualified)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                Qualified
                            </span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Qualifying
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ url('/admin/teams/' . $team->id . '/edit') }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ url('/admin/teams/' . $team->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this team?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-500">
                            No teams found. <a href="{{ url('/admin/teams/create') }}" class="text-indigo-600 hover:text-indigo-900">Create your first team</a>.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            <div class="flex justify-between">
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        @if(isset($teams) && method_exists($teams, 'total'))
                        <p class="text-sm text-gray-700">
                            Total Teams: <span class="font-medium">{{ $teams->total() ?? 0 }}</span>
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Matches -->
    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Upcoming Matches</h3>
            <a href="{{ url('/admin/matches') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Teams
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Stadium
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            City
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Example Match 1 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            June 15, 2030
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="font-medium text-gray-900">Morocco vs Spain</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Mohammed V Stadium
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Casablanca
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Confirmed
                            </span>
                        </td>
                    </tr>
                    <!-- Example Match 2 -->
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            June 18, 2030
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <span class="font-medium text-gray-900">Brazil vs Germany</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Grand Stade de Marrakech
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            Marrakech
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Scheduling
                            </span>
                        </td>
                    </tr>
                    <!-- Replace with dynamic data from your database -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Activity / Content Updates -->
    <div class="mt-8 grid grid-cols-1 gap-6"> {{-- Changed to single column since we're removing Quick Stats --}}
        <!-- Recent Content Updates Table -->
        <div class="bg-white shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Content Updates</h3>
            </div>
            <ul class="divide-y divide-gray-200">
                @forelse($recentUpdates ?? [] as $update)
                <li>
                    <a href="{{ $update->url ?? '#' }}" class="block hover:bg-gray-50">
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-indigo-600 truncate">
                                    {{ $update->title ?? 'Update' }}
                                </p>
                                <div class="ml-2 flex-shrink-0 flex">
                                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $update->type_color ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ $update->type ?? 'Update' }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-2 sm:flex sm:justify-between">
                                <div class="sm:flex items-center text-sm text-gray-500">
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    <p>{{ $update->user->name ?? 'System' }}</p>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    <p>
                                        {{ $update->action ?? 'Updated' }} <time datetime="{{ $update->created_at }}">{{ $update->created_at->format('M d, Y') }}</time>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                @empty
                <li>
                    <div class="px-4 py-4 sm:px-6 text-center text-gray-500">
                        No recent updates found.
                    </div>
                </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

{{-- Footer (Consider if needed in admin panel, maybe simpler) --}}
<footer class="bg-white border-t border-gray-200">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <p class="text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Morocco 2030 Admin Panel. All rights reserved.
        </p>
    </div>
</footer>
</div>
@endsection

@push('scripts')
{{-- Add Alpine.js if you haven't included it globally via Vite --}}
<script src="//unpkg.com/alpinejs" defer></script>

{{-- Basic JS for profile dropdown (if not using Alpine) and mobile sidebar --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Profile dropdown toggle (Example without Alpine.js)
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = userMenuButton?.closest('.relative')?.querySelector('div[role="menu"]'); // Select the dropdown menu itself

    // Check if elements exist before adding listeners
    if (userMenuButton && userMenu) {
        // Initial setup if not using Alpine which handles this via x-show
        userMenu.style.display = 'none';
        userMenuButton.setAttribute('aria-expanded', 'false');

        userMenuButton.addEventListener('click', (event) => {
            const isExpanded = userMenuButton.getAttribute('aria-expanded') === 'true';
            userMenuButton.setAttribute('aria-expanded', !isExpanded);
            userMenu.style.display = isExpanded ? 'none' : 'block'; // Toggle display
            event.stopPropagation();
        });

        // Close dropdown if clicking outside (if not using Alpine's @click.away)
        document.addEventListener('click', (event) => {
            if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                if (userMenuButton.getAttribute('aria-expanded') === 'true') {
                    userMenuButton.setAttribute('aria-expanded', 'false');
                    userMenu.style.display = 'none';
                }
            }
        });
    }

    // Mobile sidebar toggle (Requires more setup for overlay)
    const mobileMenuButton = document.querySelector('.md\\:hidden button[aria-label="Open sidebar"]');
    // You'll need to target the sidebar container and add/remove classes for visibility & overlay
    // Example using Alpine.js: Add x-data="{ sidebarOpen: false }" to the parent div (e.g., <div class="flex" x-data...> )
    // Then toggle `sidebarOpen` on button click (@click="sidebarOpen = true")
    // And bind sidebar visibility: <div class="hidden md:flex..." :class="{ 'fixed inset-0 flex z-40 md:hidden': sidebarOpen }">...
    // Add overlay: <div x-show="sidebarOpen" class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="sidebarOpen = false"></div>
    // Add close button inside mobile sidebar: <button @click="sidebarOpen = false">...</button>

    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', () => {
            console.warn('Mobile sidebar toggle needs full implementation (overlay, class toggling, potentially using Alpine.js).');
            // Example (won't work correctly without full setup):
            // const sidebar = document.querySelector('.hidden.md\\:flex.md\\:flex-shrink-0');
            // if (sidebar) sidebar.classList.toggle('hidden'); // Incorrect way for mobile overlay
        });
    }
});
</script>
@endpush
