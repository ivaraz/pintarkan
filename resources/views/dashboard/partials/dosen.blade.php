<!-- Lecturer Dashboard - Teaching Focus -->
<div class="space-y-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Welcome Back, {{ Auth::user()->name }}</h1>
        <p class="text-gray-600 mt-2">Manage your courses and track student progress</p>
    </div>

    <!-- Key Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Courses Taught -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Courses Taught</p>
                    <p class="text-4xl font-bold text-gray-900 mt-3">{{ $courseCount ?? 0 }}</p>
                    <p class="text-xs text-gray-600 mt-2">This academic year</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.228 6.228 2 10.456 2 15.5S6.228 24.772 12 24.772s10-4.228 10-9.272S17.772 6.253 12 6.253z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Active Students -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Active Students</p>
                    <p class="text-4xl font-bold text-gray-900 mt-3">{{ $studentCount ?? 0 }}</p>
                    <p class="text-xs text-gray-600 mt-2">Enrolled this semester</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-50 rounded-lg flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20a6 6 0 0112 0v2H0v-2a6 6 0 016-6z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Assignments Created -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Assignments</p>
                    <p class="text-4xl font-bold text-gray-900 mt-3">{{ $assignmentCount ?? 0 }}</p>
                    <p class="text-xs text-gray-600 mt-2">Total created</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-purple-100 to-purple-50 rounded-lg flex items-center justify-center">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Submissions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Submissions to Grade</p>
                    <p class="text-4xl font-bold text-red-600 mt-3">{{ $submissionsToGrade ?? 0 }}</p>
                    <p class="text-xs text-red-600 mt-2">Awaiting your review</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-red-100 to-red-50 rounded-lg flex items-center justify-center">
                    <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Grading Status & Course Management -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Grading Status Section -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Grading Status</h2>
                    <p class="text-sm text-gray-600 mt-1">Assignments awaiting your grading</p>
                </div>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium text-sm">View All</a>
            </div>

            <div class="space-y-4">
                <!-- Pending Assignment 1 -->
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors cursor-pointer">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">Web Development Project - Semester Project</h3>
                            <p class="text-sm text-gray-600 mt-1">Due: 2026-05-15 • 24 submissions</p>
                        </div>
                        <span class="inline-block px-3 py-1 bg-red-100 text-red-700 text-xs font-bold rounded-full">12 Pending</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-red-500 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                    <p class="text-xs text-gray-600 mt-2">45% graded</p>
                </div>

                <!-- Pending Assignment 2 -->
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors cursor-pointer">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">Database Design Quiz</h3>
                            <p class="text-sm text-gray-600 mt-1">Due: 2026-05-12 • 18 submissions</p>
                        </div>
                        <span class="inline-block px-3 py-1 bg-orange-100 text-orange-700 text-xs font-bold rounded-full">8 Pending</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-orange-500 h-2 rounded-full" style="width: 56%"></div>
                    </div>
                    <p class="text-xs text-gray-600 mt-2">56% graded</p>
                </div>

                <!-- Pending Assignment 3 -->
                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition-colors cursor-pointer">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">Algorithm Implementation Assignment</h3>
                            <p class="text-sm text-gray-600 mt-1">Due: 2026-05-18 • 30 submissions</p>
                        </div>
                        <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">5 Pending</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: 83%"></div>
                    </div>
                    <p class="text-xs text-gray-600 mt-2">83% graded</p>
                </div>
            </div>
        </div>

        <!-- Quick Actions Panel -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Quick Actions</h2>
            <div class="space-y-3">
                <a href="#" class="flex items-center justify-between p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors group">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span class="font-medium text-gray-900 group-hover:text-blue-700">Create Assignment</span>
                    </div>
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="#" class="flex items-center justify-between p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors group">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span class="font-medium text-gray-900 group-hover:text-purple-700">Grade Submissions</span>
                    </div>
                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="#" class="flex items-center justify-between p-3 bg-green-50 rounded-lg hover:bg-green-100 transition-colors group">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span class="font-medium text-gray-900 group-hover:text-green-700">Upload Material</span>
                    </div>
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>

                <a href="#" class="flex items-center justify-between p-3 bg-orange-50 rounded-lg hover:bg-orange-100 transition-colors group">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM9 9H5a4 4 0 00-4 4v5h16v-5a4 4 0 00-4-4h-4z"/>
                        </svg>
                        <span class="font-medium text-gray-900 group-hover:text-orange-700">Class Records</span>
                    </div>
                    <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <!-- Class Performance Summary -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="font-semibold text-gray-900 mb-4">Class Overview</h3>
                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-700">Pemrograman Web</span>
                            <span class="text-xs font-bold text-blue-600">78%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 78%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-700">Basis Data</span>
                            <span class="text-xs font-bold text-purple-600">82%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-600 h-2 rounded-full" style="width: 82%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="text-sm text-gray-700">Algoritma</span>
                            <span class="text-xs font-bold text-green-600">75%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Management -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Your Courses</h2>
                <p class="text-sm text-gray-600 mt-1">Manage and track your teaching courses</p>
            </div>
            <a href="#" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Course
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Course Card 1 -->
            <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-32 bg-gradient-to-br from-blue-500 to-blue-600"></div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-900">Pemrograman Web</h3>
                    <p class="text-sm text-gray-600 mt-1">Kelas A - 45 Students</p>
                    <div class="mt-4 pt-4 border-t border-gray-200 flex items-center justify-between text-sm">
                        <span class="text-gray-600">Completion</span>
                        <span class="font-bold text-blue-600">68%</span>
                    </div>
                </div>
            </div>

            <!-- Course Card 2 -->
            <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-32 bg-gradient-to-br from-purple-500 to-purple-600"></div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-900">Basis Data</h3>
                    <p class="text-sm text-gray-600 mt-1">Kelas B - 38 Students</p>
                    <div class="mt-4 pt-4 border-t border-gray-200 flex items-center justify-between text-sm">
                        <span class="text-gray-600">Completion</span>
                        <span class="font-bold text-purple-600">75%</span>
                    </div>
                </div>
            </div>

            <!-- Course Card 3 -->
            <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-32 bg-gradient-to-br from-green-500 to-green-600"></div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-900">Algoritma & Struktur Data</h3>
                    <p class="text-sm text-gray-600 mt-1">Kelas C - 52 Students</p>
                    <div class="mt-4 pt-4 border-t border-gray-200 flex items-center justify-between text-sm">
                        <span class="text-gray-600">Completion</span>
                        <span class="font-bold text-green-600">82%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Submission Status Chart -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Status Pengumpulan Tugas</h2>
            <div class="flex items-center justify-center" style="height: 300px;">
                <canvas id="submissionStatusChart"></canvas>
            </div>
        </div>

        <!-- Student Performance Chart -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Kinerja Mahasiswa per Mata Kuliah</h2>
            <div class="flex items-center justify-center" style="height: 300px;">
                <canvas id="coursePerformanceChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Charts Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Submission Status Chart - Pie Chart
            const submissionCtx = document.getElementById('submissionStatusChart');
            if (submissionCtx) {
                new Chart(submissionCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Sudah Dikumpulkan', 'Pending', 'Terlambat'],
                        datasets: [{
                            data: [65, 25, 10],
                            backgroundColor: [
                                '#10B981',
                                '#F59E0B',
                                '#EF4444'
                            ],
                            borderColor: '#fff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    font: { size: 12 },
                                    padding: 15,
                                    usePointStyle: true
                                }
                            }
                        }
                    }
                });
            }

            // Student Performance Chart - Bar Chart
            const performanceCtx = document.getElementById('coursePerformanceChart');
            if (performanceCtx) {
                new Chart(performanceCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Pemrograman Web', 'Basis Data', 'Algoritma'],
                        datasets: [{
                            label: 'Rata-rata Nilai',
                            data: [78, 82, 75],
                            backgroundColor: '#8B5CF6',
                            borderRadius: 4
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                labels: {
                                    font: { size: 12 },
                                    usePointStyle: true,
                                    padding: 15
                                }
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                max: 100,
                                grid: {
                                    drawBorder: false,
                                    color: '#E5E7EB'
                                }
                            },
                            y: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>

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
