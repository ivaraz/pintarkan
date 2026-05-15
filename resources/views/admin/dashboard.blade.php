@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">

        <div class="max-w-7xl mx-auto space-y-8">

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Dashboard Admin
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Kelola seluruh aktivitas sistem LMS dalam satu tempat.
                    </p>
                </div>

                <div class="flex items-center gap-3">

                    <a href="{{ route('admin.users.create') }}"
                        class="inline-flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl shadow-sm transition">

                        + Tambah User
                    </a>

                    <a href="{{ route('admin.courses.create') }}"
                        class="inline-flex items-center px-5 py-3 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-2xl transition">

                        + Tambah Course
                    </a>

                </div>

            </div>

            {{-- STATISTICS --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- USERS --}}
                <div
                    class="bg-white rounded-3xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200 p-6">

                    <div class="flex flex-col items-center text-center">

                        <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-3xl mb-4">
                            👥
                        </div>

                        <p class="text-sm font-medium text-gray-500">
                            Total Users
                        </p>

                        <h2 class="text-4xl font-bold text-gray-900 mt-3">
                            {{ $totalUsers ?? 0 }}
                        </h2>

                    </div>

                </div>

                {{-- DOSEN --}}
                <div
                    class="bg-white rounded-3xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200 p-6">

                    <div class="flex flex-col items-center text-center">

                        <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center text-3xl mb-4">
                            👨‍🏫
                        </div>

                        <p class="text-sm font-medium text-gray-500">
                            Dosen
                        </p>

                        <h2 class="text-4xl font-bold text-gray-900 mt-3">
                            {{ $totalLecturers ?? 0 }}
                        </h2>

                    </div>

                </div>

                {{-- MAHASISWA --}}
                <div
                    class="bg-white rounded-3xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200 p-6">

                    <div class="flex flex-col items-center text-center">

                        <div class="w-16 h-16 rounded-2xl bg-purple-100 flex items-center justify-center text-3xl mb-4">
                            👨‍🎓
                        </div>

                        <p class="text-sm font-medium text-gray-500">
                            Mahasiswa
                        </p>

                        <h2 class="text-4xl font-bold text-gray-900 mt-3">
                            {{ $totalStudents ?? 0 }}
                        </h2>

                    </div>

                </div>

                {{-- COURSES --}}
                <div
                    class="bg-white rounded-3xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-200 p-6">

                    <div class="flex flex-col items-center text-center">

                        <div class="w-16 h-16 rounded-2xl bg-orange-100 flex items-center justify-center text-3xl mb-4">
                            📚
                        </div>

                        <p class="text-sm font-medium text-gray-500">
                            Mata Kuliah
                        </p>

                        <h2 class="text-4xl font-bold text-gray-900 mt-3">
                            {{ $totalCourses ?? 0 }}
                        </h2>

                    </div>

                </div>

            </div>

            {{-- MAIN CONTENT --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                {{-- RECENT COURSES --}}
                <div class="xl:col-span-2">
                    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900">
                                    Mata Kuliah Terbaru
                                </h2>
                                <p class="text-sm text-gray-500 mt-1">
                                    Daftar course terbaru yang ditambahkan.
                                </p>
                            </div>
                            <a href="{{ route('admin.courses.index') }}"
                                class="text-blue-600 hover:text-blue-700 text-sm font-semibold transition">
                                Lihat Semua
                            </a>

                        </div>

                        <div class="space-y-4">

                            @forelse ($courses as $course)
                                <div
                                    class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 p-5 rounded-2xl border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition">

                                    <div class="flex-1">

                                        <h3 class="text-lg font-semibold text-gray-900">
                                            {{ $course->title }}
                                        </h3>

                                        <p class="text-sm text-gray-500 mt-2">
                                            {{ Str::limit($course->description, 100) }}
                                        </p>

                                        <div class="flex flex-wrap gap-3 mt-4">

                                            <div class="px-3 py-1 bg-white border rounded-lg text-sm text-gray-600">
                                                👨‍🏫
                                                {{ $course->lecturers->name ?? 'Belum Ada Dosen' }}
                                            </div>

                                            <div class="px-3 py-1 bg-white border rounded-lg text-sm text-gray-600">
                                                👨‍🎓
                                                {{ $course->enrollments->count() }}
                                                Mahasiswa
                                            </div>

                                        </div>

                                    </div>

                                    <div class="flex items-center gap-3">

                                        <a href="{{ route('admin.courses.show', $course->id) }}"
                                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-xl transition">

                                            Detail
                                        </a>

                                        <a href="{{ route('admin.courses.edit', $course->id) }}"
                                            class="px-4 py-2 border border-gray-300 hover:bg-gray-100 text-gray-700 text-sm rounded-xl transition">

                                            Edit
                                        </a>

                                    </div>

                                </div>

                            @empty

                                <div
                                    class="flex flex-col items-center justify-center py-16 text-center border border-dashed border-gray-300 rounded-3xl">

                                    <div class="text-6xl mb-4">
                                        📚
                                    </div>

                                    <h3 class="text-xl font-bold text-gray-900">
                                        Belum Ada Mata Kuliah
                                    </h3>

                                    <p class="text-gray-500 mt-2">
                                        Tambahkan course pertama untuk memulai LMS.
                                    </p>

                                </div>
                            @endforelse

                        </div>

                    </div>
                    {{ $courses->links() }}

                </div>

                {{-- QUICK ACTION --}}
                <div>

                    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">

                        <h2 class="text-2xl font-bold text-gray-900 mb-6">
                            Aksi Cepat
                        </h2>

                        <div class="space-y-4">

                            <a href="{{ route('admin.users.create') }}"
                                class="flex items-center gap-4 p-4 rounded-2xl border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition group">

                                <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl">
                                    👤
                                </div>

                                <div>
                                    <h3 class="font-semibold text-gray-900 group-hover:text-blue-700">
                                        Tambah User
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        Tambah admin, dosen, atau mahasiswa
                                    </p>
                                </div>

                            </a>

                            <a href="{{ route('admin.courses.create') }}"
                                class="flex items-center gap-4 p-4 rounded-2xl border border-gray-200 hover:border-green-300 hover:bg-green-50 transition group">

                                <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-2xl">
                                    📚
                                </div>

                                <div>
                                    <h3 class="font-semibold text-gray-900 group-hover:text-green-700">
                                        Tambah Course
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        Buat mata kuliah baru
                                    </p>
                                </div>

                            </a>

                            <a href="{{ route('admin.courses.index') }}"
                                class="flex items-center gap-4 p-4 rounded-2xl border border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition group">

                                <div class="w-14 h-14 rounded-2xl bg-purple-100 flex items-center justify-center text-2xl">
                                    📋
                                </div>

                                <div>
                                    <h3 class="font-semibold text-gray-900 group-hover:text-purple-700">
                                        Kelola Course
                                    </h3>

                                    <p class="text-sm text-gray-500">
                                        Atur seluruh mata kuliah
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
