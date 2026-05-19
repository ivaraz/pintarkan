<x-guest-layout>

    <div class="w-full h-screen flex overflow-hidden">

        {{-- LEFT SIDE --}}
        <x-auth.left-section badgeIcon="fa-solid fa-key" badgeText="Password Recovery" title="Reset Password Dengan Aman"
            description="Jangan khawatir jika lupa password. Kami akan membantu Anda mengakses kembali akun PintarKan." />

        {{-- RIGHT SIDE --}}
        <div class="w-full lg:w-1/2 h-screen bg-gray-50 flex items-center justify-center px-6 py-8 overflow-y-auto">

            <div class="w-full max-w-md">

                {{-- Mobile Logo --}}
                <div class="lg:hidden flex items-center justify-center gap-3 mb-8">

                    <div
                        class="w-12 h-12 rounded-2xl bg-blue-600 text-white flex items-center justify-center text-xl shadow-sm">

                        <i class="fa-solid fa-graduation-cap"></i>

                    </div>

                    <div>

                        <h1 class="text-2xl font-bold text-gray-900">
                            PintarKan
                        </h1>

                        <p class="text-sm text-gray-500">
                            Learning Management System
                        </p>

                    </div>

                </div>

                {{-- Card --}}
                <div class="bg-white border border-gray-200 shadow-xl rounded-[32px] p-8">

                    {{-- Heading --}}
                    <div class="text-center">

                        <div
                            class="w-16 h-16 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center mx-auto mb-5 text-2xl">

                            <i class="fa-solid fa-key"></i>

                        </div>

                        <h2 class="text-3xl font-bold text-gray-900">
                            Forgot Password
                        </h2>

                        <p class="text-gray-500 mt-3 leading-relaxed">

                            Masukkan email Anda dan kami akan
                            mengirimkan link reset password.

                        </p>

                    </div>

                    {{-- Session Status --}}
                    <x-auth-session-status class="mt-6" :status="session('status')" />

                    {{-- Form --}}
                    <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-6">

                        @csrf

                        {{-- Email --}}
                        <div>

                            <x-input-label for="email" :value="__('Email')" />

                            <div class="relative mt-2">

                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">

                                    <i class="fa-solid fa-envelope"></i>

                                </div>

                                <x-text-input id="email"
                                    class="block w-full pl-11 pr-4 py-3 rounded-2xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                    type="email" name="email" :value="old('email')" required autofocus />

                            </div>

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-semibold transition shadow-lg shadow-blue-100">

                            <i class="fa-solid fa-paper-plane"></i>

                            Kirim Link Reset Password

                        </button>

                        {{-- Back --}}
                        <div class="text-center">

                            <a href="{{ route('login') }}"
                                class="inline-flex items-center gap-2 text-sm text-blue-600 hover:text-blue-700 font-medium transition">

                                <i class="fa-solid fa-arrow-left"></i>

                                Kembali ke Login

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>
