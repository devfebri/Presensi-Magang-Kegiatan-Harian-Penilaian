<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

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

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                    },
                    animation: {
                        'blob': 'blob 7s infinite',
                        'fade-in': 'fadeIn 0.4s ease-out',
                        'slide-up': 'slideUp 0.4s ease-out',
                    },
                    keyframes: {
                        blob: {
                            '0%':   { transform: 'translate(0px,0px) scale(1)' },
                            '33%':  { transform: 'translate(30px,-50px) scale(1.1)' },
                            '66%':  { transform: 'translate(-20px,20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px,0px) scale(1)' },
                        },
                        fadeIn:  { from: { opacity: '0' }, to: { opacity: '1' } },
                        slideUp: { from: { opacity: '0', transform: 'translateY(16px)' }, to: { opacity: '1', transform: 'translateY(0)' } },
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

        <!-- Logo -->
        <div class="flex items-center gap-3 px-6 py-5 border-b border-white/10">
            <div class="w-9 h-9 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0 shadow">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <p class="font-outfit font-bold text-white text-sm leading-tight">SIMWEB</p>
                <p class="text-purple-300 text-xs">Portal Pembimbing</p>
            </div>
        </div>

        <!-- Nav -->
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
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                Logbook
            </a>
        </nav>

        <!-- User Profile & Logout -->
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

    <!-- Sidebar Overlay (mobile) -->
    <div id="sidebarOverlay" onclick="closeSidebar()"
        class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>

    <!-- Main Content -->
    <div class="lg:ml-64 min-h-screen flex flex-col">

        <!-- Top Bar -->
        <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-200 shadow-sm">
            <div class="flex items-center justify-between px-4 md:px-6 h-16">
                <div class="flex items-center gap-3">
                    <!-- Mobile menu toggle -->
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div>
                        <h1 class="font-outfit font-bold text-slate-900 text-lg leading-tight">{{ $title }}</h1>
                        <p class="text-slate-400 text-xs">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-purple-50 border border-purple-200">
                        <span class="w-2 h-2 rounded-full bg-purple-500 animate-pulse"></span>
                        <span class="text-purple-700 text-xs font-semibold">Pembimbing</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-4 md:p-6 animate-fade-in">

            <!-- Welcome Banner -->
            <div class="relative bg-gradient-to-r from-purple-700 via-purple-600 to-indigo-600 rounded-2xl p-6 mb-6 overflow-hidden shadow-xl">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full translate-x-1/3 -translate-y-1/2 pointer-events-none"></div>
                <div class="absolute bottom-0 left-0 w-40 h-40 bg-white/5 rounded-full -translate-x-1/3 translate-y-1/2 pointer-events-none"></div>
                <div class="relative z-10 flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
                    <div>
                        <p class="text-purple-200 text-sm font-medium mb-1">Selamat datang kembali,</p>
                        <h2 class="font-outfit font-bold text-white text-2xl mb-1">{{ $pembimbing->nama_lengkap }}</h2>
                        @if($pembimbing->jabatan)
                            <p class="text-purple-200 text-sm">{{ $pembimbing->jabatan }}</p>
                        @endif
                    </div>
                    @if($namaInstansi)
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/15 border border-white/20 text-white text-sm font-medium">
                        <svg class="w-4 h-4 text-purple-200 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        {{ $namaInstansi }}
                    </div>
                    @endif
                </div>
            </div>

            <!-- Stat Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">

                <!-- Total Pemagang -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md transition-shadow animate-slide-up">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-11 h-11 rounded-xl bg-blue-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-blue-500 bg-blue-50 px-2 py-1 rounded-full">Total</span>
                    </div>
                    <p class="text-3xl font-outfit font-bold text-slate-900">{{ $totalPemagang }}</p>
                    <p class="text-slate-500 text-sm mt-1">Total Pemagang</p>
                </div>

                <!-- Hadir Hari Ini -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md transition-shadow animate-slide-up" style="animation-delay:0.1s">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-11 h-11 rounded-xl bg-emerald-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-full">Hari Ini</span>
                    </div>
                    <p class="text-3xl font-outfit font-bold text-slate-900">{{ $hadir }}</p>
                    <p class="text-slate-500 text-sm mt-1">Pemagang Hadir</p>
                </div>

                <!-- Belum Hadir -->
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md transition-shadow animate-slide-up" style="animation-delay:0.2s">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-11 h-11 rounded-xl bg-amber-50 flex items-center justify-center">
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-amber-500 bg-amber-50 px-2 py-1 rounded-full">Hari Ini</span>
                    </div>
                    <p class="text-3xl font-outfit font-bold text-slate-900">{{ $totalPemagang - $hadir }}</p>
                    <p class="text-slate-500 text-sm mt-1">Belum Absen</p>
                </div>
            </div>

            <!-- Rekap Bulan Ini -->
            @if($rekapBulanIni)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-slate-700">Total Kehadiran Bulan Ini</p>
                    </div>
                    <p class="text-4xl font-outfit font-bold text-indigo-600">{{ $rekapBulanIni->jml_kehadiran ?? 0 }}</p>
                    <p class="text-slate-400 text-xs mt-1">Absen masuk tercatat</p>
                </div>
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-slate-700">Keterlambatan Bulan Ini</p>
                    </div>
                    <p class="text-4xl font-outfit font-bold text-red-500">{{ $rekapBulanIni->jml_terlambat ?? 0 }}</p>
                    <p class="text-slate-400 text-xs mt-1">Masuk setelah 08:00</p>
                </div>
            </div>
            @endif

            <!-- Daftar Pemagang -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="font-outfit font-semibold text-slate-900">Daftar Pemagang Hari Ini</h3>
                        <p class="text-slate-400 text-xs mt-0.5">
                            {{ now()->isoFormat('dddd, D MMMM Y') }}
                            @if($namaInstansi)
                                &mdash; <span class="text-purple-600 font-medium">{{ $namaInstansi }}</span>
                            @endif
                        </p>
                    </div>
                    <span class="text-xs font-semibold text-purple-600 bg-purple-50 border border-purple-100 px-3 py-1 rounded-full">
                        {{ $hadir }} / {{ $totalPemagang }} Hadir
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100">
                                <th class="text-left px-6 py-3 text-slate-500 font-semibold text-xs uppercase tracking-wider">No</th>
                                <th class="text-left px-6 py-3 text-slate-500 font-semibold text-xs uppercase tracking-wider">Nama Pemagang</th>
                                <th class="text-left px-6 py-3 text-slate-500 font-semibold text-xs uppercase tracking-wider hidden md:table-cell">Instansi</th>
                                <th class="text-left px-6 py-3 text-slate-500 font-semibold text-xs uppercase tracking-wider">Jam Masuk</th>
                                <th class="text-left px-6 py-3 text-slate-500 font-semibold text-xs uppercase tracking-wider hidden sm:table-cell">Jam Keluar</th>
                                <th class="text-left px-6 py-3 text-slate-500 font-semibold text-xs uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($daftarPemagang as $index => $item)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="px-6 py-4 text-slate-400">{{ $daftarPemagang->firstItem() + $index }}</td>
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="font-semibold text-slate-800">{{ $item->nama_lengkap }}</p>
                                        <p class="text-xs text-slate-400">{{ $item->nik }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 hidden md:table-cell">{{ $item->instansi ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    @if($item->jam_masuk)
                                        <span class="font-mono text-slate-800">{{ $item->jam_masuk }}</span>
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 hidden sm:table-cell">
                                    @if($item->jam_keluar)
                                        <span class="font-mono text-slate-800">{{ $item->jam_keluar }}</span>
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($item->tanggal_presensi)
                                        @if($item->jam_masuk > '08:00')
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-50 text-amber-600 text-xs font-semibold border border-amber-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>Terlambat
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 text-xs font-semibold border border-emerald-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Hadir
                                            </span>
                                        @endif
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-slate-100 text-slate-500 text-xs font-semibold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>Belum Absen
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center">
                                            <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-slate-500 font-medium">Belum ada data pemagang</p>
                                        <p class="text-slate-400 text-xs">Data pemagang akan muncul di sini</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($daftarPemagang->hasPages())
                <div class="px-6 py-4 border-t border-slate-100">
                    {{ $daftarPemagang->links() }}
                </div>
                @endif
            </div>

        </main>

        <!-- Footer -->
        <footer class="text-center py-4 text-slate-400 text-xs border-t border-slate-200 mt-auto">
            © {{ date('Y') }} SIMWEB – Kementerian Hukum Provinsi Jambi
        </footer>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        function closeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
    </script>

</body>
</html>
