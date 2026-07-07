<x-guest-layout>
    <section
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-100 via-purple-100 to-pink-100">
        <div class="w-full max-w-md bg-white/80 backdrop-blur-lg rounded-xl shadow-lg p-8">
            {{-- Logo --}}
            <div class="flex items-center justify-center mb-6">
                <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-xl">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <h1 class="ml-3 text-2xl font-bold text-gray-900">PintarKan</h1>
            </div>

            <h2 class="text-center text-2xl font-bold text-gray-900 mb-2">Reset Password</h2>
            <p class="text-center text-gray-600 mb-6">Create a new, secure password for your account</p>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block w-full mt-1" type="email" name="email"
                        :value="old('email', $request->email)" required autofocus autocomplete="username" placeholder="Enter your email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                        autocomplete="new-password" placeholder="Enter new password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block w-full mt-1" type="password"
                        name="password_confirmation" required autocomplete="new-password"
                        placeholder="Confirm new password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl shadow transition duration-150 ease-in-out">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-guest-layout>
