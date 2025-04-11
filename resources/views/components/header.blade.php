<header class="sticky top-0 z-50 w-full">
    <nav class="glass border-b border-border/40 bg-white/90 backdrop-blur-md">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('images/morocco-logo.svg') }}" alt="Morocco 2030" class="h-8 w-auto">
                        <span class="ml-2 text-lg font-semibold text-primary">Morocco 2030</span>
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="flex items-center space-x-4">
                        <a href="/" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('/') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Home
                        </a>
                        <a href="/cities" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('cities*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Cities
                        </a>
                        <a href="/stadiums" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('stadiums*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Stadiums
                        </a>
                        <a href="/match-schedule" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('match-schedule*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Match Schedule
                        </a>
                        <a href="/travel" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('travel*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Travel
                        </a>
                        <a href="/news" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('news*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            News
                        </a>
                        <a href="/favorites" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('favorites*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                            Favorites
                        </a>
                        <div class="ml-4">
                            <a href="/login" class="inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow hover:bg-primary/90">
                                Login
                            </a>
                        </div>
                    </div>
                </div>
                <div class="md:hidden">
                    <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center rounded-md p-2 text-foreground">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden">
            <div class="space-y-1 px-4 pb-3 pt-2">
                <a href="/" class="block px-3 py-2 rounded-md text-base font-medium {{ request() ->is('/') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                    Home
                </a>
                <a href="/cities" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('cities*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                    Cities
                </a>
                <a href="/stadiums" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('stadiums*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                    Stadiums
                </a>
                <a href="/match-schedule" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('match-schedule*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                    Match Schedule
                </a>
                <a href="/travel" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('travel*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                    Travel
                </a>
                <a href="/news" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('news*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                    News
                </a>
                <a href="/favorites" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('favorites*') ? 'text-primary' : 'text-foreground hover:text-primary' }}">
                    Favorites
                </a>
                <div class="mt-4">
                    <a href="/login" class="inline-flex w-full items-center justify-center rounded-md bg-primary px-4 py-2 text-base font-medium text-primary-foreground shadow hover:bg-primary/90">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
