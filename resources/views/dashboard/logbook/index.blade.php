@extends("dashboard.layouts.main")

@section("container")
<div class="-mx-3 flex flex-wrap">
    <div class="mb-6 w-full px-3">

        {{-- Header --}}
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-outfit text-2xl font-bold text-white dark:text-white">Logbook Kegiatan</h2>
                <p class="text-sm text-white/70 mt-0.5">Catatan kegiatan harian Anda selama magang</p>
            </div>
            <a href="{{ route('pemagang.logbook.tambah') }}"
               class="inline-flex items-center gap-2 rounded-xl bg-white px-5 py-2.5 text-sm font-semibold text-sky-700 shadow-md hover:bg-sky-50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Logbook
            </a>
        </div>

        {{-- Alert --}}
        @if(session('success'))
        <div class="mb-4 flex items-center gap-3 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-emerald-700 text-sm dark:bg-emerald-900/30 dark:border-emerald-700 dark:text-emerald-300">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        {{-- ===== NILAI DARI PEMBIMBING ===== --}}
        @if($penilaian->isNotEmpty())
        <div class="mb-6">
            <h3 class="text-white font-semibold text-sm mb-3 flex items-center gap-2">
                <svg class="w-4 h-4 text-yellow-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                Penilaian dari Pembimbing
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($penilaian as $p)
                @php
                    $nilai = $p->nilai;
                    if ($nilai >= 90)      { $color = 'emerald'; $predikat = 'A – Sangat Baik'; }
                    elseif ($nilai >= 80)  { $color = 'blue';    $predikat = 'B – Baik'; }
                    elseif ($nilai >= 70)  { $color = 'amber';   $predikat = 'C – Cukup'; }
                    elseif ($nilai >= 60)  { $color = 'orange';  $predikat = 'D – Kurang'; }
                    else                   { $color = 'red';     $predikat = 'E – Sangat Kurang'; }
                @endphp
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 p-5 relative overflow-hidden">
                    {{-- Decorative bg circle --}}
                    <div class="absolute -top-4 -right-4 w-20 h-20 rounded-full opacity-10
                        @if($color=='emerald') bg-emerald-500
                        @elseif($color=='blue') bg-blue-500
                        @elseif($color=='amber') bg-amber-500
                        @elseif($color=='orange') bg-orange-500
                        @else bg-red-500 @endif">
                    </div>

                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-xs text-slate-400 dark:text-slate-500 mb-0.5">Dinilai oleh</p>
                            <p class="font-semibold text-slate-800 dark:text-slate-200 text-sm truncate">
                                {{ $p->pembimbing->nama_lengkap ?? 'Pembimbing' }}
                            </p>
                            @if($p->pembimbing && $p->pembimbing->jabatan)
                            <p class="text-xs text-slate-400 truncate">{{ $p->pembimbing->jabatan }}</p>
                            @endif
                        </div>
                        {{-- Nilai circle --}}
                        <div class="w-16 h-16 rounded-2xl flex flex-col items-center justify-center flex-shrink-0 ml-3
                            @if($color=='emerald') bg-emerald-50 dark:bg-emerald-900/30
                            @elseif($color=='blue') bg-blue-50 dark:bg-blue-900/30
                            @elseif($color=='amber') bg-amber-50 dark:bg-amber-900/30
                            @elseif($color=='orange') bg-orange-50 dark:bg-orange-900/30
                            @else bg-red-50 dark:bg-red-900/30 @endif">
                            <span class="font-outfit font-black text-2xl leading-none
                                @if($color=='emerald') text-emerald-600 dark:text-emerald-400
                                @elseif($color=='blue') text-blue-600 dark:text-blue-400
                                @elseif($color=='amber') text-amber-600 dark:text-amber-400
                                @elseif($color=='orange') text-orange-600 dark:text-orange-400
                                @else text-red-600 dark:text-red-400 @endif">
                                {{ $nilai }}
                            </span>
                            <span class="text-xs font-bold
                                @if($color=='emerald') text-emerald-500
                                @elseif($color=='blue') text-blue-500
                                @elseif($color=='amber') text-amber-500
                                @elseif($color=='orange') text-orange-500
                                @else text-red-500 @endif">/100</span>
                        </div>
                    </div>

                    {{-- Predikat --}}
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-semibold
                        @if($color=='emerald') bg-emerald-50 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400
                        @elseif($color=='blue') bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400
                        @elseif($color=='amber') bg-amber-50 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400
                        @elseif($color=='orange') bg-orange-50 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400
                        @else bg-red-50 text-red-700 dark:bg-red-900/30 dark:text-red-400 @endif mb-3">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        {{ $predikat }}
                    </span>

                    {{-- Progress bar --}}
                    <div class="w-full h-1.5 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden mb-3">
                        <div class="h-full rounded-full transition-all duration-700
                            @if($color=='emerald') bg-emerald-500
                            @elseif($color=='blue') bg-blue-500
                            @elseif($color=='amber') bg-amber-500
                            @elseif($color=='orange') bg-orange-500
                            @else bg-red-500 @endif"
                            style="width: {{ $nilai }}%">
                        </div>
                    </div>

                    {{-- Catatan / Feedback --}}
                    @if($p->catatan)
                    <div class="rounded-xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-600 px-3 py-2.5 mb-3">
                        <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1">Catatan Pembimbing:</p>
                        <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed">{{ $p->catatan }}</p>
                    </div>
                    @endif

                    <p class="text-xs text-slate-400 dark:text-slate-500">
                        Dinilai: {{ $p->updated_at->isoFormat('D MMM Y, HH:mm') }}
                    </p>
                </div>
                @endforeach
            </div>
        </div>
        @else
        {{-- Belum ada penilaian --}}
        <div class="mb-6 flex items-center gap-3 rounded-xl bg-white/10 border border-white/20 px-4 py-3 text-white/80 text-sm">
            <svg class="w-5 h-5 flex-shrink-0 text-yellow-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
            </svg>
            <span>Logbook Anda belum dinilai oleh pembimbing. Terus semangat isi logbook ya!</span>
        </div>
        @endif

        {{-- ===== TABLE LOGBOOK ===== --}}
        <div class="dark:bg-slate-850 dark:shadow-dark-xl relative flex min-w-0 flex-col break-words rounded-2xl bg-white bg-clip-border shadow-xl">

            @if($logbooks->isEmpty())
            <div class="flex flex-col items-center justify-center py-16 px-6 text-center">
                <div class="w-16 h-16 rounded-full bg-sky-50 dark:bg-slate-700 flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <p class="text-slate-600 dark:text-slate-300 font-semibold text-base">Belum ada logbook</p>
                <p class="text-slate-400 dark:text-slate-500 text-sm mt-1 mb-4">Mulai catat kegiatan harian Anda</p>
                <a href="{{ route('pemagang.logbook.tambah') }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-sky-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-sky-500 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Logbook Pertama
                </a>
            </div>
            @else

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="border-b border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-800">
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">No</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Tanggal</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400">Kegiatan Hari Ini</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 dark:text-slate-400 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 dark:divide-slate-700">
                        @foreach($logbooks as $index => $lb)
                        <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-700/40 transition-colors">
                            <td class="px-6 py-4 text-slate-400 dark:text-slate-500">{{ $logbooks->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 rounded-lg bg-sky-50 dark:bg-sky-900/30 px-3 py-1 text-xs font-semibold text-sky-700 dark:text-sky-300">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($lb->tanggal)->isoFormat('dddd, D MMMM Y') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-700 dark:text-slate-300 max-w-sm">
                                <p class="line-clamp-2">{{ $lb->kegiatann_hari_ini }}</p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('pemagang.logbook.edit', $lb->id) }}"
                                       class="inline-flex items-center gap-1.5 rounded-lg bg-amber-50 dark:bg-amber-900/30 px-3 py-1.5 text-xs font-semibold text-amber-600 dark:text-amber-400 hover:bg-amber-100 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('pemagang.logbook.destroy', $lb->id) }}" method="POST" id="delete-form-{{ $lb->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="konfirmasiHapus({{ $lb->id }})"
                                            class="inline-flex items-center gap-1.5 rounded-lg bg-red-50 dark:bg-red-900/30 px-3 py-1.5 text-xs font-semibold text-red-600 dark:text-red-400 hover:bg-red-100 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($logbooks->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 dark:border-slate-700">
                {{ $logbooks->links() }}
            </div>
            @endif
            @endif
        </div>
    </div>
</div>
@endsection

@section("js")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function konfirmasiHapus(id) {
        Swal.fire({
            title: 'Hapus Logbook?',
            text: 'Data logbook ini akan dihapus permanen dan tidak bisa dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection
