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

                    <div>

                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium border border-blue-100 mb-5">

                            <i class="fa-solid fa-shield-halved"></i>

                            Admin Panel

                        </div>

                        <h1 class="text-3xl font-bold text-gray-900">
                            Dashboard Admin
                        </h1>

                        <p class="text-gray-500 mt-3 text-base">
                            Kelola user, course, dan aktivitas LMS PintarKan.
                        </p>

                    </div>

                </div>

            </div>

            {{-- STATISTICS --}}
            <div class="grid grid-cols-2 xl:grid-cols-4 gap-6">

                {{-- Users --}}
                <div class="bg-white border border-gray-200 rounded-3xl p-4 shadow-sm hover:shadow-lg transition">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Total Users
                            </p>

                            <h2 class="text-3xl font-bold text-gray-900 mt-3">
                                {{ $totalUsers ?? 0 }}
                            </h2>

                        </div>

                        <div
                            class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl">

                            <i class="fa-solid fa-users"></i>

                        </div>

                    </div>

                </div>

                {{-- Lecturers --}}
                <div class="bg-white border border-gray-200 rounded-3xl p-4 shadow-sm hover:shadow-lg transition">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Dosen
                            </p>

                            <h2 class="text-4xl font-bold text-gray-900 mt-3">
                                {{ $totalLecturers ?? 0 }}
                            </h2>

                        </div>

                        <div
                            class="w-14 h-14 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center text-2xl">

                            <i class="fa-solid fa-chalkboard-user"></i>

                        </div>

                    </div>

                </div>

                {{-- Students --}}
                <div class="bg-white border border-gray-200 rounded-3xl p-4 shadow-sm hover:shadow-lg transition">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Mahasiswa
                            </p>

                            <h2 class="text-3xl font-bold text-gray-900 mt-3">
                                {{ $totalStudents ?? 0 }}
                            </h2>

                        </div>

                        <div
                            class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-2xl">

                            <i class="fa-solid fa-user-graduate"></i>

                        </div>

                    </div>

                </div>

                {{-- Courses --}}
                <div class="bg-white border border-gray-200 rounded-3xl p-4 shadow-sm hover:shadow-lg transition">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-gray-500">
                                Mata Kuliah
                            </p>

                            <h2 class="text-4xl font-bold text-gray-900 mt-3">
                                {{ $totalCourses ?? 0 }}
                            </h2>

                        </div>

                        <div
                            class="w-14 h-14 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl">

                            <i class="fa-solid fa-book-open"></i>

                        </div>

                    </div>

                </div>

            </div>

            {{-- MAIN CONTENT --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">

                {{-- COURSES --}}
                <div class="xl:col-span-4">

                    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6">

                        {{-- Header --}}
                        <div class="flex items-center justify-between mb-8">

                            <div>

                                <h2 class="text-xl font-bold text-gray-900">
                                    Mata Kuliah Terbaru
                                </h2>

                                <p class="text-sm text-gray-500 mt-2">
                                    Course terbaru yang ditambahkan ke sistem.
                                </p>

                            </div>

                            <a href="{{ route('admin.courses.index') }}"
                                class="text-blue-600 hover:text-blue-700 font-semibold text-sm transition">

                                Lihat Semua

                            </a>

                        </div>

                        {{-- Course List --}}
                        <div class="space-y-5">

                            @forelse ($courses as $course)
                                <div
                                    class="border border-gray-200 rounded-3xl p-4 hover:border-blue-300 hover:shadow-md transition bg-gray-50/50">

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

                                                        {{ Str::limit($course->description, 120) }}

                                                    </p>

                                                </div>

                                            </div>

                                            {{-- Meta --}}
                                            <div class="flex flex-wrap items-center gap-3 mt-5">

                                                <div
                                                    class="inline-flex items-center gap-2 px-3 py-2 bg-white border border-gray-200 rounded-xl text-sm text-gray-600">

                                                    <i class="fa-solid fa-graduation-cap text-orange-600"></i>

                                                    Semester {{ $course->semester }}

                                                </div>

                                                <div
                                                    class="inline-flex items-center gap-2 px-3 py-2 bg-white border border-gray-200 rounded-xl text-sm text-gray-600">

                                                    <i class="fa-solid fa-chalkboard-user text-green-600"></i>

                                                    {{ $course->lecturers->name ?? 'Belum Ada Dosen' }}

                                                </div>

                                                <div
                                                    class="inline-flex items-center gap-2 px-3 py-2 bg-white border border-gray-200 rounded-xl text-sm text-gray-600">

                                                    <i class="fa-solid fa-user-graduate text-purple-600"></i>

                                                    {{ $course->enrollments->count() }}
                                                    Mahasiswa

                                                </div>

                                            </div>

                                        </div>

                                        {{-- Actions --}}
                                        <div class="flex items-center gap-3">

                                            <a href="{{ route('admin.courses.show', $course->id) }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition">

                                                <i class="fa-solid fa-eye"></i>

                                                Detail

                                            </a>

                                            <a href="{{ route('admin.courses.edit', $course->id) }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-xl transition">

                                                <i class="fa-solid fa-pen"></i>

                                                Edit

                                            </a>

                                        </div>

                                    </div>

                                </div>

                            @empty

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

                                        Tambahkan course pertama untuk memulai
                                        pembelajaran di PintarKan.

                                    </p>

                                </div>
                            @endforelse

                        </div>

                        {{-- Pagination --}}
                        <div class="mt-8">
                            {{ $courses->links() }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
