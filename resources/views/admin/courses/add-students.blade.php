@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Tambah Mahasiswa ke Matkul</h1>
                <p class="text-gray-600 mb-6">{{ $course->title }}</p>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($students->count() > 0)
                    <form action="{{ route('admin.courses.store-enrollment', $course) }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Students Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-4">
                                Pilih Mahasiswa <span class="text-red-500">*</span>
                            </label>
                            <div
                                class="space-y-3 max-h-96 overflow-y-auto border border-gray-300 rounded-lg p-4 bg-gray-50">
                                @foreach ($students as $student)
                                    <div class="flex items-center">
                                        <input type="checkbox" id="student_{{ $student->id }}" name="student_ids[]"
                                            value="{{ $student->id }}"
                                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                                        <label for="student_{{ $student->id }}" class="ml-3 flex-1 cursor-pointer">
                                            <span class="text-sm font-medium text-gray-900">{{ $student->name }}</span>
                                            <span class="text-sm text-gray-600 block">NPM: {{ $student->npm }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('student_ids')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 pt-4">
                            <button type="submit"
                                class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg transition">
                                Tambah Mahasiswa
                            </button>
                            <a href="{{ route('admin.courses.show', $course) }}"
                                class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg text-center transition">
                                Batal
                            </a>
                        </div>
                    </form>
                @else
                    <div class="p-6 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="text-yellow-800">
                            Semua mahasiswa sudah terdaftar di matkul ini. <a
                                href="{{ route('admin.courses.show', $course) }}"
                                class="text-blue-500 hover:text-blue-700">Kembali</a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
