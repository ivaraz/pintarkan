@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Kelola User</h1>
            <a href="{{ route('admin.users.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                + Tambah User Baru
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Role</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">ID / NPM / NIDN</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-3 text-sm text-gray-800">{{ $user->email }}</td>
                            <td class="px-6 py-3 text-sm text-gray-800">
                                @if ($user->student)
                                    {{ $user->student->name }}
                                @elseif ($user->lecturer)
                                    {{ $user->lecturer->name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-3 text-sm">
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
                            </td>
                            <td class="px-6 py-3 text-sm text-gray-800">
                                @if ($user->student)
                                    {{ $user->student->npm }}
                                @elseif ($user->lecturer)
                                    {{ $user->lecturer->nidn }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-3 text-sm">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded text-xs transition duration-200">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-xs transition duration-200">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                Belum ada user. <a href="{{ route('admin.users.create') }}"
                                    class="text-blue-500 hover:underline">Buat sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
@endsection
