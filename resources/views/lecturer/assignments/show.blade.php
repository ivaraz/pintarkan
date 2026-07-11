@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-gray-50">

        {{-- Background Blur --}}
        <div class="fixed top-0 left-0 w-72 h-72 bg-blue-200 opacity-20 rounded-full blur-3xl -z-10"></div>
        <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 opacity-30 rounded-full blur-3xl -z-10"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 space-y-8">

            {{-- Header Card --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8">
                <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-8">
                    <div class="flex items-start gap-5">
                        <div class="w-20 h-20 rounded-3xl bg-blue-100 text-blue-600 flex items-center justify-center text-3xl shrink-0">
                            <i class="fa-solid fa-file-signature"></i>
                        </div>
                        <div>
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium border border-blue-100 mb-5">
                                <i class="fa-solid fa-chalkboard-user"></i>
                                Detail Tugas
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $assignment->title }}</h1>
                            <p class="text-gray-500 mt-2">Mata Kuliah: <span class="font-semibold text-gray-700">{{ $course->title }}</span></p>
                        </div>
                    </div>
                    
                    {{-- Navigation / Back --}}
                    <div>
                        <a href="{{ route('lecturer.courses.show', $course) }}"
                            class="inline-flex items-center gap-2 px-5 py-3 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-2xl transition">
                            <i class="fa-solid fa-arrow-left"></i>
                            Kembali ke Course
                        </a>
                    </div>
                </div>
            </div>

            {{-- Info & Desc Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Assignment Details Card --}}
                <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8 lg:col-span-2 space-y-6">
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-4">
                        <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-align-left"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Deskripsi Tugas</h2>
                    </div>
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line">
                        {{ $assignment->description ?? 'Belum ada deskripsi tugas.' }}
                    </p>
                    
                    @if ($assignment->file)
                        <div class="pt-4 border-t border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-700 mb-3">Lampiran File Tugas:</h3>
                            <a href="{{ asset('storage/' . $assignment->file) }}" target="_blank"
                                class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-50 border border-blue-100 text-blue-700 rounded-xl hover:bg-blue-100 transition text-sm font-medium">
                                <i class="fa-solid fa-download"></i>
                                Download Lampiran Tugas
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Task Metadata Stats --}}
                <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8 space-y-6">
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-4">
                        <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Informasi Penting</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <span class="text-gray-500 text-sm">Nilai Maksimal</span>
                            <span class="font-bold text-gray-950">{{ $assignment->max_score }} Poin</span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <span class="text-gray-500 text-sm">Batas Waktu</span>
                            <span class="font-bold text-gray-950 text-right text-sm">
                                {{ \Carbon\Carbon::parse($assignment->due_date)->format('d M Y') }}<br>
                                <span class="text-xs text-orange-600 font-medium">Jam {{ \Carbon\Carbon::parse($assignment->due_date)->format('H:i') }} WIB</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Calculate Stats --}}
            @php
                $totalStudents = $enrollments->count();
                $submittedCount = $submissions->where('status', 'submitted')->count();
                $gradedCount = $submissions->where('status', 'graded')->count();
                $pendingGrading = $submittedCount;
                $notSubmitted = $totalStudents - ($submittedCount + $gradedCount);
            @endphp

            {{-- Stats Widgets --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Total Mahasiswa</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-0.5">{{ $totalStudents }}</h3>
                    </div>
                </div>
                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-2xl flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Perlu Dinilai</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-0.5">{{ $pendingGrading }}</h3>
                    </div>
                </div>
                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Sudah Dinilai</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-0.5">{{ $gradedCount }}</h3>
                    </div>
                </div>
                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Belum Kumpul</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-0.5">{{ $notSubmitted }}</h3>
                    </div>
                </div>
            </div>

            {{-- Submissions Table Card --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">
                <div class="p-8 border-b border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 font-sans">Status Pengumpulan Mahasiswa</h2>
                    <p class="text-gray-500 mt-1">Kelola dan berikan nilai pada tugas yang dikumpulkan mahasiswa.</p>
                </div>

                @if ($enrollments->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 text-gray-700 text-sm font-semibold uppercase border-b border-gray-100">
                                    <th class="py-4 px-8">Mahasiswa</th>
                                    <th class="py-4 px-6">NPM</th>
                                    <th class="py-4 px-6">Tgl Mengumpulkan</th>
                                    <th class="py-4 px-6">File Jawaban</th>
                                    <th class="py-4 px-6">Status / Nilai</th>
                                    <th class="py-4 px-8 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-gray-700">
                                @foreach ($enrollments as $enrollment)
                                    @php
                                        $student = $enrollment->student;
                                        $sub = $submissions->get($student->id);
                                    @endphp
                                    <tr class="hover:bg-blue-50/20 transition">
                                        {{-- Student Info --}}
                                        <td class="py-5 px-8">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-sm shrink-0">
                                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                                </div>
                                                <div class="font-bold text-gray-900">{{ $student->name }}</div>
                                            </div>
                                        </td>
                                        
                                        {{-- NPM --}}
                                        <td class="py-5 px-6 font-medium text-gray-600">{{ $student->npm }}</td>

                                        {{-- Date Submitted --}}
                                        <td class="py-5 px-6">
                                            @if ($sub)
                                                <span class="text-sm font-medium text-gray-800">
                                                    {{ \Carbon\Carbon::parse($sub->submitted_at)->format('d M Y H:i') }}
                                                </span>
                                            @else
                                                <span class="text-sm text-gray-400 font-medium">-</span>
                                            @endif
                                        </td>

                                        {{-- Submission File --}}
                                        <td class="py-5 px-6">
                                            @if ($sub && $sub->file)
                                                <a href="{{ asset('storage/' . $sub->file) }}" target="_blank"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-100 rounded-xl text-xs font-semibold transition">
                                                    <i class="fa-solid fa-file-pdf text-sm"></i>
                                                    Lihat File
                                                </a>
                                            @else
                                                <span class="text-sm text-gray-400 font-medium">-</span>
                                            @endif
                                        </td>

                                        {{-- Status & Score --}}
                                        <td class="py-5 px-6">
                                            @if ($sub)
                                                @if ($sub->status == 'graded' && $sub->grade)
                                                    <div class="flex flex-col gap-1">
                                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-50 text-green-700 border border-green-200 text-xs font-semibold w-fit">
                                                            <i class="fa-solid fa-circle-check"></i>
                                                            Sudah Dinilai
                                                        </span>
                                                        <span class="text-sm font-bold text-gray-900 mt-1">
                                                            Nilai: <span class="text-green-600 text-base">{{ $sub->grade->score }}</span> / {{ $assignment->max_score }}
                                                        </span>
                                                    </div>
                                                @else
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200 text-xs font-semibold w-fit">
                                                        <i class="fa-solid fa-circle-notch fa-spin"></i>
                                                        Perlu Dinilai
                                                    </span>
                                                @endif
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-700 border border-red-200 text-xs font-semibold w-fit">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                    Belum Kumpul
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Action Buttons --}}
                                        <td class="py-5 px-8 text-right">
                                            @if ($sub)
                                                @if ($sub->status == 'graded' && $sub->grade)
                                                    <button type="button" onclick="document.getElementById('grade-modal-{{ $student->id }}').classList.remove('hidden')"
                                                        class="inline-flex items-center gap-1.5 px-4 py-2 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-xl transition text-sm font-semibold">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                        Ubah Nilai
                                                    </button>
                                                @else
                                                    <button type="button" onclick="document.getElementById('grade-modal-{{ $student->id }}').classList.remove('hidden')"
                                                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow-md shadow-blue-100 transition text-sm font-semibold">
                                                        <i class="fa-solid fa-star"></i>
                                                        Beri Nilai
                                                    </button>
                                                @endif

                                                {{-- Sleek Grade Modal --}}
                                                <div id="grade-modal-{{ $student->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                                        {{-- Backdrop --}}
                                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="document.getElementById('grade-modal-{{ $student->id }}').classList.add('hidden')"></div>

                                                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                                                        {{-- Modal Card --}}
                                                        <div class="inline-block align-middle bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
                                                            <div class="bg-white px-8 pt-8 pb-6">
                                                                <div class="flex items-start gap-4">
                                                                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-2xl bg-blue-100 text-blue-600 sm:mx-0 sm:h-10 sm:w-10 text-lg">
                                                                        <i class="fa-solid fa-star"></i>
                                                                    </div>
                                                                    <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                                                        <h3 class="text-xl font-bold text-gray-900" id="modal-title">
                                                                            {{ $sub->status == 'graded' ? 'Ubah Nilai Tugas' : 'Beri Nilai Tugas' }}
                                                                        </h3>
                                                                        <p class="text-sm text-gray-500 mt-1">
                                                                            Mahasiswa: <span class="font-semibold text-gray-700">{{ $student->name }}</span>
                                                                        </p>
                                                                        
                                                                        {{-- Form --}}
                                                                        <form action="{{ route('lecturer.assignments.grade', [$assignment->id, $sub->id]) }}" method="POST" class="mt-6 space-y-5">
                                                                            @csrf
                                                                            
                                                                            <div>
                                                                                <label for="score-{{ $student->id }}" class="block text-sm font-semibold text-gray-700 text-left mb-2">
                                                                                    Nilai (Batas Maksimal: {{ $assignment->max_score }})
                                                                                </label>
                                                                                <input type="number" id="score-{{ $student->id }}" name="score" min="0" max="{{ $assignment->max_score }}" required
                                                                                    value="{{ $sub->grade ? $sub->grade->score : '' }}"
                                                                                    class="block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base p-4 bg-gray-50/50">
                                                                            </div>

                                                                            <div>
                                                                                <label for="note-{{ $student->id }}" class="block text-sm font-semibold text-gray-700 text-left mb-2">
                                                                                    Catatan Dosen
                                                                                </label>
                                                                                <textarea id="note-{{ $student->id }}" name="note" rows="3" placeholder="Contoh: Jawaban sangat baik dan lengkap."
                                                                                    class="block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base p-4 bg-gray-50/50">{{ $sub->grade ? $sub->grade->note : '' }}</textarea>
                                                                            </div>

                                                                            <div class="flex flex-col sm:flex-row items-center gap-3 pt-4">
                                                                                <button type="submit"
                                                                                    class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl transition font-semibold shadow-lg shadow-blue-100">
                                                                                    <i class="fa-solid fa-floppy-disk"></i>
                                                                                    Simpan Nilai
                                                                                </button>
                                                                                <button type="button" onclick="document.getElementById('grade-modal-{{ $student->id }}').classList.add('hidden')"
                                                                                    class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-3 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-2xl transition font-semibold">
                                                                                    Batal
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-sm text-gray-400 font-medium italic">Tidak ada aksi</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="py-20 px-8 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-24 h-24 rounded-3xl bg-yellow-100 text-yellow-600 flex items-center justify-center text-4xl mb-6">
                                <i class="fa-solid fa-users-slash"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Belum Ada Mahasiswa</h3>
                            <p class="text-gray-500 mt-3 max-w-md">Course ini belum memiliki mahasiswa yang terdaftar.</p>
                        </div>
                    </div>
                @endif
            </div>

        </div>

    </div>

@endsection
