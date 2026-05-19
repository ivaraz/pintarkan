@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-gray-50">

        {{-- Background Blur --}}
        <div class="fixed top-0 left-0 w-72 h-72 bg-blue-200 opacity-20 rounded-full blur-3xl -z-10">
        </div>

        <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 opacity-30 rounded-full blur-3xl -z-10">
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">

            {{-- HEADER --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8 mb-8">

                <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-8">

                    {{-- Left --}}
                    <div class="flex items-start gap-5">

                        {{-- Icon --}}
                        <div
                            class="w-20 h-20 rounded-3xl bg-blue-100 text-blue-600 flex items-center justify-center text-3xl shrink-0">

                            <i class="fa-solid fa-book-open"></i>

                        </div>

                        {{-- Content --}}
                        <div>

                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium border border-blue-100 mb-5">

                                <i class="fa-solid fa-layer-group"></i>

                                Detail Mata Kuliah

                            </div>

                            <h1 class="text-4xl font-bold text-gray-900">

                                {{ $course->title }}

                            </h1>

                            <div class="flex flex-wrap items-center gap-3 mt-5">

                                <div
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-green-50 border border-green-100 text-green-700 text-sm font-medium">

                                    <i class="fa-solid fa-chalkboard-user"></i>

                                    {{ $course->lecturers->name ?? 'Belum Ada Dosen' }}

                                </div>

                                <div
                                    class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-purple-50 border border-purple-100 text-purple-700 text-sm font-medium">

                                    <i class="fa-solid fa-user-graduate"></i>

                                    {{ $enrolledStudents->count() }}
                                    Mahasiswa

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-wrap items-center gap-3">

                        {{-- Edit --}}
                        <a href="{{ route('admin.courses.edit', $course) }}"
                            class="inline-flex items-center gap-2 px-5 py-3 bg-yellow-500 hover:bg-yellow-600 text-white rounded-2xl transition shadow-lg shadow-yellow-100">

                            <i class="fa-solid fa-pen"></i>

                            Edit

                        </a>

                        {{-- Back --}}
                        <a href="{{ route('admin.courses.index') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-2xl transition">

                            <i class="fa-solid fa-arrow-left"></i>

                            Kembali

                        </a>

                    </div>

                </div>

            </div>

            {{-- ALERT --}}
            @if (session('alert-type'))
                <div
                    class="mb-6 p-5 rounded-2xl border flex items-start gap-4
                    {{ session('alert-type') == 'success'
                        ? 'bg-green-50 border-green-200 text-green-700'
                        : 'bg-red-50 border-red-200 text-red-700' }}">

                    <div class="text-xl mt-0.5">

                        @if (session('alert-type') == 'success')
                            <i class="fa-solid fa-circle-check"></i>
                        @else
                            <i class="fa-solid fa-circle-xmark"></i>
                        @endif

                    </div>

                    <div>

                        <h3 class="font-semibold">
                            {{ session('alert-type') == 'success' ? 'Berhasil' : 'Terjadi Kesalahan' }}
                        </h3>

                        <p class="mt-1">
                            {{ session('message') }}
                        </p>

                    </div>

                </div>
            @endif

            {{-- COURSE INFO --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8 mb-8">

                <div class="flex items-center gap-3 mb-8">

                    <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl">

                        <i class="fa-solid fa-circle-info"></i>

                    </div>

                    <div>

                        <h2 class="text-2xl font-bold text-gray-900">

                            Informasi Mata Kuliah

                        </h2>

                        <p class="text-gray-500 mt-1">

                            Detail lengkap mengenai mata kuliah.

                        </p>

                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Title --}}
                    <div class="p-6 rounded-3xl border border-gray-200 bg-gray-50">

                        <div class="flex items-center gap-3 mb-4">

                            <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center">

                                <i class="fa-solid fa-book"></i>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">

                                    Judul Mata Kuliah

                                </p>

                                <h3 class="font-bold text-gray-900 text-lg mt-1">

                                    {{ $course->title }}

                                </h3>

                            </div>

                        </div>

                    </div>

                    {{-- Lecturer --}}
                    <div class="p-6 rounded-3xl border border-gray-200 bg-gray-50">

                        <div class="flex items-center gap-3 mb-4">

                            <div class="w-12 h-12 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center">

                                <i class="fa-solid fa-chalkboard-user"></i>

                            </div>

                            <div>

                                <p class="text-sm text-gray-500">

                                    Dosen Pengampu

                                </p>

                                <h3 class="font-bold text-gray-900 text-lg mt-1">

                                    {{ $course->lecturers->name ?? 'Belum Ada Dosen' }}

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

                                    Informasi Mata Kuliah

                                </h3>

                            </div>

                        </div>

                        <p class="text-gray-600 leading-relaxed">

                            {{ $course->description ?? 'Belum ada deskripsi untuk mata kuliah ini.' }}

                        </p>

                    </div>

                </div>

            </div>

            {{-- STUDENTS --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">

                {{-- Header --}}
                <div
                    class="p-8 border-b border-gray-100 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                    <div>

                        <h2 class="text-2xl font-bold text-gray-900">

                            Mahasiswa Terdaftar

                        </h2>

                        <p class="text-gray-500 mt-2">

                            Total
                            {{ $enrolledStudents->count() }}
                            mahasiswa mengikuti mata kuliah ini.

                        </p>

                    </div>

                    {{-- Add Student --}}
                    <a href="{{ route('admin.courses.add-students', $course) }}"
                        class="inline-flex items-center gap-2 px-5 py-3 bg-green-600 hover:bg-green-700 text-white rounded-2xl transition shadow-lg shadow-green-100">

                        <i class="fa-solid fa-user-plus"></i>

                        Tambah Mahasiswa

                    </a>

                </div>

                {{-- Content --}}
                @if ($enrolledStudents->count() > 0)
                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="bg-gray-50 border-b border-gray-100">

                                <tr>

                                    <th class="px-8 py-5 text-left text-sm font-semibold text-gray-600">
                                        Mahasiswa
                                    </th>

                                    <th class="px-8 py-5 text-left text-sm font-semibold text-gray-600">
                                        NPM
                                    </th>

                                    <th class="px-8 py-5 text-left text-sm font-semibold text-gray-600">
                                        Status
                                    </th>

                                    <th class="px-8 py-5 text-left text-sm font-semibold text-gray-600">
                                        Tanggal Daftar
                                    </th>

                                    <th class="px-8 py-5 text-center text-sm font-semibold text-gray-600">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>

                            <tbody class="divide-y divide-gray-100">

                                @foreach ($enrolledStudents as $enrollment)
                                    <tr class="hover:bg-blue-50/40 transition">

                                        {{-- Student --}}
                                        <td class="px-8 py-6">

                                            <div class="flex items-center gap-4">

                                                <div
                                                    class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-lg">

                                                    {{ strtoupper(substr($enrollment->student->name, 0, 1)) }}

                                                </div>

                                                <div>

                                                    <h3 class="font-semibold text-gray-900">

                                                        {{ $enrollment->student->name }}

                                                    </h3>

                                                    <p class="text-sm text-gray-500 mt-1">

                                                        Mahasiswa

                                                    </p>

                                                </div>

                                            </div>

                                        </td>

                                        {{-- NPM --}}
                                        <td class="px-8 py-6 text-gray-700 font-medium">

                                            {{ $enrollment->student->npm }}

                                        </td>

                                        {{-- Status --}}
                                        <td class="px-8 py-6">

                                            <span
                                                class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-sm font-medium
                                                {{ $enrollment->status == 'active'
                                                    ? 'bg-green-50 text-green-700 border border-green-100'
                                                    : 'bg-red-50 text-red-700 border border-red-100' }}">

                                                <i
                                                    class="fa-solid {{ $enrollment->status == 'active' ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>

                                                {{ ucfirst($enrollment->status) }}

                                            </span>

                                        </td>

                                        {{-- Date --}}
                                        <td class="px-8 py-6 text-gray-600">

                                            {{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('d M Y') : 'N/A' }}

                                        </td>

                                        {{-- Action --}}
                                        <td class="px-8 py-6 text-center">

                                            <form
                                                action="{{ route('admin.courses.remove-student', [$course, $enrollment]) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 rounded-xl transition text-sm font-medium">

                                                    <i class="fa-solid fa-trash"></i>

                                                    Hapus

                                                </button>

                                            </form>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="py-20 px-8 text-center">

                        <div class="flex flex-col items-center">

                            <div
                                class="w-24 h-24 rounded-3xl bg-blue-100 text-blue-600 flex items-center justify-center text-4xl mb-6">

                                <i class="fa-solid fa-user-graduate"></i>

                            </div>

                            <h3 class="text-2xl font-bold text-gray-900">

                                Belum Ada Mahasiswa

                            </h3>

                            <p class="text-gray-500 mt-3 max-w-md">

                                Tambahkan mahasiswa ke mata kuliah
                                ini untuk mulai proses pembelajaran.

                            </p>

                            <a href="{{ route('admin.courses.add-students', $course) }}"
                                class="mt-8 inline-flex items-center gap-2 px-5 py-3 bg-green-600 hover:bg-green-700 text-white rounded-2xl transition shadow-lg shadow-green-100">

                                <i class="fa-solid fa-user-plus"></i>

                                Tambah Mahasiswa

                            </a>

                        </div>

                    </div>
                @endif

            </div>

        </div>

    </div>

@endsection
