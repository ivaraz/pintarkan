@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">

        <div class="max-w-7xl mx-auto space-y-6">

            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h1 class="text-3xl font-bold text-gray-900">
                        Mata Kuliah Saya
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Kelola seluruh mata kuliah yang Anda ajarkan.
                    </p>
                </div>

                <a href="{{ route('dosen.courses.create') }}"
                    class="inline-flex items-center justify-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow-sm transition">

                    + Tambah Mata Kuliah
                </a>

            </div>

            {{-- ALERT --}}
            @if (session('alert-type'))
                <div
                    class="rounded-2xl border px-5 py-4 shadow-sm
                    {{ session('alert-type') == 'success'
                        ? 'bg-green-50 border-green-200 text-green-700'
                        : 'bg-red-50 border-red-200 text-red-700' }}">

                    <div class="flex items-center gap-3">
                        <span class="text-lg">
                            {{ session('alert-type') == 'success' ? '✅' : '❌' }}
                        </span>

                        <p class="font-medium">
                            {{ session('message') }}
                        </p>
                    </div>

                </div>
            @endif

            {{-- EMPTY STATE --}}
            @if ($courses->count() < 1)
                <div class="bg-white border border-dashed border-gray-300 rounded-3xl p-16 text-center shadow-sm">

                    <div class="text-6xl mb-4">
                        📚
                    </div>

                    <h2 class="text-2xl font-bold text-gray-900">
                        Belum Ada Mata Kuliah
                    </h2>

                    <p class="text-gray-500 mt-3 max-w-lg mx-auto">
                        Anda belum memiliki mata kuliah yang diajarkan.
                        Mulai dengan membuat course pertama Anda.
                    </p>

                    <a href="{{ route('dosen.courses.create') }}"
                        class="mt-8 inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl transition">

                        + Tambah Mata Kuliah
                    </a>

                </div>
            @else
                {{-- COURSE GRID --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    @foreach ($courses as $course)
                        <div
                            class="bg-white rounded-3xl border border-gray-200 shadow-sm hover:shadow-md hover:border-blue-300 transition-all duration-200 overflow-hidden">

                            {{-- TOP --}}
                            <div class="p-6">

                                <div class="flex items-start justify-between gap-4">

                                    <div class="flex-1">

                                        <h2 class="text-xl font-bold text-gray-900">
                                            {{ $course->title }}
                                        </h2>

                                        <p class="text-sm text-gray-500 mt-3 leading-relaxed">
                                            {{ Str::limit($course->description, 120) }}
                                        </p>

                                    </div>

                                    <div
                                        class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl">

                                        📘

                                    </div>

                                </div>

                                {{-- STATS --}}
                                <div class="grid grid-cols-3 gap-4 mt-6">

                                    {{-- STUDENTS --}}
                                    <div class="bg-gray-50 rounded-2xl p-4 text-center border">

                                        <p class="text-2xl font-bold text-gray-900">
                                            {{ $course->enrollments->count() }}
                                        </p>

                                        <p class="text-xs text-gray-500 mt-1">
                                            Mahasiswa
                                        </p>

                                    </div>

                                    {{-- MATERIALS --}}
                                    <div class="bg-gray-50 rounded-2xl p-4 text-center border">

                                        <p class="text-2xl font-bold text-gray-900">
                                            {{ $course->materials->count() }}
                                        </p>

                                        <p class="text-xs text-gray-500 mt-1">
                                            Materi
                                        </p>

                                    </div>

                                    {{-- ASSIGNMENTS --}}
                                    <div class="bg-gray-50 rounded-2xl p-4 text-center border">

                                        <p class="text-2xl font-bold text-gray-900">
                                            {{ $course->assignments->count() }}
                                        </p>

                                        <p class="text-xs text-gray-500 mt-1">
                                            Tugas
                                        </p>

                                    </div>

                                </div>

                            </div>

                            {{-- ACTIONS --}}
                            <div class="border-t bg-gray-50 px-6 py-4">

                                <div class="flex flex-wrap items-center gap-3">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('dosen.courses.show', $course->id) }}"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-xl transition">

                                        Detail
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('dosen.courses.edit', $course->id) }}"
                                        class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 hover:bg-gray-100 text-gray-700 text-sm rounded-xl transition">

                                        Edit
                                    </a>

                                    {{-- ADD STUDENT --}}
                                    <a href="{{ route('dosen.courses.students', $course->id) }}"
                                        class="inline-flex items-center justify-center px-4 py-2 border border-green-300 bg-green-50 hover:bg-green-100 text-green-700 text-sm rounded-xl transition">

                                        + Mahasiswa
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('dosen.courses.destroy', $course->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus mata kuliah ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex items-center justify-center px-4 py-2 border border-red-300 bg-red-50 hover:bg-red-100 text-red-700 text-sm rounded-xl transition">

                                            Hapus
                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

                {{-- PAGINATION --}}
                <div class="mt-8">
                    {{ $courses->links() }}
                </div>
            @endif

        </div>

    </div>
@endsection
