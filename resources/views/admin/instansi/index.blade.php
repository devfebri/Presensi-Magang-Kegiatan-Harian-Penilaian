<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gov-primary rounded-lg flex items-center justify-center text-white">
                    <i class="ri-organization-chart text-lg"></i>
                </div>
                <h2 class="text-2xl font-bold leading-tight text-gov-primary">
                    {{ __('Data Instansi') }}
                </h2>
            </div>
            <label class="gov-btn-primary cursor-pointer" for="create_modal">
                <i class="ri-add-line"></i>
                Tambah Instansi
            </label>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Search Section -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form action="{{ route('admin.instansi') }}" method="get" enctype="multipart/form-data" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="gov-form-label">Cari Instansi</label>
                        <input type="text" name="cari_instansi" placeholder="Pencarian..." class="gov-form-input"
                            value="{{ request()->cari_instansi }}" />
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

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">#</th>
                        <th class="px-4 py-3 text-left font-semibold">Kode</th>
                        <th class="px-4 py-3 text-left font-semibold">Nama Instansi</th>
                        <th class="px-4 py-3 text-left font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($instansi as $value => $item)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 font-semibold text-gray-700">{{ $instansi->firstItem() + $value }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="gov-badge-primary">{{ $item->kode }}</span>
                            </td>
                            <td class="px-4 py-3 text-gray-800">{{ $item->nama }}</td>
                            <td class="px-4 py-3">
                                <div class="flex space-x-2">
                                    <button class="gov-btn-warning text-sm"
                                        onclick="return edit_button('{{ $item->id }}')">
                                        <i class="ri-pencil-fill"></i>
                                        Edit
                                    </button>
                                    <button class="gov-btn-danger text-sm"
                                        onclick="return delete_button('{{ $item->id }}', '{{ $item->nama }}')">
                                        <i class="ri-delete-bin-line"></i>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mx-3 mb-5">
                {{ $instansi->links() }}
            </div>
        </div>
    </div>

    {{-- Awal Modal Create --}}
    <input type="checkbox" id="create_modal" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box">
            <div class="mb-3 flex justify-between">
                <h3 class="text-lg font-bold">Tambah {{ $title }}</h3>
                <label for="create_modal" class="cursor-pointer">
                    <i class="ri-close-large-fill"></i>
                </label>
            </div>
            <div>
                <form action="{{ route('admin.instansi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button type="reset" class="btn btn-neutral btn-sm">Reset</button>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">
                                <span class="label-text font-semibold">Kode<span class="text-red-500">*</span></span>
                            </span>
                        </div>
                        <input type="text" name="kode" placeholder="Kode"
                            class="input input-bordered w-full text-blue-700" value="{{ old('kode') }}" required />
                        @error('kode')
                            <div class="label">
                                <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">
                                <span class="label-text font-semibold">Nama<span class="text-red-500">*</span></span>
                            </span>
                        </div>
                        <input type="text" name="nama" placeholder="Nama"
                            class="input input-bordered w-full text-blue-700" value="{{ old('nama') }}" required />
                        @error('nama')
                            <div class="label">
                                <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                    <button type="submit" class="btn btn-success mt-3 w-full text-white">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    {{-- Akhir Modal Create --}}

    {{-- Awal Modal Edit --}}
    <input type="checkbox" id="edit_button" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box">
            <div class="mb-3 flex justify-between">
                <h3 class="text-lg font-bold">Ubah {{ $title }}</h3>
                <label for="edit_button" class="cursor-pointer">
                    <i class="ri-close-large-fill"></i>
                </label>
            </div>
            <div>
                <form action="{{ route('admin.instansi.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="text" name="id" hidden>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">Kode<span class="text-red-500">*</span></span>
                            <span class="label-text-alt" id="loading_edit1"></span>
                        </div>
                        <input type="text" name="kode" placeholder="Kode"
                            class="input input-bordered w-full text-blue-700" required />
                        @error('kode')
                            <div class="label">
                                <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text font-semibold">Nama<span class="text-red-500">*</span></span>
                            <span class="label-text-alt" id="loading_edit2"></span>
                        </div>
                        <input type="text" name="nama" placeholder="Nama"
                            class="input input-bordered w-full text-blue-700" required />
                        @error('nama')
                            <div class="label">
                                <span class="label-text-alt text-sm text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </label>
                    <button type="submit" class="btn btn-warning mt-3 w-full text-slate-700">Perbarui</button>
                </form>
            </div>
        </div>
    </div>
    {{-- Akhir Modal Edit --}}

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
            // Loading effect start
            let loading = `<span class="loading loading-dots loading-md text-purple-600"></span>`;
            $("#loading_edit1").html(loading);
            $("#loading_edit2").html(loading);

            axios.get("{{ route('admin.instansi.edit') }}", {
                    params: {
                        id: id
                    }
                })
                .then(function(response) {
                    let data = response.data;
                    $("input[name='id']").val(data.id);
                    $("input[name='kode']").val(data.kode);
                    $("input[name='nama']").val(data.nama);

                    // Loading effect end
                    loading = "";
                    $("#loading_edit1").html(loading);
                    $("#loading_edit2").html(loading);
                })
                .catch(function(error) {
                    console.error(error);
                    // Loading effect end
                    loading = "";
                    $("#loading_edit1").html(loading);
                    $("#loading_edit2").html(loading);
                });
        }

        function delete_button(id, nama) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: "<p>Data yang dihapus tidak dapat dipulihkan kembali!</p>" +
                    "<div class='divider'></div>" +
                    "<div class='flex flex-col'>" +
                    "<b>Instansi: " + nama + "</b>" +
                    "</div>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#6419E6',
                cancelButtonColor: '#F87272',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("{{ route('admin.instansi.delete') }}", {
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
                                if (result.isConfirmed) {
                                    location.reload();
                                }
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
            })
        }
    </script>
</x-app-layout>
