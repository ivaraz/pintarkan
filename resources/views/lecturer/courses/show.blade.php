@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-gray-50">

        {{-- Background Blur --}}
        <div class="fixed top-0 left-0 w-72 h-72 bg-blue-200 opacity-20 rounded-full blur-3xl -z-10">
        </div>

        <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 opacity-30 rounded-full blur-3xl -z-10">
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 space-y-8">

            {{-- Header --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8">

                <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-8">

                    {{-- Left --}}
                    <div class="flex items-start gap-5">

                        <div
                            class="w-20 h-20 rounded-3xl bg-blue-100 text-blue-600 flex items-center justify-center text-3xl shrink-0">

                            <i class="fa-solid fa-book-open"></i>

                        </div>

                        <div>

                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium border border-blue-100 mb-5">

                                <i class="fa-solid fa-chalkboard-user"></i>

                                Course Detail

                            </div>

                            <h1 class="text-4xl font-bold text-gray-900">

                                {{ $course->title }}

                            </h1>

                            <div class="flex flex-wrap items-center gap-3 mt-5">

                                <div
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-green-50 border border-green-100 text-green-700 text-sm font-medium">

                                    <i class="fa-solid fa-user-graduate"></i>

                                    {{ $course->enrollments->count() }}
                                    Mahasiswa

                                </div>

                                <div
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-purple-50 border border-purple-100 text-purple-700 text-sm font-medium">

                                    <i class="fa-solid fa-file-pen"></i>

                                    {{ $course->assignments->count() }}
                                    Tugas

                                </div>

                                <div
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-orange-50 border border-orange-100 text-orange-700 text-sm font-medium">

                                    <i class="fa-solid fa-book"></i>

                                    {{ $course->materials->count() }}
                                    Materi

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-wrap items-center gap-3">

                        {{-- Add Materi --}}
                        <a href="{{ route('lecturer.materials.create', $course) }}"
                            class="inline-flex items-center gap-2 px-5 py-3 bg-orange-600 hover:bg-orange-700 text-white rounded-2xl transition shadow-lg shadow-orange-100">

                            <i class="fa-solid fa-book-medical"></i>

                            Tambah Materi

                        </a>

                        {{-- Add Assignment --}}
                        <a href="{{ route('lecturer.assignments.create', $course) }}"
                            class="inline-flex items-center gap-2 px-5 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-2xl transition shadow-lg shadow-purple-100">

                            <i class="fa-solid fa-file-circle-plus"></i>

                            Tambah Tugas

                        </a>

                        {{-- Add Participant / Student --}}
                        <a href="{{ route('lecturer.courses.students', $course) }}"
                            class="inline-flex items-center gap-2 px-5 py-3 bg-green-600 hover:bg-green-700 text-white rounded-2xl transition shadow-lg shadow-green-100">

                            <i class="fa-solid fa-user-plus"></i>

                            Tambah Peserta

                        </a>

                        {{-- Rekap Nilai --}}
                        <a href="{{ route('lecturer.courses.grades-recap', $course) }}"
                            class="inline-flex items-center gap-2 px-5 py-3 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-2xl transition">

                            <i class="fa-solid fa-square-poll-vertical text-blue-600"></i>

                            Rekap Nilai

                        </a>

                        {{-- Edit --}}
                        <a href="{{ route('lecturer.courses.edit', $course) }}"
                            class="inline-flex items-center gap-2 px-5 py-3 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-2xl transition">

                            <i class="fa-solid fa-pen"></i>

                            Edit Course

                        </a>

                    </div>

                </div>

            </div>

            {{-- Course Info --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8">

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>

                    <div>

                        <h2 class="text-2xl font-bold text-gray-900">

                            Informasi Mata Kuliah

                        </h2>

                        <p class="text-gray-500 mt-1">

                            Detail lengkap course.

                        </p>

                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Course Title --}}
                    <div class="p-6 rounded-3xl border border-gray-200 bg-gray-50">

                        <div class="flex items-center gap-3 mb-4">

                            <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center">

                                <i class="fa-solid fa-book"></i>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">

                                    Mata Kuliah

                                </p>

                                <h3 class="font-bold text-gray-900 text-lg mt-1">

                                    {{ $course->title }}

                                </h3>

                            </div>

                        </div>

                    </div>

                    {{-- Students --}}
                    <div class="p-6 rounded-3xl border border-gray-200 bg-gray-50">

                        <div class="flex items-center gap-3 mb-4">

                            <div class="w-12 h-12 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center">

                                <i class="fa-solid fa-user-graduate"></i>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">

                                    Total Mahasiswa

                                </p>

                                <h3 class="font-bold text-gray-900 text-lg mt-1">

                                    {{ $course->enrollments->count() }}

                                </h3>

                            </div>

                        </div>

                    </div>

                    {{-- Description --}}
                    <div class="md:col-span-2 p-6 rounded-3xl border border-gray-200 bg-gray-50">

                        <div class="flex items-center gap-3 mb-4">

                            <div
                                class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center">

                                <i class="fa-solid fa-align-left"></i>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">

                                    Deskripsi

                                </p>

                                <h3 class="font-bold text-gray-900 text-lg mt-1">

                                    Informasi Course

                                </h3>

                            </div>

                        </div>

                        <p class="text-gray-600 leading-relaxed">

                            {{ $course->description ?? 'Belum ada deskripsi.' }}

                        </p>

                    </div>

                </div>

            </div>

            {{-- Material List --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="p-8 border-b border-gray-100 flex items-center justify-between">

                    <div>

                        <h2 class="text-2xl font-bold text-gray-900">

                            Daftar Materi

                        </h2>

                        <p class="text-gray-500 mt-2">

                            Semua materi pada mata kuliah ini.

                        </p>

                    </div>

                </div>

                {{-- Content --}}
                @if ($course->materials->count() > 0)
                    <div class="divide-y divide-gray-100">

                        @foreach ($course->materials as $material)
                            <div class="p-8 hover:bg-orange-50/30 transition">

                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                                    {{-- Left --}}
                                    <div class="flex items-start gap-5">

                                        <div
                                            class="w-16 h-16 rounded-3xl bg-orange-100 text-orange-600 flex items-center justify-center text-2xl shrink-0">

                                            <i class="fa-solid fa-book-open"></i>

                                        </div>

                                        <div>

                                            <h3 class="text-xl font-bold text-gray-900">

                                                {{ $material->title }}

                                            </h3>

                                            <p class="text-gray-500 mt-2 leading-relaxed">

                                                {{ Str::limit($material->content, 120) }}

                                            </p>

                                        </div>

                                    </div>

                                    {{-- Action --}}
                                    <div class="flex items-center gap-3 mt-4 lg:mt-0">

                                        @if (!empty($material->files))
                                            <a href="{{ Storage::url($material->files[0]) }}" target="_blank"
                                                class="inline-flex items-center justify-center w-10 h-10 bg-orange-50 hover:bg-orange-100 text-orange-700 rounded-xl transition tooltip" title="Download File Pertama">
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                        @endif

                                        <a href="{{ route('lecturer.materials.show', [$course->id, $material->id]) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition">
                                            <i class="fa-solid fa-eye"></i>
                                            Detail
                                        </a>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="py-20 px-8 text-center">

                        <div class="flex flex-col items-center">

                            <div
                                class="w-24 h-24 rounded-3xl bg-orange-100 text-orange-600 flex items-center justify-center text-4xl mb-6">

                                <i class="fa-solid fa-book-medical"></i>

                            </div>

                            <h3 class="text-2xl font-bold text-gray-900">

                                Belum Ada Materi

                            </h3>

                            <p class="text-gray-500 mt-3 max-w-md">

                                Tambahkan materi pertama untuk mahasiswa pada course ini.

                            </p>

                            <a href="{{ route('lecturer.materials.create', $course) }}"
                                class="mt-8 inline-flex items-center gap-2 px-5 py-3 bg-orange-600 hover:bg-orange-700 text-white rounded-2xl transition shadow-lg shadow-orange-100">

                                <i class="fa-solid fa-book-medical"></i>

                                Tambah Materi

                            </a>

                        </div>

                    </div>
                @endif

            </div>

            {{-- Assignment List --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="p-8 border-b border-gray-100 flex items-center justify-between">

                    <div>

                        <h2 class="text-2xl font-bold text-gray-900">

                            Daftar Tugas

                        </h2>

                        <p class="text-gray-500 mt-2">

                            Semua assignment pada mata kuliah ini.

                        </p>

                    </div>

                </div>

                {{-- Content --}}
                @if ($course->assignments->count() > 0)
                    <div class="divide-y divide-gray-100">

                        @foreach ($course->assignments as $assignment)
                            <div class="p-8 hover:bg-blue-50/30 transition">

                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                                    {{-- Left --}}
                                    <div class="flex items-start gap-5">

                                        <div
                                            class="w-16 h-16 rounded-3xl bg-purple-100 text-purple-600 flex items-center justify-center text-2xl shrink-0">

                                            <i class="fa-solid fa-file-lines"></i>

                                        </div>

                                        <div>

                                            <h3 class="text-xl font-bold text-gray-900">

                                                {{ $assignment->title }}

                                            </h3>

                                            <p class="text-gray-500 mt-2 leading-relaxed">

                                                {{ Str::limit($assignment->description, 120) }}

                                            </p>

                                            <div class="flex flex-wrap items-center gap-3 mt-5">

                                                {{-- Deadline --}}
                                                <div
                                                    class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-orange-50 border border-orange-100 text-orange-700 text-sm font-medium">

                                                    <i class="fa-solid fa-calendar-days"></i>

                                                    Deadline:
                                                    {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y H:i') }}

                                                </div>

                                                {{-- Score --}}
                                                <div
                                                    class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-green-50 border border-green-100 text-green-700 text-sm font-medium">

                                                    <i class="fa-solid fa-star"></i>

                                                    {{ $assignment->max_score }}
                                                    Poin

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    {{-- Action --}}
                                    <div class="flex items-center gap-3">

                                        <a href="{{ route('lecturer.assignments.show', [$course->id, $assignment->id]) }}"
                                            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition">

                                            <i class="fa-solid fa-eye"></i>

                                            Detail

                                        </a>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="py-20 px-8 text-center">

                        <div class="flex flex-col items-center">

                            <div
                                class="w-24 h-24 rounded-3xl bg-purple-100 text-purple-600 flex items-center justify-center text-4xl mb-6">

                                <i class="fa-solid fa-file-circle-plus"></i>

                            </div>

                            <h3 class="text-2xl font-bold text-gray-900">

                                Belum Ada Tugas

                            </h3>

                            <p class="text-gray-500 mt-3 max-w-md">

                                Tambahkan assignment pertama untuk mahasiswa pada course ini.

                            </p>

                            <a href="{{ route('lecturer.assignments.create', $course) }}"
                                class="mt-8 inline-flex items-center gap-2 px-5 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-2xl transition shadow-lg shadow-purple-100">

                                <i class="fa-solid fa-file-circle-plus"></i>

                                Tambah Tugas

                            </a>

                        </div>

                    </div>
                @endif

            </div>

            {{-- Participant List --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">

                {{-- Header --}}
                <div class="p-8 border-b border-gray-100 flex items-center justify-between">

                    <div>

                        <h2 class="text-2xl font-bold text-gray-900">

                            Daftar Peserta (Mahasiswa)

                        </h2>

                        <p class="text-gray-500 mt-2">

                            Semua mahasiswa yang terdaftar dalam mata kuliah ini.

                        </p>

                    </div>

                    <div>

                        <a href="{{ route('lecturer.courses.students', $course) }}"
                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-2xl transition shadow-lg shadow-green-100 text-sm font-medium">

                            <i class="fa-solid fa-user-plus"></i>

                            Tambah Peserta

                        </a>

                    </div>

                </div>

                {{-- Content --}}
                @if ($course->enrollments->count() > 0)
                    <div class="divide-y divide-gray-100">

                        @foreach ($course->enrollments as $enrollment)
                            <div class="p-8 hover:bg-blue-50/30 transition">

                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">

                                    {{-- Left --}}
                                    <div class="flex items-center gap-5">

                                        {{-- Avatar --}}
                                        <div
                                            class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-lg font-bold shrink-0">

                                            {{ strtoupper(substr($enrollment->student->name, 0, 1)) }}

                                        </div>

                                        <div>

                                            <h3 class="text-xl font-bold text-gray-900">

                                                {{ $enrollment->student->name }}

                                            </h3>

                                            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mt-2 text-sm text-gray-500">

                                                <span class="inline-flex items-center gap-1.5">

                                                    <i class="fa-solid fa-id-card"></i>

                                                    NPM: {{ $enrollment->student->npm }}

                                                </span>

                                                <span class="hidden sm:inline text-gray-300">|</span>

                                                <span class="inline-flex items-center gap-1.5">

                                                    <i class="fa-solid fa-calendar-check"></i>

                                                    Terdaftar: {{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('d M Y') : '-' }}

                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                    {{-- Action --}}
                                    <div class="flex items-center gap-3">

                                        <form action="{{ route('lecturer.courses.remove-student', [$course->id, $enrollment->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengeluarkan {{ $enrollment->student->name }} dari mata kuliah?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 border border-red-200 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl transition text-sm font-semibold">

                                                <i class="fa-solid fa-user-minus"></i>

                                                Keluarkan

                                            </button>
                                        </form>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="py-20 px-8 text-center">

                        <div class="flex flex-col items-center">

                            <div
                                class="w-24 h-24 rounded-3xl bg-green-100 text-green-600 flex items-center justify-center text-4xl mb-6">

                                <i class="fa-solid fa-users-slash"></i>

                            </div>

                            <h3 class="text-2xl font-bold text-gray-900">

                                Belum Ada Peserta

                            </h3>

                            <p class="text-gray-500 mt-3 max-w-md">

                                Mata kuliah ini belum memiliki mahasiswa yang terdaftar.

                            </p>

                            <a href="{{ route('lecturer.courses.students', $course) }}"
                                class="mt-8 inline-flex items-center gap-2 px-5 py-3 bg-green-600 hover:bg-green-700 text-white rounded-2xl transition shadow-lg shadow-green-100">

                                <i class="fa-solid fa-user-plus"></i>

                                Tambahkan Peserta Pertama

                            </a>

                        </div>

                    </div>
                @endif

            </div>

        </div>

    </div>

@endsection
