<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <!-- Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Left -->
            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ auth()->user()->dashboard_route }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Menu -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    {{-- Dashboard --}}
                    <x-nav-link :href="auth()->user()->dashboard_route" :active="request()->routeIs('admin.dashboard') ||
                        request()->routeIs('dosen.dashboard') ||
                        request()->routeIs('mahasiswa.dashboard')">
                        Dashboard
                    </x-nav-link>

                </div>
            </div>

            <!-- Right -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <x-dropdown align="right" width="48">

                    <!-- Trigger -->
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm text-gray-500 hover:text-gray-700">
                            <div>{{ Auth::user()->student->name }}</div>

                            <div class="ms-1">
                                ▼
                            </div>
                        </button>
                    </x-slot>

                    <!-- Content -->
                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open">
                    ☰
                </button>
            </div>

        </div>
    </div>

    <!-- Responsive -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="auth()->user()->dashboard_route" :active="request()->routeIs('admin.dashboard') ||
                request()->routeIs('dosen.dashboard') ||
                request()->routeIs('mahasiswa.dashboard')">
                Dashboard
            </x-responsive-nav-link>

        </div>

        <div class="pt-4 pb-1 border-t">
            <div class="px-4">
                <div class="font-medium">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">

                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Logout
                    </x-responsive-nav-link>
                </form>

            </div>
        </div>
    </div>

</nav>
