<x-app-frozen-layout>
    <x-slot name="header">
        Upload Arsip Baru
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="soft-card rounded-2xl overflow-hidden">
            <form method="POST" action="{{ route('archives.store') }}" enctype="multipart/form-data" id="upload-form">
                @csrf
                
                <!-- Upload Zone -->
                <div class="p-8">
                    <div class="upload-zone rounded-2xl p-12 text-center cursor-pointer transition-all"
                         id="upload-zone"
                         onclick="document.getElementById('file-input').click()">
                        <div class="flex flex-col items-center">
                            <!-- Cloud Snow Icon -->
                            <div class="relative mb-6">
                                <svg class="w-16 h-16 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                            </div>
                            
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">
                                Drag & drop file di sini
                            </h3>
                            <p class="text-gray-500 mb-4">atau klik untuk memilih file</p>
                            
                            <p class="text-sm text-gray-400">
                                PDF, DOC, JPG, PNG, ZIP, MP4 (Max: 50MB)
                            </p>
                        </div>
                        
                        <input type="file" 
                               name="file" 
                               id="file-input" 
                               class="hidden" 
                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.gif,.zip,.rar,.mp4,.mov,.webm"
                               required>
                    </div>
                    
                    <!-- File Preview -->
                    <div id="file-preview" class="hidden mt-4 p-4 bg-sky-50 rounded-xl">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center">
                                    <svg id="file-icon" class="w-5 h-5 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p id="file-name" class="font-medium text-gray-800"></p>
                                    <p id="file-size" class="text-sm text-gray-500"></p>
                                </div>
                            </div>
                            <button type="button" id="remove-file" class="text-gray-400 hover:text-red-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    @error('file')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Fields -->
                <div class="px-8 pb-8 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Arsip <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="title" 
                               id="title" 
                               value="{{ old('title') }}"
                               class="w-full px-4 py-3 rounded-xl border border-sky-200 focus:border-sky-400 focus:ring focus:ring-sky-100 transition-all"
                               placeholder="Contoh: Sertifikat Kelulusan 2024"
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
                            <option value="">Pilih kategori...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                  placeholder="Tambahkan catatan tentang arsip ini...">{{ old('description') }}</textarea>
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
                            <input type="checkbox" name="is_private" value="1" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-sky-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-sky-500"></div>
                        </label>
                    </div>
                </div>

                <!-- Submit -->
                <div class="px-8 py-4 bg-gray-50 border-t border-sky-100 flex items-center justify-between">
                    <a href="{{ route('archives.index') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                        ← Kembali
                    </a>
                    <button type="submit" class="btn-frozen px-6 py-3 rounded-xl font-medium inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        Upload Arsip
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript for Drag & Drop -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const uploadZone = document.getElementById('upload-zone');
            const fileInput = document.getElementById('file-input');
            const filePreview = document.getElementById('file-preview');
            const fileName = document.getElementById('file-name');
            const fileSize = document.getElementById('file-size');
            const fileIcon = document.getElementById('file-icon');
            const removeFile = document.getElementById('remove-file');

            // Drag & Drop handlers
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                uploadZone.addEventListener(eventName, () => {
                    uploadZone.classList.add('dragover');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                uploadZone.addEventListener(eventName, () => {
                    uploadZone.classList.remove('dragover');
                }, false);
            });

            uploadZone.addEventListener('drop', (e) => {
                const files = e.dataTransfer.files;
                if (files.length) {
                    fileInput.files = files;
                    showFilePreview(files[0]);
                }
            });

            fileInput.addEventListener('change', (e) => {
                if (e.target.files.length) {
                    showFilePreview(e.target.files[0]);
                }
            });

            // SVG icons for different file types
            const fileIcons = {
                image: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>',
                pdf: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>',
                video: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>',
                archive: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>',
                doc: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>',
                default: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>'
            };
            
            const fileColors = {
                image: 'text-sky-600',
                pdf: 'text-red-500',
                video: 'text-purple-500',
                archive: 'text-amber-500',
                doc: 'text-blue-600',
                default: 'text-gray-500'
            };

            function showFilePreview(file) {
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                
                // Set icon based on file type
                const ext = file.name.split('.').pop().toLowerCase();
                let iconType = 'default';
                
                if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
                    iconType = 'image';
                } else if (ext === 'pdf') {
                    iconType = 'pdf';
                } else if (['mp4', 'mov', 'webm'].includes(ext)) {
                    iconType = 'video';
                } else if (['zip', 'rar'].includes(ext)) {
                    iconType = 'archive';
                } else if (['doc', 'docx'].includes(ext)) {
                    iconType = 'doc';
                }
                
                fileIcon.innerHTML = fileIcons[iconType];
                fileIcon.className = 'w-5 h-5 ' + fileColors[iconType];

                uploadZone.classList.add('hidden');
                filePreview.classList.remove('hidden');
            }

            removeFile.addEventListener('click', () => {
                fileInput.value = '';
                filePreview.classList.add('hidden');
                uploadZone.classList.remove('hidden');
            });

            function formatFileSize(bytes) {
                if (bytes >= 1073741824) return (bytes / 1073741824).toFixed(2) + ' GB';
                if (bytes >= 1048576) return (bytes / 1048576).toFixed(2) + ' MB';
                if (bytes >= 1024) return (bytes / 1024).toFixed(2) + ' KB';
                return bytes + ' B';
            }
        });
    </script>
</x-app-frozen-layout>
