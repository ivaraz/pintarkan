@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-gray-50">

        {{-- Background Blur --}}
        <div class="fixed top-0 left-0 w-72 h-72 bg-blue-200 opacity-20 rounded-full blur-3xl -z-10">
        </div>

        <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 opacity-30 rounded-full blur-3xl -z-10">
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">

            {{-- Header --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8 mb-8">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <div>

                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium border border-blue-100 mb-5">

                            <i class="fa-solid fa-book-open"></i>

                            Course Management

                        </div>

                        <h1 class="text-3xl font-bold text-gray-900">
                            Daftar Mata Kuliah
                        </h1>

                        <p class="text-gray-500 mt-3 text-base">
                            Kelola seluruh mata kuliah di sistem PintarKan.
                        </p>

                    </div>

                    {{-- Action --}}
                    <div>

                        <a href="{{ route('admin.courses.create') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl transition shadow-lg shadow-blue-100">

                            <i class="fa-solid fa-plus"></i>

                            Tambah Matkul

                        </a>

                    </div>

                </div>

            </div>

            {{-- Alert --}}
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

            {{-- Courses --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">

                {{-- Table Header --}}
                <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between">

                    <div>

                        <h2 class="text-2xl font-bold text-gray-900">
                            Semua Mata Kuliah
                        </h2>

                        <p class="text-gray-500 mt-1">
                            Total {{ $courses->count() }} mata kuliah tersedia
                        </p>

                    </div>

                </div>

                {{-- Filter & Sort Form --}}
                <div class="px-8 py-5 bg-gray-50/50 border-b border-gray-100">
                    <form action="{{ route('admin.courses.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        
                        {{-- Sort by Lecturer --}}
                        <div>
                            <label for="sort_lecturer" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">Urutkan Dosen</label>
                            <select id="sort_lecturer" name="sort_lecturer" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm bg-white text-gray-800">
                                <option value="">Default (Tidak Diurutkan)</option>
                                <option value="asc" {{ request('sort_lecturer') == 'asc' ? 'selected' : '' }}>Nama Dosen (A - Z)</option>
                                <option value="desc" {{ request('sort_lecturer') == 'desc' ? 'selected' : '' }}>Nama Dosen (Z - A)</option>
                            </select>
                        </div>

                        {{-- Sort by Semester --}}
                        <div>
                            <label for="sort_semester" class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">Urutkan Semester</label>
                            <select id="sort_semester" name="sort_semester" class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm bg-white text-gray-800">
                                <option value="">Default (Tidak Diurutkan)</option>
                                <option value="asc" {{ request('sort_semester') == 'asc' ? 'selected' : '' }}>Semester (Terendah - Tertinggi)</option>
                                <option value="desc" {{ request('sort_semester') == 'desc' ? 'selected' : '' }}>Semester (Tertinggi - Terendah)</option>
                            </select>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 inline-flex justify-center items-center gap-1.5 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition text-xs shadow-sm">
                                <i class="fa-solid fa-sort text-[10px]"></i>
                                Urutkan
                            </button>
                            <a href="{{ route('admin.courses.index') }}" class="inline-flex justify-center items-center px-4 py-3 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-xl font-bold transition text-xs">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50 border-b border-gray-100">

                            <tr>

                                <th class="px-8 py-5 text-left text-sm font-semibold text-gray-600">
                                    Mata Kuliah
                                </th>

                                <th class="px-8 py-5 text-left text-sm font-semibold text-gray-600">
                                    Dosen
                                </th>

                                <th class="px-8 py-5 text-left text-sm font-semibold text-gray-600">
                                    Deskripsi
                                </th>

                                <th class="px-8 py-5 text-center text-sm font-semibold text-gray-600">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse ($courses as $course)
                                <tr class="hover:bg-blue-50/40 transition">

                                    {{-- Course --}}
                                    <td class="px-8 py-6">

                                        <div class="flex items-center gap-4">

                                            <div
                                                class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl shrink-0">

                                                <i class="fa-solid fa-book"></i>

                                            </div>

                                            <div>

                                                <h3 class="font-semibold text-gray-900 text-lg">

                                                    {{ $course->title }}

                                                </h3>

                                                <p class="text-xs text-gray-500 mt-1.5 flex items-center gap-2">
                                                    <span class="font-mono">ID: #{{ $course->id }}</span>
                                                    <span class="inline-flex items-center gap-1 px-1.5 py-0.5 bg-blue-50 text-blue-700 text-[11px] font-semibold rounded border border-blue-100">
                                                        <i class="fa-solid fa-graduation-cap text-[10px]"></i>
                                                        Semester {{ $course->semester }}
                                                    </span>
                                                </p>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- Lecturer --}}
                                    <td class="px-8 py-6">

                                        <div
                                            class="inline-flex items-center gap-3 px-4 py-2 rounded-2xl bg-green-50 text-green-700 border border-green-100">

                                            <i class="fa-solid fa-chalkboard-user"></i>

                                            <span class="font-medium">

                                                {{ $course->lecturers->name ?? 'Belum Ada Dosen' }}

                                            </span>

                                        </div>

                                    </td>

                                    {{-- Description --}}
                                    <td class="px-8 py-6">

                                        <p class="text-gray-600 leading-relaxed max-w-md">

                                            {{ Str::limit($course->description, 80) }}

                                        </p>

                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-8 py-6">

                                        <div class="flex items-center justify-center gap-3">

                                            {{-- Detail --}}
                                            <a href="{{ route('admin.courses.show', $course) }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-xl transition text-sm font-medium">

                                                <i class="fa-solid fa-eye"></i>

                                                Detail

                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('admin.courses.edit', $course) }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-50 hover:bg-yellow-100 text-yellow-700 rounded-xl transition text-sm font-medium">

                                                <i class="fa-solid fa-pen"></i>

                                                Edit

                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST"
                                                class="delete-form inline"
                                                data-title="Hapus Mata Kuliah"
                                                data-message="Apakah Anda yakin ingin menghapus mata kuliah '{{ $course->title }}'? Semua data terkait (materi, tugas) juga akan dihapus secara permanen.">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 hover:bg-red-100 text-red-700 rounded-xl transition text-sm font-medium">

                                                    <i class="fa-solid fa-trash"></i>

                                                    Hapus

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                {{-- Empty State --}}
                                <tr>

                                    <td colspan="4" class="px-8 py-20 text-center">

                                        <div class="flex flex-col items-center">

                                            <div
                                                class="w-24 h-24 rounded-3xl bg-blue-100 text-blue-600 flex items-center justify-center text-4xl mb-6">

                                                <i class="fa-solid fa-book-open"></i>

                                            </div>

                                            <h3 class="text-2xl font-bold text-gray-900">

                                                Belum Ada Mata Kuliah

                                            </h3>

                                            <p class="text-gray-500 mt-3 max-w-md">

                                                Tambahkan mata kuliah pertama
                                                untuk mulai mengelola pembelajaran.

                                            </p>

                                            <a href="{{ route('admin.courses.create') }}"
                                                class="mt-8 inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl transition shadow-lg shadow-blue-100">

                                                <i class="fa-solid fa-plus"></i>

                                                Tambah Matkul

                                            </a>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            {{-- Pagination --}}
            <div class="mt-8">

                {{ $courses->links() }}

            </div>

        </div>

    </div>

@endsection
