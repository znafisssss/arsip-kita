<!-- Frozen Clean Navbar -->
<nav x-data="{ open: false }" class="navbar-glass sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo & Navigation -->
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <svg class="w-7 h-7 text-sky-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L12 5M12 19L12 22M4.93 4.93L7.05 7.05M16.95 16.95L19.07 19.07M2 12L5 12M19 12L22 12M4.93 19.07L7.05 16.95M16.95 7.05L19.07 4.93M12 8C9.79 8 8 9.79 8 12C8 14.21 9.79 16 12 16C14.21 16 16 14.21 16 12C16 9.79 14.21 8 12 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none"/>
                    </svg>
                    <span class="text-xl font-bold text-sky-600">ArsipKu</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden sm:flex sm:items-center sm:ml-10 space-x-1">
                    <a href="{{ route('dashboard') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-sky-100 text-sky-700' : 'text-gray-600 hover:bg-sky-50 hover:text-sky-600' }}">
                        <span class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span>Dashboard</span>
                        </span>
                    </a>
                    
                    <a href="{{ route('archives.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('archives.*') && !request()->routeIs('archives.create') ? 'bg-sky-100 text-sky-700' : 'text-gray-600 hover:bg-sky-50 hover:text-sky-600' }}">
                        <span class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                            </svg>
                            <span>Arsip</span>
                        </span>
                    </a>
                    
                    <a href="{{ route('archives.create') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('archives.create') ? 'bg-sky-100 text-sky-700' : 'text-gray-600 hover:bg-sky-50 hover:text-sky-600' }}">
                        <span class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <span>Upload</span>
                        </span>
                    </a>
                </div>
            </div>

            <!-- Right Side: Profile & Logout -->
            <div class="hidden sm:flex sm:items-center space-x-3">
                <!-- Sparkle Accent -->
                <svg class="w-4 h-4 text-sky-300 sparkle" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 3L13.4 8.6L19 10L13.4 11.4L12 17L10.6 11.4L5 10L10.6 8.6L12 3Z"/>
                </svg>
                
                <!-- Profile Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-sky-50 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-sky-200 to-sky-300 flex items-center justify-center text-sky-700 font-semibold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="hidden md:block">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-48 rounded-xl bg-white shadow-lg border border-sky-100 py-1"
                         style="display: none;">
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-sky-50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-sky-50">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center sm:hidden">
                <button @click="open = !open" class="p-2 rounded-lg text-gray-500 hover:bg-sky-50">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" x-transition class="sm:hidden bg-white border-t border-sky-100">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-sky-100 text-sky-700' : 'text-gray-600' }}">
                Dashboard
            </a>
            <a href="{{ route('archives.index') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('archives.*') ? 'bg-sky-100 text-sky-700' : 'text-gray-600' }}">
                Arsip
            </a>
            <a href="{{ route('archives.create') }}" class="block px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('archives.create') ? 'bg-sky-100 text-sky-700' : 'text-gray-600' }}">
                Upload
            </a>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded-lg text-sm font-medium text-gray-600">
                Profil
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 rounded-lg text-sm font-medium text-gray-600">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>
