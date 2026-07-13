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
                            class="w-20 h-20 rounded-3xl bg-purple-100 text-purple-600 flex items-center justify-center text-3xl shrink-0">

                            <i class="fa-solid fa-file-circle-plus"></i>

                        </div>

                        <div>

                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-50 text-purple-700 text-sm font-medium border border-purple-100 mb-5">

                                <i class="fa-solid fa-file-pen"></i>

                                Assignment Management

                            </div>

                            <h1 class="text-3xl font-bold text-gray-900">

                                Tambah Tugas

                            </h1>

                            <p class="text-gray-500 mt-3 text-base">

                                Buat tugas baru untuk mahasiswa pada mata kuliah
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
                            class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-xl">

                            <i class="fa-solid fa-file-lines"></i>

                        </div>

                        <div>

                            <h2 class="text-2xl font-bold text-gray-900">

                                Form Tambah Tugas

                            </h2>

                            <p class="text-gray-500 mt-1">

                                Lengkapi informasi berikut untuk membuat assignment baru.

                            </p>

                        </div>

                    </div>

                </div>

                {{-- Form --}}
                <form action="{{ route('lecturer.assignments.store', $course) }}" method="POST" enctype="multipart/form-data"
                    class="p-8 space-y-8">

                    @csrf

                    {{-- Title --}}
                    <div>

                        <label for="title" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">

                            <i class="fa-solid fa-heading text-blue-600"></i>

                            Judul Tugas

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            placeholder="Contoh: Tugas Laravel CRUD"
                            class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition bg-gray-50 text-gray-900 placeholder-gray-400
                            @error('title') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                            required>

                        @error('title')
                            <p class="mt-2 text-sm text-red-500 flex items-center gap-2">

                                <i class="fa-solid fa-circle-exclamation"></i>

                                {{ $message }}

                            </p>
                        @enderror

                    </div>

                    {{-- Description --}}
                    <div>

                        <label for="description" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">

                            <i class="fa-solid fa-align-left text-purple-600"></i>

                            Deskripsi Tugas

                        </label>

                        <textarea id="description" name="description" rows="7" placeholder="Jelaskan detail tugas untuk student..."
                            class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition bg-gray-50 text-gray-900 placeholder-gray-400 resize-none
                            @error('description') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror">{{ old('description') }}</textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-500 flex items-center gap-2">

                                <i class="fa-solid fa-circle-exclamation"></i>

                                {{ $message }}

                            </p>
                        @enderror

                    </div>

                    {{-- Deadline --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Due Date --}}
                        <div>

                            <label for="due_date" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">

                                <i class="fa-solid fa-calendar-days text-orange-600"></i>

                                Deadline

                                <span class="text-red-500">*</span>

                            </label>

                            <input type="datetime-local" id="due_date" name="due_date" value="{{ old('due_date') }}"
                                class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition bg-gray-50 text-gray-900
                                @error('due_date') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                                required>

                            @error('due_date')
                                <p class="mt-2 text-sm text-red-500 flex items-center gap-2">

                                    <i class="fa-solid fa-circle-exclamation"></i>

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>

                        {{-- Max Score --}}
                        <div>

                            <label for="max_score" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">

                                <i class="fa-solid fa-star text-yellow-500"></i>

                                Nilai Maksimal

                            </label>

                            <input type="number" id="max_score" name="max_score" value="100"
                                class="w-full px-5 py-4 rounded-2xl border border-gray-200 bg-gray-100 text-gray-500 cursor-not-allowed transition font-medium"
                                readonly>

                            <p class="mt-2 text-xs text-gray-400">
                                Nilai maksimal tugas dikunci secara default pada 100.
                            </p>

                    </div>

                    {{-- Allow Late Submission --}}
                    <div class="bg-gray-50 border border-gray-200 p-5 rounded-2xl flex items-start gap-4">
                        <div class="flex items-center h-5 mt-0.5">
                            <input id="allow_late" name="allow_late" type="checkbox" value="1" {{ old('allow_late') ? 'checked' : '' }}
                                class="w-5 h-5 text-purple-600 border-gray-300 rounded focus:ring-purple-500 cursor-pointer">
                        </div>
                        <div class="text-sm">
                            <label for="allow_late" class="font-semibold text-gray-700 cursor-pointer select-none">
                                Tetap Bisa Mengumpulkan Meskipun Tenggat Tanggal Sudah Lewat
                            </label>
                            <p class="text-gray-500 mt-1 select-none">
                                Jika diaktifkan, mahasiswa masih diperbolehkan mengunggah jawaban tugas meskipun batas waktu pengumpulan telah terlewati.
                            </p>
                        </div>
                    </div>

                    {{-- File Upload --}}
                    <div>

                        <label for="file" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">

                            <i class="fa-solid fa-paperclip text-green-600"></i>

                            Lampiran File

                            <span class="text-gray-400 text-xs">
                                (Opsional)
                            </span>

                        </label>

                        <div
                            class="border-2 border-dashed border-gray-300 rounded-3xl bg-gray-50 hover:border-purple-400 transition">

                            <label for="file"
                                class="flex flex-col items-center justify-center py-14 px-6 cursor-pointer">

                                <div
                                    class="w-20 h-20 rounded-3xl bg-purple-100 text-purple-600 flex items-center justify-center text-3xl mb-5">

                                    <i class="fa-solid fa-cloud-arrow-up"></i>

                                </div>

                                <h3 class="text-lg font-semibold text-gray-900">

                                    Upload File Tugas

                                </h3>

                                <p class="text-sm text-gray-500 mt-2 text-center max-w-md">

                                    Drag & drop file atau klik untuk memilih file.
                                    Mendukung PDF, DOCX, ZIP, dan lainnya.

                                </p>

                                <input type="file" id="file" name="file" class="hidden">

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
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 bg-purple-600 hover:bg-purple-700 text-white rounded-2xl transition shadow-lg shadow-purple-100 font-semibold">

                            <i class="fa-solid fa-floppy-disk"></i>

                            Simpan Tugas

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

@endsection
