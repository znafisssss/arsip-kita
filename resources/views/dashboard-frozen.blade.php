<x-app-frozen-layout>
    <x-slot name="header">
        Selamat Datang di Arsip Pribadimu
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Welcome Card -->
        <div class="soft-card rounded-2xl p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Halo, {{ Auth::user()->name }}!</h2>
                    <p class="text-gray-500 mt-1">Kelola arsip pribadimu dengan mudah dan aman.</p>
                </div>
                <div class="hidden md:flex items-center space-x-2">
                    <svg class="w-10 h-10 text-sky-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L12 5M12 19L12 22M4.93 4.93L7.05 7.05M16.95 16.95L19.07 19.07M2 12L5 12M19 12L22 12M4.93 19.07L7.05 16.95M16.95 7.05L19.07 4.93M12 8C9.79 8 8 9.79 8 12C8 14.21 9.79 16 12 16C14.21 16 16 14.21 16 12C16 9.79 14.21 8 12 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none"/>
                    </svg>
                    <svg class="w-4 h-4 text-sky-300 sparkle" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 3L13.4 8.6L19 10L13.4 11.4L12 17L10.6 11.4L5 10L10.6 8.6L12 3Z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total Arsip -->
            <div class="stat-card rounded-2xl p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-sky-600 uppercase tracking-wide">Total Arsip</p>
                        <p class="text-4xl font-bold text-gray-800 mt-2">{{ auth()->user()->archives()->count() }}</p>
                        <p class="text-sm text-gray-500 mt-1">file tersimpan</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-sky-100 flex items-center justify-center">
                        <svg class="w-7 h-7 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Arsip Terbaru -->
            <div class="stat-card rounded-2xl p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-sky-600 uppercase tracking-wide">Arsip Terbaru</p>
                        @php
                            $latestArchive = auth()->user()->archives()->latest()->first();
                        @endphp
                        @if($latestArchive)
                            <p class="text-lg font-bold text-gray-800 mt-2 truncate max-w-[150px]">{{ $latestArchive->title }}</p>
                            <p class="text-sm text-gray-500 mt-1">{{ $latestArchive->created_at->diffForHumans() }}</p>
                        @else
                            <p class="text-lg font-medium text-gray-400 mt-2">Belum ada arsip</p>
                        @endif
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 flex items-center justify-center">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Jenis File -->
            <div class="stat-card rounded-2xl p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-sky-600 uppercase tracking-wide">Kategori</p>
                        <p class="text-4xl font-bold text-gray-800 mt-2">{{ auth()->user()->archives()->distinct('category_id')->count('category_id') }}</p>
                        <p class="text-sm text-gray-500 mt-1">kategori digunakan</p>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-violet-100 flex items-center justify-center">
                        <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <a href="{{ route('archives.create') }}" class="soft-card rounded-2xl p-6 hover:shadow-lg hover:border-sky-300 transition-all group">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-xl bg-sky-100 flex items-center justify-center group-hover:bg-sky-200 transition-colors">
                        <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Upload Arsip Baru</h3>
                        <p class="text-sm text-gray-500">Tambahkan file ke penyimpananmu</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('archives.index') }}" class="soft-card rounded-2xl p-6 hover:shadow-lg hover:border-sky-300 transition-all group">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-xl bg-violet-100 flex items-center justify-center group-hover:bg-violet-200 transition-colors">
                        <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Lihat Semua Arsip</h3>
                        <p class="text-sm text-gray-500">Kelola koleksi arsipmu</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Recent Archives -->
        @php
            $recentArchives = auth()->user()->archives()->with('category')->latest()->take(5)->get();
        @endphp

        @if ($recentArchives->isNotEmpty())
            <div class="soft-card rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-sky-100">
                    <h3 class="text-lg font-semibold text-gray-800">Arsip Terbaru</h3>
                </div>
                <div class="divide-y divide-sky-50">
                    @foreach ($recentArchives as $archive)
                        <a href="{{ route('archives.show', $archive) }}" class="flex items-center justify-between px-6 py-4 hover:bg-sky-50/50 transition-colors">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-lg bg-sky-100 flex items-center justify-center">
                                    @if ($archive->isImage())
                                        <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    @elseif ($archive->isPdf())
                                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    @elseif ($archive->isVideo())
                                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $archive->title }}</p>
                                    <p class="text-sm text-gray-500">{{ $archive->category->name }} • {{ $archive->file_size_formatted }}</p>
                                </div>
                            </div>
                            <div class="text-sm text-gray-400">
                                {{ $archive->created_at->diffForHumans() }}
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <div class="soft-card rounded-2xl p-12 text-center">
                <svg class="w-16 h-16 text-sky-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum ada arsip</h3>
                <p class="text-gray-500 mb-6">Mulai dengan mengunggah arsip pertamamu!</p>
                <a href="{{ route('archives.create') }}" class="btn-frozen inline-flex items-center px-6 py-3 rounded-xl font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Upload Arsip
                </a>
            </div>
        @endif
    </div>
</x-app-frozen-layout>
