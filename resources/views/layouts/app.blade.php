<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-inter bg-gradient-to-br from-gray-100 to-gray-300 text-gray-800 antialiased">
    <div class="min-h-screen flex flex-col">
        
        <!-- Navbar -->
        <nav class="fixed w-full bg-white/80 backdrop-blur-md shadow-md z-50">
            @include('layouts.navigation')
        </nav>

        <!-- Page Wrapper -->
        <div class="flex-1 flex flex-col mt-16">
            
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-md rounded-lg mx-auto mt-4 max-w-7xl px-6 py-4 animate-fade-in">
                    <h1 class="text-2xl font-semibold text-gray-800">{{ $header }}</h1>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1 flex flex-col items-center justify-center py-6 px-4 sm:px-6 lg:px-8 animate-fade-in">
                <div class="max-w-7xl w-full">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <!-- Footer -->
        <footer class="bg-white text-center py-4 text-sm text-gray-600 shadow-inner">
            © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
        </footer>
    </div>
</body>
</html>