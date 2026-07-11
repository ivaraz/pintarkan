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
                        <div class="w-20 h-20 rounded-3xl bg-orange-100 text-orange-600 flex items-center justify-center text-3xl shrink-0">
                            <i class="fa-solid fa-book-open"></i>
                        </div>
                        <div>
                            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-50 text-orange-700 text-sm font-medium border border-orange-100 mb-5">
                                <i class="fa-solid fa-book"></i>
                                Detail Materi
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $material->title }}</h1>
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
                {{-- Material Details Card --}}
                <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8 lg:col-span-2 space-y-6">
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-4">
                        <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-align-left"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Isi Materi</h2>
                    </div>
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line">
                        {{ $material->content ?? 'Belum ada isi materi.' }}
                    </p>
                    
                    @if (!empty($material->files))
                        <div class="pt-4 border-t border-gray-100">
                            <h3 class="text-sm font-semibold text-gray-700 mb-3">Lampiran File Materi:</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach($material->files as $file)
                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-orange-50 border border-orange-100 text-orange-700 rounded-xl hover:bg-orange-100 transition text-sm font-medium">
                                        <i class="fa-solid fa-download"></i>
                                        {{ basename($file) }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Material Metadata --}}
                <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8 space-y-6">
                    <div class="flex items-center gap-3 border-b border-gray-100 pb-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Informasi Penting</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <span class="text-gray-500 text-sm">Dibuat Pada</span>
                            <span class="font-bold text-gray-950 text-right text-sm">
                                {{ \Carbon\Carbon::parse($material->created_at)->format('d M Y') }}<br>
                                <span class="text-xs text-blue-600 font-medium">Jam {{ \Carbon\Carbon::parse($material->created_at)->format('H:i') }} WIB</span>
                            </span>
                        </div>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <span class="text-gray-500 text-sm">Terakhir Diperbarui</span>
                            <span class="font-bold text-gray-950 text-right text-sm">
                                {{ \Carbon\Carbon::parse($material->updated_at)->format('d M Y') }}<br>
                                <span class="text-xs text-blue-600 font-medium">Jam {{ \Carbon\Carbon::parse($material->updated_at)->format('H:i') }} WIB</span>
                            </span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex flex-col gap-3">
                        <a href="{{ route('lecturer.materials.edit', [$course, $material]) }}"
                            class="inline-flex justify-center items-center gap-2 px-4 py-3 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-xl transition text-sm font-semibold w-full">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Edit Materi
                        </a>
                        
                        <form action="{{ route('lecturer.materials.destroy', [$course, $material]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi ini?')" class="w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex justify-center items-center gap-2 px-4 py-3 bg-red-50 hover:bg-red-100 text-red-700 rounded-xl transition text-sm font-semibold w-full">
                                <i class="fa-solid fa-trash-can"></i>
                                Hapus Materi
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
