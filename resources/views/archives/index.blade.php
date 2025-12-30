<x-app-layout>
    <x-slot name="header">
        My Frozen Archives ❄️
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 glass-card rounded-lg p-4 border-l-4 border-blue-400">
                    <p class="text-white font-semibold">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Search Bar -->
            <div class="mb-6">
                <form action="{{ route('archives.index') }}" method="GET" class="relative">
                    <div class="flex gap-2">
                        <div class="flex-1 relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Search archives by title or description..." class="w-full px-6 py-4 glass-card rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                            @if(request('search'))
                                <a href="{{ route('archives.index') }}" class="absolute right-4 top-1/2 -translate-y-1/2 text-blue-200 hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            @endif
                        </div>
                        <button type="submit" class="px-6 py-4 glass-card rounded-lg text-white font-semibold hover:bg-white/30 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                    @if(request('search'))
                        <p class="text-blue-100 text-sm mt-2">Found {{ $archives->total() }} result(s) for "{{ request('search') }}"</p>
                    @endif
                </form>
            </div>

            <!-- Upload Button & Category Filter -->
            <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <a href="{{ route('archives.create') }}" class="inline-flex items-center px-6 py-3 glass-card rounded-lg text-white font-semibold hover:bg-white/30 transition duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Upload New Archive
                </a>

                <!-- Category Filter -->
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('archives.index') }}" class="px-4 py-2 glass-card rounded-lg text-white text-sm hover:bg-white/30 transition {{ !isset($category) ? 'bg-white/30' : '' }}">
                        All
                    </a>
                    @foreach ($categories as $cat)
                        <a href="{{ route('archives.category', $cat) }}" class="px-4 py-2 glass-card rounded-lg text-white text-sm hover:bg-white/30 transition {{ isset($category) && $category->id === $cat->id ? 'bg-white/30' : '' }}">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Archives Grid -->
            @if ($archives->isEmpty())
                <div class="glass-card rounded-lg p-12 text-center">
                    <div class="text-6xl mb-4">📦</div>
                    <h3 class="text-2xl font-semibold text-white mb-2">No Archives Yet</h3>
                    <p class="text-blue-100 mb-6">Start by uploading your first frozen archive!</p>
                    <a href="{{ route('archives.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition">
                        Upload Archive
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($archives as $archive)
                        <div class="glass-card rounded-lg overflow-hidden hover:scale-105 transition-transform duration-300">
                            <!-- Preview -->
                            <div class="h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center relative overflow-hidden">
                                @if ($archive->isImage())
                                    <img src="{{ route('archives.download', $archive) }}" alt="{{ $archive->title }}" class="w-full h-full object-cover">
                                @elseif ($archive->isPdf())
                                    <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                                    </svg>
                                @elseif ($archive->isVideo())
                                    <div class="relative w-full h-full group">
                                        <video class="w-full h-full object-cover" muted loop preload="metadata">
                                            <source src="{{ route('archives.download', $archive) }}#t=0.1" type="video/{{ $archive->file_type }}">
                                        </video>
                                        <div class="absolute inset-0 flex flex-col items-center justify-center bg-black/40 group-hover:bg-black/50 transition">
                                            <svg class="w-16 h-16 text-white opacity-90" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"></path>
                                            </svg>
                                            <span class="text-white text-xs mt-2 opacity-90">🎬 Video</span>
                                        </div>
                                    </div>
                                @else
                                    <svg class="w-20 h-20 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                            </div>

                            <!-- Info -->
                            <div class="p-4">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="text-lg font-semibold text-white truncate flex-1">{{ $archive->title }}</h3>
                                    <span class="ml-2 px-2 py-1 bg-blue-500 text-white text-xs rounded-full">{{ $archive->category->name }}</span>
                                </div>
                                
                                @if ($archive->description)
                                    <p class="text-blue-100 text-sm mb-3 line-clamp-2">{{ $archive->description }}</p>
                                @endif

                                <div class="flex items-center justify-between text-sm text-blue-100 mb-4">
                                    <span>{{ $archive->file_size_formatted }}</span>
                                    <span>{{ $archive->created_at->diffForHumans() }}</span>
                                </div>

                                <!-- Actions -->
                                <div class="flex gap-2">
                                    <a href="{{ route('archives.show', $archive) }}" class="flex-1 text-center px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-sm transition">
                                        {{ $archive->isVideo() ? 'Play' : 'View' }}
                                    </a>
                                    @if ($archive->isVideo() || $archive->isPdf())
                                        <a href="{{ route('archives.forceDownload', $archive) }}" class="flex-1 text-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg text-sm transition">
                                            Download
                                        </a>
                                    @else
                                        <a href="{{ route('archives.download', $archive) }}" class="flex-1 text-center px-3 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg text-sm transition">
                                            Download
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $archives->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
