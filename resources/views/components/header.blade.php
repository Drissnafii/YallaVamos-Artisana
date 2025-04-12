<header class="sticky top-0 z-50 w-full transition-transform duration-300" id="main-header">
    <nav class="glass border-b border-border/40 bg-white/90 backdrop-blur-md transition-all duration-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between transition-all duration-300" id="nav-container">
                <div class="flex items-center">
                    <a href="/" class="flex items-center group">
                        <img src="{{ asset('images/morocco-logo.svg') }}" alt="Morocco 2030" class="h-8 w-auto transition-transform duration-500 group-hover:rotate-12">
                        <span class="ml-2 text-lg font-semibold text-primary transition-colors duration-300 hover:text-primary/80">Morocco 2030</span>
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="flex items-center space-x-4 relative">
                        <!-- Hover Indicator -->
                        <div class="absolute rounded-md bg-[#FDE8E9]/40 transition-all duration-300 ease-out opacity-0 z-0" id="hover-indicator"></div>

                        <a href="/" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->is('/') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Home
                        </a>
                        <a href="/cities" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->is('cities*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Cities
                        </a>
                        <a href="/stadiums" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->is('stadiums*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Stadiums
                        </a>
                        <a href="/match-schedule" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->is('match-schedule*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Match Schedule
                        </a>
                        <a href="/travel" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->is('travel*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Travel
                        </a>
                        <a href="/news" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->is('news*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            News
                        </a>
                        <a href="/favorites" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->is('favorites*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Favorites
                        </a>
                        <!-- Modified Login Button (Desktop) -->
                        <div class="ml-4 z-10">
                            <a href="/login" class="inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 transition-colors duration-150 hover:bg-[#E9272E] hover:text-white">
                                Login
                            </a>
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
                <a href="/" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->is('/') ? 'text-primary' : 'text-foreground hover:bg-[#FDE8E9]/40 hover:text-primary' }}">
                    Home
                </a>
                <a href="/cities" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->is('cities*') ? 'text-primary' : 'text-foreground hover:bg-[#FDE8E9]/40 hover:text-primary' }}">
                    Cities
                </a>
                <a href="/stadiums" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->is('stadiums*') ? 'text-primary' : 'text-foreground hover:bg-[#FDE8E9]/40 hover:text-primary' }}">
                    Stadiums
                </a>
                <a href="/match-schedule" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->is('match-schedule*') ? 'text-primary' : 'text-foreground hover:bg-[#FDE8E9]/40 hover:text-primary' }}">
                    Match Schedule
                </a>
                <a href="/travel" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->is('travel*') ? 'text-primary' : 'text-foreground hover:bg-[#FDE8E9]/40 hover:text-primary' }}">
                    Travel
                </a>
                <a href="/news" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->is('news*') ? 'text-primary' : 'text-foreground hover:bg-[#FDE8E9]/40 hover:text-primary' }}">
                    News
                </a>
                <a href="/favorites" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->is('favorites*') ? 'text-primary' : 'text-foreground hover:bg-[#FDE8E9]/40 hover:text-primary' }}">
                    Favorites
                </a>
            </div>
            <!-- Modified Login Button (Mobile) -->
            <div class="ml-4 z-10">
                <a href="/login" class="inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 transition-colors duration-150 hover:bg-[#E9272E] hover:text-white">
                    Login
                </a>
            </div>
        </div>
    </nav>
</header>
