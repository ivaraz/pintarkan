@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-gray-50">

        {{-- Background Blur --}}
        <div class="fixed top-0 left-0 w-72 h-72 bg-blue-200 opacity-20 rounded-full blur-3xl -z-10"></div>
        <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 opacity-30 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 space-y-8">

            {{-- Header Card --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="flex items-start gap-5">
                        <div
                            class="w-16 h-16 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl shrink-0">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                        <div>
                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium border border-blue-100 mb-4">
                                <i class="fa-solid fa-users"></i>
                                Rekapitulasi Mahasiswa
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900">Daftar Mahasiswa Binaan</h1>
                            <p class="text-gray-500 mt-1">Daftar seluruh mahasiswa unik yang terdaftar pada kelas-kelas yang
                                Anda ampu.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Mahasiswa</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-0.5">{{ $uniqueStudentsCount }}</h3>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-rectangle-list"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Total Pendaftaran Kelas</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-0.5">{{ $totalEnrollmentsCount }}</h3>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Mata Kuliah Diampu</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-0.5">{{ $coursesCount }}</h3>
                    </div>
                </div>
            </div>

            {{-- Table & Search Card --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">

                {{-- Search Bar --}}
                <div
                    class="p-8 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gray-50/50">
                    <div class="relative w-full md:max-w-md">
                        <input type="text" id="search-students" onkeyup="filterStudents()"
                            placeholder="Cari nama atau NPM mahasiswa..."
                            class="block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm p-4 bg-white pl-11">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400">Klik <strong>Lihat Detail</strong> untuk melihat rekap nilai & ekspor
                        PDF per mahasiswa.</p>
                </div>

                {{-- Table Content --}}
                @if (count($studentsData) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-gray-50 text-gray-700 text-xs font-semibold uppercase border-b border-gray-100">
                                    <th class="py-4 px-8">Mahasiswa</th>
                                    <th class="py-4 px-6">NPM</th>
                                    <th class="py-4 px-6">Email Akun</th>
                                    <th class="py-4 px-6">Mata Kuliah Diikuti</th>
                                    <th class="py-4 px-6 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-gray-700" id="students-table-body">
                                @foreach ($studentsData as $data)
                                    @php
                                        $student = $data['student'];
                                        $studentCourses = $data['courses'];
                                    @endphp
                                    <tr class="student-row hover:bg-blue-50/20 transition" data-name="{{ $student->name }}"
                                        data-npm="{{ $student->npm }}">
                                        {{-- Student --}}
                                        <td class="py-5 px-8">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-sm shrink-0">
                                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                                </div>
                                                <div class="font-bold text-gray-900">{{ $student->name }}</div>
                                            </div>
                                        </td>

                                        {{-- NPM --}}
                                        <td class="py-5 px-6 font-medium text-gray-600">{{ $student->npm }}</td>

                                        {{-- Email --}}
                                        <td class="py-5 px-6 font-normal text-gray-500">
                                            {{ $student->user ? $student->user->email : '-' }}
                                        </td>

                                        {{-- Enrolled Courses (badges) --}}
                                        <td class="py-5 px-6">
                                            <div class="flex flex-wrap gap-2">
                                                @foreach ($studentCourses as $course)
                                                    <a href="{{ route('lecturer.courses.show', $course) }}"
                                                        class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-100 text-xs font-semibold transition">
                                                        <i class="fa-solid fa-book text-[10px]"></i>
                                                        {{ $course->title }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </td>

                                        {{-- Actions --}}
                                        <td class="py-5 px-6 text-center">
                                            <a href="{{ route('lecturer.students.show', $student) }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold transition shadow-sm">
                                                <i class="fa-solid fa-chart-bar"></i>
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Search Empty State --}}
                    <div id="search-empty-state" class="hidden py-20 px-8 text-center">
                        <div class="flex flex-col items-center">
                            <div
                                class="w-16 h-16 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center text-2xl mb-4">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Hasil Pencarian Tidak Ditemukan</h3>
                            <p class="text-gray-500 mt-2 max-w-sm">Tidak ada mahasiswa binaan yang cocok dengan kata kunci
                                pencarian Anda.</p>
                        </div>
                    </div>
                @else
                    {{-- Global Empty State --}}
                    <div class="py-20 px-8 text-center">
                        <div class="flex flex-col items-center">
                            <div
                                class="w-24 h-24 rounded-3xl bg-yellow-100 text-yellow-600 flex items-center justify-center text-4xl mb-6">
                                <i class="fa-solid fa-users-slash"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Belum Ada Mahasiswa</h3>
                            <p class="text-gray-500 mt-3 max-w-md">Anda belum memiliki mahasiswa terdaftar di kelas mata
                                kuliah mana pun.</p>
                        </div>
                    </div>
                @endif

            </div>

        </div>

    </div>

    {{-- Live Search Filter JavaScript --}}
    <script>
        function filterStudents() {
            const query = document.getElementById('search-students').value.toLowerCase();
            const rows = document.querySelectorAll('.student-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const name = row.getAttribute('data-name').toLowerCase();
                const npm = row.getAttribute('data-npm').toLowerCase();

                if (name.includes(query) || npm.includes(query)) {
                    row.classList.remove('hidden');
                    visibleCount++;
                } else {
                    row.classList.add('hidden');
                }
            });

            const emptyState = document.getElementById('search-empty-state');
            if (visibleCount === 0 && rows.length > 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }
    </script>

@endsection
