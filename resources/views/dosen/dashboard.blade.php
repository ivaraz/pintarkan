@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">

        <div class="max-w-7xl mx-auto space-y-8">

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Dashboard Dosen
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Kelola mata kuliah, tugas, materi, dan aktivitas pembelajaran Anda.
                    </p>
                </div>

                <div>
                    <a href="{{ route('dosen.courses.index') }}"
                        class="inline-flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow-sm transition">

                        📚 Kelola Mata Kuliah
                    </a>
                </div>
            </div>

            {{-- STATS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

                {{-- COURSE --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Mata Kuliah
                            </p>

                            <h2 class="text-3xl font-bold text-gray-900 mt-2">
                                {{ $courseCount ?? 0 }}
                            </h2>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl">
                            📚
                        </div>
                    </div>
                </div>

                {{-- STUDENT --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Mahasiswa
                            </p>

                            <h2 class="text-3xl font-bold text-gray-900 mt-2">
                                {{ $studentCount ?? 0 }}
                            </h2>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-2xl">
                            👨‍🎓
                        </div>
                    </div>
                </div>

                {{-- ASSIGNMENT --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Tugas
                            </p>

                            <h2 class="text-3xl font-bold text-gray-900 mt-2">
                                {{ $assignmentCount ?? 0 }}
                            </h2>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center text-2xl">
                            📝
                        </div>
                    </div>
                </div>

                {{-- SUBMISSION --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 hover:shadow-md transition">

                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Menunggu Penilaian
                            </p>

                            <h2 class="text-3xl font-bold text-gray-900 mt-2">
                                {{ $pendingSubmissions ?? 0 }}
                            </h2>
                        </div>

                        <div class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center text-2xl">
                            ⏳
                        </div>
                    </div>
                </div>

            </div>

            {{-- CONTENT --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                {{-- COURSE LIST --}}
                <div class="xl:col-span-2">

                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">

                        {{-- HEADER --}}
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">
                                    Mata Kuliah Anda
                                </h2>

                                <p class="text-sm text-gray-500 mt-1">
                                    Daftar kelas yang sedang Anda ajarkan.
                                </p>
                            </div>

                            <a href="{{ route('dosen.courses.index') }}"
                                class="text-sm font-medium text-blue-600 hover:text-blue-700 transition">
                                Lihat Semua
                            </a>
                        </div>

                        {{-- COURSE --}}
                        @if ($courses && count($courses) > 0)
                            <div class="space-y-4">

                                @foreach ($courses as $course)
                                    <div
                                        class="bg-gray-50 border border-gray-200 rounded-2xl p-5 hover:border-blue-300 hover:shadow-md transition-all duration-200">

                                        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                                            {{-- LEFT --}}
                                            <div class="flex-1">

                                                <h3 class="text-lg font-semibold text-gray-900">
                                                    {{ $course->title }}
                                                </h3>

                                                <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                                                    {{ Str::limit($course->description, 100) }}
                                                </p>

                                                {{-- STATS --}}
                                                <div class="flex flex-wrap items-center gap-4 mt-5 text-sm text-gray-600">

                                                    <div
                                                        class="flex items-center gap-2 px-3 py-1 bg-white rounded-lg border">
                                                        👨‍🎓
                                                        <span>
                                                            {{ $course->enrollments->count() }}
                                                            Mahasiswa
                                                        </span>
                                                    </div>

                                                    <div
                                                        class="flex items-center gap-2 px-3 py-1 bg-white rounded-lg border">
                                                        📘
                                                        <span>
                                                            {{ $course->materials->count() }}
                                                            Materi
                                                        </span>
                                                    </div>

                                                    <div
                                                        class="flex items-center gap-2 px-3 py-1 bg-white rounded-lg border">
                                                        📝
                                                        <span>
                                                            {{ $course->assignments->count() }}
                                                            Tugas
                                                        </span>
                                                    </div>

                                                </div>
                                            </div>

                                            {{-- RIGHT --}}
                                            <div class="flex flex-row lg:flex-col gap-3">

                                                <a href="{{ route('dosen.courses.show', $course->id) }}"
                                                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-xl transition">

                                                    Detail
                                                </a>

                                                <a href="{{ route('dosen.courses.edit', $course->id) }}"
                                                    class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 hover:bg-gray-100 text-gray-700 text-sm rounded-xl transition">

                                                    Edit
                                                </a>

                                            </div>

                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        @else
                            {{-- EMPTY --}}
                            <div
                                class="flex flex-col items-center justify-center text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-300">

                                <div class="text-5xl mb-4">
                                    📚
                                </div>

                                <h3 class="text-lg font-semibold text-gray-900">
                                    Belum Ada Mata Kuliah
                                </h3>

                                <p class="text-gray-500 mt-2 max-w-md">
                                    Anda belum memiliki kelas untuk diajar.
                                    Hubungi admin atau buat course baru.
                                </p>

                                <a href="{{ route('dosen.courses.create') }}"
                                    class="mt-6 inline-flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition">

                                    + Tambah Mata Kuliah
                                </a>

                            </div>
                        @endif

                    </div>

                </div>

                {{-- SIDEBAR --}}
                <div class="space-y-6">

                    {{-- QUICK ACTION --}}
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">

                        <h2 class="text-xl font-bold text-gray-900 mb-6">
                            Aksi Cepat
                        </h2>

                        <div class="space-y-4">

                            {{-- COURSE --}}
                            <a href="{{ route('dosen.courses.index') }}"
                                class="flex items-center gap-4 p-4 rounded-2xl border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition group">

                                <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-xl">
                                    📚
                                </div>

                                <div>
                                    <h3 class="font-semibold text-gray-900 group-hover:text-blue-700">
                                        Mata Kuliah
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        Kelola seluruh kelas
                                    </p>
                                </div>

                            </a>

                            {{-- ASSIGNMENT --}}
                            <a href="#"
                                class="flex items-center gap-4 p-4 rounded-2xl border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition group">

                                <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-xl">
                                    📝
                                </div>

                                <div>
                                    <h3 class="font-semibold text-gray-900 group-hover:text-purple-700">
                                        Buat Tugas
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        Tambahkan assignment baru
                                    </p>
                                </div>

                            </a>

                            {{-- MATERIAL --}}
                            <a href="#"
                                class="flex items-center gap-4 p-4 rounded-2xl border border-gray-200 hover:border-green-300 hover:bg-green-50 transition group">

                                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-xl">
                                    📘
                                </div>

                                <div>
                                    <h3 class="font-semibold text-gray-900 group-hover:text-green-700">
                                        Upload Materi
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        Tambahkan materi pembelajaran
                                    </p>
                                </div>

                            </a>

                            {{-- GRADES --}}
                            <a href="#"
                                class="flex items-center gap-4 p-4 rounded-2xl border border-gray-200 hover:border-orange-300 hover:bg-orange-50 transition group">

                                <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center text-xl">
                                    📊
                                </div>

                                <div>
                                    <h3 class="font-semibold text-gray-900 group-hover:text-orange-700">
                                        Penilaian
                                    </h3>

                                    <p class="text-sm text-gray-500">
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
