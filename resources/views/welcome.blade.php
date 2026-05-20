<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Presensi Magang - Kementerian Hukum Provinsi Jambi</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            900: '#0c4a6e',
                        }
                    },
                    animation: {
                        'blob': 'blob 7s infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in-up': 'fadeInUp 1s ease-out forwards',
                    },
                    keyframes: {
                        blob: {
                            '0%': {
                                transform: 'translate(0px, 0px) scale(1)'
                            },
                            '33%': {
                                transform: 'translate(30px, -50px) scale(1.1)'
                            },
                            '66%': {
                                transform: 'translate(-20px, 20px) scale(0.9)'
                            },
                            '100%': {
                                transform: 'translate(0px, 0px) scale(1)'
                            },
                        },
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        },
                        fadeInUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(20px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .dark .glass {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .dark .glass-card {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>

<body
    class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 font-sans antialiased overflow-x-hidden selection:bg-brand-500 selection:text-white">

    <!-- Background Animated Blobs -->
    <div class="fixed inset-0 w-full h-full pointer-events-none z-[-1] overflow-hidden">
        <div
            class="absolute top-0 left-1/4 w-96 h-96 bg-brand-400 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 dark:opacity-20 animate-blob">
        </div>
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 dark:opacity-20 animate-blob"
            style="animation-delay: 2s"></div>
        <div class="absolute -bottom-32 left-1/2 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-[128px] opacity-40 dark:opacity-20 animate-blob"
            style="animation-delay: 4s"></div>
    </div>

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 glass border-b border-white/20 dark:border-slate-700/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-tr from-brand-600 to-indigo-500 flex items-center justify-center shadow-lg shadow-brand-500/30 transform transition hover:scale-105">
                        <img src="{{ asset('img/favicon.png') }}" alt="SIMWEB Logo">
                    </div>
                    <div>
                        <h1
                            class="text-xl md:text-2xl font-outfit font-bold text-slate-900 dark:text-white tracking-tight">
                            Presensi<span class="text-brand-500">Magang</span></h1>
                        <p
                            class="text-[10px] md:text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                            Kemenkumham Jambi</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ auth()->user()->role }}/dashboard"
                            class="relative inline-flex items-center justify-center px-4 md:px-6 py-2 md:py-2.5 overflow-hidden font-medium text-white transition duration-300 ease-out bg-brand-600 rounded-full shadow-md group hover:bg-brand-500">
                            <span
                                class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-brand-500 group-hover:translate-x-0 ease">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </span>
                            <span
                                class="absolute flex items-center justify-center w-full h-full text-white transition-all duration-300 transform group-hover:translate-x-full ease">Dashboard</span>
                            <span class="relative invisible text-sm md:text-base">Dashboard</span>
                        </a>
                    @else
                        <!-- Login Dropdown (Desktop) -->
                        <div class="relative hidden md:block" id="loginDropdownWrapper">
                            <button id="loginDropdownBtn" onclick="toggleLoginDropdown()"
                                class="relative inline-flex items-center justify-center gap-2 px-5 md:px-7 py-2.5 font-semibold text-white transition-all duration-300 ease-out bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 rounded-full shadow-lg shadow-brand-500/25 hover:shadow-brand-500/40 hover:scale-105 active:scale-95 text-sm md:text-base">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Masuk Sistem
                                <svg id="loginDropdownChevron" class="w-4 h-4 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <!-- Dropdown Menu -->
                            <div id="loginDropdownMenu" class="hidden absolute right-0 mt-3 w-64 origin-top-right z-50">
                                <div
                                    class="bg-white dark:bg-slate-800 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-2xl shadow-slate-900/20">
                                    <div class="px-4 py-3 border-b border-slate-100/50 dark:border-slate-700/50">
                                        <p
                                            class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                            Masuk sebagai</p>
                                    </div>
                                    <div class="p-2 space-y-1">
                                        <a href="{{ route('login') }}"
                                            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-rose-50 dark:hover:bg-rose-900/20 transition-colors group/item">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-rose-100 dark:bg-rose-900/40 flex items-center justify-center text-rose-500 group-hover/item:bg-rose-500 group-hover/item:text-white transition-colors flex-shrink-0">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-slate-800 dark:text-slate-100 text-sm">
                                                    Administrator</p>
                                                <p class="text-xs text-slate-500 dark:text-slate-400">Kelola seluruh sistem
                                                </p>
                                            </div>
                                        </a>
                                        <a href="{{ route('login.pembimbing') }}"
                                            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-brand-50 dark:hover:bg-brand-900/20 transition-colors group/item">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-brand-100 dark:bg-brand-900/40 flex items-center justify-center text-brand-500 group-hover/item:bg-brand-500 group-hover/item:text-white transition-colors flex-shrink-0">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-slate-800 dark:text-slate-100 text-sm">
                                                    Pembimbing</p>
                                                <p class="text-xs text-slate-500 dark:text-slate-400">Pantau pemagang binaan
                                                </p>
                                            </div>
                                        </a>
                                        <a href="{{ route('login.view') }}"
                                            class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-colors group/item">
                                            <div
                                                class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center text-emerald-500 group-hover/item:bg-emerald-500 group-hover/item:text-white transition-colors flex-shrink-0">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-slate-800 dark:text-slate-100 text-sm">
                                                    Pemagang</p>
                                                <p class="text-xs text-slate-500 dark:text-slate-400">Absensi &amp; lihat
                                                    kehadiran</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hamburger Button (Mobile only) -->
                        <button id="mobileMenuBtn" onclick="toggleMobileMenu()"
                            class="md:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">
                            <svg id="hamburgerIcon" class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            <svg id="closeIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    @endauth
                </div>

                <script>
                    function toggleLoginDropdown() {
                        const menu = document.getElementById('loginDropdownMenu');
                        const chevron = document.getElementById('loginDropdownChevron');
                        const isHidden = menu.classList.contains('hidden');
                        if (isHidden) {
                            menu.classList.remove('hidden');
                            menu.style.opacity = '0';
                            menu.style.transform = 'translateY(-8px) scale(0.97)';
                            menu.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
                            requestAnimationFrame(() => {
                                menu.style.opacity = '1';
                                menu.style.transform = 'translateY(0) scale(1)';
                            });
                            chevron.style.transform = 'rotate(180deg)';
                        } else {
                            menu.style.opacity = '0';
                            menu.style.transform = 'translateY(-8px) scale(0.97)';
                            setTimeout(() => menu.classList.add('hidden'), 200);
                            chevron.style.transform = 'rotate(0deg)';
                        }
                    }

                    function toggleMobileMenu() {
                        const mobileMenu = document.getElementById('mobileMenu');
                        const hamburger = document.getElementById('hamburgerIcon');
                        const close = document.getElementById('closeIcon');
                        const isHidden = mobileMenu.classList.contains('hidden');
                        if (isHidden) {
                            mobileMenu.classList.remove('hidden');
                            hamburger.classList.add('hidden');
                            close.classList.remove('hidden');
                        } else {
                            mobileMenu.classList.add('hidden');
                            hamburger.classList.remove('hidden');
                            close.classList.add('hidden');
                        }
                    }
                    document.addEventListener('click', function(e) {
                        const wrapper = document.getElementById('loginDropdownWrapper');
                        const menu = document.getElementById('loginDropdownMenu');
                        const chevron = document.getElementById('loginDropdownChevron');
                        if (wrapper && menu && !wrapper.contains(e.target) && !menu.classList.contains('hidden')) {
                            menu.style.opacity = '0';
                            menu.style.transform = 'translateY(-8px) scale(0.97)';
                            setTimeout(() => menu.classList.add('hidden'), 200);
                            if (chevron) chevron.style.transform = 'rotate(0deg)';
                        }
                    });
                </script>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobileMenu"
            class="hidden md:hidden bg-white dark:bg-slate-800 border-t border-slate-100 dark:border-slate-700">
            <div class="px-4 py-3">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Masuk sebagai</p>
                <div class="space-y-2">
                    <a href="{{ route('login') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl bg-rose-50 dark:bg-rose-900/20 hover:bg-rose-100 dark:hover:bg-rose-900/40 transition-colors">
                        <div
                            class="w-9 h-9 rounded-xl bg-rose-100 dark:bg-rose-900/50 flex items-center justify-center text-rose-500 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800 dark:text-white text-sm">Administrator</p>
                            <p class="text-xs text-slate-500">Kelola seluruh sistem</p>
                        </div>
                    </a>
                    <a href="{{ route('login') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl bg-brand-50 dark:bg-brand-900/20 hover:bg-brand-100 dark:hover:bg-brand-900/40 transition-colors">
                        <div
                            class="w-9 h-9 rounded-xl bg-brand-100 dark:bg-brand-900/50 flex items-center justify-center text-brand-500 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800 dark:text-white text-sm">Pembimbing</p>
                            <p class="text-xs text-slate-500">Pantau pemagang binaan</p>
                        </div>
                    </a>
                    <a href="{{ route('login.view') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 hover:bg-emerald-100 dark:hover:bg-emerald-900/40 transition-colors">
                        <div
                            class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center text-emerald-500 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800 dark:text-white text-sm">Pemagang</p>
                            <p class="text-xs text-slate-500">Absensi &amp; lihat kehadiran</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-32 pb-16 lg:pt-40 lg:pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Hero Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <!-- Left: Typography & CTA -->
                <div class="space-y-8 animate-fade-in-up relative z-10">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-50 dark:bg-brand-900/30 border border-brand-200 dark:border-brand-700/50 text-brand-600 dark:text-brand-400 text-sm font-medium">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                        </span>
                        Sistem Informasi Presensi V2.0
                    </div>

                    <h2
                        class="text-3xl md:text-4xl lg:text-5xl font-outfit font-extrabold leading-[1.2] tracking-tight mb-4">
                        Sistem Informasi Manajemen <br />
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-indigo-600 dark:from-brand-400 dark:to-indigo-400">
                            Berbasis WEB
                        </span><br />
                        <span
                            class="text-xl md:text-2xl lg:text-3xl text-slate-700 dark:text-slate-300 font-semibold leading-snug block mt-4">Pada
                            Kantor Wilayah Kementerian Hukum Provinsi Jambi</span>
                    </h2>

                    <p class="text-base md:text-lg text-slate-600 dark:text-slate-400 leading-relaxed max-w-xl">
                        Kelola kehadiran pemagang dengan lebih efisien, transparan, dan real-time menggunakan teknologi
                        terkini.
                    </p>

                    <div class="flex flex-wrap items-center gap-4 pt-4">
                        <a href="{{ route('login') }}"
                            class="px-6 md:px-8 py-3 md:py-4 bg-gradient-to-r from-brand-600 to-indigo-600 hover:from-brand-500 hover:to-indigo-500 text-white rounded-2xl font-semibold shadow-xl shadow-brand-500/20 transition-all transform hover:-translate-y-1 flex items-center gap-2">
                            Mulai Sekarang
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="#features"
                            class="px-6 md:px-8 py-3 md:py-4 glass-card text-slate-700 dark:text-slate-200 rounded-2xl font-semibold hover:bg-white/60 dark:hover:bg-slate-800/60 transition-all">
                            Pelajari Fitur
                        </a>
                    </div>

                    <!-- Quick Stats -->
                    <div
                        class="grid grid-cols-3 gap-4 md:gap-6 pt-8 border-t border-slate-200 dark:border-slate-800/50 mt-8">
                        <div>
                            <p class="text-2xl md:text-3xl font-outfit font-bold text-slate-900 dark:text-white">
                                100<span class="text-brand-500">+</span></p>
                            <p class="text-xs md:text-sm text-slate-500">Pemagang Aktif</p>
                        </div>
                        <div>
                            <p class="text-2xl md:text-3xl font-outfit font-bold text-slate-900 dark:text-white">
                                10<span class="text-brand-500">+</span></p>
                            <p class="text-xs md:text-sm text-slate-500">Instansi Asal</p>
                        </div>
                        <div>
                            <p class="text-2xl md:text-3xl font-outfit font-bold text-slate-900 dark:text-white">
                                99<span class="text-brand-500">%</span></p>
                            <p class="text-xs md:text-sm text-slate-500">Uptime Sistem</p>
                        </div>
                    </div>
                </div>

                <!-- Right: Illustration / Glassmorphic UI -->
                <div class="relative lg:h-[600px] flex items-center justify-center animate-float lg:block hidden z-10">
                    <!-- Decorator Elements -->
                    <div
                        class="absolute top-10 right-10 w-20 h-20 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-full blur-2xl opacity-60">
                    </div>
                    <div
                        class="absolute bottom-10 left-10 w-32 h-32 bg-gradient-to-tr from-brand-400 to-indigo-500 rounded-full blur-3xl opacity-50">
                    </div>

                    <!-- Main Dashboard Card -->
                    <div
                        class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[450px] glass-card rounded-3xl p-6 border border-white/40 shadow-2xl">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="font-outfit font-bold text-lg text-slate-800 dark:text-white">Live
                                    Attendance</h3>
                                <p class="text-xs text-slate-500">Hari ini, {{ now()->translatedFormat('d F Y') }}</p>
                            </div>
                            <div
                                class="flex items-center gap-2 px-3 py-1 bg-green-100/80 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-xs font-semibold border border-green-200 dark:border-green-800/50">
                                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                Active
                            </div>
                        </div>

                        <div class="space-y-4">
                            <!-- User Item 1 -->
                            <div
                                class="bg-white/60 dark:bg-slate-800/60 p-4 rounded-2xl flex items-center justify-between border border-white/20">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-bold">
                                        A</div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800 dark:text-white">Ahmad Fauzi</p>
                                        <p class="text-xs text-slate-500">Sistem Informasi</p>
                                    </div>
                                </div>
                                <span
                                    class="px-3 py-1 bg-brand-100 dark:bg-brand-900/50 text-brand-700 dark:text-brand-300 rounded-lg text-xs font-medium">07:45
                                    AM</span>
                            </div>

                            <!-- User Item 2 -->
                            <div
                                class="bg-white/60 dark:bg-slate-800/60 p-4 rounded-2xl flex items-center justify-between border border-white/20">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-400 to-rose-500 flex items-center justify-center text-white font-bold">
                                        B</div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800 dark:text-white">Budi Santoso
                                        </p>
                                        <p class="text-xs text-slate-500">Hukum</p>
                                    </div>
                                </div>
                                <span
                                    class="px-3 py-1 bg-brand-100 dark:bg-brand-900/50 text-brand-700 dark:text-brand-300 rounded-lg text-xs font-medium">08:02
                                    AM</span>
                            </div>

                            <!-- User Item 3 -->
                            <div
                                class="bg-white/60 dark:bg-slate-800/60 p-4 rounded-2xl flex items-center justify-between border border-white/20 opacity-70">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-slate-300 dark:bg-slate-600 flex items-center justify-center text-slate-500 dark:text-slate-300 font-bold">
                                        C</div>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800 dark:text-white">Citra Lestari
                                        </p>
                                        <p class="text-xs text-slate-500">Manajemen</p>
                                    </div>
                                </div>
                                <span
                                    class="px-3 py-1 bg-slate-100 dark:bg-slate-700/50 text-slate-600 dark:text-slate-400 rounded-lg text-xs font-medium">Belum
                                    Hadir</span>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-slate-200/50 dark:border-slate-700/50">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Tingkat
                                    Kehadiran</span>
                                <span class="text-sm font-bold text-brand-600 dark:text-brand-400">85%</span>
                            </div>
                            <div
                                class="w-full h-3 bg-slate-100 dark:bg-slate-800 rounded-full overflow-hidden border border-slate-200 dark:border-slate-700">
                                <div class="h-full bg-gradient-to-r from-brand-400 to-indigo-500 rounded-full"
                                    style="width: 85%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Widget -->
                    <div class="absolute bottom-20 -left-10 glass-card p-4 rounded-2xl flex items-center gap-4 animate-float"
                        style="animation-delay: 1s;">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center shadow-inner">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-800 dark:text-white">Data Tersinkronisasi</p>
                            <p class="text-xs text-slate-500">Secara Real-time</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Features Section -->
    <section id="features" class="py-16 md:py-20 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16">
                <h2 class="text-2xl md:text-4xl font-outfit font-bold text-slate-900 dark:text-white mb-4">Fitur Utama
                    Sistem</h2>
                <p class="text-sm md:text-base text-slate-600 dark:text-slate-400">Tiga alur kerja utama yang saling
                    terintegrasi untuk memudahkan pengelolaan magang dari awal hingga penilaian akhir.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                <!-- Feature 1: Presensi -->
                <div
                    class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl hover:-translate-y-2 transition-transform duration-300 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-xl hover:shadow-brand-500/10">
                    <div
                        class="w-14 h-14 bg-brand-100 dark:bg-brand-900/50 rounded-2xl flex items-center justify-center mb-6 text-brand-600 dark:text-brand-400">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-brand-50 dark:bg-brand-900/30 text-brand-600 dark:text-brand-400 text-xs font-semibold rounded-full mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-brand-500 animate-pulse"></span> Fitur #1
                    </div>
                    <h3 class="text-xl font-bold font-outfit text-slate-900 dark:text-white mb-3">Presensi Digital</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">Pemagang melakukan absen
                        masuk dan pulang secara digital setiap hari. Data kehadiran langsung tercatat real-time dan
                        dapat dipantau oleh admin maupun pembimbing.</p>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700 flex flex-wrap gap-2">
                        <span
                            class="px-2 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs rounded-lg">Absen
                            Masuk</span>
                        <span
                            class="px-2 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs rounded-lg">Absen
                            Pulang</span>
                        <span
                            class="px-2 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs rounded-lg">Rekap
                            Otomatis</span>
                    </div>
                </div>

                <!-- Feature 2: Input Kegiatan Harian -->
                <div
                    class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl hover:-translate-y-2 transition-transform duration-300 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-xl hover:shadow-emerald-500/10">
                    <div
                        class="w-14 h-14 bg-emerald-100 dark:bg-emerald-900/50 rounded-2xl flex items-center justify-center mb-6 text-emerald-600 dark:text-emerald-400">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <div
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-xs font-semibold rounded-full mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Fitur #2 · Pemagang
                    </div>
                    <h3 class="text-xl font-bold font-outfit text-slate-900 dark:text-white mb-3">Jurnal Kegiatan
                        Harian</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">Pemagang mencatat laporan
                        kegiatan yang dilakukan setiap hari selama masa magang. Jurnal ini menjadi dasar penilaian
                        kinerja oleh pembimbing di akhir periode.</p>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700 flex flex-wrap gap-2">
                        <span
                            class="px-2 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs rounded-lg">Input
                            Harian</span>
                        <span
                            class="px-2 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs rounded-lg">Deskripsi
                            Tugas</span>
                        <span
                            class="px-2 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs rounded-lg">Riwayat
                            Jurnal</span>
                    </div>
                </div>

                <!-- Feature 3: Penilaian -->
                <div
                    class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl hover:-translate-y-2 transition-transform duration-300 border border-slate-100 dark:border-slate-700 shadow-sm hover:shadow-xl hover:shadow-purple-500/10">
                    <div
                        class="w-14 h-14 bg-purple-100 dark:bg-purple-900/50 rounded-2xl flex items-center justify-center mb-6 text-purple-600 dark:text-purple-400">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                            </path>
                        </svg>
                    </div>
                    <div
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 text-xs font-semibold rounded-full mb-4">
                        <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span> Fitur #3 · Pembimbing
                    </div>
                    <h3 class="text-xl font-bold font-outfit text-slate-900 dark:text-white mb-3">Penilaian Akhir</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">Pembimbing memberikan
                        penilaian terhadap kinerja dan kegiatan pemagang di akhir periode magang berdasarkan jurnal
                        harian dan rekap kehadiran.</p>
                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-700 flex flex-wrap gap-2">
                        <span
                            class="px-2 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs rounded-lg">Nilai
                            Kinerja</span>
                        <span
                            class="px-2 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs rounded-lg">Review
                            Jurnal</span>
                        <span
                            class="px-2 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs rounded-lg">Sertifikat</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Login Roles Section -->
    <section class="py-20 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="glass-card rounded-[2.5rem] p-8 md:p-16 border border-white/50 dark:border-slate-700/50">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-outfit font-bold text-slate-900 dark:text-white mb-4">Pilih
                        Gerbang Akses Anda</h2>
                    <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">Silakan masuk menggunakan akun
                        sesuai dengan peran masing-masing.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Admin Role -->
                    <a href="{{ route('login') }}" class="group block">
                        <div
                            class="h-full bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-3xl p-8 shadow-sm hover:shadow-xl hover:shadow-rose-500/10 border border-slate-100 dark:border-slate-700 transition-all duration-300 transform group-hover:-translate-y-2">
                            <div
                                class="w-16 h-16 bg-rose-50 dark:bg-rose-500/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-rose-500 group-hover:text-white text-rose-500 transition-colors duration-300 shadow-inner">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold font-outfit text-slate-900 dark:text-white mb-2">Administrator
                            </h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mb-6">Pusat kontrol sistem, kelola
                                data master, dan monitoring keseluruhan presensi.</p>
                            <div
                                class="flex items-center text-rose-500 font-semibold text-sm group-hover:gap-2 transition-all">
                                Masuk Panel Admin
                                <svg class="w-4 h-4 ml-1 opacity-0 group-hover:opacity-100 transition-opacity"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- Dospem Role -->
                    <a href="{{ route('login') }}" class="group block">
                        <div
                            class="h-full bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-3xl p-8 shadow-sm hover:shadow-xl hover:shadow-brand-500/10 border border-slate-100 dark:border-slate-700 transition-all duration-300 transform group-hover:-translate-y-2 relative overflow-hidden">
                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-brand-500/5 rounded-bl-full -z-10 group-hover:scale-150 transition-transform duration-500">
                            </div>
                            <div
                                class="w-16 h-16 bg-brand-50 dark:bg-brand-500/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-brand-500 group-hover:text-white text-brand-500 transition-colors duration-300 shadow-inner">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold font-outfit text-slate-900 dark:text-white mb-2">Pembimbing
                            </h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mb-6">Pantau aktivitas, setujui izin,
                                dan evaluasi pemagang bimbingan Anda.</p>
                            <div
                                class="flex items-center text-brand-500 font-semibold text-sm group-hover:gap-2 transition-all">
                                Masuk Portal Pembimbing
                                <svg class="w-4 h-4 ml-1 opacity-0 group-hover:opacity-100 transition-opacity"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </div>
                        </div>
                    </a>

                    <!-- Mahasiswa Role -->
                    <a href="{{ route('login.view') }}" class="group block">
                        <div
                            class="h-full bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-3xl p-8 shadow-sm hover:shadow-xl hover:shadow-emerald-500/10 border border-slate-100 dark:border-slate-700 transition-all duration-300 transform group-hover:-translate-y-2">
                            <div
                                class="w-16 h-16 bg-emerald-50 dark:bg-emerald-500/10 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-500 group-hover:text-white text-emerald-500 transition-colors duration-300 shadow-inner">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 14v6m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold font-outfit text-slate-900 dark:text-white mb-2">Pemagang</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mb-6">Lakukan absensi harian, ajukan
                                izin, dan unduh rekap kehadiran bulanan Anda.</p>
                            <div
                                class="flex items-center text-emerald-500 font-semibold text-sm group-hover:gap-2 transition-all">
                                Masuk Area Pemagang
                                <svg class="w-4 h-4 ml-1 opacity-0 group-hover:opacity-100 transition-opacity"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Test Credentials Alert -->
                <div
                    class="mt-12 p-6 bg-amber-50/80 dark:bg-amber-900/20 backdrop-blur-sm border border-amber-200 dark:border-amber-700/50 rounded-2xl flex flex-col md:flex-row gap-6 items-center shadow-sm">
                    <div
                        class="flex-shrink-0 w-12 h-12 bg-amber-100 dark:bg-amber-800/50 rounded-full flex items-center justify-center text-amber-600 dark:text-amber-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-grow text-center md:text-left">
                        <h4 class="text-amber-800 dark:text-amber-300 font-bold mb-1">Informasi Kredensial Uji Coba
                        </h4>
                        <p class="text-amber-700/80 dark:text-amber-400/80 text-sm">Gunakan akun berikut untuk mencoba
                            sistem jika Anda adalah evaluator.</p>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col gap-2 text-sm text-slate-600 dark:text-slate-400 bg-white/60 dark:bg-slate-900/60 p-4 rounded-xl border border-white/40 dark:border-slate-700/40">
                        <div
                            class="flex justify-between gap-4 border-b border-slate-200/60 dark:border-slate-700/60 pb-1">
                            <span class="font-medium">Admin:</span> <span>admin@admin.com / password</span>
                        </div>
                        <div
                            class="flex justify-between gap-4 border-b border-slate-200/60 dark:border-slate-700/60 pb-1">
                            <span class="font-medium">Pembimbing:</span> <span>pembimbing@gmail.com / password</span>
                        </div>
                        <div class="flex justify-between gap-4">
                            <span class="font-medium">Pemagang:</span> <span>12345 / password</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer
        class="border-t border-slate-200/60 dark:border-slate-800/60 bg-white/50 dark:bg-slate-900/50 backdrop-blur-lg pt-12 pb-8 relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-lg bg-gradient-to-tr from-brand-600 to-indigo-500 flex items-center justify-center shadow-lg shadow-brand-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <span class="font-outfit font-bold text-slate-900 dark:text-white text-lg">Presensi<span
                                class="text-brand-500">Magang</span></span>
                        <p class="text-xs text-slate-500">Kemenkumham Jambi</p>
                    </div>
                </div>

                <p class="text-sm text-slate-500 text-center md:text-right">
                    &copy; {{ date('Y') }} Kementerian Hukum Provinsi Jambi.<br class="md:hidden" /> Seluruh hak
                    cipta dilindungi.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>
