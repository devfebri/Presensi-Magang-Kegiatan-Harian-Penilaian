<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Informasi Manajemen WEB Kementerian Hukum Provinsi Jambi') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(135deg, #003DA5 0%, #1565C0 50%, #0D47A1 100%);
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- Logo Area -->
        <div class="mb-8 text-center">
            <div class="w-20 h-20 flex items-center justify-center mx-auto mb-8">
                <img src="{{ asset('img/favicon.png') }}" alt="SIMWEB Logo">
            </div>
            <h1 class="text-3xl font-bold text-white">SIMWEB</h1>
            <p class="text-blue-100 mt-2">Kantor Wilayah Kementerian Hukum Provinsi Jambi</p>
        </div>

        <!-- Auth Form Card -->
        <div class="w-full sm:max-w-md">
            <div class="bg-white shadow-2xl overflow-hidden sm:rounded-2xl">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-gov-primary to-blue-900 px-6 py-8">
                    <p class="text-white text-center text-lg font-semibold">
                        {{ request()->is('register') ? 'Buat Akun Baru' : 'Masuk ke Sistem' }}</p>
                </div>

                <!-- Card Body -->
                <div class="px-6 py-8">
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer -->
            <p class="text-center text-white text-sm mt-6">
                © 2026 SIMWEB | Kementerian Hukum Provinsi Jambi
            </p>
        </div>
    </div>
</body>

</html>
