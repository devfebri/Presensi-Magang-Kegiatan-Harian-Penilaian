<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Administrasi Presensi') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Search & Filter Section -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form action="{{ route('admin.administrasi-presensi') }}" method="get" enctype="multipart/form-data"
                class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="gov-form-label">NIK</label>
                        <input type="text" name="nik" placeholder="NIK" class="gov-form-input"
                            value="{{ request()->nik }}" />
                    </div>
                    <div>
                        <label class="gov-form-label">Nama Pemagang</label>
                        <input type="text" name="pemagang" placeholder="Nama Pemagang" class="gov-form-input"
                            value="{{ request()->pemagang }}" />
                    </div>
                    <div>
                        <label class="gov-form-label">Instansi</label>
                        <select name="departemen" class="gov-form-input">
                            <option value="0">Semua Instansi</option>
                            @foreach ($departemen as $item)
                                <option value="{{ $item->id }}"
                                    {{ request()->departemen == $item->id ? 'selected' : '' }}>{{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="gov-form-label">Status</label>
                        <select name="status" class="gov-form-input">
                            <option value="0">Semua Status</option>
                            <option value="I" {{ request()->status == 'I' ? 'selected' : '' }}>Izin</option>
                            <option value="S" {{ request()->status == 'S' ? 'selected' : '' }}>Sakit</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="gov-form-label">Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" class="gov-form-input"
                            value="{{ request()->tanggal_awal ? request()->tanggal_awal : \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}" />
                    </div>
                    <div>
                        <label class="gov-form-label">Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" class="gov-form-input"
                            value="{{ request()->tanggal_akhir ? request()->tanggal_akhir : \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d') }}" />
                    </div>
                    <div>
                        <label class="gov-form-label">Status Approved</label>
                        <select name="status_approved" class="gov-form-input">
                            <option value="0">Semua Aksi</option>
                            <option value="1" {{ request()->status_approved == 1 ? 'selected' : '' }}>Pending
                            </option>
                            <option value="2" {{ request()->status_approved == 2 ? 'selected' : '' }}>Diterima
                            </option>
                            <option value="3" {{ request()->status_approved == 3 ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="gov-btn-primary w-full">
                            <i class="ri-search-2-line"></i>
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="w-full overflow-x-auto rounded-md bg-slate-200 px-10">
            <table id="tabelPresensi"
                class="table mb-4 w-full border-collapse items-center border-gray-200 align-top dark:border-white/40">
                <thead class="text-sm text-gray-800 dark:text-gray-300">
                    <tr>
                        <th></th>
                        <th>Nama Pemagang / NIK</th>
                        <th>Instansi</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuan as $value => $item)
                        <tr class="hover">
                            <td class="font-bold">{{ $value + 1 }}</td>
                            <td class="text-slate-500 dark:text-slate-300">{{ $item->nama_pemagang }} -
                                {{ $item->nik }}</td>
                            <td class="text-slate-500 dark:text-slate-300">{{ $item->nama_instansi }}</td>
                            <td class="text-slate-500 dark:text-slate-300">
                                {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('l, d-m-Y') }}</td>
                            <td class="text-slate-500 dark:text-slate-300">
                                @if ($item->status == 'I')
                                    <span>Izin</span>
                                @elseif ($item->status == 'S')
                                    <span>Sakit</span>
                                @endif
                            </td>
                            <td class="text-slate-500 dark:text-slate-300">{{ $item->keterangan }}</td>
                            <td class="flex justify-center gap-2">
                                @if ($item->status_approved == 1)
                                    <label class="btn btn-warning btn-sm tooltip flex items-center" data-tip="Diterima"
                                        onclick="return terima_button('{{ $item->id }}', '{{ $item->nama_pemagang }}', '{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y') }}', 'terima')">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </label>
                                    <label class="btn btn-error btn-sm tooltip flex items-center" data-tip="Ditolak"
                                        onclick="return tolak_button('{{ $item->id }}', '{{ $item->nama_pemagang }}', '{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y') }}', 'tolak')">
                                        <i class="ri-close-circle-line"></i>
                                    </label>
                                @elseif ($item->status_approved == 2)
                                    <div class="flex items-center gap-2">
                                        <div class="badge badge-success">Diterima</div>
                                        <label class="btn btn-error btn-sm tooltip flex items-center"
                                            data-tip="Dibatalkan"
                                            onclick="return batal_button('{{ $item->id }}', '{{ $item->nama_pemagang }}', '{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y') }}', 'batal')">
                                            <i class="ri-close-circle-line"></i>
                                        </label>
                                    </div>
                                @elseif ($item->status_approved == 3)
                                    <div class="flex items-center gap-2">
                                        <div class="badge badge-error">Ditolak</div>
                                        <label class="btn btn-error btn-sm tooltip flex items-center"
                                            data-tip="Dibatalkan"
                                            onclick="return batal_button('{{ $item->id }}', '{{ $item->nama_pemagang }}', '{{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y') }}', 'batal')">
                                            <i class="ri-close-circle-line"></i>
                                        </label>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mx-3 mb-5">
                {{ $pengajuan->links() }}
            </div>
        </div>
    </div>

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

        function terima_button(id, pemagang, tanggal, ajuan) {
            Swal.fire({
                title: 'Pengajuan Presensi Diterima',
                html: "<p>Apakah Anda menerima pengajuan presensi?</p>" +
                    "<div class='divider'></div>" +
                    "<div class='flex flex-col'>" +
                    "<b>Pemagang: " + pemagang + "</b>" +
                    "<b>Tanggal Pengajuan: " + tanggal + "</b>" +
                    "</div>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6419E6',
                cancelButtonColor: '#F87272',
                confirmButtonText: 'Terima',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.administrasi-presensi.persetujuan') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                            "ajuan": ajuan
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: response.message,
                                icon: 'success',
                                confirmButtonColor: '#6419E6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.responseJSON.message
                            })
                        }
                    });
                }
            })
        }

        function tolak_button(id, pemagang, tanggal, ajuan) {
            Swal.fire({
                title: 'Pengajuan Presensi Ditolak',
                html: "<p>Apakah Anda menolak pengajuan presensi?</p>" +
                    "<div class='divider'></div>" +
                    "<div class='flex flex-col'>" +
                    "<b>Pemagang: " + pemagang + "</b>" +
                    "<b>Tanggal Pengajuan: " + tanggal + "</b>" +
                    "</div>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6419E6',
                cancelButtonColor: '#F87272',
                confirmButtonText: 'Tolak',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.administrasi-presensi.persetujuan') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                            "ajuan": ajuan
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: response.message,
                                icon: 'success',
                                confirmButtonColor: '#6419E6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.responseJSON.message
                            })
                        }
                    });
                }
            })
        }

        function batal_button(id, pemagang, tanggal, ajuan) {
            Swal.fire({
                title: 'Pengajuan Presensi Dibatalkan',
                html: "<p>Apakah Anda membatalkan pengajuan presensi?</p>" +
                    "<div class='divider'></div>" +
                    "<div class='flex flex-col'>" +
                    "<b>Pemagang: " + pemagang + "</b>" +
                    "<b>Tanggal Pengajuan: " + tanggal + "</b>" +
                    "</div>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6419E6',
                cancelButtonColor: '#F87272',
                confirmButtonText: 'Batalkan',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.administrasi-presensi.persetujuan') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                            "ajuan": ajuan
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: response.message,
                                icon: 'success',
                                confirmButtonColor: '#6419E6',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.responseJSON.message
                            })
                        }
                    });
                }
            })
        }
    </script>
</x-app-layout>
