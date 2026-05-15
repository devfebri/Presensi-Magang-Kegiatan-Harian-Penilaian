<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light" class="scroll-smooth" :class="{ 'theme-dark': dark }" x-data="data()">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $title }} – SIMWEB Kemenkumham Jambi</title>

        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}" />
        <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        @include("dashboard.layouts.link")
        @yield("css")
        @vite(["resources/css/app.css", "resources/js/app.js"])

        <script>
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>

        <style>
            body { font-family: 'Inter', sans-serif; }
            .font-outfit { font-family: 'Outfit', sans-serif; }
        </style>
    </head>

    <body class="leading-default m-0 bg-gray-50 font-sans text-base font-normal text-slate-500 antialiased dark:bg-slate-900">

        {{-- Header gradient background --}}
        <div class="min-h-[250px] absolute w-full top-0 bg-gradient-to-tr from-sky-700 via-sky-600 to-indigo-600 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 20% 50%, rgba(255,255,255,0.3) 0%, transparent 60%), radial-gradient(circle at 80% 20%, rgba(255,255,255,0.2) 0%, transparent 50%);"></div>
        </div>

        @include("dashboard.layouts.sidebar")

        <main class="xl:ml-72 relative h-full max-h-screen rounded-xl transition-all duration-200 ease-in-out">
            @include("dashboard.layouts.navbar")

            <div class="mx-auto w-full px-6 py-6">
                @yield("container")
                @include("dashboard.layouts.footer")
            </div>
        </main>

        @include("dashboard.layouts.script")
        @yield("js")
        @vite('resources/js/app.js')
    </body>

</html>

