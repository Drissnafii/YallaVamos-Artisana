<header class="sticky top-0 z-50 w-full transition-transform duration-300" id="main-header">
    <nav class="bg-black/85 backdrop-blur-lg border-b border-white/10 transition-all duration-300" id="header-nav">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between transition-all duration-300" id="nav-container">
                <div class="flex items-center">
                    <a href="/" class="flex items-center group">
                        <img src="{{ asset('images/morocco-logo.svg') }}" alt="Morocco 2030" class="h-8 w-auto transition-transform duration-500 group-hover:rotate-12">
                        <span class="ml-2 text-lg font-semibold text-white transition-colors duration-300 hover:text-white/80">Morocco 2030</span>
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="flex items-center space-x-4 relative">
                        <!-- Hover Indicator -->
                        <div class="absolute rounded-md bg-white/20 transition-all duration-300 ease-out opacity-0 z-0" id="hover-indicator"></div>

                        <a href="{{ auth()->check() ? '/member' : '/' }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->is('/') || request()->is('member') ? 'text-white font-bold bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/5' }}">
                            Home
                        </a>
                        <a href="{{ auth()->check() ? '/member/cities' : '/cities' }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->is('cities*') || request()->is('member/cities*') ? 'text-white font-bold bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/5' }}">
                            Cities
                        </a>
                        <a href="{{ auth()->check() ? '/member/stadiums' : '/stadiums' }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->is('stadiums*') || request()->is('member/stadiums*') ? 'text-white font-bold bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/5' }}">
                            Stadiums
                        </a>
                        <a href="{{ auth()->check() ? '/member/match-schedule' : '/match-schedule' }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->is('match-schedule*') || request()->is('member/match-schedule*') ? 'text-white font-bold bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/5' }}">
                            Match Schedule
                        </a>
                        <a href="{{ auth()->check() ? '/member/travel' : '/travel' }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->is('travel*') || request()->is('member/travel*') ? 'text-white font-bold bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/5' }}">
                            Travel
                        </a>
                        <a href="{{ auth()->check() ? '/member/news' : '/news' }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->is('news*') || request()->is('member/news*') ? 'text-white font-bold bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/5' }}">
                            News
                        </a>
                        <a href="{{ auth()->check() ? '/member/favorites' : '/favorites' }}" class="nav-link px-3 py-2 rounded-md text-sm font-medium z-10 relative {{ request()->is('favorites*') || request()->is('member/favorites*') ? 'text-white font-bold bg-white/10' : 'text-white/80 hover:text-white hover:bg-white/5' }}">
                            Favorites
                        </a>
                        <!-- Login/Logout Button (Desktop) -->
                        <div class="ml-4 z-10">
                            @if(auth()->check())
                                <form method="POST" action="{{ route('logout') }}" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium text-white bg-white/10 backdrop-blur-sm border border-white/20 transition-colors duration-150 hover:bg-[#E9272E] hover:text-white">
                                        Logout
                                    </button>
                                </form>
                            @else
                                <a href="/login" class="inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium text-white bg-white/10 backdrop-blur-sm border border-white/20 transition-colors duration-150 hover:bg-[#E9272E] hover:text-white">
                                    Login
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center rounded-md p-2 text-white transition-transform duration-300 hover:rotate-90">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden overflow-hidden transition-all duration-500 max-h-0 bg-black/30 backdrop-blur-md">
            <div class="space-y-1 px-4 pb-3 pt-2">
                <a href="{{ auth()->check() ? '/member' : '/' }}" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->is('/') || request()->is('member') ? 'text-white font-bold bg-white/10' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Home
                </a>
                <a href="{{ auth()->check() ? '/member/cities' : '/cities' }}" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->is('cities*') || request()->is('member/cities*') ? 'text-white font-bold bg-white/10' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Cities
                </a>
                <a href="{{ auth()->check() ? '/member/stadiums' : '/stadiums' }}" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->is('stadiums*') || request()->is('member/stadiums*') ? 'text-white font-bold bg-white/10' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Stadiums
                </a>
                <a href="{{ auth()->check() ? '/member/match-schedule' : '/match-schedule' }}" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->is('match-schedule*') || request()->is('member/match-schedule*') ? 'text-white font-bold bg-white/10' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Match Schedule
                </a>
                <a href="{{ auth()->check() ? '/member/travel' : '/travel' }}" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->is('travel*') || request()->is('member/travel*') ? 'text-white font-bold bg-white/10' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Travel
                </a>
                <a href="{{ auth()->check() ? '/member/news' : '/news' }}" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->is('news*') || request()->is('member/news*') ? 'text-white font-bold bg-white/10' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    News
                </a>
                <a href="{{ auth()->check() ? '/member/favorites' : '/favorites' }}" class="block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300 {{ request()->is('favorites*') || request()->is('member/favorites*') ? 'text-white font-bold bg-white/10' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                    Favorites
                </a>
                <!-- Login/Logout Button (Mobile) -->
                <div class="mt-4">
                    @if(auth()->check())
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium text-white bg-white/10 backdrop-blur-sm border border-white/20 transition-colors duration-150 hover:bg-[#E9272E] hover:text-white">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="/login" class="inline-flex items-center justify-center rounded-md px-4 py-2 text-sm font-medium text-white bg-white/10 backdrop-blur-sm border border-white/20 transition-colors duration-150 hover:bg-[#E9272E] hover:text-white">
                            Login
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>
