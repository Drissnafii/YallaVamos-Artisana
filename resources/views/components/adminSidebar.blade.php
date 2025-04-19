<!-- Material Design-inspired Sidebar -->
<div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 shadow-xl">
        <div class="flex flex-col h-full bg-white">
            <!-- Header with logo -->
            <div class="flex items-center h-16 flex-shrink-0 px-4 bg-[#A94438]">
                <img class="h-8 w-auto" src="{{ asset('images/morocco-logo.svg') }}" alt="Morocco 2030">
                <span class="ml-3 text-white font-medium text-lg">Admin</span>
            </div>

            <!-- Main navigation -->
            <div class="flex-1 flex flex-col overflow-y-auto">
                <nav class="flex-1 py-4">
                    <!-- Dashboard -->
                    <a href="{{ url('/admin/dashboard') }}"
                       class="group relative flex items-center py-3 px-6 text-sm font-medium
                              {{ request()->is('admin') ? 'text-[#D24545] bg-[#E4DEBE]/20' : 'text-gray-700 hover:bg-[#E4DEBE]/10' }}">
                        <div class="{{ request()->is('admin') ? 'absolute inset-y-0 left-0 w-1 bg-[#D24545]' : '' }}"></div>
                        <svg class="{{ request()->is('admin') ? 'text-[#D24545]' : 'text-gray-500' }} mr-4 h-5 w-5"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <!-- Divider -->
                    <div class="mt-2 mb-2 mx-6 border-t border-gray-200"></div>

                    <!-- Tournament Section -->
                    <div class="px-6 py-2">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Tournament</p>
                    </div>

                    <!-- Host Cities -->
                    <a href="{{ url('/admin/cities') }}"
                       class="group relative flex items-center py-3 px-6 text-sm font-medium
                              {{ request()->is('admin/cities*') ? 'text-[#D24545] bg-[#E4DEBE]/20' : 'text-gray-700 hover:bg-[#E4DEBE]/10' }}">
                        <div class="{{ request()->is('admin/cities*') ? 'absolute inset-y-0 left-0 w-1 bg-[#D24545]' : '' }}"></div>
                        <svg class="{{ request()->is('admin/cities*') ? 'text-[#D24545]' : 'text-gray-500' }} mr-4 h-5 w-5"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Host Cities
                    </a>

                    <!-- Stadiums -->
                    <a href="{{ url('/admin/stadiums') }}"
                       class="group relative flex items-center py-3 px-6 text-sm font-medium
                              {{ request()->is('admin/stadiums*') ? 'text-[#D24545] bg-[#E4DEBE]/20' : 'text-gray-700 hover:bg-[#E4DEBE]/10' }}">
                        <div class="{{ request()->is('admin/stadiums*') ? 'absolute inset-y-0 left-0 w-1 bg-[#D24545]' : '' }}"></div>
                        <svg class="{{ request()->is('admin/stadiums*') ? 'text-[#D24545]' : 'text-gray-500' }} mr-4 h-5 w-5"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19.428 11.714L12 4.286l-7.428 7.428M6 14.571v5.715h12v-5.715M9.429 14.571v-2.857a2.571 2.571 0 115.142 0v2.857" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 21.429c-5.714 0-10.286-4.571-10.286-10.286S6.286.857 12 .857s10.286 4.571 10.286 10.286c0 2.38-.821 4.578-2.207 6.286" />
                        </svg>
                        Stadiums
                    </a>

                    <!-- Teams -->
                    <a href="{{ url('/admin/teams') }}"
                       class="group relative flex items-center py-3 px-6 text-sm font-medium
                              {{ request()->is('admin/teams*') ? 'text-[#D24545] bg-[#E4DEBE]/20' : 'text-gray-700 hover:bg-[#E4DEBE]/10' }}">
                        <div class="{{ request()->is('admin/teams*') ? 'absolute inset-y-0 left-0 w-1 bg-[#D24545]' : '' }}"></div>
                        <svg class="{{ request()->is('admin/teams*') ? 'text-[#D24545]' : 'text-gray-500' }} mr-4 h-5 w-5"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Teams
                    </a>

                    <!-- Matches -->
                    <a href="{{ url('/admin/matches') }}"
                       class="group relative flex items-center py-3 px-6 text-sm font-medium
                              {{ request()->is('admin/matches*') ? 'text-[#D24545] bg-[#E4DEBE]/20' : 'text-gray-700 hover:bg-[#E4DEBE]/10' }}">
                        <div class="{{ request()->is('admin/matches*') ? 'absolute inset-y-0 left-0 w-1 bg-[#D24545]' : '' }}"></div>
                        <svg class="{{ request()->is('admin/matches*') ? 'text-[#D24545]' : 'text-gray-500' }} mr-4 h-5 w-5"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Matches
                    </a>

                    <!-- Divider -->
                    <div class="mt-2 mb-2 mx-6 border-t border-gray-200"></div>

                    <!-- Content Section -->
                    <div class="px-6 py-2">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Content</p>
                    </div>

                    <!-- Articles & News -->
                    <a href="{{ url('/admin/articles') }}"
                       class="group relative flex items-center py-3 px-6 text-sm font-medium
                              {{ request()->is('admin/articles*') ? 'text-[#D24545] bg-[#E4DEBE]/20' : 'text-gray-700 hover:bg-[#E4DEBE]/10' }}">
                        <div class="{{ request()->is('admin/articles*') ? 'absolute inset-y-0 left-0 w-1 bg-[#D24545]' : '' }}"></div>
                        <svg class="{{ request()->is('admin/articles*') ? 'text-[#D24545]' : 'text-gray-500' }} mr-4 h-5 w-5"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h6m-4 8H7" />
                        </svg>
                        Articles & News
                    </a>

                    <!-- Categories -->
                    <a href="{{ url('/admin/categories') }}"
                       class="group relative flex items-center py-3 px-6 text-sm font-medium
                              {{ request()->is('admin/categories*') ? 'text-[#D24545] bg-[#E4DEBE]/20' : 'text-gray-700 hover:bg-[#E4DEBE]/10' }}">
                        <div class="{{ request()->is('admin/categories*') ? 'absolute inset-y-0 left-0 w-1 bg-[#D24545]' : '' }}"></div>
                        <svg class="{{ request()->is('admin/categories*') ? 'text-[#D24545]' : 'text-gray-500' }} mr-4 h-5 w-5"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Categories
                    </a>

                    <!-- Accommodations -->
                    <a href="{{ url('/admin/accommodations') }}"
                       class="group relative flex items-center py-3 px-6 text-sm font-medium
                              {{ request()->is('admin/accommodations*') ? 'text-[#D24545] bg-[#E4DEBE]/20' : 'text-gray-700 hover:bg-[#E4DEBE]/10' }}">
                        <div class="{{ request()->is('admin/accommodations*') ? 'absolute inset-y-0 left-0 w-1 bg-[#D24545]' : '' }}"></div>
                        <svg class="{{ request()->is('admin/accommodations*') ? 'text-[#D24545]' : 'text-gray-500' }} mr-4 h-5 w-5"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l9-9 9 9M5 10v11h14V10M9 21v-6a2 2 0 012-2h2a2 2 0 012 2v6" />
                        </svg>
                        Accommodations
                    </a>

                    <!-- Divider -->
                    <div class="mt-2 mb-2 mx-6 border-t border-gray-200"></div>

                    <!-- System Section -->
                    <div class="px-6 py-2">
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">System</p>
                    </div>

                    <!-- Users -->
                    <a href="{{ url('/admin/users') }}"
                       class="group relative flex items-center py-3 px-6 text-sm font-medium
                              {{ request()->is('admin/users*') ? 'text-[#D24545] bg-[#E4DEBE]/20' : 'text-gray-700 hover:bg-[#E4DEBE]/10' }}">
                        <div class="{{ request()->is('admin/users*') ? 'absolute inset-y-0 left-0 w-1 bg-[#D24545]' : '' }}"></div>
                        <svg class="{{ request()->is('admin/users*') ? 'text-[#D24545]' : 'text-gray-500' }} mr-4 h-5 w-5"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Users
                    </a>

                    <!-- NEW: AI Assistant Card (Material Design Style) -->
                    <div class="mt-6 mx-4">
                        <div class="rounded-lg shadow-md overflow-hidden">
                            <!-- Card Header with gradient -->
                            <div class="bg-gradient-to-r from-[#A94438] to-[#D24545] px-4 py-3">
                                <div class="flex items-center">
                                    <div class="rounded-full bg-white p-1 mr-3">
                                        <svg class="h-5 w-5 text-[#D24545]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-white flex items-center">
                                            AI Assistant
                                            <span class="ml-2 text-xs py-0.5 px-1.5 bg-white text-[#A94438] rounded">NEW</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <!-- Card content -->
                            <div class="bg-[#E4DEBE]/20 px-4 py-3">
                                <p class="text-gray-700 text-sm mb-3">Get instant help with tournament management, content creation, and more.</p>
                                <a href="{{ url('/admin/chat') }}"
                                   class="block w-full bg-[#D24545] hover:bg-[#A94438] transition-colors duration-150 text-white text-center py-2 px-4 rounded text-sm font-medium">
                                    Open Assistant
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- User profile -->
            <div class="border-t border-gray-200 bg-[#E6BAA3]/10 p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-8 rounded-full" src="{{ asset('images/avatar-placeholder.jpg') }}" alt="User avatar">
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700">Admin User</p>
                        <button class="text-xs text-[#A94438] hover:text-[#D24545]">Sign out</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
