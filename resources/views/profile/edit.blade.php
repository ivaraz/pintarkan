@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50">

        {{-- Background Blur --}}
        <div class="fixed top-0 left-0 w-72 h-72 bg-blue-200 opacity-20 rounded-full blur-3xl -z-10">
        </div>

        <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 opacity-30 rounded-full blur-3xl -z-10">
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8 space-y-8">

            {{-- Header --}}
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8">

                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <div>

                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 text-sm font-medium border border-blue-100 mb-5">

                            <i class="fa-solid fa-user"></i>

                            Profile Settings

                        </div>

                        <h1 class="text-3xl font-bold text-gray-900">
                            My Profile
                        </h1>

                        <p class="text-gray-500 mt-3 text-base">
                            Kelola informasi akun dan keamanan profile Anda.
                        </p>

                    </div>

                    {{-- Avatar --}}
                    <div
                        class="w-20 h-20 rounded-3xl bg-blue-100 text-blue-700 flex items-center justify-center text-3xl font-bold shadow-sm">

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    </div>

                </div>

            </div>

            {{-- Content --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                {{-- Left Info --}}
                <div class="space-y-6">

                    {{-- User Card --}}
                    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6">

                        <div class="flex items-center gap-4">

                            <div
                                class="w-16 h-16 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl font-bold">

                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                            </div>

                            <div>

                                <h2 class="text-xl font-bold text-gray-900">
                                    {{ Auth::user()->name }}
                                </h2>

                                <p class="text-gray-500 mt-1">
                                    {{ Auth::user()->email }}
                                </p>

                            </div>

                        </div>

                        {{-- Role --}}
                        <div
                            class="mt-6 inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-blue-50 text-blue-700 text-sm font-medium border border-blue-100">

                            <i class="fa-solid fa-shield-halved"></i>

                            {{ Auth::user()->getRoleNames()->first() }}

                        </div>

                    </div>

                    {{-- Security Tips --}}
                    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6">

                        <div class="flex items-center gap-3 mb-5">

                            <div
                                class="w-12 h-12 rounded-2xl bg-green-100 text-green-600 flex items-center justify-center text-xl">

                                <i class="fa-solid fa-lock"></i>

                            </div>

                            <div>

                                <h2 class="text-lg font-bold text-gray-900">
                                    Security
                                </h2>

                                <p class="text-sm text-gray-500">
                                    Tips keamanan akun
                                </p>

                            </div>

                        </div>

                        <div class="space-y-4 text-sm text-gray-600">

                            <div class="flex items-start gap-3">

                                <i class="fa-solid fa-check text-green-500 mt-1"></i>

                                <p>
                                    Gunakan password yang kuat dan unik.
                                </p>

                            </div>

                            <div class="flex items-start gap-3">

                                <i class="fa-solid fa-check text-green-500 mt-1"></i>

                                <p>
                                    Jangan bagikan akun kepada orang lain.
                                </p>

                            </div>

                            <div class="flex items-start gap-3">

                                <i class="fa-solid fa-check text-green-500 mt-1"></i>

                                <p>
                                    Update password secara berkala.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- Right Form --}}
                <div class="xl:col-span-2 space-y-8">

                    {{-- Profile Information --}}
                    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8">

                        <div class="flex items-center gap-3 mb-6">

                            <div
                                class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center text-xl">

                                <i class="fa-solid fa-user-pen"></i>

                            </div>

                            <div>

                                <h2 class="text-2xl font-bold text-gray-900">
                                    Informasi Profile
                                </h2>

                                <p class="text-gray-500 text-sm mt-1">
                                    Update nama dan email akun Anda.
                                </p>

                            </div>

                        </div>

                        <div class="max-w-2xl">

                            @include('profile.partials.update-profile-information-form')

                        </div>

                    </div>

                    {{-- Password --}}
                    <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-8">

                        <div class="flex items-center gap-3 mb-6">

                            <div
                                class="w-12 h-12 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center text-xl">

                                <i class="fa-solid fa-key"></i>

                            </div>

                            <div>

                                <h2 class="text-2xl font-bold text-gray-900">
                                    Update Password
                                </h2>

                                <p class="text-gray-500 text-sm mt-1">
                                    Pastikan akun Anda menggunakan password yang aman.
                                </p>

                            </div>

                        </div>

                        <div class="max-w-2xl">

                            @include('profile.partials.update-password-form')

                        </div>

                    </div>

                    {{-- Delete Account --}}
                    <div class="bg-white border border-red-200 rounded-3xl shadow-sm p-8">

                        <div class="flex items-center gap-3 mb-6">

                            <div
                                class="w-12 h-12 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center text-xl">

                                <i class="fa-solid fa-trash"></i>

                            </div>

                            <div>

                                <h2 class="text-2xl font-bold text-red-600">
                                    Delete Account
                                </h2>

                                <p class="text-gray-500 text-sm mt-1">
                                    Hapus akun secara permanen dari sistem.
                                </p>

                            </div>

                        </div>

                        <div class="max-w-2xl">

                            @include('profile.partials.delete-user-form')

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
