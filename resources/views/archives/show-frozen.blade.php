<x-app-frozen-layout>
    <x-slot name="header">
        Detail Arsip
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('archives.index') }}" class="inline-flex items-center text-gray-600 hover:text-sky-600 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Arsip
            </a>
        </div>

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

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left: Preview (2/3) -->
            <div class="lg:col-span-2">
                <div class="soft-card rounded-2xl overflow-hidden">
                    <div class="bg-gradient-to-br from-sky-100 to-sky-50 p-6 flex items-center justify-center" style="min-height: 400px; max-height: calc(100vh - 300px);">
                        @if ($archive->isImage())
                            <img src="{{ route('archives.download', $archive) }}" 
                                 alt="{{ $archive->title }}" 
                                 class="max-w-full max-h-full object-contain rounded-xl shadow-lg">
                        @elseif ($archive->isPdf())
                            <iframe src="{{ route('archives.download', $archive) }}" 
                                    class="w-full h-full rounded-xl" 
                                    style="min-height: 500px;" 
                                    frameborder="0"></iframe>
                        @elseif ($archive->isVideo())
                            <video controls 
                                   class="max-w-full max-h-full rounded-xl shadow-lg" 
                                   style="max-height: calc(100vh - 350px);"
                                   controlsList="nodownload">
                                <source src="{{ route('archives.download', $archive) }}" type="video/{{ $archive->file_type }}">
                                Browser tidak mendukung video.
                            </video>
                        @else
                            <div class="text-center py-12">
                                <svg class="w-20 h-20 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                                <p class="text-gray-600 text-lg uppercase font-medium">{{ $archive->file_type }} File</p>
                                <p class="text-gray-400 mt-2">Preview tidak tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right: Details (1/3) -->
            <div class="lg:col-span-1">
                <div class="soft-card rounded-2xl p-6 sticky top-24">
                    <!-- Title -->
                    <h1 class="text-2xl font-bold text-gray-800 mb-4">{{ $archive->title }}</h1>
                    
                    <!-- Category -->
                    <div class="flex items-center gap-2 mb-6">
                        <span class="px-3 py-1 bg-sky-100 text-sky-700 text-sm font-medium rounded-lg">
                            {{ $archive->category->name }}
                        </span>
                        @if ($archive->is_private)
                            <span class="px-3 py-1 bg-violet-100 text-violet-700 text-sm font-medium rounded-lg inline-flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Pribadi
                            </span>
                        @endif
                    </div>

                    <!-- Description -->
                    @if ($archive->description)
                        <div class="mb-6 pb-6 border-b border-sky-100">
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-2">Deskripsi</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $archive->description }}</p>
                        </div>
                    @endif

                    <!-- File Info -->
                    <div class="mb-6 pb-6 border-b border-sky-100">
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-3">Informasi File</h3>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Nama File</span>
                                <span class="text-gray-800 font-medium truncate ml-4" title="{{ $archive->file_name }}">
                                    {{ Str::limit($archive->file_name, 20) }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Tipe</span>
                                <span class="text-gray-800 font-medium uppercase">{{ $archive->file_type }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Ukuran</span>
                                <span class="text-gray-800 font-medium">{{ $archive->file_size_formatted }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Diupload</span>
                                <span class="text-gray-800 font-medium">{{ $archive->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="space-y-3">
                        @if ($archive->isVideo() || $archive->isPdf())
                            <a href="{{ route('archives.forceDownload', $archive) }}" 
                               class="w-full flex items-center justify-center px-4 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download
                            </a>
                        @else
                            <a href="{{ route('archives.download', $archive) }}" 
                               class="w-full flex items-center justify-center px-4 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download
                            </a>
                        @endif
                        
                        <a href="{{ route('archives.edit', $archive) }}" 
                           class="w-full flex items-center justify-center px-4 py-3 bg-sky-500 hover:bg-sky-600 text-white rounded-xl font-medium transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit
                        </a>
                        
                        <form method="POST" action="{{ route('archives.destroy', $archive) }}" onsubmit="return confirm('Yakin ingin menghapus arsip ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full flex items-center justify-center px-4 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-medium transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-frozen-layout>
