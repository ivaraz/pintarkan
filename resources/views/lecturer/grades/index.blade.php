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
                            <i class="fa-solid fa-file-signature"></i>
                        </div>
                        <div>
                            <div
                                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium border border-blue-100 mb-4">
                                <i class="fa-solid fa-star"></i>
                                Penilaian Tugas
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900">Pusat Penilaian Tugas</h1>
                            <p class="text-gray-500 mt-1">Daftar pengumpulan tugas mahasiswa dari seluruh mata kuliah yang
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
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Total Pengumpulan</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-0.5">{{ $totalSubmissionsCount }}</h3>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-2xl flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-circle-notch fa-spin"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Perlu Dinilai</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-0.5">{{ $pendingGradingCount }}</h3>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center text-xl shrink-0">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Sudah Dinilai</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-0.5">{{ $gradedCount }}</h3>
                    </div>
                </div>
            </div>

            {{-- Submissions & Filtering Card --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden">

                {{-- Filters --}}
                <div
                    class="p-8 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-6 bg-gray-50/50">
                    {{-- Course Filter --}}
                    <div class="w-full md:max-w-xs">
                        <label for="filter-course"
                            class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Filter
                            Matkul</label>
                        <select id="filter-course" onchange="filterSubmissions()"
                            class="block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm p-3.5 bg-white">
                            <option value="">Semua Mata Kuliah</option>
                            @foreach ($courses as $c)
                                <option value="{{ $c->title }}">{{ $c->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Search bar --}}
                    <div class="w-full md:max-w-md">
                        <label for="search-submissions"
                            class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Cari Mahasiswa /
                            Tugas</label>
                        <div class="relative">
                            <input type="text" id="search-submissions" onkeyup="filterSubmissions()"
                                placeholder="Cari nama mahasiswa atau judul tugas..."
                                class="block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm p-3.5 bg-white pl-11">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Table Queue --}}
                @if ($submissions->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-gray-50 text-gray-700 text-xs font-semibold uppercase border-b border-gray-100">
                                    <th class="py-4 px-8">Mahasiswa</th>
                                    <th class="py-4 px-6">Mata Kuliah</th>
                                    <th class="py-4 px-6">Tugas / Max Poin</th>
                                    <th class="py-4 px-6">Tgl Mengumpulkan</th>
                                    <th class="py-4 px-6">File Jawaban</th>
                                    <th class="py-4 px-6">Nilai</th>
                                    <th class="py-4 px-8 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-gray-700" id="submissions-table-body">
                                @foreach ($submissions as $submission)
                                    @php
                                        $student = $submission->student;
                                        $assignment = $submission->assignment;
                                        $course = $assignment->course;
                                    @endphp
                                    <tr class="submission-row hover:bg-blue-50/20 transition"
                                        data-name="{{ $student->name }}" data-assignment="{{ $assignment->title }}"
                                        data-course="{{ $course->title }}">
                                        {{-- Student Info --}}
                                        <td class="py-5 px-8">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-sm shrink-0">
                                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="font-bold text-gray-900 leading-snug">{{ $student->name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 mt-0.5">NPM: {{ $student->npm }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Course Title --}}
                                        <td class="py-5 px-6 font-semibold text-gray-700 text-sm">
                                            {{ $course->title }}
                                        </td>

                                        {{-- Assignment Title --}}
                                        <td class="py-5 px-6">
                                            <div class="font-bold text-gray-900 text-sm leading-snug">
                                                {{ $assignment->title }}</div>
                                            <div class="text-xs text-gray-400 mt-0.5">Max Score:
                                                {{ $assignment->max_score }}p</div>
                                        </td>

                                        {{-- Date Submitted --}}
                                        <td class="py-5 px-6 text-sm font-medium text-gray-600">
                                            {{ \Carbon\Carbon::parse($submission->submitted_at)->format('d M Y H:i') }}
                                        </td>

                                        {{-- Attachment File --}}
                                        <td class="py-5 px-6">
                                            @if ($submission->file)
                                                <a href="{{ asset('storage/' . $submission->file) }}" target="_blank"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-100 rounded-xl text-xs font-semibold transition">
                                                    <i class="fa-solid fa-file-pdf text-sm"></i>
                                                    Lihat File
                                                </a>
                                            @else
                                                <span class="text-sm text-gray-400 font-medium">-</span>
                                            @endif
                                        </td>

                                        {{-- Status & Score --}}
                                        <td class="py-5 px-6 text-sm">
                                            @if ($submission->status == 'graded' && $submission->grade)
                                                <div class="flex flex-col gap-1">
                                                    <span
                                                        class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-green-50 text-green-700 border border-green-200 text-xs font-semibold w-fit">
                                                        <i class="fa-solid fa-circle-check"></i>
                                                        Sudah Dinilai
                                                    </span>
                                                    <span class="font-bold text-gray-900 mt-1">
                                                        Nilai: <span
                                                            class="text-green-600 text-base">{{ $submission->grade->score }}</span>
                                                        / {{ $assignment->max_score }}
                                                    </span>
                                                </div>
                                            @else
                                                <span
                                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-yellow-50 text-yellow-700 border border-yellow-200 text-xs font-semibold w-fit">
                                                    <i class="fa-solid fa-circle-notch fa-spin"></i>
                                                    Perlu Dinilai
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Actions --}}
                                        <td class="py-5 px-8 text-right">
                                            @if ($submission->status == 'graded' && $submission->grade)
                                                <button type="button"
                                                    onclick="document.getElementById('grade-modal-{{ $submission->id }}').classList.remove('hidden')"
                                                    class="inline-flex items-center gap-1.5 px-4 py-2 border border-gray-300 hover:bg-gray-100 text-gray-700 rounded-xl transition text-sm font-semibold">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                    Ubah Nilai
                                                </button>
                                            @else
                                                <button type="button"
                                                    onclick="document.getElementById('grade-modal-{{ $submission->id }}').classList.remove('hidden')"
                                                    class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow-md shadow-blue-100 transition text-sm font-semibold">
                                                    <i class="fa-solid fa-star"></i>
                                                    Beri Nilai
                                                </button>
                                            @endif

                                            {{-- Sleek Grade Modal --}}
                                            <div id="grade-modal-{{ $submission->id }}"
                                                class="hidden fixed inset-0 z-50 overflow-y-auto"
                                                aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                                <div
                                                    class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                                    {{-- Backdrop --}}
                                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                                        aria-hidden="true"
                                                        onclick="document.getElementById('grade-modal-{{ $submission->id }}').classList.add('hidden')">
                                                    </div>

                                                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                                        aria-hidden="true">&#8203;</span>

                                                    {{-- Modal Card --}}
                                                    <div
                                                        class="inline-block align-middle bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
                                                        <div class="bg-white px-8 pt-8 pb-6">
                                                            <div class="flex items-start gap-4">
                                                                <div
                                                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-2xl bg-blue-100 text-blue-600 sm:mx-0 sm:h-10 sm:w-10 text-lg">
                                                                    <i class="fa-solid fa-star"></i>
                                                                </div>
                                                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                                                    <h3 class="text-xl font-bold text-gray-900">
                                                                        {{ $submission->status == 'graded' ? 'Ubah Nilai Tugas' : 'Beri Nilai Tugas' }}
                                                                    </h3>
                                                                    <p class="text-sm text-gray-500 mt-1">
                                                                        Mahasiswa: <span
                                                                            class="font-semibold text-gray-700">{{ $student->name }}</span>
                                                                    </p>

                                                                    {{-- Form --}}
                                                                    <form
                                                                        action="{{ route('lecturer.assignments.grade', [$assignment->id, $submission->id]) }}"
                                                                        method="POST" class="mt-6 space-y-5">
                                                                        @csrf

                                                                        <div>
                                                                            <label for="score-{{ $submission->id }}"
                                                                                class="block text-sm font-semibold text-gray-700 text-left mb-2">
                                                                                Nilai (Batas Maksimal:
                                                                                {{ $assignment->max_score }})
                                                                            </label>
                                                                            <input type="number"
                                                                                id="score-{{ $submission->id }}"
                                                                                name="score" min="0"
                                                                                max="{{ $assignment->max_score }}"
                                                                                required
                                                                                value="{{ $submission->grade ? $submission->grade->score : '' }}"
                                                                                class="block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base p-4 bg-gray-50/50 text-left">
                                                                        </div>

                                                                        <div>
                                                                            <label for="note-{{ $submission->id }}"
                                                                                class="block text-sm font-semibold text-gray-700 text-left mb-2">
                                                                                Catatan Dosen
                                                                            </label>
                                                                            <textarea id="note-{{ $submission->id }}" name="note" rows="3"
                                                                                placeholder="Contoh: Kerja bagus, tingkatkan lagi."
                                                                                class="block w-full rounded-2xl border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-base p-4 bg-gray-50/50 text-left">{{ $submission->grade ? $submission->grade->note : '' }}</textarea>
                                                                        </div>

                                                                        <div
                                                                            class="flex flex-col sm:flex-row items-center gap-3 pt-4">
                                                                            <button type="submit"
                                                                                class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl transition font-semibold shadow-lg shadow-blue-100">
                                                                                <i class="fa-solid fa-floppy-disk"></i>
                                                                                Simpan Nilai
                                                                            </button>
                                                                            <button type="button"
                                                                                onclick="document.getElementById('grade-modal-{{ $submission->id }}').classList.add('hidden')"
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
                                                {{-- @endif --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Search Empty State --}}
                    <div id="search-empty-state" class="hidden py-20 px-8 text-center bg-white">
                        <div class="flex flex-col items-center">
                            <div
                                class="w-16 h-16 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center text-2xl mb-4">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Hasil Pencarian Tidak Ditemukan</h3>
                            <p class="text-gray-500 mt-2 max-w-sm">Tidak ada pengerjaan tugas yang cocok dengan kriteria
                                pencarian Anda.</p>
                        </div>
                    </div>

                    {{-- Pagination Links --}}
                    <div class="p-8 border-t border-gray-100 bg-white">
                        {{ $submissions->links() }}
                    </div>
                @else
                    {{-- Global Empty State --}}
                    <div class="py-20 px-8 text-center bg-white">
                        <div class="flex flex-col items-center">
                            <div
                                class="w-24 h-24 rounded-3xl bg-yellow-100 text-yellow-600 flex items-center justify-center text-4xl mb-6">
                                <i class="fa-solid fa-envelope-open"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Kotak Masuk Nilai Kosong</h3>
                            <p class="text-gray-500 mt-3 max-w-md">Belum ada mahasiswa yang mengumpulkan tugas untuk
                                seluruh mata kuliah Anda.</p>
                        </div>
                    </div>
                @endif

            </div>

        </div>

    </div>

    {{-- Live Search Filter JavaScript --}}
    <script>
        function filterSubmissions() {
            const courseQuery = document.getElementById('filter-course').value.toLowerCase();
            const searchQuery = document.getElementById('search-submissions').value.toLowerCase();
            const rows = document.querySelectorAll('.submission-row');
            let visibleCount = 0;

            rows.forEach(row => {
                const name = row.getAttribute('data-name').toLowerCase();
                const assignment = row.getAttribute('data-assignment').toLowerCase();
                const course = row.getAttribute('data-course').toLowerCase();

                const matchesCourse = courseQuery === "" || course.includes(courseQuery);
                const matchesSearch = searchQuery === "" || name.includes(searchQuery) || assignment.includes(
                    searchQuery);

                if (matchesCourse && matchesSearch) {
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
