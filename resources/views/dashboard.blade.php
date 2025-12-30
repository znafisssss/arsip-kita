<x-app-layout>
    <x-slot name="hideSnowflakes">{{ true }}</x-slot>
    <x-slot name="header">
        Dashboard ❄️
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="mb-8 glass-card rounded-lg p-8 text-center">
                <h1 class="text-4xl font-bold text-white mb-2">Welcome to Frozen Archive! ❄️</h1>
                <p class="text-blue-100 text-lg">Your personal archive management system</p>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Archives -->
                <div class="glass-card rounded-lg p-6 hover:scale-105 transition-transform">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm uppercase tracking-wide mb-1">Total Archives</p>
                            <p class="text-4xl font-bold text-white">{{ auth()->user()->archives()->count() }}</p>
                        </div>
                        <div class="text-5xl">📦</div>
                    </div>
                </div>

                <!-- Total Categories -->
                <div class="glass-card rounded-lg p-6 hover:scale-105 transition-transform">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm uppercase tracking-wide mb-1">Categories Used</p>
                            <p class="text-4xl font-bold text-white">{{ auth()->user()->archives()->distinct('category_id')->count('category_id') }}</p>
                        </div>
                        <div class="text-5xl">📂</div>
                    </div>
                </div>

                <!-- Total Storage -->
                <div class="glass-card rounded-lg p-6 hover:scale-105 transition-transform">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm uppercase tracking-wide mb-1">Total Storage</p>
                            <p class="text-4xl font-bold text-white">{{ \App\Models\Archive::formatBytes(auth()->user()->archives()->sum('file_size')) }}</p>
                        </div>
                        <div class="text-5xl">💾</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Upload New Archive -->
                <a href="{{ route('archives.create') }}" class="glass-card rounded-lg p-8 hover:bg-white/30 transition group">
                    <div class="flex items-center">
                        <div class="text-5xl mr-4 group-hover:scale-110 transition">⬆️</div>
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-1">Upload Archive</h3>
                            <p class="text-blue-100">Add new files to your frozen storage</p>
                        </div>
                    </div>
                </a>

                <!-- View All Archives -->
                <a href="{{ route('archives.index') }}" class="glass-card rounded-lg p-8 hover:bg-white/30 transition group">
                    <div class="flex items-center">
                        <div class="text-5xl mr-4 group-hover:scale-110 transition">📚</div>
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-1">Browse Archives</h3>
                            <p class="text-blue-100">View and manage your collection</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Recent Archives -->
            @php
                $recentArchives = auth()->user()->archives()->with('category')->latest()->take(6)->get();
            @endphp

            @if ($recentArchives->isNotEmpty())
                <div class="glass-card rounded-lg p-6">
                    <h2 class="text-2xl font-bold text-white mb-6">Recent Archives ❄️</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach ($recentArchives as $archive)
                            <a href="{{ route('archives.show', $archive) }}" class="glass-card rounded-lg p-4 hover:bg-white/20 transition group">
                                <div class="flex items-start">
                                    <div class="text-3xl mr-3">
                                        @if ($archive->isImage())
                                            🖼️
                                        @elseif ($archive->isPdf())
                                            📄
                                        @elseif ($archive->isVideo())
                                            🎥
                                        @else
                                            📎
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-white font-semibold truncate group-hover:text-blue-200">{{ $archive->title }}</h3>
                                        <p class="text-blue-100 text-sm">{{ $archive->category->name }}</p>
                                        <p class="text-blue-200 text-xs mt-1">{{ $archive->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
