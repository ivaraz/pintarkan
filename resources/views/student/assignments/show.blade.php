@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('student.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <a href="{{ route('student.courses.show', $course->id) }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">{{ $course->title }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail Tugas</span>
                    </div>
                </li>
            </ol>
        </nav>

        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Assignment Header -->
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-200 mb-6">
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <h1 class="text-2xl font-bold text-gray-900">{{ $assignment->title }}</h1>
                @php
                    $dueDate = \Carbon\Carbon::parse($assignment->due_date);
                    $isPast = $dueDate->isPast();
                @endphp
                <div class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium {{ $isPast ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                    <svg class="mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Tenggat: {{ $dueDate->translatedFormat('d M Y, H:i') }}
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-2">Instruksi Tugas</h3>
                <div class="prose max-w-none text-gray-600 bg-gray-50 p-4 rounded-lg border border-gray-100">
                    {!! nl2br(e($assignment->description)) !!}
                </div>
            </div>
        </div>

        <!-- Submission Status & Upload Section -->
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-200">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-900">Status Pengumpulan</h2>
            </div>
            
            <div class="p-0">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <th class="px-6 py-4 bg-gray-50 text-left text-sm font-medium text-gray-500 w-1/3">Status</th>
                            <td class="px-6 py-4 text-sm font-medium">
                                @if($submission)
                                    @if($submission->status === 'graded')
                                        <span class="text-green-600 bg-green-100 px-3 py-1 rounded-full">Selesai Dinilai</span>
                                    @else
                                        <span class="text-blue-600 bg-blue-100 px-3 py-1 rounded-full">Sudah Mengumpulkan</span>
                                    @endif
                                @else
                                    <span class="text-gray-600 bg-gray-100 px-3 py-1 rounded-full">Belum Mengumpulkan</span>
                                @endif
                            </td>
                        </tr>
                        @if($submission)
                            <tr>
                                <th class="px-6 py-4 bg-gray-50 text-left text-sm font-medium text-gray-500 w-1/3">Waktu Pengumpulan</th>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($submission->submitted_at)->translatedFormat('l, d F Y H:i:s') }}
                                </td>
                            </tr>
                            <tr>
                                <th class="px-6 py-4 bg-gray-50 text-left text-sm font-medium text-gray-500 w-1/3">File Tugas</th>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <a href="{{ Storage::url($submission->file) }}" target="_blank" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                        {{ basename($submission->file) }}
                                    </a>
                                </td>
                            </tr>
                        @endif
                        @if($submission && $submission->status === 'graded')
                            <tr>
                                <th class="px-6 py-4 bg-gray-50 text-left text-sm font-medium text-gray-500 w-1/3">Nilai</th>
                                <td class="px-6 py-4">
                                    <span class="text-2xl font-bold text-green-600">{{ $submission->grade->score ?? '-' }}</span> / 100
                                </td>
                            </tr>
                            @if($submission->grade && $submission->grade->feedback)
                                <tr>
                                    <th class="px-6 py-4 bg-gray-50 text-left text-sm font-medium text-gray-500 w-1/3 align-top">Catatan Dosen</th>
                                    <td class="px-6 py-4 text-sm text-gray-700 whitespace-pre-wrap italic bg-yellow-50 rounded-md border-l-4 border-yellow-400 p-4 m-4">{{ $submission->grade->feedback }}</td>
                                </tr>
                            @endif
                        @endif
                    </tbody>
                </table>
            </div>
            
            <!-- Upload Form -->
            @if(!$submission || $submission->status !== 'graded')
                <div class="p-6 border-t border-gray-200 bg-gray-50">
                    @if($isPast && !$submission)
                        <div class="flex items-center justify-center p-6 bg-red-50 rounded-lg border border-red-200">
                            <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            <span class="text-red-700 font-medium">Batas waktu pengumpulan tugas sudah terlewat. Anda tidak dapat mengirimkan tugas.</span>
                        </div>
                    @else
                        <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ $submission ? 'Kirim Ulang File Tugas' : 'Upload File Tugas' }}
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-400 transition-colors bg-white">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600 justify-center">
                                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Pilih file</span>
                                                <input id="file-upload" name="file" type="file" class="sr-only" required accept=".pdf,.zip,.rar,.doc,.docx">
                                            </label>
                                            <p class="pl-1">atau tarik dan lepas</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PDF, ZIP, RAR, Word up to 5MB
                                        </p>
                                    </div>
                                </div>
                                @error('file')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                    {{ $submission ? 'Perbarui Tugas' : 'Kirim Tugas' }}
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    // Simple script to display selected file name
    document.getElementById('file-upload')?.addEventListener('change', function(e) {
        if(e.target.files.length > 0) {
            const fileName = e.target.files[0].name;
            const textElement = this.parentElement.nextElementSibling;
            if (textElement) {
                textElement.textContent = fileName;
            }
        }
    });
</script>
@endsection
