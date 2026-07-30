<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} – SIMWEB Kemenkum Jambi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif']
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.4s ease-out',
                        'slide-up': 'slideUp 0.4s ease-out'
                    },
                    keyframes: {
                        fadeIn: {
                            from: {
                                opacity: '0'
                            },
                            to: {
                                opacity: '1'
                            }
                        },
                        slideUp: {
                            from: {
                                opacity: '0',
                                transform: 'translateY(16px)'
                            },
                            to: {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                    }
                }
            }
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 font-sans antialiased">

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-purple-900 via-purple-800 to-indigo-900 shadow-2xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col">
        <div class="flex items-center gap-3 px-6 py-5 border-b border-white/10">
            <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0 shadow">
                <img src="{{ asset('img/logo.jpeg') }}" class="img-fluid img-thumbnail" width="50" height="50"
                    alt="">
            </div>
            <div>
                <p class="font-outfit font-bold text-white text-sm leading-tight">SIMWEB</p>
                <p class="text-purple-300 text-xs">Portal Pembimbing</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto">
            <p class="text-purple-400 text-xs font-semibold uppercase tracking-widest px-3 mb-3">Menu Utama</p>

            <a href="{{ route('pembimbing.dashboard') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ request()->routeIs('pembimbing.dashboard') ? 'bg-white/15 text-white' : 'text-purple-200 hover:bg-white/10 hover:text-white' }} font-medium text-sm transition-all">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>

            <a href="{{ route('pembimbing.logbook') }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl {{ request()->routeIs('pembimbing.logbook*') ? 'bg-white/15 text-white' : 'text-purple-200 hover:bg-white/10 hover:text-white' }} font-medium text-sm transition-all">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                Logbook
            </a>
        </nav>

        <div class="px-4 py-4 border-t border-white/10">
            <div class="flex items-center gap-3 mb-3 px-2">
                <div class="w-8 h-8 rounded-full bg-purple-400/30 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div class="overflow-hidden">
                    <p class="text-white text-sm font-semibold truncate">{{ $pembimbing->nama_lengkap }}</p>
                    <p class="text-purple-300 text-xs truncate">{{ $pembimbing->email }}</p>
                </div>
            </div>
            <form action="{{ route('pembimbing.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-2 px-3 py-2.5 rounded-xl text-purple-200 hover:bg-white/10 hover:text-white transition-all text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <div id="sidebarOverlay" onclick="closeSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>

    <div class="lg:ml-64 min-h-screen flex flex-col">
        <!-- Top Bar -->
        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-200 shadow-sm">
            <div class="flex items-center justify-between px-4 md:px-6 h-16">
                <div class="flex items-center gap-3">
                    <button onclick="toggleSidebar()"
                        class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div>
                        <h1 class="font-outfit font-bold text-slate-900 text-lg leading-tight">{{ $title }}</h1>
                        <p class="text-slate-400 text-xs">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div
                        class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-purple-50 border border-purple-200">
                        <span class="w-2 h-2 rounded-full bg-purple-500 animate-pulse"></span>
                        <span class="text-purple-700 text-xs font-semibold">Pembimbing</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-4 md:p-6 animate-fade-in">
            @yield('content')
        </main>

        <footer class="text-center py-4 text-slate-400 text-xs border-t border-slate-200 mt-auto">
            © {{ date('Y') }} SIMWEB – Kementerian Hukum Provinsi Jambi
        </footer>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.toggle('hidden');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.add('hidden');
        }
    </script>
    @yield('js')
</body>

</html>
