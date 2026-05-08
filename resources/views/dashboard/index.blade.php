@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            {{-- ADMIN --}}
            @role('admin')
                @include('dashboard.partials.admin')
            @endrole

            {{-- DOSEN --}}
            @role('lecturer')
                @include('dashboard.partials.dosen')
            @endrole

            {{-- MAHASISWA --}}
            @role('student')
                @include('dashboard.partials.mahasiswa')
            @endrole
        </div>
    </div>
@endsection
