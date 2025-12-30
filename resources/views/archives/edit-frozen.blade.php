<x-app-frozen-layout>
    <x-slot name="header">
        Edit Arsip
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="soft-card rounded-2xl overflow-hidden">
            <form method="POST" action="{{ route('archives.update', $archive) }}">
                @csrf
                @method('PUT')

                <!-- Current File Preview -->
                <div class="p-6 bg-sky-50 border-b border-sky-100">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-white rounded-xl flex items-center justify-center shadow-sm">
                            @if ($archive->isImage())
                                <svg class="w-8 h-8 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            @elseif ($archive->isPdf())
                                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            @elseif ($archive->isVideo())
                                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            @else
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $archive->file_name }}</p>
                            <p class="text-sm text-gray-500">{{ strtoupper($archive->file_type) }} • {{ $archive->file_size_formatted }}</p>
                        </div>
                    </div>
                </div>

                <!-- Form Fields -->
                <div class="p-8 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Arsip <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title', $archive->title) }}"
                               class="w-full px-4 py-3 rounded-xl border border-sky-200 focus:border-sky-400 focus:ring focus:ring-sky-100 transition-all"
                               required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="category_id" 
                                id="category_id" 
                                class="w-full px-4 py-3 rounded-xl border border-sky-200 focus:border-sky-400 focus:ring focus:ring-sky-100 transition-all"
                                required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $archive->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi <span class="text-gray-400">(opsional)</span>
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="3"
                                  class="w-full px-4 py-3 rounded-xl border border-sky-200 focus:border-sky-400 focus:ring focus:ring-sky-100 transition-all resize-none"
                                  placeholder="Tambahkan catatan tentang arsip ini...">{{ old('description', $archive->description) }}</textarea>
                    </div>

                    <!-- Private Toggle -->
                    <div class="flex items-center justify-between p-4 bg-sky-50 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <div>
                                <p class="font-medium text-gray-700">Arsip Pribadi</p>
                                <p class="text-sm text-gray-500">Hanya kamu yang dapat melihat arsip ini</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_private" value="1" class="sr-only peer" {{ $archive->is_private ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-sky-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-sky-500"></div>
                        </label>
                    </div>
                </div>

                <!-- Submit -->
                <div class="px-8 py-4 bg-gray-50 border-t border-sky-100 flex items-center justify-between">
                    <a href="{{ route('archives.show', $archive) }}" class="text-gray-600 hover:text-gray-800 font-medium">
                        ← Batal
                    </a>
                    <button type="submit" class="btn-frozen px-6 py-3 rounded-xl font-medium inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-frozen-layout>
