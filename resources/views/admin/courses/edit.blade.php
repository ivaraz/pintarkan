@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-gray-50">

        {{-- Background Blur --}}
        <div class="fixed top-0 left-0 w-72 h-72 bg-blue-200 opacity-20 rounded-full blur-3xl -z-10">
        </div>

        <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 opacity-30 rounded-full blur-3xl -z-10">
        </div>

        <div class="max-w-4xl mx-auto px-6 lg:px-8 py-8">

            {{-- Header --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8 mb-8">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    {{-- Left --}}
                    <div class="flex items-start gap-5">

                        <div
                            class="w-20 h-20 rounded-3xl bg-yellow-100 text-yellow-600 flex items-center justify-center text-3xl shrink-0">

                            <i class="fa-solid fa-pen"></i>

                        </div>

                        <div>

                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-yellow-50 text-yellow-700 text-sm font-medium border border-yellow-100 mb-5">

                                <i class="fa-solid fa-book-open"></i>

                                Edit Mata Kuliah

                            </div>

                            <h1 class="text-4xl font-bold text-gray-900">

                                {{ $course->title }}

                            </h1>

                            <p class="text-gray-500 mt-3 text-lg">

                                Perbarui informasi mata kuliah di sistem PintarKan.

                            </p>

                        </div>

                    </div>

                    {{-- Back --}}
                    <div>

                        <a href="{{ route('admin.courses.show', $course) }}"
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
                            class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl">

                            <i class="fa-solid fa-file-pen"></i>

                        </div>

                        <div>

                            <h2 class="text-2xl font-bold text-gray-900">

                                Form Edit Mata Kuliah

                            </h2>

                            <p class="text-gray-500 mt-1">

                                Lengkapi informasi berikut untuk memperbarui course.

                            </p>

                        </div>

                    </div>

                </div>

                {{-- Form --}}
                <form action="{{ route('admin.courses.update', $course) }}" method="POST" class="p-8 space-y-8">

                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div>

                        <label for="title" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">

                            <i class="fa-solid fa-book text-blue-600"></i>

                            Judul Mata Kuliah

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text" id="title" name="title" value="{{ old('title', $course->title) }}"
                            placeholder="Contoh: Pemrograman Web"
                            class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-gray-50 text-gray-900 placeholder-gray-400
                            @error('title') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                            required>

                        @error('title')
                            <p class="mt-2 text-sm text-red-500 flex items-center gap-2">

                                <i class="fa-solid fa-circle-exclamation"></i>

                                {{ $message }}

                            </p>
                        @enderror

                    </div>

                    {{-- Lecturer --}}
                    <div>

                        <label for="lecturer_id" class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-3">

                            <i class="fa-solid fa-chalkboard-user text-green-600"></i>

                            Dosen Pengampu

                            <span class="text-red-500">*</span>

                        </label>

                        <select id="lecturer_id" name="lecturer_id"
                            class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-gray-50 text-gray-900
                            @error('lecturer_id') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                            required>

                            <option value="">
                                -- Pilih Dosen --
                            </option>

                            @foreach ($lecturers as $lecturer)
                                <option value="{{ $lecturer->id }}"
                                    {{ old('lecturer_id', $course->lecturer_id) == $lecturer->id ? 'selected' : '' }}>

                                    {{ $lecturer->name }}
                                    ({{ $lecturer->nidn }})
                                </option>
                            @endforeach

                        </select>

                        @error('lecturer_id')
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

                            Deskripsi

                        </label>

                        <textarea id="description" name="description" rows="6" placeholder="Deskripsi mata kuliah..."
                            class="w-full px-5 py-4 rounded-2xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition bg-gray-50 text-gray-900 placeholder-gray-400 resize-none
                            @error('description') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror">{{ old('description', $course->description) }}</textarea>

                        @error('description')
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
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl transition shadow-lg shadow-blue-100 font-semibold">

                            <i class="fa-solid fa-floppy-disk"></i>

                            Simpan Perubahan

                        </button>

                        {{-- Cancel --}}
                        <a href="{{ route('admin.courses.show', $course) }}"
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
