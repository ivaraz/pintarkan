<!-- Student Dashboard - Learning Focus -->
<div class="space-y-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-900">Welcome Back, {{ Auth::user()->name }}</h1>
        <p class="text-gray-600 mt-2">Continue your learning journey and track your progress</p>
    </div>

    <!-- Key Learning Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Enrolled Courses -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Enrolled Courses</p>
                    <p class="text-4xl font-bold text-gray-900 mt-3">{{ count($courses ?? []) }}</p>
                    <p class="text-xs text-gray-600 mt-2">This semester</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.228 6.228 2 10.456 2 15.5S6.228 24.772 12 24.772s10-4.228 10-9.272S17.772 6.253 12 6.253z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Assignments Pending -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Pending Assignments</p>
                    <p class="text-4xl font-bold text-orange-600 mt-3">{{ count($deadlines ?? []) }}</p>
                    <p class="text-xs text-orange-600 mt-2">Due this week</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-orange-100 to-orange-50 rounded-lg flex items-center justify-center">
                    <svg class="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Average Grade -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Average Grade</p>
                    <p class="text-4xl font-bold text-green-600 mt-3">78%</p>
                    <p class="text-xs text-gray-600 mt-2">All courses</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-green-100 to-green-50 rounded-lg flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Study Streak -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Study Streak</p>
                    <p class="text-4xl font-bold text-purple-600 mt-3">12</p>
                    <p class="text-xs text-purple-600 mt-2">Days active</p>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-purple-100 to-purple-50 rounded-lg flex items-center justify-center">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Learning Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Upcoming Deadlines with Color Coding -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Upcoming Deadlines</h2>
                    <p class="text-sm text-gray-600 mt-1">Stay on track with your assignments</p>
                </div>
                <a href="#" class="text-blue-600 hover:text-blue-700 font-medium text-sm">View All</a>
            </div>

            <div class="space-y-3">
                <!-- Critical Deadline (Red) -->
                <div class="border-l-4 border-red-500 bg-red-50 rounded-r-lg p-4 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <h3 class="font-semibold text-gray-900">Web Development Final Project</h3>
                                <span class="inline-block px-2 py-1 bg-red-200 text-red-700 text-xs font-bold rounded">CRITICAL</span>
                            </div>
                            <p class="text-sm text-gray-700">Pemrograman Web • Prof. Ahmad Wijaya</p>
                            <div class="flex items-center mt-3 space-x-4 text-xs text-gray-600">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zm0 7a2 2 0 100-4 2 2 0 000 4zm.5 7a.5.5 0 11-1 0 .5.5 0 011 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Due: May 10, 2026
                                </span>
                                <span class="text-red-600 font-bold">2 days left</span>
                            </div>
                        </div>
                        <button class="px-3 py-2 bg-red-100 text-red-700 rounded hover:bg-red-200 transition text-xs font-medium">View Details</button>
                    </div>
                </div>

                <!-- Upcoming Deadline (Orange) -->
                <div class="border-l-4 border-orange-500 bg-orange-50 rounded-r-lg p-4 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <h3 class="font-semibold text-gray-900">Database Design Quiz</h3>
                                <span class="inline-block px-2 py-1 bg-orange-200 text-orange-700 text-xs font-bold rounded">URGENT</span>
                            </div>
                            <p class="text-sm text-gray-700">Basis Data • Dr. Siti Nurhaliza</p>
                            <div class="flex items-center mt-3 space-x-4 text-xs text-gray-600">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zm0 7a2 2 0 100-4 2 2 0 000 4zm.5 7a.5.5 0 11-1 0 .5.5 0 011 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Due: May 12, 2026
                                </span>
                                <span class="text-orange-600 font-bold">4 days left</span>
                            </div>
                        </div>
                        <button class="px-3 py-2 bg-orange-100 text-orange-700 rounded hover:bg-orange-200 transition text-xs font-medium">View Details</button>
                    </div>
                </div>

                <!-- Standard Deadline (Blue) -->
                <div class="border-l-4 border-blue-500 bg-blue-50 rounded-r-lg p-4 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <h3 class="font-semibold text-gray-900">Reading Assignment: Design Patterns</h3>
                                <span class="inline-block px-2 py-1 bg-blue-200 text-blue-700 text-xs font-bold rounded">NORMAL</span>
                            </div>
                            <p class="text-sm text-gray-700">Algoritma & Struktur Data • Prof. Budi Santoso</p>
                            <div class="flex items-center mt-3 space-x-4 text-xs text-gray-600">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zm0 7a2 2 0 100-4 2 2 0 000 4zm.5 7a.5.5 0 11-1 0 .5.5 0 011 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Due: May 20, 2026
                                </span>
                                <span class="text-blue-600 font-bold">12 days left</span>
                            </div>
                        </div>
                        <button class="px-3 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition text-xs font-medium">View Details</button>
                    </div>
                </div>

                <!-- Completed (Green) -->
                <div class="border-l-4 border-green-500 bg-green-50 rounded-r-lg p-4 hover:shadow-md transition-shadow cursor-pointer opacity-75">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <h3 class="font-semibold text-gray-900">Midterm Exam</h3>
                                <span class="inline-block px-2 py-1 bg-green-200 text-green-700 text-xs font-bold rounded">COMPLETED</span>
                            </div>
                            <p class="text-sm text-gray-700">Pemrograman Web • Prof. Ahmad Wijaya</p>
                            <div class="flex items-center mt-3 space-x-4 text-xs text-gray-600">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v2a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zm0 7a2 2 0 100-4 2 2 0 000 4zm.5 7a.5.5 0 11-1 0 .5.5 0 011 0z" clip-rule="evenodd"/>
                                    </svg>
                                    Completed: May 5, 2026
                                </span>
                                <span class="text-green-600 font-bold">Score: 85/100</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Learning Progress & Announcements -->
        <div class="space-y-6">
            <!-- Course Progress Cards -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Course Progress</h2>
                <div class="space-y-4">
                    <!-- Course 1 Progress -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-900">Pemrograman Web</span>
                            <span class="text-xs font-bold text-blue-600">75%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 75%"></div>
                        </div>
                        <p class="text-xs text-gray-600 mt-1">15/20 materials completed</p>
                    </div>

                    <!-- Course 2 Progress -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-900">Basis Data</span>
                            <span class="text-xs font-bold text-purple-600">60%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-purple-600 h-2.5 rounded-full" style="width: 60%"></div>
                        </div>
                        <p class="text-xs text-gray-600 mt-1">12/20 materials completed</p>
                    </div>

                    <!-- Course 3 Progress -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-900">Algoritma & Struktur Data</span>
                            <span class="text-xs font-bold text-green-600">85%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-green-600 h-2.5 rounded-full" style="width: 85%"></div>
                        </div>
                        <p class="text-xs text-gray-600 mt-1">17/20 materials completed</p>
                    </div>

                    <!-- Course 4 Progress -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-900">Sistem Operasi</span>
                            <span class="text-xs font-bold text-orange-600">45%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-orange-600 h-2.5 rounded-full" style="width: 45%"></div>
                        </div>
                        <p class="text-xs text-gray-600 mt-1">9/20 materials completed</p>
                    </div>
                </div>
            </div>

            <!-- Recent Announcements -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Announcements</h2>
                <div class="space-y-3">
                    <div class="p-3 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                        <p class="text-sm font-medium text-gray-900">Class Rescheduled</p>
                        <p class="text-xs text-gray-600 mt-1">Web Dev class moved to 2:00 PM</p>
                        <p class="text-xs text-gray-500 mt-2">2 hours ago</p>
                    </div>

                    <div class="p-3 bg-green-50 rounded-lg border-l-4 border-green-500">
                        <p class="text-sm font-medium text-gray-900">New Materials Available</p>
                        <p class="text-xs text-gray-600 mt-1">Database chapter 5 uploaded</p>
                        <p class="text-xs text-gray-500 mt-2">5 hours ago</p>
                    </div>

                    <div class="p-3 bg-purple-50 rounded-lg border-l-4 border-purple-500">
                        <p class="text-sm font-medium text-gray-900">Quiz Results Posted</p>
                        <p class="text-xs text-gray-600 mt-1">Algorithm quiz results ready</p>
                        <p class="text-xs text-gray-500 mt-2">1 day ago</p>
                    </div>
                </div>
                <a href="#" class="mt-4 w-full py-2 text-center text-sm font-medium text-blue-600 hover:text-blue-700">View All Announcements</a>
            </div>
        </div>
    </div>
</div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Enrolled Courses Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm font-medium">Mata Kuliah Diambil</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">0</p>
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
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <p class="text-3xl font-bold text-gray-900 mt-2">0</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <p class="text-3xl font-bold text-gray-900 mt-2">0</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Grade Distribution Chart -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Distribusi Nilai Mata Kuliah</h2>
            <div class="flex items-center justify-center" style="height: 300px;">
                <canvas id="gradeDistributionChart"></canvas>
            </div>
        </div>

        <!-- Course Engagement Chart -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Keterlibatan per Mata Kuliah</h2>
            <div class="flex items-center justify-center" style="height: 300px;">
                <canvas id="courseEngagementChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Charts Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Grade Distribution Chart - Radar Chart
            const gradeCtx = document.getElementById('gradeDistributionChart');
            if (gradeCtx) {
                new Chart(gradeCtx, {
                    type: 'radar',
                    data: {
                        labels: ['Pemrograman Web', 'Basis Data', 'Algoritma', 'Sistem Operasi', 'Networking'],
                        datasets: [{
                            label: 'Nilai Anda',
                            data: [75, 82, 85, 70, 88],
                            borderColor: '#3B82F6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderWidth: 2,
                            pointBackgroundColor: '#3B82F6',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                labels: {
                                    font: { size: 12 }
                                }
                            }
                        },
                        scales: {
                            r: {
                                beginAtZero: true,
                                max: 100,
                                grid: {
                                    color: '#E5E7EB'
                                }
                            }
                        }
                    }
                });
            }

            // Course Engagement Chart - Bar Chart
            const engagementCtx = document.getElementById('courseEngagementChart');
            if (engagementCtx) {
                new Chart(engagementCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Pemrograman\nWeb', 'Basis\nData', 'Algoritma', 'Sistem\nOperasi'],
                        datasets: [
                            {
                                label: 'Materi Selesai',
                                data: [75, 60, 85, 45],
                                backgroundColor: '#10B981',
                                borderRadius: 4
                            },
                            {
                                label: 'Tugas Selesai',
                                data: [80, 70, 90, 60],
                                backgroundColor: '#8B5CF6',
                                borderRadius: 4
                            }
                        ]
                    },
                    options: {
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
                            y: {
                                beginAtZero: true,
                                max: 100,
                                grid: {
                                    drawBorder: false,
                                    color: '#E5E7EB'
                                }
                            },
                            x: {
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
        <!-- Active Assignments -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-gray-900">Tugas Mendatang</h2>
                <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-medium">Lihat Semua</a>
            </div>
            <div class="space-y-3">
                <div
                    class="p-4 border-l-4 border-red-500 bg-red-50 rounded-lg hover:shadow-sm transition-shadow cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">Quiz Minggu Ke-5: OOP Concepts</h3>
                            <p class="text-sm text-gray-600 mt-1">Pemrograman Web • Prof. Ahmad Wijaya</p>
                            <div class="flex items-center mt-2">
                                <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-xs text-red-600 font-medium">Deadline: 5 hari lagi</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-red-200 text-red-800 text-xs font-bold rounded">Segera</span>
                    </div>
                </div>

                <div
                    class="p-4 border-l-4 border-yellow-500 bg-yellow-50 rounded-lg hover:shadow-sm transition-shadow cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">Submission: Project UAS Database</h3>
                            <p class="text-sm text-gray-600 mt-1">Basis Data • Dr. Siti Nurhaliza</p>
                            <div class="flex items-center mt-2">
                                <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-xs text-yellow-600 font-medium">Deadline: 12 hari lagi</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-yellow-200 text-yellow-800 text-xs font-bold rounded">Mendesak</span>
                    </div>
                </div>

                <div
                    class="p-4 border-l-4 border-green-500 bg-green-50 rounded-lg hover:shadow-sm transition-shadow cursor-pointer">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900">Reading Assignment: Algorithm Design Paradigms</h3>
                            <p class="text-sm text-gray-600 mt-1">Algoritma & Struktur Data • Prof. Budi Santoso</p>
                            <div class="flex items-center mt-2">
                                <svg class="w-4 h-4 text-gray-400 mr-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-xs text-green-600 font-medium">Deadline: 20 hari lagi</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-green-200 text-green-800 text-xs font-bold rounded">Cukup</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Progress -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Progress Mata Kuliah</h2>
            <div class="space-y-4">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-medium text-gray-900">Pemrograman Web</p>
                        <span class="text-xs font-bold text-gray-600">75%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-medium text-gray-900">Basis Data</p>
                        <span class="text-xs font-bold text-gray-600">60%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-purple-600 h-2 rounded-full" style="width: 60%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-medium text-gray-900">Algoritma & Struktur Data</p>
                        <span class="text-xs font-bold text-gray-600">85%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: 85%"></div>
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-medium text-gray-900">Sistem Operasi</p>
                        <span class="text-xs font-bold text-gray-600">45%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-orange-600 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                </div>
            </div>

            <a href="#"
                class="mt-6 w-full py-2 px-4 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium text-center">
                Lihat Nilai Lengkap
            </a>
        </div>
    </div>
</div>
