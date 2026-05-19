<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between h-16">

            {{-- LEFT --}}
            <div class="flex items-center gap-10">

                {{-- Logo --}}
                <a href="{{ auth()->user()->dashboard_route }}" class="flex items-center gap-3 shrink-0">

                    <div
                        class="w-11 h-11 rounded-2xl bg-blue-600 text-white flex items-center justify-center shadow-sm text-lg">

                        <i class="fa-solid fa-graduation-cap"></i>

                    </div>

                    <div class="hidden sm:block">

                        <h1 class="text-lg font-bold text-gray-900">
                            PintarKan
                        </h1>

                        <p class="text-xs text-gray-500 -mt-1">
                            LMS Platform
                        </p>

                    </div>

                </a>

                {{-- Desktop Navigation --}}
                <div class="hidden sm:flex items-center gap-2">

                    {{-- Dashboard --}}
                    <a href="{{ auth()->user()->dashboard_route }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium transition
                        {{ request()->routeIs('admin.dashboard') ||
                        request()->routeIs('dosen.dashboard') ||
                        request()->routeIs('mahasiswa.dashboard')
                            ? 'bg-blue-50 text-blue-700'
                            : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">

                        <i class="fa-solid fa-house"></i>

                        Dashboard

                    </a>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="hidden sm:flex items-center gap-4">

                {{-- User Dropdown --}}
                <x-dropdown align="right" width="60">

                    {{-- Trigger --}}
                    <x-slot name="trigger">

                        <button class="flex items-center gap-3 px-3 py-2 rounded-2xl hover:bg-gray-100 transition">

                            {{-- Avatar --}}
                            <div
                                class="w-10 h-10 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-semibold text-sm">

                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                            </div>

                            {{-- User Info --}}
                            <div class="text-left">

                                <p class="text-sm font-semibold text-gray-900 leading-none">
                                    {{ Auth::user()->name }}
                                </p>

                                <p class="text-xs text-gray-500 mt-1">
                                    {{ Auth::user()->getRoleNames()->first() }}
                                </p>

                            </div>

                            {{-- Arrow --}}
                            <div class="text-gray-400 text-sm">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>

                        </button>

                    </x-slot>

                    {{-- Content --}}
                    <x-slot name="content">

                        <div class="px-4 py-3 border-b border-gray-100">

                            <p class="text-sm font-semibold text-gray-900">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-gray-500 mt-1">
                                {{ Auth::user()->email }}
                            </p>

                        </div>

                        {{-- Profile --}}
                        <x-dropdown-link :href="route('profile.edit')">

                            <div class="flex items-center gap-3">

                                <i class="fa-solid fa-user text-gray-500"></i>

                                <span>Profile</span>

                            </div>

                        </x-dropdown-link>

                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">

                                <div class="flex items-center gap-3 text-red-600">

                                    <i class="fa-solid fa-right-from-bracket"></i>

                                    <span>Logout</span>

                                </div>

                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            {{-- MOBILE BUTTON --}}
            <div class="flex sm:hidden">

                <button @click="open = !open"
                    class="w-11 h-11 rounded-xl border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition">

                    <i class="fa-solid fa-bars"></i>

                </button>

            </div>

        </div>

    </div>

    {{-- MOBILE MENU --}}
    <div x-show="open" x-transition class="sm:hidden border-t border-gray-100 bg-white">

        <div class="px-4 py-4 space-y-2">

            {{-- User --}}
            <div class="flex items-center gap-3 p-4 rounded-2xl bg-gray-50 border border-gray-100">

                <div
                    class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-semibold">

                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                </div>

                <div>

                    <p class="font-semibold text-gray-900">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ Auth::user()->email }}
                    </p>

                </div>

            </div>

            {{-- Dashboard --}}
            <a href="{{ auth()->user()->dashboard_route }}"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-medium transition
                {{ request()->routeIs('admin.dashboard') ||
                request()->routeIs('dosen.dashboard') ||
                request()->routeIs('mahasiswa.dashboard')
                    ? 'bg-blue-50 text-blue-700'
                    : 'text-gray-700 hover:bg-gray-100' }}">

                <i class="fa-solid fa-house"></i>

                Dashboard

            </a>

            {{-- Profile --}}
            <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-medium text-gray-700 hover:bg-gray-100 transition">

                <i class="fa-solid fa-user"></i>

                Profile

            </a>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-medium text-red-600 hover:bg-red-50 transition">

                    <i class="fa-solid fa-right-from-bracket"></i>

                    Logout

                </button>

            </form>

        </div>

    </div>

</nav>
