@extends('pembimbing.layouts.app')

@section('content')
<div class="animate-slide-up">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-slate-400 mb-4">
        <a href="{{ route('pembimbing.logbook') }}" class="hover:text-purple-600 transition-colors flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
            </svg>
            Logbook Pemagang
        </a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-slate-700 font-medium">{{ $pemagang->nama_lengkap }}</span>
    </div>

    {{-- Alert success --}}
    @if(session('success'))
    <div class="mb-5 flex items-center gap-3 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-emerald-700 text-sm">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Profile Card --}}
    <div class="bg-gradient-to-r from-purple-700 via-purple-600 to-indigo-600 rounded-2xl p-6 mb-6 shadow-xl overflow-hidden relative">
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full translate-x-1/3 -translate-y-1/3 pointer-events-none"></div>
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center gap-4">
            <div class="w-16 h-16 rounded-2xl bg-white/20 border border-white/30 flex items-center justify-center flex-shrink-0 shadow-lg">
                <span class="text-white font-outfit font-bold text-2xl">{{ strtoupper(substr($pemagang->nama_lengkap, 0, 1)) }}</span>
            </div>
            <div class="flex-1">
                <p class="text-purple-200 text-xs font-semibold uppercase tracking-wide mb-0.5">Pemagang</p>
                <h2 class="font-outfit font-bold text-white text-xl">{{ $pemagang->nama_lengkap }}</h2>
                <div class="flex flex-wrap gap-3 mt-2">
                    <span class="text-purple-200 text-xs flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1"/></svg>
                        NIK: {{ $pemagang->nik }}
                    </span>
                    @if($pemagang->jabatan)
                    <span class="text-purple-200 text-xs flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01"/></svg>
                        {{ $pemagang->jabatan }}
                    </span>
                    @endif
                </div>
            </div>
            <div class="text-center bg-white/15 border border-white/20 rounded-xl px-5 py-3 flex-shrink-0">
                <p class="text-3xl font-outfit font-bold text-white">{{ $totalLogbook }}</p>
                <p class="text-purple-200 text-xs mt-0.5">Total Logbook</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">

        {{-- Form Penilaian --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden sticky top-24">
                {{-- Header --}}
                <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-purple-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-outfit font-semibold text-slate-900 text-sm">Penilaian Logbook</h3>
                        <p class="text-slate-400 text-xs">Nilai keseluruhan logbook pemagang</p>
                    </div>
                </div>

                {{-- Existing nilai badge --}}
                @if($penilaian)
                <div class="mx-5 mt-4 flex items-center justify-between px-4 py-3 rounded-xl
                    @if($penilaian->nilai >= 90) bg-emerald-50 border border-emerald-200
                    @elseif($penilaian->nilai >= 80) bg-blue-50 border border-blue-200
                    @elseif($penilaian->nilai >= 70) bg-amber-50 border border-amber-200
                    @elseif($penilaian->nilai >= 60) bg-orange-50 border border-orange-200
                    @else bg-red-50 border border-red-200 @endif">
                    <div>
                        <p class="text-xs text-slate-500 mb-0.5">Nilai Saat Ini</p>
                        <p class="font-outfit font-bold text-2xl
                            @if($penilaian->nilai >= 90) text-emerald-600
                            @elseif($penilaian->nilai >= 80) text-blue-600
                            @elseif($penilaian->nilai >= 70) text-amber-600
                            @elseif($penilaian->nilai >= 60) text-orange-600
                            @else text-red-600 @endif">
                            {{ $penilaian->nilai }}
                        </p>
                        <p class="text-xs font-semibold
                            @if($penilaian->nilai >= 90) text-emerald-600
                            @elseif($penilaian->nilai >= 80) text-blue-600
                            @elseif($penilaian->nilai >= 70) text-amber-600
                            @elseif($penilaian->nilai >= 60) text-orange-600
                            @else text-red-600 @endif">
                            {{ $penilaian->predikat }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-slate-400">Diperbarui</p>
                        <p class="text-xs font-medium text-slate-600">{{ $penilaian->updated_at->isoFormat('D MMM Y') }}</p>
                    </div>
                </div>
                @endif

                <form action="{{ route('pembimbing.logbook.nilai', $pemagang->nik) }}" method="POST" class="p-5 space-y-4">
                    @csrf

                    {{-- Validation errors --}}
                    @if($errors->any())
                    <div class="rounded-lg bg-red-50 border border-red-200 px-3 py-2">
                        @foreach($errors->all() as $err)
                            <p class="text-xs text-red-600">• {{ $err }}</p>
                        @endforeach
                    </div>
                    @endif

                    {{-- Slider nilai --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-3">
                            Nilai (0 – 100) <span class="text-red-500">*</span>
                        </label>
                        <div class="flex items-center gap-3">
                            <input
                                type="range"
                                id="nilaiSlider"
                                name="nilai"
                                min="0" max="100" step="1"
                                value="{{ old('nilai', $penilaian->nilai ?? 75) }}"
                                class="flex-1 h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-purple-600"
                                oninput="updateNilai(this.value)"
                            />
                            <div class="w-14 h-10 flex items-center justify-center rounded-xl bg-purple-50 border border-purple-200">
                                <span id="nilaiDisplay" class="font-outfit font-bold text-purple-700 text-lg">
                                    {{ old('nilai', $penilaian->nilai ?? 75) }}
                                </span>
                            </div>
                        </div>

                        {{-- Predikat indikator --}}
                        <div id="predikatBadge" class="mt-2.5 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold"></div>
                    </div>

                    {{-- Catatan --}}
                    <div>
                        <label for="catatan" class="block text-sm font-semibold text-slate-700 mb-2">
                            Catatan / Feedback <span class="text-slate-400 font-normal">(opsional)</span>
                        </label>
                        <textarea
                            id="catatan"
                            name="catatan"
                            rows="4"
                            placeholder="Tuliskan feedback atau komentar untuk pemagang..."
                            class="w-full px-3 py-2.5 rounded-xl border border-slate-200 text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500/30 focus:border-purple-500 resize-none transition-all"
                        >{{ old('catatan', $penilaian->catatan ?? '') }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 rounded-xl bg-purple-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-purple-500 transition-all shadow-md shadow-purple-500/20 hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ $penilaian ? 'Perbarui Nilai' : 'Simpan Nilai' }}
                    </button>
                </form>

                {{-- Panduan nilai --}}
                <div class="px-5 pb-5">
                    <p class="text-xs font-semibold text-slate-500 mb-2">Panduan Predikat</p>
                    <div class="space-y-1 text-xs">
                        <div class="flex items-center justify-between"><span class="text-emerald-600 font-semibold">A – Sangat Baik</span><span class="text-slate-400">90 – 100</span></div>
                        <div class="flex items-center justify-between"><span class="text-blue-600 font-semibold">B – Baik</span><span class="text-slate-400">80 – 89</span></div>
                        <div class="flex items-center justify-between"><span class="text-amber-600 font-semibold">C – Cukup</span><span class="text-slate-400">70 – 79</span></div>
                        <div class="flex items-center justify-between"><span class="text-orange-600 font-semibold">D – Kurang</span><span class="text-slate-400">60 – 69</span></div>
                        <div class="flex items-center justify-between"><span class="text-red-600 font-semibold">E – Sangat Kurang</span><span class="text-slate-400">0 – 59</span></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Logbook List --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="font-outfit font-semibold text-slate-900">Riwayat Logbook</h3>
                    <span class="text-xs text-slate-400">Diurutkan terbaru</span>
                </div>

                @if($logbooks->isEmpty())
                    <div class="flex flex-col items-center justify-center py-16 text-center">
                        <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                            </svg>
                        </div>
                        <p class="text-slate-600 font-semibold">Belum ada logbook</p>
                        <p class="text-slate-400 text-sm mt-1">Pemagang ini belum mengisi logbook kegiatan</p>
                    </div>
                @else
                    <div class="divide-y divide-slate-50">
                        @foreach($logbooks as $index => $lb)
                        <div class="px-6 py-5 hover:bg-slate-50/60 transition-colors">
                            <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                                <div class="flex-shrink-0 sm:w-20 sm:text-center">
                                    <span class="inline-flex w-7 h-7 rounded-full bg-purple-100 text-purple-600 text-xs font-bold items-center justify-center">
                                        {{ $logbooks->firstItem() + $index }}
                                    </span>
                                    <div class="mt-1 hidden sm:block">
                                        <p class="text-sm font-bold text-slate-900">{{ \Carbon\Carbon::parse($lb->tanggal)->format('d') }}</p>
                                        <p class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($lb->tanggal)->isoFormat('MMM Y') }}</p>
                                        <p class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($lb->tanggal)->isoFormat('ddd') }}</p>
                                    </div>
                                </div>
                                <div class="hidden sm:block w-px bg-purple-100 self-stretch flex-shrink-0"></div>
                                <div class="flex-1 min-w-0">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-purple-50 text-purple-600 text-xs font-semibold mb-2">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ \Carbon\Carbon::parse($lb->tanggal)->isoFormat('dddd, D MMMM Y') }}
                                    </span>
                                    <p class="text-slate-700 text-sm leading-relaxed whitespace-pre-line">{{ $lb->kegiatann_hari_ini }}</p>
                                    <p class="text-slate-400 text-xs mt-2">Dicatat: {{ $lb->created_at->isoFormat('D MMM Y, HH:mm') }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if($logbooks->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100">
                        {{ $logbooks->links() }}
                    </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script>
    const predikatData = {
        90: { label: 'A – Sangat Baik', color: 'bg-emerald-100 text-emerald-700' },
        80: { label: 'B – Baik',        color: 'bg-blue-100 text-blue-700' },
        70: { label: 'C – Cukup',       color: 'bg-amber-100 text-amber-700' },
        60: { label: 'D – Kurang',      color: 'bg-orange-100 text-orange-700' },
        0:  { label: 'E – Sangat Kurang', color: 'bg-red-100 text-red-700' },
    };

    function getPredikat(nilai) {
        if (nilai >= 90) return predikatData[90];
        if (nilai >= 80) return predikatData[80];
        if (nilai >= 70) return predikatData[70];
        if (nilai >= 60) return predikatData[60];
        return predikatData[0];
    }

    function updateNilai(val) {
        document.getElementById('nilaiDisplay').textContent = val;
        const p = getPredikat(parseInt(val));
        const badge = document.getElementById('predikatBadge');
        badge.textContent = p.label;
        badge.className = 'mt-2.5 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold ' + p.color;
    }

    // Init on load
    updateNilai(document.getElementById('nilaiSlider').value);
</script>
@endsection
