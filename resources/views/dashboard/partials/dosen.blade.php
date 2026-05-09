<!-- Lecturer Dashboard -->
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Pengajar</h1>
        <p class="text-gray-600 mt-2">Kelola mata kuliah dan pantau kemajuan mahasiswa Anda</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Courses Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Mata Kuliah</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $courseCount ?? 0 }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C6.228 6.228 2 10.456 2 15.5S6.228 24.772 12 24.772s10-4.228 10-9.272S17.772 6.253 12 6.253z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Students Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Total Mahasiswa</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">0</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20a6 6 0 0112 0v2H0v-2a6 6 0 016-6z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Assignments Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Tugas Aktif</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">0</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Submissions Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Pengumpulan Menunggu</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">0</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Courses -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-900">Mata Kuliah Anda</h2>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Semua</a>
            </div>
            <div class="space-y-3">
                <div class="p-4 border border-gray-200 rounded-lg hover:bg-blue-50 transition-colors cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-gray-900">Pemrograman Web</h3>
                            <p class="text-sm text-gray-600 mt-1">3 Kelas • 45 Mahasiswa</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Total Materi</p>
                            <p class="text-lg font-bold text-blue-600">12</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 border border-gray-200 rounded-lg hover:bg-green-50 transition-colors cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-gray-900">Basis Data</h3>
                            <p class="text-sm text-gray-600 mt-1">2 Kelas • 38 Mahasiswa</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Total Materi</p>
                            <p class="text-lg font-bold text-green-600">8</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 border border-gray-200 rounded-lg hover:bg-purple-50 transition-colors cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold text-gray-900">Algoritma & Struktur Data</h3>
                            <p class="text-sm text-gray-600 mt-1">3 Kelas • 52 Mahasiswa</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500">Total Materi</p>
                            <p class="text-lg font-bold text-purple-600">15</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h2>
            <div class="space-y-3">
                <a href="#"
                    class="block p-3 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition-colors group">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 text-blue-600">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 group-hover:text-blue-600">Tambah Materi</p>
                            <p class="text-xs text-gray-500">Unggah konten pembelajaran</p>
                        </div>
                    </div>
                </a>
                <a href="#"
                    class="block p-3 border border-gray-200 rounded-lg hover:bg-purple-50 hover:border-purple-300 transition-colors group">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 text-purple-600">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 group-hover:text-purple-600">Buat Tugas Baru
                            </p>
                            <p class="text-xs text-gray-500">Buat assignment untuk mahasiswa</p>
                        </div>
                    </div>
                </a>
                <a href="#"
                    class="block p-3 border border-gray-200 rounded-lg hover:bg-green-50 hover:border-green-300 transition-colors group">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 text-green-600">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 group-hover:text-green-600">Lihat Nilai</p>
                            <p class="text-xs text-gray-500">Kelola nilai mahasiswa</p>
                        </div>
                    </div>
                </a>
                <a href="#"
                    class="block p-3 border border-gray-200 rounded-lg hover:bg-orange-50 hover:border-orange-300 transition-colors group">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 text-orange-600">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900 group-hover:text-orange-600">Kelola Jadwal</p>
                            <p class="text-xs text-gray-500">Ubah jadwal perkuliahan</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
