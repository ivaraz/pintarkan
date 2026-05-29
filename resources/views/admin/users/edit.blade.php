@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        {{-- Background Blur --}}
        <div class="fixed top-0 left-0 w-72 h-72 bg-blue-200 opacity-20 rounded-full blur-3xl -z-10"></div>
        <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 opacity-30 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-3xl mx-auto px-6">
            {{-- Back Link --}}
            <div class="mb-6">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-900 transition font-medium">
                    <i class="fa-solid fa-arrow-left"></i>
                    Kembali ke Daftar User
                </a>
            </div>

            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
                {{-- Form Header --}}
                <div class="border-b border-gray-100 p-8 bg-gray-50/50">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-950">Edit User</h1>
                            <p class="text-gray-500 text-sm mt-1">Ubah info akun, role, profil, atau reset password untuk <strong>{{ $user->email }}</strong>.</p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    @if ($errors->any())
                        <div class="mb-6 p-5 bg-red-50 border border-red-200 text-red-800 rounded-2xl flex flex-col gap-2">
                            <div class="flex items-center gap-2 font-semibold">
                                <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
                                Periksa kesalahan berikut:
                            </div>
                            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        {{-- Section: Account --}}
                        <div>
                            <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Informasi Akun</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Email --}}
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                        placeholder="contoh@email.com" required>
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Role --}}
                                <div>
                                    <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Role <span class="text-red-500">*</span>
                                    </label>
                                    <select id="role" name="role"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('role') border-red-500 @enderror"
                                        required onchange="toggleRoleFields()">
                                        <option value="admin" {{ old('role', $user->getRoleNames()->first()) === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="lecturer" {{ old('role', $user->getRoleNames()->first()) === 'lecturer' ? 'selected' : '' }}>Lecturer (Dosen)</option>
                                        <option value="student" {{ old('role', $user->getRoleNames()->first()) === 'student' ? 'selected' : '' }}>Student (Mahasiswa)</option>
                                    </select>
                                    @error('role')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-100 my-6">

                        {{-- Section: Profile details --}}
                        <div id="profileSection">
                            <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Informasi Profil</h2>
                            <div class="space-y-6">
                                {{-- Name --}}
                                <div id="nameField" class="hidden">
                                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name"
                                        value="{{ old('name', $user->student?->name ?? ($user->lecturer?->name ?? '')) }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                        placeholder="Masukkan nama lengkap">
                                    @error('name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- NPM --}}
                                    <div id="npmField" class="hidden">
                                        <label for="npm" class="block text-sm font-semibold text-gray-700 mb-2">
                                            NPM (Nomor Pokok Mahasiswa) <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="npm" name="npm"
                                            value="{{ old('npm', $user->student?->npm ?? '') }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('npm') border-red-500 @enderror"
                                            placeholder="Masukkan NPM">
                                        @error('npm')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- NIDN --}}
                                    <div id="nidnField" class="hidden">
                                        <label for="nidn" class="block text-sm font-semibold text-gray-700 mb-2">
                                            NIDN (Nomor Induk Dosen Nasional) <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" id="nidn" name="nidn"
                                            value="{{ old('nidn', $user->lecturer?->nidn ?? '') }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nidn') border-red-500 @enderror"
                                            placeholder="Masukkan NIDN">
                                        @error('nidn')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-100 my-6">

                        {{-- Section: Reset Password --}}
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Reset Password</h2>
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded font-medium">Opsional</span>
                            </div>
                            <p class="text-xs text-gray-500 mb-4">Kosongkan kolom di bawah jika Anda tidak ingin mereset password user ini.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Password --}}
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Password Baru
                                    </label>
                                    <input type="password" id="password" name="password"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('password') border-red-500 @enderror"
                                        placeholder="Masukkan password baru">
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Confirm Password --}}
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Konfirmasi Password Baru
                                    </label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Konfirmasi password baru">
                                </div>
                            </div>
                        </div>

                        {{-- Submit Buttons --}}
                        <div class="flex gap-4 pt-6">
                            <button type="submit"
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-2xl transition duration-200 shadow-lg shadow-blue-100">
                                <i class="fa-solid fa-floppy-disk mr-1"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.users.index') }}"
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3.5 px-4 rounded-2xl text-center transition duration-200">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleRoleFields() {
            const role = document.getElementById('role').value;
            const profileSection = document.getElementById('profileSection');
            const nameField = document.getElementById('nameField');
            const npmField = document.getElementById('npmField');
            const nidnField = document.getElementById('nidnField');

            // Hide all by default
            nameField.classList.add('hidden');
            npmField.classList.add('hidden');
            nidnField.classList.add('hidden');
            profileSection.classList.add('hidden');

            // Show relevant fields based on role
            if (role === 'student') {
                profileSection.classList.remove('hidden');
                nameField.classList.remove('hidden');
                npmField.classList.remove('hidden');
            } else if (role === 'lecturer') {
                profileSection.classList.remove('hidden');
                nameField.classList.remove('hidden');
                nidnField.classList.remove('hidden');
            }
            // Admin doesn't need additional profile details
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', toggleRoleFields);
    </script>
@endsection
