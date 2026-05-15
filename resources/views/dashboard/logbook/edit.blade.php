@extends("dashboard.layouts.main")

@section("container")
<div class="-mx-3 flex flex-wrap">
    <div class="mb-6 w-full px-3">

        {{-- Header --}}
        <div class="mb-6">
            <div class="flex items-center gap-2 text-white/60 text-sm mb-2">
                <a href="{{ route('pemagang.logbook') }}" class="hover:text-white transition-colors">Logbook</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white font-medium">Edit</span>
            </div>
            <h2 class="font-outfit text-2xl font-bold text-white">Edit Logbook Kegiatan</h2>
            <p class="text-sm text-white/70 mt-0.5">
                Perbarui catatan kegiatan —
                <span class="text-white font-medium">{{ \Carbon\Carbon::parse($logbook->tanggal)->isoFormat('dddd, D MMMM Y') }}</span>
            </p>
        </div>

        <div class="dark:bg-slate-850 dark:shadow-dark-xl relative flex min-w-0 flex-col break-words rounded-2xl bg-white bg-clip-border shadow-xl">
            <div class="p-6 md:p-8">

                {{-- Validation Errors --}}
                @if($errors->any())
                <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 dark:bg-red-900/30 dark:border-red-700">
                    <p class="text-sm font-semibold text-red-700 dark:text-red-300 mb-1">Terdapat kesalahan input:</p>
                    <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400 space-y-1">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('pemagang.logbook.update', $logbook->id) }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Tanggal --}}
                    <div>
                        <label for="tanggal" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="date"
                            id="tanggal"
                            name="tanggal"
                            value="{{ old('tanggal', \Carbon\Carbon::parse($logbook->tanggal)->format('Y-m-d')) }}"
                            max="{{ date('Y-m-d') }}"
                            required
                            class="w-full sm:max-w-xs px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition-all
                                   @error('tanggal') border-red-400 dark:border-red-500 @enderror"
                        />
                        @error('tanggal')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kegiatan --}}
                    <div>
                        <label for="kegiatann_hari_ini" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            Kegiatan Hari Ini <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="kegiatann_hari_ini"
                            name="kegiatann_hari_ini"
                            rows="6"
                            placeholder="Tuliskan kegiatan yang Anda lakukan..."
                            required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition-all resize-none
                                   @error('kegiatann_hari_ini') border-red-400 dark:border-red-500 @enderror"
                        >{{ old('kegiatann_hari_ini', $logbook->kegiatann_hari_ini) }}</textarea>
                        <div class="flex justify-between items-center mt-1.5">
                            @error('kegiatann_hari_ini')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @else
                                <p class="text-xs text-slate-400">Minimal 10 karakter</p>
                            @enderror
                            <p class="text-xs text-slate-400" id="charCount">0 karakter</p>
                        </div>
                    </div>

                    {{-- Info timestamps --}}
                    <div class="rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700 px-4 py-3 flex flex-wrap gap-4 text-xs text-slate-400 dark:text-slate-500">
                        <span>
                            <span class="font-semibold text-slate-500 dark:text-slate-400">Dibuat:</span>
                            {{ $logbook->created_at->isoFormat('D MMM Y, HH:mm') }}
                        </span>
                        <span>
                            <span class="font-semibold text-slate-500 dark:text-slate-400">Diperbarui:</span>
                            {{ $logbook->updated_at->isoFormat('D MMM Y, HH:mm') }}
                        </span>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-sky-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-sky-500 transition-all shadow-md shadow-sky-500/20 hover:shadow-sky-500/30 hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Perbarui Logbook
                        </button>
                        <a href="{{ route('pemagang.logbook') }}"
                           class="inline-flex items-center gap-2 rounded-xl border border-slate-200 dark:border-slate-600 px-6 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section("js")
<script>
    const textarea = document.getElementById('kegiatann_hari_ini');
    const counter  = document.getElementById('charCount');

    function updateCounter() {
        counter.textContent = textarea.value.length + ' karakter';
        counter.className = 'text-xs ' + (textarea.value.length < 10 ? 'text-red-400' : 'text-emerald-500');
    }

    textarea.addEventListener('input', updateCounter);
    updateCounter();
</script>
@endsection
