@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-gray-50">

        {{-- Background Blur --}}
        <div class="fixed top-0 left-0 w-72 h-72 bg-indigo-200 opacity-20 rounded-full blur-3xl -z-10"></div>
        <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 opacity-30 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 space-y-6">

            {{-- ── HEADER ──────────────────────────────────────── --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                    {{-- Left: Student Info --}}
                    <div class="flex items-center gap-5">

                        {{-- Avatar --}}
                        <div class="w-16 h-16 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-2xl shrink-0 ring-2 ring-indigo-200">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>

                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-50 text-indigo-700 text-xs font-semibold border border-indigo-100 mb-2">
                                <i class="fa-solid fa-user-graduate"></i>
                                Rekap Nilai Mahasiswa
                            </div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $student->name }}</h1>
                            <div class="flex items-center gap-4 mt-1">
                                <span class="text-sm text-gray-500">
                                    <i class="fa-solid fa-id-card text-gray-400 mr-1"></i>
                                    NPM: <span class="font-semibold text-gray-700">{{ $student->npm ?? '-' }}</span>
                                </span>
                                @if ($student->user)
                                    <span class="text-sm text-gray-500">
                                        <i class="fa-solid fa-envelope text-gray-400 mr-1"></i>
                                        {{ $student->user->email }}
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    {{-- Right: Actions --}}
                    <div class="flex items-center gap-3 shrink-0">

                        {{-- Export PDF Button --}}
                        <a href="{{ route('lecturer.students.export-pdf', $student) }}"
                           class="inline-flex items-center gap-2 px-5 py-3 bg-red-600 hover:bg-red-700 text-white rounded-2xl font-semibold text-sm transition shadow-lg shadow-red-200">
                            <i class="fa-solid fa-file-pdf"></i>
                            Ekspor PDF
                        </a>

                        {{-- Back Button --}}
                        <a href="{{ route('lecturer.students.index') }}"
                           class="inline-flex items-center gap-2 px-5 py-3 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-2xl font-semibold text-sm transition">
                            <i class="fa-solid fa-arrow-left"></i>
                            Kembali
                        </a>

                    </div>

                </div>
            </div>

            {{-- ── SUMMARY STATS ────────────────────────────────── --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                {{-- Courses Taken --}}
                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-book-open"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Mata Kuliah Diikuti</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-0.5">{{ count($courses_data) }}</h3>
                    </div>
                </div>

                {{-- Total Score --}}
                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Total Nilai Terkumpul</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-0.5">
                            {{ $grand_total_score }} / {{ $grand_total_max }}
                        </h3>
                    </div>
                </div>

                {{-- Overall Average --}}
                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                    @php
                        $avg = $overall_average;
                        $avgColor = $avg === null ? 'gray' : ($avg >= 80 ? 'green' : ($avg >= 60 ? 'blue' : 'red'));
                    @endphp
                    <div class="w-12 h-12 bg-{{ $avgColor }}-100 text-{{ $avgColor }}-600 rounded-2xl flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-chart-pie"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Rata-rata Keseluruhan</p>
                        <h3 class="text-2xl font-bold text-{{ $avgColor }}-600 mt-0.5">
                            {{ $avg !== null ? $avg . '%' : '-' }}
                        </h3>
                    </div>
                </div>

            </div>

            {{-- ── PER-COURSE GRADE TABLES ──────────────────────── --}}
            @if (count($courses_data) > 0)

                @foreach ($courses_data as $courseItem)
                    @php
                        $course         = $courseItem['course'];
                        $assignmentRows = $courseItem['assignments'];
                        $courseAvg      = $courseItem['course_average'];
                        $totalScore     = $courseItem['total_score'];
                        $totalMax       = $courseItem['total_max'];

                        $avgColor = $courseAvg === null ? 'gray' : ($courseAvg >= 80 ? 'green' : ($courseAvg >= 60 ? 'blue' : 'red'));
                    @endphp

                    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">

                        {{-- Course Header --}}
                        <div class="flex items-center justify-between px-8 py-5 bg-gray-50 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                                    <i class="fa-solid fa-book"></i>
                                </div>
                                <div>
                                    <h2 class="font-bold text-gray-900 text-base">{{ $course->title }}</h2>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ count($assignmentRows) }} Tugas</p>
                                </div>
                            </div>

                            {{-- Course Average Badge --}}
                            <div class="flex items-center gap-3">
                                <div class="text-right">
                                    <p class="text-xs text-gray-400 font-medium">Nilai Kursus</p>
                                    <p class="font-bold text-gray-700 text-sm">{{ $totalScore }} / {{ $totalMax }}</p>
                                </div>
                                @if ($courseAvg !== null)
                                    <span class="inline-flex items-center justify-center px-4 py-1.5 rounded-2xl font-bold text-sm
                                        bg-{{ $avgColor }}-100 text-{{ $avgColor }}-700 border border-{{ $avgColor }}-200">
                                        {{ $courseAvg }}%
                                    </span>
                                @else
                                    <span class="text-gray-400 text-sm font-medium">-</span>
                                @endif
                            </div>
                        </div>

                        {{-- Assignment Rows --}}
                        @if (count($assignmentRows) > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="text-xs font-semibold uppercase text-gray-500 border-b border-gray-100 bg-white">
                                            <th class="py-3 px-8">Tugas</th>
                                            <th class="py-3 px-6 text-center">Max Nilai</th>
                                            <th class="py-3 px-6 text-center">Status</th>
                                            <th class="py-3 px-6 text-center">Nilai</th>
                                            <th class="py-3 px-6 text-center">Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-50">
                                        @foreach ($assignmentRows as $row)
                                            @php
                                                $pct = null;
                                                if ($row['is_graded'] && ($row['assignment']->max_score ?? 0) > 0) {
                                                    $pct = round(($row['score'] / $row['assignment']->max_score) * 100, 1);
                                                }
                                                $pctColor = $pct === null ? 'gray' : ($pct >= 80 ? 'green' : ($pct >= 60 ? 'blue' : 'red'));
                                            @endphp
                                            <tr class="hover:bg-gray-50/50 transition">

                                                {{-- Assignment Title --}}
                                                <td class="py-4 px-8">
                                                    <div class="font-semibold text-gray-900 text-sm">{{ $row['assignment']->title }}</div>
                                                    @if ($row['assignment']->due_date)
                                                        <div class="text-xs text-gray-400 mt-0.5">
                                                            <i class="fa-regular fa-clock mr-1"></i>
                                                            Deadline: {{ \Carbon\Carbon::parse($row['assignment']->due_date)->format('d M Y') }}
                                                        </div>
                                                    @endif
                                                </td>

                                                {{-- Max Score --}}
                                                <td class="py-4 px-6 text-center">
                                                    <span class="text-sm font-semibold text-gray-600">{{ $row['assignment']->max_score ?? '-' }}</span>
                                                </td>

                                                {{-- Status --}}
                                                <td class="py-4 px-6 text-center">
                                                    @if ($row['is_graded'])
                                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-green-50 text-green-700 border border-green-200 text-xs font-semibold">
                                                            <i class="fa-solid fa-circle-check text-[10px]"></i>
                                                            Sudah Dinilai
                                                        </span>
                                                    @elseif ($row['submission'])
                                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-blue-50 text-blue-700 border border-blue-200 text-xs font-semibold">
                                                            <i class="fa-solid fa-clock text-[10px]"></i>
                                                            Sudah Dikumpulkan
                                                        </span>
                                                    @else
                                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-gray-100 text-gray-500 border border-gray-200 text-xs font-semibold">
                                                            <i class="fa-solid fa-minus text-[10px]"></i>
                                                            Belum Mengumpulkan
                                                        </span>
                                                    @endif
                                                </td>

                                                {{-- Score --}}
                                                <td class="py-4 px-6 text-center">
                                                    @if ($row['is_graded'])
                                                        <span class="text-lg font-bold text-green-600">{{ $row['score'] }}</span>
                                                    @else
                                                        <span class="text-gray-400 font-medium">-</span>
                                                    @endif
                                                </td>

                                                {{-- Percentage --}}
                                                <td class="py-4 px-6 text-center">
                                                    @if ($pct !== null)
                                                        <div class="flex flex-col items-center gap-1.5">
                                                            <span class="font-bold text-{{ $pctColor }}-600 text-sm">{{ $pct }}%</span>
                                                            <div class="w-20 bg-gray-200 rounded-full h-1.5">
                                                                <div class="bg-{{ $pctColor }}-500 h-1.5 rounded-full" style="width: {{ min($pct, 100) }}%"></div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="text-gray-400 font-medium">-</span>
                                                    @endif
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="py-10 px-8 text-center text-gray-400">
                                <i class="fa-solid fa-clipboard-question text-3xl mb-2 block"></i>
                                <p class="text-sm">Belum ada tugas di mata kuliah ini.</p>
                            </div>
                        @endif

                    </div>

                @endforeach

            @else
                {{-- Empty State --}}
                <div class="bg-white border border-gray-200 rounded-3xl shadow-sm py-20 text-center">
                    <div class="w-20 h-20 rounded-3xl bg-yellow-100 text-yellow-500 flex items-center justify-center text-3xl mx-auto mb-5">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Tidak Ada Data</h3>
                    <p class="text-gray-500 mt-2 max-w-sm mx-auto text-sm">Mahasiswa ini belum terdaftar di mata kuliah yang Anda ampu.</p>
                </div>
            @endif

        </div>

    </div>

@endsection
