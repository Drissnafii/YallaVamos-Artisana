<header class="sticky top-0 z-50 w-full transition-transform duration-300" id="main-header">
    <nav class="glass border-b border-border/40 bg-white/90 backdrop-blur-md transition-all duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between transition-all duration-300" id="nav-container">
                <div class="flex items-center">
                    <a href="{{ route('member.dashboard') }}" class="flex items-center group">
                        <img src="{{ asset('images/morocco-logo.svg') }}" alt="Morocco 2030" class="h-8 w-auto transition-transform duration-500 group-hover:rotate-12">
                        <span class="ml-2 text-lg font-semibold text-primary transition-colors duration-300 hover:text-primary/80">Morocco 2030</span>
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="flex items-center space-x-4 relative">
                        <!-- Hover Indicator -->
                        <div class="absolute rounded-md bg-[#FDE8E9]/40 transition-all duration-300 ease-out opacity-0 z-0" id="hover-indicator"></div>

                        <a href="{{ route('member.dashboard') }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->routeIs('member.dashboard') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('member.cities.index') }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->routeIs('member.cities*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Host Cities
                        </a>
                        <a href="{{ route('member.stadiums.index') }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->routeIs('member.stadiums*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Stadiums
                        </a>
                        <a href="{{ route('member.matches.index') }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->routeIs('member.matches*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Match Schedule
                        </a>
                        <a href="{{ route('member.articles.index') }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->routeIs('member.articles*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            My Articles
                        </a>
                        <a href="{{ route('member.travel.index') }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->routeIs('member.travel*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Travel
                        </a>
                        <a href="{{ route('member.favorites.index') }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->routeIs('member.favorites*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Favorites
                        </a>

                        <!-- Profile dropdown -->
                        <div class="ml-3 relative" x-data="{ open: false }">
                            <div>
                                <button @click="open = !open" type="button" class="flex items-center space-x-2 bg-white rounded-md py-1 pl-1 pr-3 border border-gray-300 hover:bg-[#FDE8E9]/40" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="h-7 w-7 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                                    <span class="text-sm font-medium text-gray-700 hidden sm:block">{{ Auth::user()->name }}</span>
                                </button>
                            </div>

                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1"
                                style="display: none;">

                                    <a href="{{ route('member.profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FDE8E9]/40" role="menuitem" tabindex="-1">
                                    Your Profile
                                </a>

                                <a href="{{ route('member.profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FDE8E9]/40" role="menuitem" tabindex="-1">
                                    Settings
                                </a>

                                <a href="/" class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#FDE8E9]/40" role="menuitem" tabindex="-1">
                                    Back to Website
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-[#FDE8E9]/40" role="menuitem" tabindex="-1">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center rounded-md p-2 text-foreground transition-transform duration-300 hover:rotate-90">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden overflow-hidden transition-all duration-500 max-h-0">
            <div class="space-y-1 px-4 pb-3 pt-2">
                <a href="{{ route('member.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->routeIs('member.dashboard') ? 'text-primary' : 'text-foreground hover:bg-[#FDE8E9]/40 hover:text-primary' }}">
                    Dashboard
                </a>
                <a href="{{ route('member.cities.index') }}" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->routeIs('member.cities*') ? 'text-primary' : 'text-foreground hover:bg-[#FDE8E9]/40 hover:text-primary' }}">
                    Host Cities
                </a>
                <a href="{{ route('member.stadiums.index') }}" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->routeIs('member.stadiums*') ? 'text-primary' : 'text-foreground hover:bg-[#FDE8E9]/40 hover:text-primary' }}">
                    Stadiums
                </a>
                <a href="{{ route('member.matches.index') }}" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->routeIs('member.matches*') ? 'text-primary' : 'text-foreground hover:bg-[#FDE8E9]/40 hover:text-primary' }}">
                    Match Schedule
                </a>
                <a href="{{ route('member.travel.index') }}" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->routeIs('member.travel*') ? 'text-primary' : 'text-foreground hover:bg-[#FDE8E9]/40 hover:text-primary' }}">
                    Transport Info
                </a>
                <a href="{{ route('member.articles.index') }}" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->routeIs('member.articles*') ? 'text-primary' : 'text-foreground hover:bg-[#FDE8E9]/40 hover:text-primary' }}">
                    My Articles
                </a>
                <a href="{{ route('member.favorites.index') }}" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->routeIs('member.favorites*') ? 'text-primary' : 'text-foreground hover:bg-[#FDE8E9]/40 hover:text-primary' }}">
                    Favorites
                </a>
            </div>

            <!-- Mobile user menu -->
            <div class="border-t border-gray-200 pt-4 pb-3 px-4">
                <!-- User information -->
                <div class="flex items-center mb-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <!-- User menu options -->
                <div class="space-y-1">
                    <a href="{{ route('member.profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-[#FDE8E9]/40">
                        Your Profile
                    </a>

                    <a href="{{ route('member.profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-[#FDE8E9]/40">
                        Settings
                    </a>

                    <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-[#FDE8E9]/40">
                        Back to Website
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:bg-[#FDE8E9]/40">
                            Sign out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>
