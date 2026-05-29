<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PintarKan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="bg-white text-gray-900 antialiased">

    <div class="min-h-screen flex flex-col">

        {{-- Navbar --}}
        <header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-gray-100">

            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <div class="flex items-center justify-between h-16">

                    {{-- Logo --}}
                    <div class="flex items-center gap-3">

                        <div
                            class="w-11 h-11 rounded-2xl bg-blue-600 text-white flex items-center justify-center shadow-sm text-lg">

                            <i class="fa-solid fa-graduation-cap"></i>

                        </div>

                        <div>
                            <h1 class="text-xl font-bold text-gray-900">
                                PintarKan
                            </h1>

                            <p class="text-xs text-gray-500">
                                Learning Management System
                            </p>
                        </div>

                    </div>

                    {{-- Navigation --}}
                    <div class="flex items-center gap-3">

                        <a href="{{ route('login') }}"
                            class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl transition shadow-sm">

                            Login
                        </a>

                    </div>

                </div>

            </div>

        </header>

        {{-- Hero --}}
        <section class="flex-1 flex items-center">

            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 w-full">

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                    {{-- Left --}}
                    <div>

                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium border border-blue-100 mb-6">

                            <i class="fa-solid fa-rocket"></i>

                            Platform Pembelajaran Modern

                        </div>

                        <h1 class="text-5xl lg:text-6xl font-bold leading-tight text-gray-900">

                            Belajar Lebih
                            <span class="text-blue-600">
                                Mudah,
                            </span>

                            Mengajar Lebih
                            <span class="text-blue-600">
                                Efektif
                            </span>

                        </h1>

                        <p class="mt-6 text-lg text-gray-600 leading-relaxed max-w-xl">

                            PintarKan adalah Learning Management System modern
                            yang membantu dosen, mahasiswa, dan admin
                            dalam mengelola pembelajaran secara efektif,
                            cepat, dan terintegrasi.

                        </p>

                        {{-- CTA --}}
                        <div class="mt-10 flex flex-wrap items-center gap-4">

                            <a href="{{ route('login') }}"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl text-lg font-medium transition shadow-lg shadow-blue-100">

                                <i class="fa-solid fa-right-to-bracket"></i>

                                Mulai Sekarang

                            </a>

                            <a href="#features"
                                class="inline-flex items-center gap-2 px-6 py-3 border border-gray-300 hover:bg-gray-100 rounded-2xl text-lg font-medium text-gray-700 transition">

                                <i class="fa-solid fa-circle-info"></i>

                                Pelajari Lebih

                            </a>

                        </div>

                        {{-- Stats --}}
                        <div class="grid grid-cols-3 gap-6 mt-14">

                            <div>
                                <h3 class="text-3xl font-bold text-gray-900">
                                    100+
                                </h3>

                                <p class="text-gray-500 mt-1">
                                    Mahasiswa
                                </p>
                            </div>

                            <div>
                                <h3 class="text-3xl font-bold text-gray-900">
                                    20+
                                </h3>

                                <p class="text-gray-500 mt-1">
                                    Mata Kuliah
                                </p>
                            </div>

                            <div>
                                <h3 class="text-3xl font-bold text-gray-900">
                                    10+
                                </h3>

                                <p class="text-gray-500 mt-1">
                                    Dosen
                                </p>
                            </div>

                        </div>

                    </div>

                    {{-- Right --}}
                    <div class="relative">

                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-100 to-blue-50 rounded-[40px] blur-3xl opacity-60">
                        </div>

                        <div
                            class="relative bg-white border border-gray-200 rounded-[32px] shadow-2xl p-8 backdrop-blur">

                            {{-- Top --}}
                            <div class="flex items-center justify-between mb-8">

                                <div>

                                    <h3 class="text-xl font-bold text-gray-900">
                                        Dashboard PintarKan
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Kelola pembelajaran dengan mudah
                                    </p>

                                </div>

                                <div
                                    class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center text-xl shadow-md">

                                    <i class="fa-solid fa-book-open"></i>

                                </div>

                            </div>

                            {{-- Cards --}}
                            <div class="grid grid-cols-2 gap-4">

                                {{-- Dosen --}}
                                <div
                                    class="p-5 rounded-2xl bg-blue-50 border border-blue-100 hover:shadow-md transition">

                                    <div class="text-3xl mb-3 text-blue-600">
                                        <i class="fa-solid fa-chalkboard-user"></i>
                                    </div>

                                    <h4 class="font-semibold text-gray-900">
                                        Dosen
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Kelola materi dan tugas
                                    </p>

                                </div>

                                {{-- Mahasiswa --}}
                                <div
                                    class="p-5 rounded-2xl bg-gray-50 border border-gray-100 hover:shadow-md transition">

                                    <div class="text-3xl mb-3 text-blue-600">
                                        <i class="fa-solid fa-user-graduate"></i>
                                    </div>

                                    <h4 class="font-semibold text-gray-900">
                                        Mahasiswa
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Akses pembelajaran online
                                    </p>

                                </div>

                                {{-- Course --}}
                                <div
                                    class="p-5 rounded-2xl bg-gray-50 border border-gray-100 hover:shadow-md transition">

                                    <div class="text-3xl mb-3 text-blue-600">
                                        <i class="fa-solid fa-book"></i>
                                    </div>

                                    <h4 class="font-semibold text-gray-900">
                                        Course
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Manajemen mata kuliah
                                    </p>

                                </div>

                                {{-- Assignment --}}
                                <div
                                    class="p-5 rounded-2xl bg-blue-50 border border-blue-100 hover:shadow-md transition">

                                    <div class="text-3xl mb-3 text-blue-600">
                                        <i class="fa-solid fa-file-pen"></i>
                                    </div>

                                    <h4 class="font-semibold text-gray-900">
                                        Assignment
                                    </h4>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Pengumpulan tugas online
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        {{-- Features --}}
        <section id="features" class="py-24 bg-gray-50 border-t border-gray-100">

            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <div class="text-center max-w-3xl mx-auto">

                    <h2 class="text-4xl font-bold text-gray-900">
                        Mengapa Memilih PintarKan?
                    </h2>

                    <p class="mt-4 text-lg text-gray-600">
                        Platform LMS modern dengan tampilan minimalis,
                        fitur lengkap, dan pengalaman belajar yang nyaman.
                    </p>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">

                    {{-- Fast --}}
                    <div
                        class="bg-white rounded-3xl border border-gray-200 p-8 hover:shadow-lg transition duration-300">

                        <div
                            class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl text-blue-600 mb-6">

                            <i class="fa-solid fa-bolt"></i>

                        </div>

                        <h3 class="text-xl font-semibold text-gray-900">
                            Cepat & Responsif
                        </h3>

                        <p class="text-gray-600 mt-3 leading-relaxed">
                            Akses LMS dengan performa cepat dan tampilan
                            yang nyaman di semua perangkat.
                        </p>

                    </div>

                    {{-- Secure --}}
                    <div
                        class="bg-white rounded-3xl border border-gray-200 p-8 hover:shadow-lg transition duration-300">

                        <div
                            class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl text-blue-600 mb-6">

                            <i class="fa-solid fa-shield-halved"></i>

                        </div>

                        <h3 class="text-xl font-semibold text-gray-900">
                            Aman & Terintegrasi
                        </h3>

                        <p class="text-gray-600 mt-3 leading-relaxed">
                            Sistem role dan autentikasi yang aman
                            untuk admin, dosen, dan student.
                        </p>

                    </div>

                    {{-- Modern --}}
                    <div
                        class="bg-white rounded-3xl border border-gray-200 p-8 hover:shadow-lg transition duration-300">

                        <div
                            class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl text-blue-600 mb-6">

                            <i class="fa-solid fa-chart-line"></i>

                        </div>

                        <h3 class="text-xl font-semibold text-gray-900">
                            Efisien & Modern
                        </h3>

                        <p class="text-gray-600 mt-3 leading-relaxed">
                            Kelola pembelajaran, tugas, dan nilai
                            dengan lebih efektif dan terstruktur.
                        </p>

                    </div>

                </div>

            </div>

        </section>

        {{-- Footer --}}
        <footer class="border-t border-gray-100 bg-white">

            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">

                <div class="flex flex-col md:flex-row items-center justify-between gap-4">

                    <div>

                        <h3 class="font-bold text-gray-900">
                            PintarKan
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            Learning Management System Modern
                        </p>

                    </div>

                    <p class="text-sm text-gray-400">
                        © {{ date('Y') }} PintarKan. All rights reserved.
                    </p>

                </div>

            </div>

        </footer>

    </div>

</body>

</html>
