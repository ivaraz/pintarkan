<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'PintarKan') }}</title>
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Custom Style --}}
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="antialiased bg-gray-50 text-gray-900">
    <div class="min-h-screen">
        {{-- Background Decoration --}}
        <div class="fixed top-0 left-0 w-72 h-72 bg-blue-200 opacity-30 rounded-full blur-3xl -z-10">
        </div>
        <div class="fixed bottom-0 right-0 w-96 h-96 bg-blue-100 opacity-40 rounded-full blur-3xl -z-10">
        </div>
        {{-- Main Content --}}
        <main class="relative z-10">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
