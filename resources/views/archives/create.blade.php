<x-app-layout>
    <x-slot name="header">
        Upload New Archive ❄️
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card rounded-lg p-8">
                <form method="POST" action="{{ route('archives.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-white mb-2">Title *</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                            class="w-full px-4 py-2 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="e.g., KTP, Ijazah, Foto Keluarga">
                        @error('title')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-white mb-2">Description</label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full px-4 py-2 bg-white/10 border border-white/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            placeholder="Optional description...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-white mb-2">Category *</label>
                        <select id="category_id" name="category_id" required
                            class="w-full px-4 py-2 bg-white/10 border border-white/30 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Upload -->
                    <div>
                        <label for="file" class="block text-sm font-medium text-white mb-2">File * (Max 50MB)</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-white/30 border-dashed rounded-lg hover:border-blue-400 transition">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-blue-200" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-blue-100">
                                    <label for="file" class="relative cursor-pointer bg-white/10 rounded-md font-medium text-white hover:text-blue-200 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-400 px-3 py-1">
                                        <span>Upload a file</span>
                                        <input id="file" name="file" type="file" class="sr-only" required onchange="displayFileName(this)">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-blue-200">PDF, DOC, JPG, PNG, ZIP, MP4 up to 50MB</p>
                                <p id="file-name" class="text-sm text-white font-semibold mt-2"></p>
                            </div>
                        </div>
                        @error('file')
                            <p class="mt-1 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Privacy -->
                    <div class="flex items-center">
                        <input type="checkbox" id="is_private" name="is_private" value="1" checked
                            class="h-4 w-4 text-blue-500 focus:ring-blue-400 border-white/30 rounded bg-white/10">
                        <label for="is_private" class="ml-2 block text-sm text-white">
                            🔒 Keep this archive private (only you can access it)
                        </label>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-end gap-4 pt-4">
                        <a href="{{ route('archives.index') }}" class="px-6 py-2 border border-white/30 rounded-lg text-white hover:bg-white/10 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition">
                            Upload Archive ❄️
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function displayFileName(input) {
            const fileName = input.files[0]?.name;
            const fileNameDisplay = document.getElementById('file-name');
            if (fileName) {
                fileNameDisplay.textContent = fileName;
            }
        }
    </script>
</x-app-layout>
