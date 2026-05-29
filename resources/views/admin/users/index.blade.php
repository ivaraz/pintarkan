@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">
        {{-- Background Blur --}}
        <div class="fixed top-0 left-0 w-72 h-72 bg-blue-200 opacity-20 rounded-full blur-3xl -z-10"></div>
        <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 opacity-30 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 space-y-8">
            {{-- HEADER --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div>
                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium border border-blue-100 mb-5">
                            <i class="fa-solid fa-users-gear"></i>
                            User Management
                        </div>
                        <h1 class="text-4xl font-bold text-gray-900">Kelola User</h1>
                        <p class="text-gray-500 mt-3 text-lg">
                            Kelola seluruh pengguna PintarKan (Admin, Lecturer, dan Student).
                        </p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-wrap items-center gap-3">

                        <a href="{{ route('admin.users.create') }}"
                            class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl transition shadow-lg shadow-blue-100">

                            <i class="fa-solid fa-user-plus"></i>

                            Tambah User

                        </a>

                    </div>
                </div>
            </div>

            {{-- SESSION MESSAGES --}}
            @if (session('success'))
                <div
                    class="p-5 bg-green-50 border border-green-200 text-green-800 rounded-2xl flex items-center gap-3 shadow-sm">
                    <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="p-5 bg-red-50 border border-red-200 text-red-800 rounded-2xl flex items-center gap-3 shadow-sm">
                    <i class="fa-solid fa-circle-xmark text-red-600 text-xl"></i>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif

            {{-- USER TABLE --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50/50">
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Nama</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Email
                                </th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">Role</th>
                                <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">ID / NPM
                                    / NIDN</th>
                                <th
                                    class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-gray-500 text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50/70 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center font-semibold text-sm">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <span class="font-semibold text-gray-950 block">
                                                    {{ $user->student?->name ?? ($user->lecturer?->name ?? 'Admin') }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-sm">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @foreach ($user->getRoleNames() as $role)
                                            @if ($role === 'admin')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-100">
                                                    <i class="fa-solid fa-shield-halved text-[10px]"></i> Admin
                                                </span>
                                            @elseif ($role === 'lecturer')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                                    <i class="fa-solid fa-chalkboard-user text-[10px]"></i> Lecturer
                                                </span>
                                            @elseif ($role === 'student')
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold bg-green-50 text-green-700 border border-green-100">
                                                    <i class="fa-solid fa-user-graduate text-[10px]"></i> Student
                                                </span>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-sm font-medium">
                                        @if ($user->student)
                                            <span
                                                class="font-mono bg-gray-100 text-gray-700 px-2.5 py-1 rounded-lg text-xs">{{ $user->student->npm }}</span>
                                        @elseif ($user->lecturer)
                                            <span
                                                class="font-mono bg-gray-100 text-gray-700 px-2.5 py-1 rounded-lg text-xs">{{ $user->lecturer->nidn }}</span>
                                        @else
                                            <span class="text-gray-400 font-mono text-xs">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 rounded-xl transition">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini? Semua data terkait (profil & pendaftaran) akan ikut terhapus secara permanen.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 rounded-xl transition">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div
                                            class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl mx-auto mb-4">
                                            <i class="fa-solid fa-users-slash"></i>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-900">Belum Ada User</h3>
                                        <p class="text-gray-500 mt-1 max-w-sm mx-auto">
                                            Tidak ada user yang ditemukan di sistem. Mulai dengan membuat user baru.
                                        </p>
                                        <a href="{{ route('admin.users.create') }}"
                                            class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition">
                                            + Tambah User
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                @if ($users->hasPages())
                    <div class="px-6 py-5 border-t border-gray-100 bg-gray-50/50">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
