<x-guest-layout>

    <div class="min-h-screen flex">

        <x-auth.left-section />

        {{-- RIGHT SIDE --}}
        <div class="w-full lg:w-1/2 bg-gray-50 flex items-center justify-center px-6 py-12">

            <div class="w-full max-w-md">

                {{-- Mobile Logo --}}
                <div class="lg:hidden flex items-center justify-center gap-3 mb-10">

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

                        <h2 class="text-3xl font-bold text-gray-900">
                            Welcome
                        </h2>

                        <p class="text-gray-500 mt-3">
                            Login untuk melanjutkan ke LMS PintarKan
                        </p>

                    </div>

                    {{-- Session Status --}}
                    <x-auth-session-status class="mb-4 mt-6" :status="session('status')" />

                    {{-- Form --}}
                    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">

                        @csrf

                        {{-- Email --}}
                        <div>

                            <x-input-label for="email" :value="__('Email')" />

                            <div class="relative mt-1">

                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">

                                    <i class="fa-solid fa-envelope"></i>

                                </div>

                                <x-text-input id="email"
                                    class="block w-full pl-11 pr-4 py-3 rounded-2xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                    type="email" name="email" :value="old('email')" required autofocus
                                    autocomplete="username" placeholder="Enter your email" />

                            </div>

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        </div>

                        {{-- Password --}}
                        <div>
                            <x-input-label for="password" :value="__('Password')" />


                            <div class="relative mt-1">

                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-400">

                                    <i class="fa-solid fa-lock"></i>

                                </div>

                                <x-text-input id="password"
                                    class="block w-full pl-11 pr-4 py-3 rounded-2xl border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                    type="password" name="password" required autocomplete="current-password"
                                    placeholder="Enter your password" />

                            </div>

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />

                            <div class="flex items-center justify-between">


                                @if (Route::has('password.request'))
                                    <a class="text-sm text-blue-600 hover:text-blue-700"
                                        href="{{ route('password.request') }}">

                                        Forgot Password?

                                    </a>
                                @endif

                            </div>

                        </div>

                        {{-- Remember --}}
                        <div class="flex items-center justify-between">

                            <label for="remember_me" class="inline-flex items-center">

                                <input id="remember_me" type="checkbox"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                    name="remember">

                                <span class="ms-2 text-sm text-gray-600">
                                    Remember me
                                </span>

                            </label>

                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-semibold transition shadow-lg shadow-blue-100">

                            <i class="fa-solid fa-right-to-bracket"></i>

                            Login

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>
