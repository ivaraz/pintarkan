@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Daftar Matkul</h1>
                <a href="{{ route('admin.courses.create') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition">
                    + Tambah Matkul
                </a>
            </div>

            @if (session('alert-type'))
                <div
                    class="mb-4 p-4 bg-{{ session('alert-type') == 'success' ? 'green' : 'red' }}-100 border border-{{ session('alert-type') == 'success' ? 'green' : 'red' }}-400 text-{{ session('alert-type') == 'success' ? 'green' : 'red' }}-700 rounded">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Courses Table -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Judul Matkul</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Dosen</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Deskripsi</th>
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($courses as $course)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $course->title }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $course->lecturers->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ Str::limit($course->description, 50) }}</td>
                                <td class="px-6 py-4 text-center text-sm">
                                    <a href="{{ route('admin.courses.show', $course) }}"
                                        class="text-blue-500 hover:text-blue-700 mr-3">Lihat</a>
                                    <a href="{{ route('admin.courses.edit', $course) }}"
                                        class="text-yellow-500 hover:text-yellow-700 mr-3">Edit</a>
                                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Apakah Anda yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada matkul. <a href="{{ route('admin.courses.create') }}"
                                        class="text-blue-500 hover:text-blue-700">Tambah sekarang</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $courses->links() }}
            </div>
        </div>
    </div>
@endsection
