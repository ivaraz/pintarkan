@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-gray-50">

        {{-- Background Blur (Hidden in print) --}}
        <div class="fixed top-0 left-0 w-72 h-72 bg-blue-200 opacity-20 rounded-full blur-3xl -z-10 print:hidden"></div>
        <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 opacity-30 rounded-full blur-3xl -z-10 print:hidden"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 space-y-8 print:p-0 print:max-w-full">

            {{-- Header (Printable / Hidden elements optimized) --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8 print:border-none print:shadow-none print:p-0 print:mb-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="flex items-start gap-5">
                        <div class="w-16 h-16 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-2xl shrink-0 print:hidden">
                            <i class="fa-solid fa-square-poll-vertical"></i>
                        </div>
                        <div>
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium border border-blue-100 mb-4 print:hidden">
                                <i class="fa-solid fa-graduation-cap"></i>
                                Rekap Nilai
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900 print:text-2xl">Rekapitulasi Nilai Tugas</h1>
                            <p class="text-gray-500 mt-1 print:text-gray-800">
                                Mata Kuliah: <span class="font-bold text-gray-800">{{ $course->title }}</span>
                            </p>
                            <p class="text-sm text-gray-400 mt-0.5 print:text-gray-800">
                                Dosen: <span class="font-medium text-gray-700">{{ auth()->user()->lecturer->name }}</span>
                            </p>
                        </div>
                    </div>
                    
                    {{-- Actions (Hidden in print) --}}
                    <div class="flex items-center gap-3 print:hidden">
                        {{-- Print Button --}}
                        <button type="button" onclick="window.print()"
                            class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl transition shadow-lg shadow-blue-100 font-semibold text-sm">
                            <i class="fa-solid fa-print"></i>
                            Cetak Rekap
                        </button>
                        
                        {{-- Back Button --}}
                        <a href="{{ route('lecturer.courses.show', $course) }}"
                            class="inline-flex items-center gap-2 px-5 py-3 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-2xl transition font-semibold text-sm">
                            <i class="fa-solid fa-arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>

            {{-- Recap Table Card --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden print:border-none print:shadow-none print:overflow-visible">
                @if ($enrollments->count() > 0)
                    <div class="overflow-x-auto print:overflow-visible">
                        <table class="w-full text-left border-collapse print:text-sm">
                            <thead>
                                <tr class="bg-gray-50 text-gray-700 text-xs font-bold uppercase border-b border-gray-100 print:bg-white print:border-b-2 print:border-gray-300">
                                    <th class="py-4 px-6 print:py-2 print:px-2">Mahasiswa</th>
                                    <th class="py-4 px-4 print:py-2 print:px-2">NPM</th>
                                    
                                    {{-- List Assignments columns --}}
                                    @foreach ($assignments as $assignment)
                                        <th class="py-4 px-4 text-center print:py-2 print:px-2">
                                            <div class="font-bold text-gray-900 max-w-[120px] truncate mx-auto" title="{{ $assignment->title }}">
                                                {{ $assignment->title }}
                                            </div>
                                            <div class="text-[10px] text-gray-400 font-medium normal-case mt-0.5">
                                                Max: {{ $assignment->max_score }}p
                                            </div>
                                        </th>
                                    @endforeach

                                    <th class="py-4 px-6 text-center font-bold text-blue-700 print:py-2 print:px-2 print:text-black">
                                        Rata-rata %
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-gray-700 print:divide-y print:divide-gray-300">
                                @foreach ($enrollments as $enrollment)
                                    @php
                                        $student = $enrollment->student;
                                        $studentSubmissions = $submissions->get($student->id) ?? collect();
                                        
                                        // Calculations for Average Percentage
                                        $totalPercentage = 0;
                                        $validAssignmentsCount = $assignments->count();
                                    @endphp
                                    <tr class="hover:bg-blue-50/10 transition print:hover:bg-transparent">
                                        {{-- Student --}}
                                        <td class="py-4 px-6 font-bold text-gray-900 print:py-2 print:px-2">
                                            {{ $student->name }}
                                        </td>
                                        
                                        {{-- NPM --}}
                                        <td class="py-4 px-4 font-mono text-sm text-gray-500 print:py-2 print:px-2 print:text-gray-800">
                                            {{ $student->npm }}
                                        </td>

                                        {{-- Grades for each assignment --}}
                                        @foreach ($assignments as $assignment)
                                            @php
                                                $sub = $studentSubmissions->firstWhere('assignment_id', $assignment->id);
                                                $score = null;
                                                $isGraded = false;
                                                $isSubmitted = false;

                                                if ($sub) {
                                                    $isSubmitted = true;
                                                    if ($sub->status == 'graded' && $sub->grade) {
                                                        $score = $sub->grade->score;
                                                        $isGraded = true;
                                                        // Add to percentage calculation
                                                        if ($assignment->max_score > 0) {
                                                            $totalPercentage += ($score / $assignment->max_score);
                                                        }
                                                    }
                                                }
                                            @endphp
                                            <td class="py-4 px-4 text-center print:py-2 print:px-2">
                                                @if ($isGraded)
                                                    <span class="inline-flex items-center justify-center font-bold text-green-600 bg-green-50 px-2.5 py-1 rounded-xl text-sm border border-green-100 print:bg-transparent print:border-none print:px-0">
                                                        {{ $score }}
                                                    </span>
                                                @elseif ($isSubmitted)
                                                    <span class="inline-flex items-center justify-center font-semibold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-xl text-[11px] border border-blue-100 print:bg-transparent print:border-none print:px-0 print:text-gray-500">
                                                        Belum Dinilai
                                                    </span>
                                                @else
                                                    <span class="text-gray-400 text-sm font-medium">-</span>
                                                @endif
                                            </td>
                                        @endforeach

                                        {{-- Average Percentage --}}
                                        <td class="py-4 px-6 text-center print:py-2 print:px-2">
                                            @if ($validAssignmentsCount > 0)
                                                @php
                                                    $averagePercentage = round(($totalPercentage / $validAssignmentsCount) * 100, 1);
                                                    
                                                    // Highlight badge based on average
                                                    $bgClass = 'bg-blue-50 text-blue-700 border-blue-100';
                                                    if ($averagePercentage >= 80) {
                                                        $bgClass = 'bg-green-50 text-green-700 border-green-200';
                                                    } elseif ($averagePercentage < 60) {
                                                        $bgClass = 'bg-red-50 text-red-700 border-red-200';
                                                    }
                                                @endphp
                                                <span class="inline-flex items-center justify-center font-bold px-3 py-1.5 rounded-2xl border text-sm {{ $bgClass }} print:border-none print:bg-transparent print:text-black">
                                                    {{ $averagePercentage }}%
                                                </span>
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
                    {{-- Empty State --}}
                    <div class="py-20 px-8 text-center print:hidden">
                        <div class="flex flex-col items-center">
                            <div class="w-24 h-24 rounded-3xl bg-yellow-100 text-yellow-600 flex items-center justify-center text-4xl mb-6">
                                <i class="fa-solid fa-users-slash"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Belum Ada Mahasiswa</h3>
                            <p class="text-gray-500 mt-3 max-w-md">Course ini belum memiliki mahasiswa yang terdaftar untuk direkap nilainya.</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Information Footer (Only visible in Print) --}}
            <div class="hidden print:block mt-12 pt-8 border-t border-gray-300">
                <div class="flex justify-between text-sm text-gray-600">
                    <div>
                        <p>Dicetak pada: {{ now()->format('d M Y H:i') }} WIB</p>
                        <p>PintarKan LMS - Laporan Nilai Resmi</p>
                    </div>
                    <div class="text-center w-48">
                        <p class="mb-12">Tanda Tangan Dosen,</p>
                        <div class="border-b border-gray-400 w-full mb-1"></div>
                        <p class="font-bold text-gray-900">{{ auth()->user()->lecturer->name }}</p>
                        <p class="text-xs">NIDN. {{ auth()->user()->lecturer->nidn ?? '-' }}</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- Printable Styles override --}}
    <style>
        @media print {
            body {
                background: white !important;
                color: black !important;
            }
            header, footer, nav, aside {
                display: none !important;
            }
            .fixed {
                display: none !important;
            }
            .shadow-sm, .shadow-lg, .shadow-2xl {
                box-shadow: none !important;
            }
            .border {
                border: none !important;
            }
            table {
                width: 100% !important;
                border-collapse: collapse !important;
            }
            th, td {
                border: 1px solid #cbd5e1 !important;
                padding: 6px 8px !important;
            }
        }
    </style>

@endsection
