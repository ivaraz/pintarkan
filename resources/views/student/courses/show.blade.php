@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('student.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Dashboard
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $course->title }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Course Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border border-gray-100">
            <div class="p-8 border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ $course->title }}</h1>
                        <p class="mt-2 text-lg text-gray-600">{{ $course->description }}</p>
                        <div class="mt-4 flex items-center space-x-4 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Dosen: {{ $course->lecturers->name ?? 'N/A' }}
                            </div>
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                {{ $course->materials->count() }} Materi
                            </div>
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                                {{ $course->assignments->count() }} Tugas
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 md:mt-0 bg-blue-50 p-4 rounded-xl border border-blue-100 flex items-center shadow-inner">
                        <div class="mr-4">
                            <p class="text-sm text-blue-600 font-medium">Rata-rata Nilai Tugas</p>
                            <p class="text-3xl font-bold text-blue-900">{{ number_format($averageGrade, 1) }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-full flex items-center justify-center {{ $averageGrade >= 80 ? 'bg-green-100 text-green-600' : ($averageGrade >= 60 ? 'bg-yellow-100 text-yellow-600' : 'bg-red-100 text-red-600') }}">
                            @if($averageGrade >= 80)
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                            @else
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Materials -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/50 rounded-t-lg">
                        <h2 class="text-lg font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            Materi Perkuliahan
                        </h2>
                    </div>
                    <div class="p-6">
                        @if($course->materials->count() > 0)
                            <div class="space-y-4">
                                @foreach($course->materials as $material)
                                    <div class="group flex items-start p-3 -mx-3 rounded-lg hover:bg-gray-50 transition-colors">
                                        <div class="flex-shrink-0 mt-1">
                                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <a href="{{ route('student.materials.show', [$course->id, $material->id]) }}" class="text-sm font-bold text-gray-900 hover:text-indigo-600 hover:underline transition-colors block">
                                                {{ $material->title }}
                                            </a>
                                            <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $material->content }}</p>
                                            <a href="{{ route('student.materials.show', [$course->id, $material->id]) }}" class="inline-flex items-center mt-2 mr-3 text-xs font-medium text-indigo-600 hover:text-indigo-800">
                                                Baca Selengkapnya &rarr;
                                            </a>
                                            @if($material->file)
                                                <a href="{{ Storage::url($material->file) }}" target="_blank" class="inline-flex items-center mt-2 text-xs font-medium text-indigo-600 hover:text-indigo-800">
                                                    Unduh File
                                                    <svg class="ml-1 w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-6">
                                <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                <p class="mt-2 text-sm text-gray-500">Belum ada materi untuk mata kuliah ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Assignments -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50/50 rounded-t-lg">
                        <h2 class="text-lg font-bold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                            Daftar Tugas
                        </h2>
                    </div>
                    <div class="p-6">
                        @if($course->assignments->count() > 0)
                            <div class="space-y-4">
                                @foreach($course->assignments as $assignment)
                                    @php
                                        $submission = $assignment->submissions->first();
                                        $dueDate = \Carbon\Carbon::parse($assignment->due_date);
                                        $isPast = $dueDate->isPast();
                                        
                                        // Determine styling based on status
                                        $borderColor = 'border-gray-200';
                                        $statusBadge = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Belum Mengumpulkan</span>';
                                        
                                        if ($submission) {
                                            if ($submission->status === 'graded') {
                                                $borderColor = 'border-green-300';
                                                $statusBadge = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Sudah Dinilai</span>';
                                            } else {
                                                $borderColor = 'border-blue-300';
                                                $statusBadge = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Sudah Mengumpulkan</span>';
                                            }
                                        } elseif ($isPast) {
                                            $borderColor = 'border-red-300';
                                            $statusBadge = '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Terlambat / Lewat Deadline</span>';
                                        }
                                    @endphp
                                    
                                    <div class="block border-l-4 {{ $borderColor }} bg-white border border-y-gray-200 border-r-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow">
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between">
                                            <div class="mb-4 sm:mb-0">
                                                <div class="flex items-center space-x-3 mb-1">
                                                    <a href="{{ route('student.assignments.show', [$course->id, $assignment->id]) }}" class="text-lg font-bold text-gray-900 hover:text-blue-600 hover:underline">
                                                        {{ $assignment->title }}
                                                    </a>
                                                    {!! $statusBadge !!}
                                                </div>
                                                <div class="text-sm text-gray-600 mt-2 line-clamp-2">
                                                    {{ $assignment->description }}
                                                </div>
                                                <div class="mt-3 flex items-center text-xs text-gray-500 font-medium space-x-4">
                                                    <div class="flex items-center {{ $isPast && !$submission ? 'text-red-600' : '' }}">
                                                        <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                        Tenggat: {{ $dueDate->translatedFormat('l, d F Y H:i') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 sm:ml-4 flex flex-col items-end">
                                                @if($submission && $submission->status === 'graded')
                                                    <div class="text-center px-4 py-2 bg-green-50 rounded-lg border border-green-100">
                                                        <span class="block text-xs text-green-600 font-bold uppercase tracking-wider">Nilai</span>
                                                        <span class="block text-2xl font-black text-green-700">{{ $submission->grade->score ?? '-' }}</span>
                                                    </div>
                                                @else
                                                    <a href="{{ route('student.assignments.show', [$course->id, $assignment->id]) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                                        {{ $submission ? 'Lihat Tugas' : 'Kerjakan' }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-10 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada tugas</h3>
                                <p class="mt-1 text-sm text-gray-500">Dosen belum memberikan tugas untuk mata kuliah ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
