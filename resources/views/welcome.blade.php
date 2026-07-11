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

                        <img src="{{ asset('img/PintarKan.png') }}" alt="PintarKan" class="w-11 h-11 object-contain">

                        <div>
                            <h1 class="text-xl font-bold text-gray-900">
                                PintarKan
                            </h1>

                            <p class="text-xs text-gray-500">
                                Learning Management System
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </header>

        {{-- Hero --}}
        <section class="relative min-h-screen flex items-center hero-bg-animated py-20 overflow-hidden">
            <!-- Decorative Background Blobs -->
            <div
                class="absolute top-1/4 left-10 w-72 h-72 bg-indigo-300 rounded-full opacity-20 blur-3xl -z-10 animate-pulse">
            </div>
            <div
                class="absolute bottom-1/4 right-10 w-96 h-96 bg-purple-300 rounded-full opacity-20 blur-3xl -z-10 animate-pulse">
            </div>

            <div class="max-w-7xl mx-auto px-6 lg:px-8 w-full z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                    {{-- Left Column: Brand, Tagline, and Action --}}
                    <div class="lg:col-span-7 text-left space-y-3">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-700 text-sm font-semibold">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <span>LMS Platform PintarKan</span>
                        </div>
                        <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                            Belajar Lebih <span
                                class="bg-gradient-to-r from-indigo-600 to-indigo-800 bg-clip-text text-transparent">Mudah
                                & Efektif</span>
                        </h1>
                        <p class="text-base text-gray-600 max-w-2xl leading-relaxed">
                            PintarKan adalah platform LMS modern yang memudahkan dosen dan mahasiswa mengelola
                            pembelajaran secara cepat, efisien, dan terintegrasi.
                        </p>

                    </div>

                    {{-- Right Column: Login Card / Dashboard Redirection --}}
                    <div class="lg:col-span-5 w-full max-w-md mx-auto">
                        @auth
                            <div
                                class="bg-white/90 backdrop-blur border border-gray-200/80 rounded-3xl p-8 shadow-xl shadow-indigo-500/5 text-center space-y-6">
                                <div
                                    class="w-16 h-16 bg-indigo-100 text-indigo-700 rounded-2xl flex items-center justify-center text-3xl mx-auto">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <div class="space-y-2">
                                    <h3 class="text-2xl font-bold text-gray-900">Selamat Datang!</h3>
                                    <p class="text-gray-500 text-sm">Anda masuk sebagai <span
                                            class="font-semibold text-gray-800">{{ auth()->user()->name }}</span>.</p>
                                </div>
                                <a href="{{ auth()->user()->dashboard_route }}"
                                    class="w-full inline-flex items-center justify-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-base font-semibold shadow-md shadow-indigo-500/20 hover:shadow-indigo-500/30 transition duration-200">
                                    Masuk ke Dashboard
                                </a>
                            </div>
                        @else
                            <div
                                class="bg-white/90 backdrop-blur border border-gray-200/80 rounded-3xl p-8 shadow-xl shadow-indigo-500/5 space-y-6">
                                <div class="space-y-2">
                                    <h3 class="text-2xl font-bold text-gray-900">Masuk ke PintarKan</h3>
                                    <p class="text-gray-500 text-sm">Silakan masuk menggunakan akun Anda untuk memulai
                                        pembelajaran.</p>
                                </div>

                                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                                    @csrf

                                    <div>
                                        <label for="email"
                                            class="block text-sm font-semibold text-gray-700">Email</label>
                                        <div class="relative mt-1.5">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                                <i class="fa-solid fa-envelope text-sm"></i>
                                            </div>
                                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                                required autofocus
                                                class="block w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/10 transition duration-200 text-sm"
                                                placeholder="nama@email.com" />
                                        </div>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div>
                                        <div class="flex items-center justify-between">
                                            <label for="password"
                                                class="block text-sm font-semibold text-gray-700">Password</label>
                                            @if (Route::has('password.request'))
                                                <a class="text-xs font-medium text-indigo-600 hover:text-indigo-700"
                                                    href="{{ route('password.request') }}">
                                                    Lupa password?
                                                </a>
                                            @endif
                                        </div>
                                        <div class="relative mt-1.5">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                                <i class="fa-solid fa-lock text-sm"></i>
                                            </div>
                                            <input id="password" type="password" name="password" required
                                                class="block w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-400 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/10 transition duration-200 text-sm"
                                                placeholder="••••••••" />
                                        </div>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <button type="submit"
                                        class="w-full flex items-center justify-center px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl shadow-md shadow-indigo-500/20 hover:shadow-indigo-500/30 transition duration-200 font-semibold text-sm">
                                        Log In
                                    </button>
                                </form>
                            </div>
                        @endauth
                    </div>

                </div>
            </div>
        </section>

        {{-- Features --}}
        <section class="py-24 bg-gray-50 border-t border-gray-100">

            <div class="max-w-7xl mx-auto px-6 lg:px-8">

                <div class="text-center max-w-3xl mx-auto">

                    <h2 class="text-4xl font-bold text-gray-900">
                        Mengapa Memilih PintarKan?
                    </h2>

                    <p class="mt-4 text-base text-gray-600">
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
