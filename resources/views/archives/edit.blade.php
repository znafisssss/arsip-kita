<x-app-layout>
    <x-slot name="header">
        Edit Archive ❄️
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card rounded-lg p-8">
                <form method="POST" action="{{ route('archives.update', $archive) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-white mb-2">Title *</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $archive->title) }}" required
                            class="w-full px-4 py-2 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        @error('title')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-white mb-2">Description</label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full px-4 py-2 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description', $archive->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-white mb-2">Category *</label>
                        <select id="category_id" name="category_id" required
                            class="w-full px-4 py-2 bg-white/10 border border-white/30 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $archive->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current File Info -->
                    <div class="bg-white/10 rounded-lg p-4 border border-white/30">
                        <h3 class="text-white font-semibold mb-2">Current File</h3>
                        <p class="text-blue-100 text-sm">📎 {{ $archive->file_name }}</p>
                        <p class="text-blue-100 text-sm">📦 {{ $archive->file_size_formatted }}</p>
                        <p class="text-blue-100 text-sm mt-2 italic">Note: File cannot be changed. Upload a new archive if you need a different file.</p>
                    </div>

                    <!-- Privacy -->
                    <div class="flex items-center">
                        <input type="checkbox" id="is_private" name="is_private" value="1" {{ old('is_private', $archive->is_private) ? 'checked' : '' }}
                            class="h-4 w-4 text-blue-500 focus:ring-blue-400 border-white/30 rounded bg-white/10">
                        <label for="is_private" class="ml-2 block text-sm text-white">
                            🔒 Keep this archive private (only you can access it)
                        </label>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-4 pt-4">
                        <a href="{{ route('archives.show', $archive) }}" class="px-6 py-2 border border-white/30 rounded-lg text-white hover:bg-white/10 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition">
                            Update Archive ❄️
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
