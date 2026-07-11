{{-- ============================================================ --}}
{{-- SIDEBAR NAVIGATION                                          --}}
{{-- Desktop: fixed left sidebar (w-64, dark theme)              --}}
{{-- Mobile: off-canvas overlay with Alpine.js toggle            --}}
{{-- ============================================================ --}}

<div x-data="{ sidebarOpen: false }">

    {{-- ======================================================== --}}
    {{-- MOBILE OVERLAY BACKDROP                                  --}}
    {{-- ======================================================== --}}
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-gray-900/60 backdrop-blur-sm lg:hidden"
        @click="sidebarOpen = false" style="display: none;">
    </div>

    {{-- ======================================================== --}}
    {{-- SIDEBAR                                                  --}}
    {{-- ======================================================== --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed inset-y-0 left-0 z-50 w-64 flex flex-col
                  bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950
                  border-r border-slate-800/50
                  transform transition-transform duration-300 ease-in-out
                  lg:translate-x-0 lg:z-30">

        {{-- ──────────────────────────────────────────────────── --}}
        {{-- LOGO                                                 --}}
        {{-- ──────────────────────────────────────────────────── --}}
        <div class="flex items-center gap-3 px-6 h-16 shrink-0 border-b border-slate-800/60">

            <a href="{{ auth()->user()->dashboard_route }}" class="flex items-center gap-3 group">

                <img src="{{ asset('img/PintarKan.png') }}" alt="PintarKan" class="w-10 h-10 object-contain">

                <div>
                    <h1 class="text-base font-bold text-white leading-none tracking-tight">
                        PintarKan
                    </h1>
                    <p class="text-[11px] text-slate-500 mt-0.5 font-medium">
                        LMS Platform
                    </p>
                </div>

            </a>

            {{-- Close button (mobile only) --}}
            <button @click="sidebarOpen = false"
                class="ml-auto w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-800 transition lg:hidden">
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>

        {{-- ──────────────────────────────────────────────────── --}}
        {{-- NAVIGATION LINKS                                     --}}
        {{-- ──────────────────────────────────────────────────── --}}
        <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5">

            {{-- Section Label --}}
            <p class="px-3 text-[11px] font-semibold uppercase tracking-widest text-slate-500 mb-3">
                Menu
            </p>

            {{-- Dashboard --}}
            <a href="{{ auth()->user()->dashboard_route }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group
               {{ request()->routeIs('admin.dashboard') ||
               request()->routeIs('lecturer.dashboard') ||
               request()->routeIs('student.dashboard')
                   ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/25'
                   : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }}">

                <i
                    class="fa-solid fa-house text-[13px] w-5 text-center
                   {{ request()->routeIs('admin.dashboard') ||
                   request()->routeIs('lecturer.dashboard') ||
                   request()->routeIs('student.dashboard')
                       ? ''
                       : 'group-hover:scale-110 transition-transform' }}"></i>

                <span>Dashboard</span>

            </a>

            {{-- ── ADMIN MENU ─────────────────────────────────── --}}
            @if (auth()->user()->hasRole('admin'))
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group
                   {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.create-user')
                       ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/25'
                       : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }}">

                    <i
                        class="fa-solid fa-users text-[13px] w-5 text-center
                       {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.create-user')
                           ? ''
                           : 'group-hover:scale-110 transition-transform' }}"></i>

                    <span>Kelola User</span>

                </a>

                <a href="{{ route('admin.courses.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group
                   {{ request()->routeIs('admin.courses.*')
                       ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/25'
                       : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }}">

                    <i
                        class="fa-solid fa-book text-[13px] w-5 text-center
                       {{ request()->routeIs('admin.courses.*') ? '' : 'group-hover:scale-110 transition-transform' }}"></i>

                    <span>Kelola Course</span>

                </a>
            @endif

            {{-- ── LECTURER MENU ──────────────────────────────── --}}
            @if (auth()->user()->hasRole('lecturer'))
                <a href="{{ route('lecturer.courses.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group
                   {{ request()->routeIs('lecturer.courses.*') ||
                   request()->routeIs('lecturer.materials.*') ||
                   request()->routeIs('lecturer.assignments.*')
                       ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/25'
                       : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }}">

                    <i
                        class="fa-solid fa-book text-[13px] w-5 text-center
                       {{ request()->routeIs('lecturer.courses.*') ||
                       request()->routeIs('lecturer.materials.*') ||
                       request()->routeIs('lecturer.assignments.*')
                           ? ''
                           : 'group-hover:scale-110 transition-transform' }}"></i>

                    <span>Kelola Course</span>

                </a>

                <a href="{{ route('lecturer.students.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group
                   {{ request()->routeIs('lecturer.students.*')
                       ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/25'
                       : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }}">

                    <i
                        class="fa-solid fa-user-graduate text-[13px] w-5 text-center
                       {{ request()->routeIs('lecturer.students.*') ? '' : 'group-hover:scale-110 transition-transform' }}"></i>

                    <span>Kelola Mahasiswa</span>

                </a>

                <a href="{{ route('lecturer.grades.index') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 group
                   {{ request()->routeIs('lecturer.grades.*')
                       ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/25'
                       : 'text-slate-400 hover:text-white hover:bg-slate-800/70' }}">

                    <i
                        class="fa-solid fa-star text-[13px] w-5 text-center
                       {{ request()->routeIs('lecturer.grades.*') ? '' : 'group-hover:scale-110 transition-transform' }}"></i>

                    <span>Penilaian</span>

                </a>
            @endif

        </nav>

        {{-- ──────────────────────────────────────────────────── --}}
        {{-- USER SECTION (bottom)                                --}}
        {{-- ──────────────────────────────────────────────────── --}}
        <div class="shrink-0 border-t border-slate-800/60 px-4 py-4 space-y-2">

            {{-- User Info --}}
            <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-slate-800/70 transition-all duration-200 group">

                {{-- Avatar --}}
                <div
                    class="w-9 h-9 rounded-lg bg-indigo-600/20 text-indigo-400 flex items-center justify-center font-semibold text-sm shrink-0 ring-1 ring-indigo-500/20">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-slate-200 truncate group-hover:text-white transition-colors">
                        {{ Auth::user()->name }}
                    </p>
                    <p class="text-[11px] text-slate-500 truncate capitalize">
                        {{ Auth::user()->getRoleNames()->first() }}
                    </p>
                </div>

                <i
                    class="fa-solid fa-chevron-right text-[10px] text-slate-600 group-hover:text-slate-400 transition-colors"></i>

            </a>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-500 hover:text-red-400 hover:bg-red-500/10 transition-all duration-200 group">

                    <i
                        class="fa-solid fa-right-from-bracket text-[13px] w-5 text-center group-hover:scale-110 transition-transform"></i>

                    <span>Logout</span>

                </button>

            </form>

        </div>

    </aside>

    {{-- ======================================================== --}}
    {{-- MOBILE TOP BAR                                           --}}
    {{-- ======================================================== --}}
    <div
        class="sticky top-0 z-30 flex items-center h-16 px-4 bg-white/80 backdrop-blur-lg border-b border-gray-200/60 lg:hidden">

        {{-- Hamburger --}}
        <button @click="sidebarOpen = true"
            class="w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-100 transition">
            <i class="fa-solid fa-bars"></i>
        </button>

        {{-- Logo --}}
        <a href="{{ auth()->user()->dashboard_route }}" class="flex items-center gap-2 ml-3">
            <img src="{{ asset('img/PintarKan.png') }}" alt="PintarKan" class="w-8 h-8 object-contain">
            <span class="font-bold text-gray-900 text-sm">PintarKan</span>
        </a>

        {{-- User Avatar (right) --}}
        <div class="ml-auto">
            <a href="{{ route('profile.edit') }}"
                class="w-9 h-9 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-semibold text-sm">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </a>
        </div>

    </div>

</div>
