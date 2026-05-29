@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-gray-50">

        {{-- Background Blur --}}
        <div class="fixed top-0 left-0 w-72 h-72 bg-blue-200 opacity-20 rounded-full blur-3xl -z-10">
        </div>

        <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 opacity-30 rounded-full blur-3xl -z-10">
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 space-y-8">

            {{-- HEADER --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    {{-- Left --}}
                    <div>

                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium border border-blue-100 mb-5">

                            <i class="fa-solid fa-chalkboard-user"></i>

                            Lecturer Dashboard

                        </div>

                        <h1 class="text-4xl font-bold text-gray-900">
                            Dashboard Dosen
                        </h1>

                        <p class="text-gray-500 mt-3 text-lg">
                            Kelola mata kuliah, tugas, materi, dan aktivitas pembelajaran Anda.
                        </p>

                    </div>

                </div>

            </div>

            {{-- STATS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

                {{-- Course --}}
                <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 hover:shadow-lg transition">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Mata Kuliah
                            </p>

                            <h2 class="text-4xl font-bold text-gray-900 mt-3">
                                {{ $courseCount ?? 0 }}
                            </h2>

                        </div>

                        <div
                            class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl">

                            <i class="fa-solid fa-book-open"></i>

                        </div>

                    </div>

                </div>

                {{-- Students --}}
                <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 hover:shadow-lg transition">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Mahasiswa
                            </p>

                            <h2 class="text-4xl font-bold text-gray-900 mt-3">
                                {{ $studentCount ?? 0 }}
                            </h2>

                        </div>

                        <div
                            class="w-14 h-14 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center text-2xl">

                            <i class="fa-solid fa-user-graduate"></i>

                        </div>

                    </div>

                </div>

                {{-- Assignment --}}
                <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 hover:shadow-lg transition">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Tugas
                            </p>

                            <h2 class="text-4xl font-bold text-gray-900 mt-3">
                                {{ $assignmentCount ?? 0 }}
                            </h2>

                        </div>

                        <div
                            class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-2xl">

                            <i class="fa-solid fa-file-pen"></i>

                        </div>

                    </div>

                </div>

                {{-- Submission --}}
                <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6 hover:shadow-lg transition">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Menunggu Penilaian
                            </p>

                            <h2 class="text-4xl font-bold text-gray-900 mt-3">
                                {{ $pendingSubmissions ?? 0 }}
                            </h2>

                        </div>

                        <div
                            class="w-14 h-14 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl">

                            <i class="fa-solid fa-clock"></i>

                        </div>

                    </div>

                </div>

            </div>

            {{-- CONTENT --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                {{-- Course List --}}
                <div class="xl:col-span-2">

                    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6">

                        {{-- Header --}}
                        <div class="flex items-center justify-between mb-8">

                            <div>

                                <h2 class="text-2xl font-bold text-gray-900">
                                    Mata Kuliah Anda
                                </h2>

                                <p class="text-gray-500 mt-2">
                                    Daftar kelas yang sedang Anda ajarkan.
                                </p>

                            </div>

                            <a href="{{ route('lecturer.courses.index') }}"
                                class="text-blue-600 hover:text-blue-700 font-semibold text-sm transition">

                                Lihat Semua

                            </a>

                        </div>

                        {{-- Course List --}}
                        @if ($courses && count($courses) > 0)
                            <div class="space-y-5">

                                @foreach ($courses as $course)
                                    <div
                                        class="border border-gray-200 rounded-3xl p-6 hover:border-blue-300 hover:shadow-md transition bg-gray-50/50">

                                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                                            {{-- Content --}}
                                            <div class="flex-1">

                                                <div class="flex items-start gap-4">

                                                    <div
                                                        class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl shrink-0">

                                                        <i class="fa-solid fa-book"></i>

                                                    </div>

                                                    <div>

                                                        <h3 class="text-xl font-bold text-gray-900">

                                                            {{ $course->title }}

                                                        </h3>

                                                        <p class="text-gray-500 mt-2 leading-relaxed">

                                                            {{ Str::limit($course->description, 100) }}

                                                        </p>

                                                    </div>

                                                </div>

                                                {{-- Stats --}}
                                                <div class="flex flex-wrap items-center gap-3 mt-5">

                                                    {{-- Students --}}
                                                    <div
                                                        class="inline-flex items-center gap-2 px-3 py-2 bg-white border border-gray-200 rounded-xl text-sm text-gray-600">

                                                        <i class="fa-solid fa-user-graduate text-green-600"></i>

                                                        {{ $course->enrollments->count() }}
                                                        Mahasiswa

                                                    </div>

                                                    {{-- Materials --}}
                                                    <div
                                                        class="inline-flex items-center gap-2 px-3 py-2 bg-white border border-gray-200 rounded-xl text-sm text-gray-600">

                                                        <i class="fa-solid fa-book text-blue-600"></i>

                                                        {{ $course->materials->count() }}
                                                        Materi

                                                    </div>

                                                    {{-- Assignment --}}
                                                    <div
                                                        class="inline-flex items-center gap-2 px-3 py-2 bg-white border border-gray-200 rounded-xl text-sm text-gray-600">

                                                        <i class="fa-solid fa-file-pen text-purple-600"></i>

                                                        {{ $course->assignments->count() }}
                                                        Tugas

                                                    </div>

                                                </div>

                                            </div>

                                            {{-- Actions --}}
                                            <div class="flex items-center gap-3">

                                                {{-- Detail --}}
                                                <a href="{{ route('lecturer.courses.show', $course->id) }}"
                                                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition">

                                                    <i class="fa-solid fa-eye"></i>

                                                    Detail

                                                </a>

                                                {{-- Edit --}}
                                                <a href="{{ route('lecturer.courses.edit', $course->id) }}"
                                                    class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-xl transition">

                                                    <i class="fa-solid fa-pen"></i>

                                                    Edit

                                                </a>

                                            </div>

                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        @else
                            {{-- Empty State --}}
                            <div class="border border-dashed border-gray-300 rounded-3xl p-16 text-center bg-gray-50">

                                <div
                                    class="w-20 h-20 rounded-3xl bg-blue-100 text-blue-600 flex items-center justify-center mx-auto text-3xl mb-6">

                                    <i class="fa-solid fa-book-open"></i>

                                </div>

                                <h3 class="text-2xl font-bold text-gray-900">

                                    Belum Ada Mata Kuliah

                                </h3>

                                <p class="text-gray-500 mt-3 max-w-md mx-auto">

                                    Anda belum memiliki kelas untuk diajar.
                                    Hubungi admin atau buat course baru.

                                </p>

                            </div>
                        @endif

                    </div>

                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">

                    {{-- Quick Action --}}
                    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6">

                        <h2 class="text-2xl font-bold text-gray-900">
                            Aksi Cepat
                        </h2>

                        <p class="text-gray-500 mt-2 mb-6">
                            Shortcut pengelolaan pembelajaran.
                        </p>

                        <div class="space-y-4">

                            {{-- Course --}}
                            <a href="{{ route('lecturer.courses.index') }}"
                                class="flex items-center gap-4 p-5 rounded-2xl border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition group">

                                <div
                                    class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl">

                                    <i class="fa-solid fa-book-open"></i>

                                </div>

                                <div>

                                    <h3 class="font-semibold text-gray-900 group-hover:text-blue-700">

                                        Mata Kuliah

                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">

                                        Kelola seluruh kelas

                                    </p>

                                </div>

                            </a>

                            {{-- Assignment --}}
                            <a href="{{ route('lecturer.courses.index') }}"
                                class="flex items-center gap-4 p-5 rounded-2xl border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition group">

                                <div
                                    class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-xl">

                                    <i class="fa-solid fa-file-pen"></i>

                                </div>

                                <div>

                                    <h3 class="font-semibold text-gray-900 group-hover:text-purple-700">

                                        Buat Tugas

                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">

                                        Pilih kelas untuk menambah tugas

                                    </p>

                                </div>

                            </a>

                            {{-- Material --}}
                            <a href="#"
                                class="flex items-center gap-4 p-5 rounded-2xl border border-gray-200 hover:border-green-300 hover:bg-green-50 transition group">

                                <div
                                    class="w-14 h-14 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center text-xl">

                                    <i class="fa-solid fa-book"></i>

                                </div>

                                <div>

                                    <h3 class="font-semibold text-gray-900 group-hover:text-green-700">

                                        Upload Materi

                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">

                                        Tambahkan materi pembelajaran

                                    </p>

                                </div>

                            </a>

                            {{-- Grades --}}
                            <a href="#"
                                class="flex items-center gap-4 p-5 rounded-2xl border border-gray-200 hover:border-orange-300 hover:bg-orange-50 transition group">

                                <div
                                    class="w-14 h-14 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-xl">

                                    <i class="fa-solid fa-chart-column"></i>

                                </div>

                                <div>

                                    <h3 class="font-semibold text-gray-900 group-hover:text-orange-700">

                                        Penilaian

                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">

                                        Kelola nilai mahasiswa

                                    </p>

                                </div>

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
