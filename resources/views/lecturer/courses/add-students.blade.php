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
                            class="w-20 h-20 rounded-3xl bg-green-100 text-green-600 flex items-center justify-center text-3xl shrink-0">

                            <i class="fa-solid fa-user-plus"></i>

                        </div>

                        <div>

                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-50 text-green-700 text-sm font-medium border border-green-100 mb-5">

                                <i class="fa-solid fa-user-graduate"></i>

                                Enrollment Management

                            </div>

                            <h1 class="text-3xl font-bold text-gray-900">

                                Tambah Mahasiswa

                            </h1>

                            <p class="text-gray-500 mt-3 text-base">

                                Tambahkan mahasiswa ke mata kuliah
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

            {{-- Content --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">

                @if ($students->count() > 0)
                    {{-- Header --}}
                    <div class="px-8 py-6 border-b border-gray-100">

                        <div class="flex items-center gap-3">

                            <div
                                class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl">

                                <i class="fa-solid fa-users"></i>

                             </div>

                            <div>

                                <h2 class="text-2xl font-bold text-gray-900">

                                    Pilih Mahasiswa

                                </h2>

                                <p class="text-gray-500 mt-1">

                                    Total
                                    {{ $students->count() }}
                                    mahasiswa tersedia untuk didaftarkan.

                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- Form --}}
                    <form action="{{ route('lecturer.courses.store-enrollment', $course) }}" method="POST" class="p-8">

                        @csrf

                        {{-- Student List --}}
                        <div>

                            <label class="flex items-center gap-2 text-sm font-semibold text-gray-700 mb-5">

                                <i class="fa-solid fa-user-graduate text-green-600"></i>

                                Daftar Mahasiswa

                                <span class="text-red-500">*</span>

                            </label>

                            <div class="border border-gray-200 rounded-3xl overflow-hidden bg-gray-50">

                                <div class="max-h-[500px] overflow-y-auto divide-y divide-gray-100">

                                    @foreach ($students as $student)
                                        <label for="student_{{ $student->id }}"
                                            class="flex items-center gap-5 p-5 hover:bg-blue-50/50 transition cursor-pointer">

                                            {{-- Checkbox --}}
                                            <div>

                                                <input type="checkbox" id="student_{{ $student->id }}" name="student_ids[]"
                                                    value="{{ $student->id }}"
                                                    class="w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">

                                            </div>

                                            {{-- Avatar --}}
                                            <div
                                                class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-lg font-bold shrink-0">

                                                {{ strtoupper(substr($student->name, 0, 1)) }}

                                            </div>

                                            {{-- Info --}}
                                            <div class="flex-1">

                                                <h3 class="font-semibold text-gray-900 text-lg">

                                                    {{ $student->name }}

                                                </h3>

                                                <div class="flex items-center gap-2 mt-2 text-sm text-gray-500">

                                                    <i class="fa-solid fa-id-card"></i>

                                                    NPM:
                                                    {{ $student->npm }}

                                                </div>

                                            </div>

                                            {{-- Status --}}
                                            <div
                                                class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-green-50 text-green-700 border border-green-100 text-sm font-medium">

                                                <i class="fa-solid fa-circle-check"></i>

                                                Tersedia

                                            </div>

                                        </label>
                                    @endforeach

                                </div>

                            </div>

                            @error('student_ids')
                                <p class="mt-3 text-sm text-red-500 flex items-center gap-2">

                                    <i class="fa-solid fa-circle-exclamation"></i>

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>

                        {{-- Actions --}}
                        <div class="flex flex-col sm:flex-row items-center gap-4 pt-8">

                            {{-- Submit --}}
                            <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 bg-green-600 hover:bg-green-700 text-white rounded-2xl transition shadow-lg shadow-green-100 font-semibold">

                                <i class="fa-solid fa-user-plus"></i>

                                Tambah Mahasiswa

                            </button>

                            {{-- Cancel --}}
                            <a href="{{ route('lecturer.courses.show', $course) }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-2xl transition font-semibold">

                                <i class="fa-solid fa-xmark"></i>

                                Batal

                            </a>

                        </div>

                    </form>
                @else
                    {{-- Empty State --}}
                    <div class="py-20 px-8 text-center">

                        <div class="flex flex-col items-center">

                            <div
                                class="w-24 h-24 rounded-3xl bg-yellow-100 text-yellow-600 flex items-center justify-center text-4xl mb-6">

                                <i class="fa-solid fa-user-check"></i>

                            </div>

                            <h3 class="text-2xl font-bold text-gray-900">

                                Semua Mahasiswa Sudah Terdaftar

                            </h3>

                            <p class="text-gray-500 mt-3 max-w-md">

                                Tidak ada mahasiswa lain yang tersedia
                                untuk ditambahkan ke mata kuliah ini.

                            </p>

                            <a href="{{ route('lecturer.courses.show', $course) }}"
                                class="mt-8 inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl transition shadow-lg shadow-blue-100">

                                <i class="fa-solid fa-arrow-left"></i>

                                Kembali ke Detail Course

                            </a>

                        </div>

                    </div>
                @endif

            </div>

        </div>

    </div>

@endsection
