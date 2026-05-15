@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Student Dashboard -->
            <div class="space-y-6">
                <!-- Header -->
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Dashboard Mahasiswa</h1>
                    <p class="text-gray-600 mt-2">Pantau kemajuan akademik dan kelola tugas Anda</p>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Enrolled Courses Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Mata Kuliah Diambil</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $enrollmentCount ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C6.228 6.228 2 10.456 2 15.5S6.228 24.772 12 24.772s10-4.228 10-9.272S17.772 6.253 12 6.253z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Assignments Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Total Tugas</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $assignmentCount ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Completed Assignments Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Tugas Selesai</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $completedAssignments ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Average Grade Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Rata-rata Nilai</p>
                                <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($averageGrade ?? 0, 1) }}
                                </p>
                            </div>
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Enrolled Courses -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-bold text-gray-900">Mata Kuliah Anda</h2>
                        </div>
                        @if ($enrollments && count($enrollments) > 0)
                            <div class="space-y-3">
                                @foreach ($enrollments as $enrollment)
                                    <div class="p-4 border border-gray-200 rounded-lg hover:bg-blue-50 transition-colors">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h3 class="font-semibold text-gray-900">{{ $enrollment->course->title }}
                                                </h3>
                                                <p class="text-sm text-gray-600 mt-1">
                                                    Dosen: {{ $enrollment->course->lecturer->name ?? 'N/A' }}
                                                </p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    Status:
                                                    <span
                                                        class="px-2 py-1 rounded text-xs font-medium {{ $enrollment->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ ucfirst($enrollment->status) }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="text-right">
                                                <a href="#"
                                                    class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                                    Lihat Kelas
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-6 text-center bg-gray-50 rounded-lg">
                                <p class="text-gray-500">Anda belum terdaftar di mata kuliah apapun</p>
                            </div>
                        @endif
                    </div>

                    <!-- Course Progress -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Status Pembelajaran</h2>
                        @if ($enrollments && count($enrollments) > 0)
                            <div class="space-y-4">
                                @php $i = 0; @endphp
                                @foreach ($enrollments as $enrollment)
                                    @php
                                        $colors = ['blue', 'purple', 'green', 'orange', 'red', 'indigo'];
                                        $color = $colors[$i % count($colors)];
                                        $progress = ((($i + 1) % 4) + 1) * 20; // Simulate progress
                                        $i++;
                                    @endphp
                                    <div>
                                        <div class="flex items-center justify-between mb-2">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ Str::limit($enrollment->course->title, 20) }}</p>
                                            <span class="text-xs font-bold text-gray-600">{{ $progress }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-{{ $color }}-600 h-2 rounded-full"
                                                style="width: {{ $progress }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="p-4 text-center bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-500">Belum ada progress pembelajaran</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Upcoming Assignments -->
                @if ($assignments && count($assignments) > 0)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-bold text-gray-900">Tugas Mendatang</h2>
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Semua</a>
                        </div>
                        <div class="space-y-3">
                            @foreach ($assignments->take(5) as $assignment)
                                @php
                                    $daysLeft = \Carbon\Carbon::parse($assignment->due_date)->diffInDays(
                                        \Carbon\Carbon::now(),
                                    );
                                    if ($daysLeft <= 0) {
                                        $status = 'danger';
                                    } elseif ($daysLeft <= 5) {
                                        $status = 'warning';
                                    } else {
                                        $status = 'info';
                                    }

                                    $colors = ['danger' => 'red', 'warning' => 'yellow', 'info' => 'green'];
                                @endphp
                                <div
                                    class="p-4 border-l-4 border-{{ $colors[$status] }}-500 bg-{{ $colors[$status] }}-50 rounded-lg hover:shadow-sm transition-shadow">
                                    <div class="flex items-center justify-between">
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-gray-900">{{ $assignment->title }}</h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ $assignment->course->title ?? 'N/A' }}
                                            </p>
                                            <div class="flex items-center mt-2">
                                                <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <p class="text-xs text-{{ $colors[$status] }}-600 font-medium">
                                                    @if ($daysLeft <= 0)
                                                        Deadline sudah lewat!
                                                    @else
                                                        Deadline: {{ $daysLeft }} hari lagi
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <span
                                            class="px-3 py-1 bg-{{ $colors[$status] }}-200 text-{{ $colors[$status] }}-800 text-xs font-bold rounded">
                                            @if ($daysLeft <= 0)
                                                Lewat
                                            @elseif($daysLeft <= 5)
                                                Segera
                                            @else
                                                Cukup
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center">
                        <p class="text-gray-500">Tidak ada tugas yang mendatang</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
