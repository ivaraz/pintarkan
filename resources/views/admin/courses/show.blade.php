@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $course->title }}</h1>
                    <p class="text-gray-600 mt-2">Dosen: <strong>{{ $course->lecturers->name ?? 'N/A' }}</strong></p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.courses.edit', $course) }}"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg transition">
                        Edit
                    </a>
                    <a href="{{ route('admin.courses.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition">
                        Kembali
                    </a>
                </div>
            </div>

            @if (session('alert-type'))
                <div
                    class="mb-4 p-4 bg-{{ session('alert-type') == 'success' ? 'green' : 'red' }}-100 border border-{{ session('alert-type') == 'success' ? 'green' : 'red' }}-400 text-{{ session('alert-type') == 'success' ? 'green' : 'red' }}-700 rounded">
                    {{ session('message') }}
                </div>
            @endif

            <!-- Course Info -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Matkul</h2>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm text-gray-600">Judul Matkul</p>
                        <p class="text-lg font-medium text-gray-900">{{ $course->title }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Dosen Pengampu</p>
                        <p class="text-lg font-medium text-gray-900">{{ $course->lecturers->name ?? 'N/A' }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-sm text-gray-600">Deskripsi</p>
                        <p class="text-lg font-medium text-gray-900">{{ $course->description ?? 'Belum ada deskripsi' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Enrolled Students -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-semibold text-gray-800">Daftar Mahasiswa Terdaftar
                        ({{ $enrolledStudents->count() }})</h2>
                    <a href="{{ route('admin.courses.add-students', $course) }}"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition">
                        + Tambah Mahasiswa
                    </a>
                </div>

                @if ($enrolledStudents->count() > 0)
                    <table class="w-full">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Mahasiswa</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">NPM</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Tanggal Daftar</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($enrolledStudents as $enrollment)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                                        {{ $enrollment->student->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-600">{{ $enrollment->student->npm }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span
                                            class="px-2 py-1 rounded-full text-xs font-medium {{ $enrollment->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($enrollment->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ $enrollment->enrolled_at ? $enrollment->enrolled_at->format('d M Y') : 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-sm">
                                        <form action="{{ route('admin.courses.remove-student', [$course, $enrollment]) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-gray-500 py-8">
                        Belum ada mahasiswa yang terdaftar. <a href="{{ route('admin.courses.add-students', $course) }}"
                            class="text-blue-500 hover:text-blue-700">Tambah mahasiswa sekarang</a>
                    </p>
                @endif
            </div>
        </div>
    </div>
@endsection
