<x-app-layout>
    <x-slot name="header">
        Archive Details ❄️
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 glass-card rounded-lg p-3 border-l-4 border-blue-400">
                    <p class="text-white font-semibold text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('archives.index') }}" class="inline-flex items-center text-white hover:text-blue-200 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Archives
                </a>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left: Preview (2/3) -->
                <div class="lg:col-span-2">
                    <div class="glass-card rounded-lg overflow-hidden">
                        <div class="bg-gradient-to-br from-blue-400 to-purple-500 p-4 flex items-center justify-center" style="max-height: calc(100vh - 200px);">
                            @if ($archive->isImage())
                                <img src="{{ route('archives.download', $archive) }}" alt="{{ $archive->title }}" class="max-w-full max-h-full object-contain rounded-lg">
                            @elseif ($archive->isPdf())
                                <div class="w-full h-full">
                                    <iframe src="{{ route('archives.download', $archive) }}" class="w-full rounded-lg" style="height: calc(100vh - 250px); min-height: 500px;" frameborder="0"></iframe>
                                </div>
                            @elseif ($archive->isVideo())
                                <video controls class="max-w-full rounded-lg" style="max-height: calc(100vh - 250px);" controlsList="nodownload">
                                    <source src="{{ route('archives.download', $archive) }}" type="video/{{ $archive->file_type }}">
                                    <p class="text-white">Your browser does not support the video tag.</p>
                                </video>
                            @else
                                <div class="text-center py-12">
                                    <svg class="w-24 h-24 text-white mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-white text-lg uppercase">{{ $archive->file_type }} File</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right: Details (1/3) -->
                <div class="lg:col-span-1">
                    <div class="glass-card rounded-lg p-6 sticky top-6">
                        <!-- Title -->
                        <h1 class="text-2xl font-bold text-white mb-3">{{ $archive->title }}</h1>
                        
                        <!-- Category & Metadata -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-blue-500 text-white rounded-full text-sm">{{ $archive->category->name }}</span>
                            @if ($archive->is_private)
                                <span class="px-3 py-1 bg-purple-500 text-white rounded-full text-sm">🔒 Private</span>
                            @endif
                        </div>

                        <!-- Description -->
                        @if ($archive->description)
                            <div class="mb-4 pb-4 border-b border-white/20">
                                <h3 class="text-sm font-semibold text-blue-200 uppercase mb-2">Description</h3>
                                <p class="text-white text-sm leading-relaxed">{{ $archive->description }}</p>
                            </div>
                        @endif

                        <!-- File Info -->
                        <div class="mb-4 pb-4 border-b border-white/20">
                            <h3 class="text-sm font-semibold text-blue-200 uppercase mb-3">File Information</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-blue-100">File Name:</span>
                                    <span class="text-white font-medium truncate ml-2" title="{{ $archive->file_name }}">{{ Str::limit($archive->file_name, 20) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-100">Type:</span>
                                    <span class="text-white font-medium">{{ strtoupper($archive->file_type) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-100">Size:</span>
                                    <span class="text-white font-medium">{{ $archive->file_size_formatted }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-100">Uploaded:</span>
                                    <span class="text-white font-medium">{{ $archive->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-100">Modified:</span>
                                    <span class="text-white font-medium">{{ $archive->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="space-y-2">
                            @if ($archive->isVideo() || $archive->isPdf())
                                <a href="{{ route('archives.forceDownload', $archive) }}" class="block w-full text-center px-4 py-2.5 bg-green-500 hover:bg-green-600 text-white rounded-lg transition font-medium text-sm">
                                    ⬇️ Download File
                                </a>
                            @else
                                <a href="{{ route('archives.download', $archive) }}" class="block w-full text-center px-4 py-2.5 bg-green-500 hover:bg-green-600 text-white rounded-lg transition font-medium text-sm">
                                    ⬇️ Download
                                </a>
                            @endif
                            <a href="{{ route('archives.edit', $archive) }}" class="block w-full text-center px-4 py-2.5 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition font-medium text-sm">
                                ✏️ Edit
                            </a>
                            <form method="POST" action="{{ route('archives.destroy', $archive) }}" class="w-full" onsubmit="return confirm('Are you sure you want to delete this archive?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg transition font-medium text-sm">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
