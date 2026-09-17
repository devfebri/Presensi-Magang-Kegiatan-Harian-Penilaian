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
                <span class="text-white font-medium">Tambah</span>
            </div>
            <h2 class="font-outfit text-2xl font-bold text-white">Tambah Logbook Kegiatan</h2>
            <p class="text-sm text-white/70 mt-0.5">Catat kegiatan yang Anda lakukan hari ini</p>
        </div>

        <div class="dark:bg-slate-850 dark:shadow-dark-xl relative flex min-w-0 flex-col break-words rounded-2xl bg-white bg-clip-border shadow-xl">
            <div class="p-6 md:p-8">

                {{-- Sudah isi hari ini --}}
                @if($sudahIsi)
                <div class="mb-6 flex items-center gap-3 rounded-xl bg-amber-50 border border-amber-200 px-4 py-3 text-amber-700 text-sm dark:bg-amber-900/30 dark:border-amber-700 dark:text-amber-300">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Anda sudah mengisi logbook untuk hari ini. Anda tetap bisa mengisi untuk tanggal lain.</span>
                </div>
                @endif

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

                <form action="{{ route('pemagang.logbook.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                            value="{{ old('tanggal', date('Y-m-d')) }}"
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
                            placeholder="Tuliskan kegiatan yang Anda lakukan hari ini secara detail..."
                            required
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-sky-500/30 focus:border-sky-500 transition-all resize-none
                                   @error('kegiatann_hari_ini') border-red-400 dark:border-red-500 @enderror"
                        >{{ old('kegiatann_hari_ini') }}</textarea>
                        <div class="flex justify-between items-center mt-1.5">
                            @error('kegiatann_hari_ini')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @else
                                <p class="text-xs text-slate-400">Minimal 10 karakter</p>
                            @enderror
                            <p class="text-xs text-slate-400" id="charCount">0 karakter</p>
                        </div>
                    </div>

                    {{-- Upload Foto --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            Foto Dokumentasi <span class="text-slate-400 font-normal">(opsional)</span>
                        </label>

                        {{-- Drop Zone --}}
                        <div id="dropZone"
                             class="relative border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-2xl p-6 text-center cursor-pointer transition-all hover:border-sky-400 hover:bg-sky-50/50 dark:hover:bg-sky-900/10 @error('foto') border-red-400 @enderror"
                             onclick="document.getElementById('foto').click()">

                            {{-- Icon + teks (tampil saat belum ada foto) --}}
                            <div id="dropPlaceholder">
                                <div class="w-14 h-14 rounded-2xl bg-sky-50 dark:bg-sky-900/30 flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-7 h-7 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-slate-600 dark:text-slate-300">Klik atau seret foto ke sini</p>
                                <p class="text-xs text-slate-400 mt-1">JPG, JPEG, PNG, WEBP — Maks. 5 MB</p>
                            </div>

                            {{-- Preview gambar (tampil setelah pilih) --}}
                            <div id="previewWrapper" class="hidden">
                                <img id="previewImg" src="#" alt="Preview"
                                     class="mx-auto max-h-64 rounded-xl object-contain shadow-md"/>
                                <p id="previewName" class="mt-2 text-xs text-slate-500 truncate"></p>
                                <button type="button" onclick="hapusPreview(event)"
                                        class="mt-3 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-red-50 text-red-600 text-xs font-semibold hover:bg-red-100 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Hapus Pilihan
                                </button>
                            </div>
                        </div>

                        <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="tampilkanPreview(this)"/>
                        @error('foto')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center gap-3 pt-2">
                        <button type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-sky-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-sky-500 transition-all shadow-md shadow-sky-500/20 hover:shadow-sky-500/30 hover:-translate-y-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Logbook
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
    // ── Character counter ──────────────────────────────────────────────────────
    const textarea = document.getElementById('kegiatann_hari_ini');
    const counter  = document.getElementById('charCount');

    function updateCounter() {
        counter.textContent = textarea.value.length + ' karakter';
        counter.className = 'text-xs ' + (textarea.value.length < 10 ? 'text-red-400' : 'text-emerald-500');
    }
    textarea.addEventListener('input', updateCounter);
    updateCounter();

    // ── Foto preview ──────────────────────────────────────────────────────────
    function tampilkanPreview(input) {
        if (!input.files || !input.files[0]) return;
        const file   = input.files[0];
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('previewName').textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
            document.getElementById('dropPlaceholder').classList.add('hidden');
            document.getElementById('previewWrapper').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    function hapusPreview(e) {
        e.stopPropagation();
        document.getElementById('foto').value = '';
        document.getElementById('previewImg').src = '#';
        document.getElementById('dropPlaceholder').classList.remove('hidden');
        document.getElementById('previewWrapper').classList.add('hidden');
    }

    // Drag & drop
    const dropZone = document.getElementById('dropZone');
    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('border-sky-400','bg-sky-50/50'); });
    dropZone.addEventListener('dragleave', () => { dropZone.classList.remove('border-sky-400','bg-sky-50/50'); });
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('border-sky-400','bg-sky-50/50');
        const dt   = e.dataTransfer;
        const file = dt.files[0];
        if (!file || !file.type.startsWith('image/')) return;
        const input  = document.getElementById('foto');
        const dT     = new DataTransfer();
        dT.items.add(file);
        input.files  = dT.files;
        tampilkanPreview(input);
    });
</script>
@endsection
