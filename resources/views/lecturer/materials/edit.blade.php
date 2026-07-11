@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-gray-50">

        {{-- Background Blur --}}
        <div class="fixed top-0 left-0 w-72 h-72 bg-blue-200 opacity-20 rounded-full blur-3xl -z-10">
        </div>

        <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 opacity-30 rounded-full blur-3xl -z-10">
        </div>

        <div class="max-w-5xl mx-auto px-6 lg:px-8 py-8">

            {{-- Header --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8 mb-8">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    {{-- Left --}}
                    <div class="flex items-start gap-5">

                        <div
                            class="w-20 h-20 rounded-3xl bg-orange-100 text-orange-600 flex items-center justify-center text-3xl shrink-0">

                            <i class="fa-solid fa-pen-to-square"></i>

                        </div>

                        <div>

                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-50 text-orange-700 text-sm font-medium border border-orange-100 mb-5">

                                <i class="fa-solid fa-book-open"></i>

                                Material Management

                            </div>

                            <h1 class="text-3xl font-bold text-gray-900">

                                Edit Materi

                            </h1>

                            <p class="text-gray-500 mt-3 text-base">

                                Perbarui informasi materi untuk mata kuliah
                                <span class="font-semibold text-gray-700">
                                    {{ $course->title }}
                                </span>

                            </p>

                        </div>

                    </div>

                    {{-- Back --}}
                    <div>

                        <a href="{{ route('lecturer.courses.show', $course) }}"
                            class="inline-flex items-center gap-2 px-5 py-3 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-2xl transition">

                            <i class="fa-solid fa-arrow-left"></i>

                            Kembali

                        </a>

                    </div>

                </div>

            </div>

            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="mb-6 p-5 rounded-2xl border border-red-200 bg-red-50 text-red-700">

                    <div class="flex items-start gap-4">

                        <div class="text-xl mt-0.5">

                            <i class="fa-solid fa-circle-xmark"></i>

                        </div>

                        <div>

                            <h3 class="font-semibold">
                                Terjadi Kesalahan
                            </h3>

                            <ul class="mt-2 space-y-1 text-sm">

                                @foreach ($errors->all() as $error)
                                    <li>
                                        • {{ $error }}
                                    </li>
                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>
            @endif

            {{-- Form Card --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="px-8 py-6 border-b border-gray-100">

                    <div class="flex items-center gap-3">

                        <div
                            class="w-14 h-14 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-xl">

                            <i class="fa-solid fa-book"></i>

                        </div>

                        <div>

                            <h2 class="text-2xl font-bold text-gray-900">

                                Form Edit Materi

                            </h2>

                            <p class="text-gray-500 mt-1">

                                Perbarui informasi materi di bawah ini.

                            </p>

                        </div>

                    </div>

                </div>

                {{-- Form --}}
                <form action="{{ route('lecturer.materials.update', [$course, $material]) }}" method="POST" enctype="multipart/form-data"
                    class="p-8 space-y-8">

                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div>

                        <label for="title" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">

                            <i class="fa-solid fa-heading text-blue-600"></i>

                            Judul Materi

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" id="title" name="title" value="{{ old('title', $material->title) }}"
                            placeholder="Contoh: Pengenalan Laravel"
                            class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition bg-gray-50 text-gray-900 placeholder-gray-400
                            @error('title') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                            required>

                        @error('title')
                            <p class="mt-2 text-sm text-red-500 flex items-center gap-2">

                                <i class="fa-solid fa-circle-exclamation"></i>

                                {{ $message }}

                            </p>
                        @enderror

                    </div>

                    {{-- Content --}}
                    <div>

                        <label for="content" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">

                            <i class="fa-solid fa-align-left text-orange-600"></i>

                            Isi Materi

                        </label>

                        <textarea id="content" name="content" rows="7" placeholder="Tuliskan isi materi di sini..."
                            class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition bg-gray-50 text-gray-900 placeholder-gray-400 resize-none
                            @error('content') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror">{{ old('content', $material->content) }}</textarea>

                        @error('content')
                            <p class="mt-2 text-sm text-red-500 flex items-center gap-2">

                                <i class="fa-solid fa-circle-exclamation"></i>

                                {{ $message }}

                            </p>
                        @enderror

                    </div>

                    {{-- File Upload --}}
                    <div>

                        <label for="file" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">
                            <i class="fa-solid fa-paperclip text-green-600"></i>
                            Lampiran File
                            <span class="text-gray-400 text-xs">
                                (Opsional, upload untuk menambahkan file baru)
                            </span>
                        </label>

                        @if(!empty($material->files))
                            <div class="mb-5 p-5 bg-orange-50/50 rounded-2xl border border-orange-100">
                                <p class="text-sm font-semibold text-gray-700 mb-4 border-b border-orange-200 pb-2">Daftar File Saat Ini:</p>
                                <div class="space-y-3">
                                    @foreach($material->files as $index => $file)
                                        <div class="flex items-center justify-between bg-white p-3 rounded-xl border border-gray-100 shadow-sm" id="file-row-{{ $index }}">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center text-lg">
                                                    <i class="fa-solid fa-file-lines"></i>
                                                </div>
                                                <div>
                                                    <a href="{{ Storage::url($file) }}" target="_blank" class="text-sm font-semibold text-gray-800 hover:text-orange-600 hover:underline">
                                                        {{ basename($file) }}
                                                    </a>
                                                </div>
                                            </div>
                                            <button type="button" onclick="deleteFile('{{ $file }}', 'file-row-{{ $index }}')" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 flex items-center justify-center transition" title="Hapus File">
                                                <i class="fa-solid fa-trash-can text-sm"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="deleted-files-container"></div>
                            </div>
                        @endif

                        <div id="dropzone"
                            class="border-2 border-dashed border-gray-300 rounded-3xl bg-gray-50 hover:border-orange-400 transition relative">

                            <label for="file"
                                class="flex flex-col items-center justify-center py-14 px-6 cursor-pointer w-full h-full">

                                <div id="icon-container"
                                    class="w-20 h-20 rounded-3xl bg-orange-100 text-orange-600 flex items-center justify-center text-3xl mb-5 transition-transform duration-300">
                                    <i class="fa-solid fa-cloud-arrow-up"></i>
                                </div>

                                <h3 id="upload-title" class="text-lg font-semibold text-gray-900">
                                    Upload File Materi Baru
                                </h3>

                                <p id="upload-desc" class="text-sm text-gray-500 mt-2 text-center max-w-md">
                                    Drag & drop file atau klik untuk memilih file.
                                    Mendukung PDF, PPTX, DOCX, dan lainnya.
                                </p>
                                
                                <div id="file-display" class="hidden flex flex-col items-center justify-center">
                                    <div class="flex items-center gap-2 px-4 py-2 bg-green-50 text-green-700 rounded-xl border border-green-200 mt-2">
                                        <i class="fa-solid fa-circle-check"></i>
                                        <span id="file-name" class="font-semibold text-sm text-center"></span>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-3">Klik atau drag untuk mengganti file</p>
                                </div>

                                <input type="file" id="file" name="file[]" class="hidden" multiple>

                            </label>

                        </div>

                        @error('file')
                            <p class="mt-2 text-sm text-red-500 flex items-center gap-2">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">

                        {{-- Submit --}}
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 bg-orange-600 hover:bg-orange-700 text-white rounded-2xl transition shadow-lg shadow-orange-100 font-semibold">

                            <i class="fa-solid fa-floppy-disk"></i>

                            Perbarui Materi

                        </button>

                        {{-- Cancel --}}
                        <a href="{{ route('lecturer.courses.show', $course) }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-2xl transition font-semibold">

                            <i class="fa-solid fa-xmark"></i>

                            Batal

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script>
        function deleteFile(filePath, rowId) {
            if (confirm('Hapus file ini? File akan terhapus saat Anda menyimpan perubahan.')) {
                document.getElementById(rowId).style.display = 'none';
                
                const container = document.getElementById('deleted-files-container');
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'delete_files[]';
                input.value = filePath;
                container.appendChild(input);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const dropzone = document.getElementById('dropzone');
            const fileInput = document.getElementById('file');
            const fileDisplay = document.getElementById('file-display');
            const fileName = document.getElementById('file-name');
            const uploadTitle = document.getElementById('upload-title');
            const uploadDesc = document.getElementById('upload-desc');
            const iconContainer = document.getElementById('icon-container');

            // Prevent default drag behaviors
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Highlight dropzone when item is dragged over it
            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                dropzone.classList.add('border-orange-500', 'bg-orange-50/50');
                iconContainer.classList.add('scale-110');
            }

            function unhighlight(e) {
                dropzone.classList.remove('border-orange-500', 'bg-orange-50/50');
                iconContainer.classList.remove('scale-110');
            }

            // Handle dropped files
            dropzone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                if (files.length > 0) {
                    fileInput.files = files;
                    updateFileDisplay(files);
                }
            }

            // Handle file input change (click to select)
            fileInput.addEventListener('change', function(e) {
                if (this.files && this.files.length > 0) {
                    updateFileDisplay(this.files);
                }
            });

            function updateFileDisplay(files) {
                uploadTitle.classList.add('hidden');
                uploadDesc.classList.add('hidden');
                fileDisplay.classList.remove('hidden');
                
                if (files.length === 1) {
                    fileName.textContent = files[0].name;
                } else {
                    fileName.textContent = files.length + ' file terpilih';
                }
                
                iconContainer.innerHTML = '<i class="fa-solid fa-file-circle-check"></i>';
                iconContainer.classList.remove('bg-orange-100', 'text-orange-600');
                iconContainer.classList.add('bg-green-100', 'text-green-600');
            }
        });
    </script>

@endsection
