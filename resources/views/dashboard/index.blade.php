@extends("dashboard.layouts.main")

@section("container")
<div class="space-y-6">

    {{-- ===== WELCOME HEADER ===== --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-100 dark:border-slate-700">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>
                <h1 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">
                    Selamat datang, <span class="text-sky-600 dark:text-sky-400">{{ Auth::guard('pemagang')->user()->nama_lengkap }}</span> 👋
                </h1>
                <p class="text-sm text-slate-500 mt-1">Berikut ringkasan aktivitas presensi Anda hari ini.</p>
            </div>
            <a href="{{ route('pemagang.presensi') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-sky-500 to-indigo-600 hover:from-sky-400 hover:to-indigo-500 text-white text-sm font-semibold rounded-xl shadow-md shadow-sky-500/20 transition-all hover:-translate-y-0.5 whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Presensi Sekarang
            </a>
        </div>
    </div>

    {{-- ===== ROW 1: JAM KERJA + PRESENSI HARI INI ===== --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- Jam Masuk Kerja --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-sky-100 dark:bg-sky-900/40 flex items-center justify-center">
                    <svg class="w-5 h-5 text-sky-600 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-sky-600 bg-sky-50 dark:bg-sky-900/30 dark:text-sky-400 px-2 py-1 rounded-lg">Masuk</span>
            </div>
            <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold mb-1">Jam Masuk Kerja</p>
            <p class="text-xl font-bold text-slate-900 dark:text-white">08:00 <span class="text-sm font-medium text-slate-400">WIB</span></p>
        </div>

        {{-- Jam Pulang Kerja --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-orange-100 dark:bg-orange-900/40 flex items-center justify-center">
                    <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </div>
                <span class="text-xs font-semibold text-orange-600 bg-orange-50 dark:bg-orange-900/30 dark:text-orange-400 px-2 py-1 rounded-lg">Pulang</span>
            </div>
            <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold mb-1">Jam Pulang Kerja</p>
            <p class="text-xl font-bold text-slate-900 dark:text-white">16:00 <span class="text-sm font-medium text-slate-400">WIB</span></p>
        </div>

        {{-- Masuk Kerja Hari Ini --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                @if($presensiHariIni != null)
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                @endif
            </div>
            <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold mb-1">Masuk Hari Ini</p>
            <p class="text-xl font-bold text-slate-900 dark:text-white">
                {{ $presensiHariIni != null ? date('H:i', strtotime($presensiHariIni->jam_masuk)) : '--:--' }}
                @if($presensiHariIni != null)<span class="text-sm font-medium text-slate-400">WIB</span>@endif
            </p>
            @if($presensiHariIni != null)
                @if(date('H:i:s', strtotime($presensiHariIni->jam_masuk)) < date_create('08:00:00')->format('H:i:s'))
                    <p class="text-xs font-semibold text-emerald-500 mt-1">✓ Tepat Waktu</p>
                @else
                    <p class="text-xs font-semibold text-red-500 mt-1">⚠ Terlambat</p>
                @endif
            @else
                <p class="text-xs text-slate-400 mt-1">Belum presensi</p>
            @endif
        </div>

        {{-- Pulang Kerja Hari Ini --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold mb-1">Pulang Hari Ini</p>
            <p class="text-xl font-bold text-slate-900 dark:text-white">
                {{ ($presensiHariIni != null && $presensiHariIni->jam_keluar != null) ? date('H:i', strtotime($presensiHariIni->jam_keluar)) : '--:--' }}
                @if($presensiHariIni != null && $presensiHariIni->jam_keluar != null)<span class="text-sm font-medium text-slate-400">WIB</span>@endif
            </p>
            @if($presensiHariIni != null && $presensiHariIni->jam_keluar != null)
                @if(date('H:i:s', strtotime($presensiHariIni->jam_keluar)) >= date_create('16:00:00')->format('H:i:s'))
                    <p class="text-xs font-semibold text-emerald-500 mt-1">✓ Sesuai Jadwal</p>
                @else
                    <p class="text-xs font-semibold text-amber-500 mt-1">⚠ Pulang Lebih Awal</p>
                @endif
            @else
                <p class="text-xs text-slate-400 mt-1">Belum presensi pulang</p>
            @endif
        </div>
    </div>

    {{-- ===== ROW 2: REKAP BULAN INI ===== --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700">
        <div class="flex items-center justify-between px-6 pt-5 pb-4 border-b border-slate-100 dark:border-slate-700">
            <div>
                <h2 class="text-base font-bold text-slate-900 dark:text-white">Rekap Bulan <span class="text-sky-600">{{ date('F Y') }}</span></h2>
                <p class="text-xs text-slate-400 mt-0.5">Ringkasan kehadiran Anda bulan ini</p>
            </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 p-6">
            {{-- Hadir --}}
            <div class="flex items-center gap-4 p-4 bg-sky-50 dark:bg-sky-900/20 rounded-xl border border-sky-100 dark:border-sky-800/30">
                <div class="w-12 h-12 rounded-xl bg-sky-500 flex items-center justify-center flex-shrink-0 shadow-md shadow-sky-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-sky-700 dark:text-sky-300">{{ $rekapPresensi->jml_kehadiran }}</p>
                    <p class="text-xs font-semibold text-sky-600 dark:text-sky-400 uppercase tracking-wide">Hadir</p>
                </div>
            </div>

            {{-- Sakit --}}
            <div class="flex items-center gap-4 p-4 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl border border-emerald-100 dark:border-emerald-800/30">
                <div class="w-12 h-12 rounded-xl bg-emerald-500 flex items-center justify-center flex-shrink-0 shadow-md shadow-emerald-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-emerald-700 dark:text-emerald-300">{{ $rekapPengajuanPresensi->jml_sakit }}</p>
                    <p class="text-xs font-semibold text-emerald-600 dark:text-emerald-400 uppercase tracking-wide">Sakit</p>
                </div>
            </div>

            {{-- Izin --}}
            <div class="flex items-center gap-4 p-4 bg-amber-50 dark:bg-amber-900/20 rounded-xl border border-amber-100 dark:border-amber-800/30">
                <div class="w-12 h-12 rounded-xl bg-amber-500 flex items-center justify-center flex-shrink-0 shadow-md shadow-amber-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-amber-700 dark:text-amber-300">{{ $rekapPengajuanPresensi->jml_izin }}</p>
                    <p class="text-xs font-semibold text-amber-600 dark:text-amber-400 uppercase tracking-wide">Izin</p>
                </div>
            </div>

            {{-- Terlambat --}}
            <div class="flex items-center gap-4 p-4 bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-100 dark:border-red-800/30">
                <div class="w-12 h-12 rounded-xl bg-red-500 flex items-center justify-center flex-shrink-0 shadow-md shadow-red-500/30">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-red-700 dark:text-red-300">{{ $rekapPresensi->jml_terlambat ?? 0 }}</p>
                    <p class="text-xs font-semibold text-red-600 dark:text-red-400 uppercase tracking-wide">Terlambat</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== ROW 3: TABEL RIWAYAT + LEADERBOARD ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Riwayat Presensi --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-bold text-slate-900 dark:text-white">Riwayat Presensi</h2>
                    <p class="text-xs text-slate-400">Bulan {{ date('F Y') }}</p>
                </div>
                <a href="{{ route('pemagang.history') }}" class="text-xs font-semibold text-sky-600 hover:text-sky-700 dark:text-sky-400 hover:underline">Lihat semua →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50">
                            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">#</th>
                            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Masuk</th>
                            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Pulang</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($riwayatPresensi as $value => $item)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-4 py-3 font-bold text-slate-400 text-xs">{{ $riwayatPresensi->firstItem() + $value }}</td>
                                <td class="px-4 py-3">
                                    <p class="font-semibold text-slate-800 dark:text-white text-xs">{{ date('d M Y', strtotime($item->tanggal_presensi)) }}</p>
                                    <p class="text-slate-400 text-xs">{{ date('l', strtotime($item->tanggal_presensi)) }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold {{ $item->jam_masuk < '08:00' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400' : 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400' }}">
                                        {{ date('H:i', strtotime($item->jam_masuk)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if($item->jam_keluar != null)
                                        <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold {{ $item->jam_keluar > '16:00' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-400' }}">
                                            {{ date('H:i', strtotime($item->jam_keluar)) }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">–</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-slate-400 text-sm">Belum ada data presensi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($riwayatPresensi->hasPages())
                <div class="px-6 py-3 border-t border-slate-100 dark:border-slate-700">
                    {{ $riwayatPresensi->links() }}
                </div>
            @endif
        </div>

        {{-- Leaderboard --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 dark:border-slate-700">
                <h2 class="text-sm font-bold text-slate-900 dark:text-white">Leaderboard Hari Ini</h2>
                <p class="text-xs text-slate-400">{{ date('d F Y') }} – Siapa yang paling awal?</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-900/50">
                            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">#</th>
                            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama</th>
                            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Masuk</th>
                            <th class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Pulang</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($leaderboard as $value => $item)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-4 py-3">
                                    @if($leaderboard->firstItem() + $value == 1)
                                        <span class="text-lg">🥇</span>
                                    @elseif($leaderboard->firstItem() + $value == 2)
                                        <span class="text-lg">🥈</span>
                                    @elseif($leaderboard->firstItem() + $value == 3)
                                        <span class="text-lg">🥉</span>
                                    @else
                                        <span class="text-xs font-bold text-slate-400">{{ $leaderboard->firstItem() + $value }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-sky-400 to-indigo-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                            {{ strtoupper(substr($item->nama_lengkap, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-800 dark:text-white text-xs">{{ $item->nama_lengkap }}</p>
                                            <p class="text-slate-400 text-xs">{{ $item->jabatan }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold {{ $item->jam_masuk < '08:00' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400' : 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400' }}">
                                        {{ date('H:i', strtotime($item->jam_masuk)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    @if($item->jam_keluar != null)
                                        <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-semibold {{ $item->jam_keluar > '16:00' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400' : 'bg-amber-100 text-amber-700 dark:bg-amber-900/40 dark:text-amber-400' }}">
                                            {{ date('H:i', strtotime($item->jam_keluar)) }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">–</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-slate-400 text-sm">Belum ada pemagang yang presensi hari ini</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($leaderboard->hasPages())
                <div class="px-6 py-3 border-t border-slate-100 dark:border-slate-700">
                    {{ $leaderboard->links() }}
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
