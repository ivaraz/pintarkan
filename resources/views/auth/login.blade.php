<x-guest-layout>
    <section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">
        <div class="w-full max-w-md bg-white/80 backdrop-blur-lg rounded-xl shadow-lg p-8">
            <div class="flex items-center justify-center mb-6">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-xl">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h1 class="ml-3 text-2xl font-bold text-gray-900">PintarKan</h1>
            </div>

            <h2 class="text-center text-2xl font-bold text-gray-900 mb-2">Welcome</h2>
            <p class="text-center text-gray-600 mb-6">Login to access the LMS</p>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus placeholder="Enter your email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required placeholder="Enter your password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:text-indigo-700" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl shadow">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
