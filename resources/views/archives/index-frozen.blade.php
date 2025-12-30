<x-app-frozen-layout>
    <x-slot name="header">
        Arsip Saya
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 rounded-xl p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <!-- Search -->
            <form action="{{ route('archives.index') }}" method="GET" class="flex-1 max-w-md">
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Cari arsip..."
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-sky-200 focus:border-sky-400 focus:ring focus:ring-sky-100 transition-all">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </form>

            <!-- Upload Button -->
            <a href="{{ route('archives.create') }}" class="btn-frozen inline-flex items-center px-5 py-2.5 rounded-xl font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Upload Arsip
            </a>
        </div>

        <!-- Category Filter -->
        <div class="flex flex-wrap gap-2 mb-6">
            <a href="{{ route('archives.index') }}" 
               class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ !isset($category) ? 'bg-sky-500 text-white' : 'bg-white text-gray-600 border border-sky-200 hover:bg-sky-50' }}">
                Semua
            </a>
            @foreach ($categories as $cat)
                <a href="{{ route('archives.category', $cat) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ isset($category) && $category->id === $cat->id ? 'bg-sky-500 text-white' : 'bg-white text-gray-600 border border-sky-200 hover:bg-sky-50' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>

        <!-- Search Results -->
        @if(request('search'))
            <p class="text-gray-500 text-sm mb-4">
                Ditemukan {{ $archives->total() }} hasil untuk "{{ request('search') }}"
            </p>
        @endif

        <!-- Archives Table -->
        @if ($archives->isEmpty())
            <div class="soft-card rounded-2xl p-12 text-center">
                <svg class="w-16 h-16 text-sky-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Tidak ada arsip</h3>
                <p class="text-gray-500 mb-6">
                    @if(request('search'))
                        Tidak ditemukan arsip dengan kata kunci tersebut.
                    @else
                        Mulai dengan mengunggah arsip pertamamu!
                    @endif
                </p>
                <a href="{{ route('archives.create') }}" class="btn-frozen inline-flex items-center px-6 py-3 rounded-xl font-medium">
                    Upload Arsip
                </a>
            </div>
        @else
            <div class="soft-card rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full frozen-table">
                        <thead>
                            <tr>
                                <th class="px-6 py-4 text-left">Nama Arsip</th>
                                <th class="px-6 py-4 text-left">Jenis File</th>
                                <th class="px-6 py-4 text-left">Kategori</th>
                                <th class="px-6 py-4 text-left">Tanggal</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($archives as $archive)
                                <tr class="group">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 rounded-lg bg-sky-100 flex items-center justify-center flex-shrink-0">
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
                                                <p class="text-sm text-gray-500">{{ $archive->file_size_formatted }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded uppercase">
                                            {{ $archive->file_type }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-gray-600">{{ $archive->category->name }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-gray-500 text-sm">{{ $archive->created_at->format('d M Y') }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center space-x-1">
                                            <!-- View -->
                                            <a href="{{ route('archives.show', $archive) }}" class="icon-btn text-sky-600" title="Lihat">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                            
                                            <!-- Download -->
                                            <a href="{{ route('archives.forceDownload', $archive) }}" class="icon-btn text-emerald-600" title="Download">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                                </svg>
                                            </a>
                                            
                                            <!-- Edit -->
                                            <a href="{{ route('archives.edit', $archive) }}" class="icon-btn text-amber-600" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            
                                            <!-- Delete -->
                                            <form method="POST" action="{{ route('archives.destroy', $archive) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus arsip ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="icon-btn text-red-600" title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($archives->hasPages())
                    <div class="px-6 py-4 border-t border-sky-100">
                        {{ $archives->links() }}
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-app-frozen-layout>
