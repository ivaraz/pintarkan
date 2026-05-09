@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit User</h1>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                            placeholder="contoh@email.com" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password (optional for edit) -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                            Password Baru (kosongkan jika tidak ingin mengubah)
                        </label>
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                            placeholder="Masukkan password baru">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Konfirmasi Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Konfirmasi password baru">
                    </div>

                    <!-- Role (Read-only info) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <div class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg">
                            @foreach ($user->getRoleNames() as $role)
                                @if ($role === 'admin')
                                    <span
                                        class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">Admin</span>
                                @elseif ($role === 'dosen')
                                    <span
                                        class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">Dosen</span>
                                @elseif ($role === 'mahasiswa')
                                    <span
                                        class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Mahasiswa</span>
                                @endif
                            @endforeach
                        </div>
                        <p class="text-gray-500 text-xs mt-2">Role tidak dapat diubah di halaman ini</p>
                    </div>

                    <!-- Name (if Dosen or Mahasiswa) -->
                    @if ($user->student || $user->lecturer)
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap
                            </label>
                            <input type="text" id="name" name="name"
                                value="{{ old('name', $user->student?->name ?? $user->lecturer?->name) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                placeholder="Masukkan nama lengkap">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <!-- NPM (if Mahasiswa) -->
                    @if ($user->student)
                        <div>
                            <label for="npm" class="block text-sm font-medium text-gray-700 mb-2">
                                NPM (Nomor Pokok Mahasiswa)
                            </label>
                            <input type="text" id="npm" name="npm"
                                value="{{ old('npm', $user->student->npm) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('npm') border-red-500 @enderror"
                                placeholder="Masukkan NPM">
                            @error('npm')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <!-- NIDN (if Dosen) -->
                    @if ($user->lecturer)
                        <div>
                            <label for="nidn" class="block text-sm font-medium text-gray-700 mb-2">
                                NIDN (Nomor Induk Dosen Nasional)
                            </label>
                            <input type="text" id="nidn" name="nidn"
                                value="{{ old('nidn', $user->lecturer->nidn) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nidn') border-red-500 @enderror"
                                placeholder="Masukkan NIDN">
                            @error('nidn')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <!-- Buttons -->
                    <div class="flex gap-4">
                        <button type="submit"
                            class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.users.index') }}"
                            class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg text-center transition duration-200">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
