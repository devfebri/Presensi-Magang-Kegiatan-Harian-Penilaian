<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gov-primary rounded-lg flex items-center justify-center text-white">
                    <i class="ri-calendar-schedule-line text-lg"></i>
                </div>
                <h2 class="text-2xl font-bold leading-tight text-gov-primary">
                    {{ __('Periode Magang') }}
                </h2>
            </div>
            <label class="gov-btn-primary cursor-pointer" for="create_modal">
                <i class="ri-add-line"></i>
                Tambah Periode
            </label>
        </div>
    </x-slot>

    <div class="space-y-6">
        {{-- Search Section --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            <form action="{{ route('admin.periode-magang') }}" method="get" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="gov-form-label">Cari Periode</label>
                        <input type="text" name="cari" placeholder="Nama periode..." class="gov-form-input"
                            value="{{ request()->cari }}" />
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="gov-btn-primary w-full">
                            <i class="ri-search-2-line"></i>
                            Cari
                        </button>
                        @if(request()->cari)
                            <a href="{{ route('admin.periode-magang') }}" class="gov-btn-secondary w-full text-center">
                                <i class="ri-refresh-line"></i>
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Table Section --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">#</th>
                        <th class="px-4 py-3 text-left font-semibold">Nama Periode</th>
                        <th class="px-4 py-3 text-left font-semibold">Tanggal Mulai</th>
                        <th class="px-4 py-3 text-left font-semibold">Tanggal Selesai</th>
                        <th class="px-4 py-3 text-left font-semibold">Keterangan</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                        <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($periode as $key => $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 font-semibold text-gray-700">{{ $periode->firstItem() + $key }}</td>
                            <td class="px-4 py-3 text-gray-800 font-medium">{{ $item->nama }}</td>
                            <td class="px-4 py-3 text-gray-700">
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-4 py-3 text-gray-700">
                                {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-4 py-3 text-gray-600 max-w-xs truncate">
                                {{ $item->keterangan ?? '-' }}
                            </td>
                            <td class="px-4 py-3">
                                @if($item->is_aktif)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex space-x-2">
                                    <button class="gov-btn-warning text-sm"
                                        onclick="edit_button('{{ $item->id }}')">
                                        <i class="ri-pencil-fill"></i>
                                        Edit
                                    </button>
                                    <button class="gov-btn-danger text-sm"
                                        onclick="delete_button('{{ $item->id }}', '{{ $item->nama }}')">
                                        <i class="ri-delete-bin-line"></i>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-10 text-center text-gray-400">
                                <i class="ri-calendar-close-line text-4xl block mb-2"></i>
                                Belum ada data periode magang
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mx-3 mb-5">
                {{ $periode->links() }}
            </div>
        </div>
    </div>

    {{-- Modal Tambah --}}
    <input type="checkbox" id="create_modal" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box max-w-lg">
            <div class="mb-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Tambah Periode Magang</h3>
                <label for="create_modal" class="cursor-pointer text-gray-400 hover:text-gray-600">
                    <i class="ri-close-large-fill text-xl"></i>
                </label>
            </div>
            <form action="{{ route('admin.periode-magang.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">Nama Periode <span class="text-red-500">*</span></span>
                        </div>
                        <input type="text" name="nama" placeholder="Contoh: Magang Semester Ganjil 2025"
                            class="input input-bordered w-full text-blue-700" value="{{ old('nama') }}" required />
                        @error('nama')
                            <div class="label">
                                <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>

                    <div class="grid grid-cols-2 gap-3">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text font-semibold">Tanggal Mulai <span class="text-red-500">*</span></span>
                            </div>
                            <input type="date" name="tanggal_mulai"
                                class="input input-bordered w-full text-blue-700" value="{{ old('tanggal_mulai') }}" required />
                            @error('tanggal_mulai')
                                <div class="label">
                                    <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                                </div>
                            @enderror
                        </label>

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text font-semibold">Tanggal Selesai <span class="text-red-500">*</span></span>
                            </div>
                            <input type="date" name="tanggal_selesai"
                                class="input input-bordered w-full text-blue-700" value="{{ old('tanggal_selesai') }}" required />
                            @error('tanggal_selesai')
                                <div class="label">
                                    <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                                </div>
                            @enderror
                        </label>
                    </div>

                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">Keterangan</span>
                        </div>
                        <textarea name="keterangan" placeholder="Keterangan tambahan (opsional)"
                            class="textarea textarea-bordered w-full text-blue-700" rows="3">{{ old('keterangan') }}</textarea>
                    </label>

                    <div class="form-control">
                        <label class="cursor-pointer flex items-center gap-3">
                            <input type="checkbox" name="is_aktif" class="checkbox checkbox-success" value="1" {{ old('is_aktif') ? 'checked' : '' }} />
                            <span class="label-text font-semibold">Jadikan periode ini <span class="text-green-600">Aktif</span></span>
                        </label>
                        <p class="text-xs text-gray-400 mt-1 ml-9">Hanya 1 periode yang bisa aktif pada satu waktu</p>
                    </div>
                </div>

                <div class="flex gap-2 mt-5">
                    <label for="create_modal" class="btn btn-ghost flex-1">Batal</label>
                    <button type="submit" class="btn btn-success flex-1 text-white">
                        <i class="ri-save-line"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- End Modal Tambah --}}

    {{-- Modal Edit --}}
    <input type="checkbox" id="edit_modal" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box max-w-lg">
            <div class="mb-4 flex justify-between items-center">
                <h3 class="text-lg font-bold">Edit Periode Magang</h3>
                <label for="edit_modal" class="cursor-pointer text-gray-400 hover:text-gray-600">
                    <i class="ri-close-large-fill text-xl"></i>
                </label>
            </div>
            <form action="{{ route('admin.periode-magang.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="edit_id" />
                <div class="space-y-4">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">Nama Periode <span class="text-red-500">*</span></span>
                            <span class="label-text-alt" id="loading_edit_nama"></span>
                        </div>
                        <input type="text" name="nama" id="edit_nama" placeholder="Nama periode"
                            class="input input-bordered w-full text-blue-700" required />
                    </label>

                    <div class="grid grid-cols-2 gap-3">
                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text font-semibold">Tanggal Mulai <span class="text-red-500">*</span></span>
                            </div>
                            <input type="date" name="tanggal_mulai" id="edit_tanggal_mulai"
                                class="input input-bordered w-full text-blue-700" required />
                        </label>

                        <label class="form-control w-full">
                            <div class="label">
                                <span class="label-text font-semibold">Tanggal Selesai <span class="text-red-500">*</span></span>
                            </div>
                            <input type="date" name="tanggal_selesai" id="edit_tanggal_selesai"
                                class="input input-bordered w-full text-blue-700" required />
                        </label>
                    </div>

                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">Keterangan</span>
                        </div>
                        <textarea name="keterangan" id="edit_keterangan" placeholder="Keterangan tambahan (opsional)"
                            class="textarea textarea-bordered w-full text-blue-700" rows="3"></textarea>
                    </label>

                    <div class="form-control">
                        <label class="cursor-pointer flex items-center gap-3">
                            <input type="checkbox" name="is_aktif" id="edit_is_aktif" class="checkbox checkbox-success" value="1" />
                            <span class="label-text font-semibold">Jadikan periode ini <span class="text-green-600">Aktif</span></span>
                        </label>
                        <p class="text-xs text-gray-400 mt-1 ml-9">Hanya 1 periode yang bisa aktif pada satu waktu</p>
                    </div>
                </div>

                <div class="flex gap-2 mt-5">
                    <label for="edit_modal" class="btn btn-ghost flex-1">Batal</label>
                    <button type="submit" class="btn btn-warning flex-1 text-slate-700">
                        <i class="ri-save-line"></i> Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- End Modal Edit --}}

    <script>
        @if (session()->has('success'))
            Swal.fire({
                title: 'Berhasil',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#6419E6',
                confirmButtonText: 'OK',
            });
        @endif

        @if (session()->has('error'))
            Swal.fire({
                title: 'Gagal',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#6419E6',
                confirmButtonText: 'OK',
            });
        @endif

        function edit_button(id) {
            let loading = `<span class="loading loading-dots loading-md text-purple-600"></span>`;
            $("#loading_edit_nama").html(loading);

            document.getElementById('edit_modal').checked = true;

            axios.get("{{ route('admin.periode-magang.edit') }}", { params: { id: id } })
                .then(function(response) {
                    let data = response.data;
                    $("#edit_id").val(data.id);
                    $("#edit_nama").val(data.nama);
                    $("#edit_tanggal_mulai").val(data.tanggal_mulai);
                    $("#edit_tanggal_selesai").val(data.tanggal_selesai);
                    $("#edit_keterangan").val(data.keterangan ?? '');
                    $("#edit_is_aktif").prop('checked', data.is_aktif == 1 || data.is_aktif === true);

                    $("#loading_edit_nama").html('');
                })
                .catch(function(error) {
                    console.error(error);
                    $("#loading_edit_nama").html('');
                    Swal.fire({ icon: 'error', title: 'Gagal', text: 'Gagal memuat data periode magang' });
                });
        }

        function delete_button(id, nama) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: "<p>Data yang dihapus tidak dapat dipulihkan kembali!</p>" +
                    "<div class='divider'></div>" +
                    "<b>Periode: " + nama + "</b>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6419E6',
                cancelButtonColor: '#F87272',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("{{ route('admin.periode-magang.delete') }}", {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        })
                        .then(function(response) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: response.data.message,
                                icon: 'success',
                                confirmButtonColor: '#6419E6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) location.reload();
                            });
                        })
                        .catch(function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: error.response?.data?.message || 'Terjadi kesalahan'
                            });
                        });
                }
            });
        }
    </script>
</x-app-layout>
