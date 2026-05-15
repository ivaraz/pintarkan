@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Matkul Baru</h1>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.courses.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Judul Matkul -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Matkul <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror"
                            placeholder="Contoh: Pemrograman Web" required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Dosen -->
                    <div>
                        <label for="lecturer_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Pilih Dosen <span class="text-red-500">*</span>
                        </label>
                        <select id="lecturer_id" name="lecturer_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('lecturer_id') border-red-500 @enderror"
                            required>
                            <option value="">-- Pilih Dosen --</option>
                            @foreach ($lecturers as $lecturer)
                                <option value="{{ $lecturer->id }}"
                                    {{ old('lecturer_id') == $lecturer->id ? 'selected' : '' }}>
                                    {{ $lecturer->name }} ({{ $lecturer->nidn }})
                                </option>
                            @endforeach
                        </select>
                        @error('lecturer_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea id="description" name="description" rows="5"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                            placeholder="Deskripsi matkul...">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="submit"
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition">
                            Simpan Matkul
                        </button>
                        <a href="{{ route('admin.courses.index') }}"
                            class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg text-center transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
