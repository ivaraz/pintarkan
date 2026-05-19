@props([
    'badgeIcon' => 'fa-solid fa-rocket',
    'badgeText' => 'Platform Pembelajaran Modern',
    'title' => 'Belajar Lebih Mudah & Terintegrasi',
    'description' => 'Kelola pembelajaran, tugas, materi, dan aktivitas akademik dalam satu platform modern.',
])

<div class="hidden lg:flex lg:w-1/2 h-screen bg-gradient-to-br from-blue-600 to-blue-700 relative overflow-hidden">

    <div class="absolute -top-20 -left-20 w-72 h-72 bg-blue-400 rounded-full opacity-20 blur-3xl">
    </div>

    <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-300 rounded-full opacity-10 blur-3xl">
    </div>

    <div class="relative z-10 flex flex-col justify-between h-full w-full px-14 py-10 text-white">

        {{-- Logo --}}
        <div class="flex items-center gap-4">

            <div
                class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center text-2xl shrink-0">

                <i class="fa-solid fa-graduation-cap"></i>

            </div>

            <div>

                <h1 class="text-3xl font-bold">
                    PintarKan
                </h1>

                <p class="text-blue-100 mt-1">
                    Learning Management System
                </p>

            </div>

        </div>

        {{-- Hero --}}
        <div class="max-w-xl">

            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-sm font-medium mb-6 backdrop-blur">

                <i class="{{ $badgeIcon }}"></i>

                {{ $badgeText }}

            </div>

            <h2 class="text-4xl xl:text-5xl font-bold leading-tight">
                {{ $title }}
            </h2>

            <p class="mt-6 text-lg text-blue-100 leading-relaxed max-w-lg">
                {{ $description }}
            </p>

            {{-- Features --}}
            <div class="grid grid-cols-2 gap-4 mt-10">

                <div class="bg-white/10 border border-white/10 backdrop-blur rounded-2xl p-5">
                    <div class="text-2xl mb-3">
                        <i class="fa-solid fa-book-open"></i>
                    </div>

                    <h3 class="font-semibold text-lg">
                        Course Management
                    </h3>

                    <p class="text-sm text-blue-100 mt-2">
                        Kelola mata kuliah lebih mudah
                    </p>
                </div>

                <div class="bg-white/10 border border-white/10 backdrop-blur rounded-2xl p-5">
                    <div class="text-2xl mb-3">
                        <i class="fa-solid fa-file-pen"></i>
                    </div>

                    <h3 class="font-semibold text-lg">
                        Assignment
                    </h3>

                    <p class="text-sm text-blue-100 mt-2">
                        Pengumpulan tugas online
                    </p>
                </div>

                <div class="bg-white/10 border border-white/10 backdrop-blur rounded-2xl p-5">
                    <div class="text-2xl mb-3">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>

                    <h3 class="font-semibold text-lg">
                        Student Access
                    </h3>

                    <p class="text-sm text-blue-100 mt-2">
                        Pembelajaran fleksibel
                    </p>
                </div>

                <div class="bg-white/10 border border-white/10 backdrop-blur rounded-2xl p-5">
                    <div class="text-2xl mb-3">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>

                    <h3 class="font-semibold text-lg">
                        Secure System
                    </h3>

                    <p class="text-sm text-blue-100 mt-2">
                        Aman dan terintegrasi
                    </p>
                </div>

            </div>

        </div>

        {{-- Footer --}}
        <div class="text-sm text-blue-100">
            © {{ date('Y') }} PintarKan. All rights reserved.
        </div>

    </div>

</div>
