<x-guest-layout>
    <section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">
        <div class="w-full max-w-md bg-white/80 backdrop-blur-lg rounded-xl shadow-lg p-8">
            {{-- Logo --}}
            <div class="flex items-center justify-center mb-6">
                <img src="{{ asset('img/PintarKan.png') }}" alt="PintarKan" class="w-12 h-12 object-contain">
                <h1 class="ml-3 text-2xl font-bold text-gray-900">PintarKan</h1>
            </div>

            <h2 class="text-center text-2xl font-bold text-gray-900 mb-2">Forgot Password</h2>
            <p class="text-center text-gray-600 mb-6">Enter your email and we will send you a password reset link</p>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                {{-- Email Address --}}
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus placeholder="Enter your email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between pt-2">
                    <a class="text-sm text-indigo-600 hover:text-indigo-700" href="{{ route('login') }}">
                        Back to Login
                    </a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl shadow transition duration-150 ease-in-out">
                        Send Reset Link
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
