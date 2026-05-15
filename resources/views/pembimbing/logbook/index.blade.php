@extends('pembimbing.layouts.app')

@section('content')
<div class="animate-slide-up">

    {{-- Header --}}
    <div class="mb-6">
        <h2 class="font-outfit text-2xl font-bold text-slate-900">Logbook Pemagang</h2>
        <p class="text-slate-500 text-sm mt-1">
            Pilih pemagang untuk melihat logbook kegiatan mereka
            @if($namaInstansi)
                &mdash; <span class="text-purple-600 font-semibold">{{ $namaInstansi }}</span>
            @endif
        </p>
    </div>

    {{-- Grid Pemagang --}}
    @if($daftarPemagang->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <div class="w-16 h-16 rounded-full bg-purple-50 flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <p class="text-slate-600 font-semibold">Belum ada pemagang</p>
            <p class="text-slate-400 text-sm mt-1">Belum ada pemagang yang terdaftar di instansi Anda</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($daftarPemagang as $p)
            <a href="{{ route('pembimbing.logbook.pemagang', $p->nik) }}"
               class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg hover:border-purple-200 transition-all duration-200 hover:-translate-y-1 p-5 flex flex-col">

                {{-- Avatar --}}
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-purple-500 to-indigo-500 flex items-center justify-center flex-shrink-0 shadow-md shadow-purple-200 group-hover:shadow-purple-300 transition-shadow">
                        <span class="text-white font-outfit font-bold text-lg leading-none">
                            {{ strtoupper(substr($p->nama_lengkap, 0, 1)) }}
                        </span>
                    </div>
                    <div class="overflow-hidden">
                        <p class="font-semibold text-slate-900 text-sm truncate group-hover:text-purple-700 transition-colors">
                            {{ $p->nama_lengkap }}
                        </p>
                        <p class="text-xs text-slate-400 truncate">{{ $p->nik }}</p>
                    </div>
                </div>

                {{-- Jabatan --}}
                @if($p->jabatan)
                <p class="text-xs text-slate-500 mb-3 line-clamp-1">{{ $p->jabatan }}</p>
                @endif

                {{-- Stats --}}
                <div class="mt-auto pt-3 border-t border-slate-50 flex items-center justify-between">
                    <div class="flex items-center gap-1.5">
                        <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-900">{{ $p->logbooks_count }}</p>
                            <p class="text-xs text-slate-400 leading-tight">Logbook</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-1 text-purple-500 group-hover:gap-2 transition-all">
                        <span class="text-xs font-semibold">Lihat</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        {{-- Summary --}}
        <p class="text-slate-400 text-xs text-center mt-6">
            Total <strong class="text-slate-600">{{ $daftarPemagang->count() }}</strong> pemagang terdaftar
        </p>
    @endif

</div>
@endsection
