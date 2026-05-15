<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gov-primary rounded-lg flex items-center justify-center text-white">
                    <i class="ri-team-fill text-lg"></i>
                </div>
                <h2 class="text-2xl font-bold leading-tight text-gov-primary">
                    {{ __('Data Pemagang') }}
                </h2>
            </div>
            <label class="gov-btn-primary cursor-pointer" for="create_modal">
                <i class="ri-add-line"></i>
                Tambah Pemagang
            </label>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- Search & Filter Section -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form action="{{ route('admin.pemagang') }}" method="get" enctype="multipart/form-data" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="gov-form-label">Nama Pemagang</label>
                        <input type="text" name="nama_pemagang" placeholder="Cari nama..." class="gov-form-input"
                            value="{{ request()->nama_pemagang }}" />
                    </div>
                    <div>
                        <label class="gov-form-label">Instansi</label>
                        <select class="gov-form-input" name="kode_departemen">
                            <option value="">-- Pilih Instansi --</option>
                            @foreach ($departemen as $item)
                                <option value="{{ $item->kode }}" @if ($item->kode == request()->kode_departemen) selected @endif>
                                    {{ $item->nama }}</option>
                            @endforeach
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

        <!-- Table Section -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="gov-table w-full">
                    <thead class="bg-gradient-to-r from-gov-primary to-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">#</th>
                            <th class="px-4 py-3 text-left font-semibold">Instansi</th>
                            <th class="px-4 py-3 text-left font-semibold">Nama Lengkap</th>
                            <th class="px-4 py-3 text-left font-semibold">Jabatan</th>
                            <th class="px-4 py-3 text-left font-semibold">Telepon</th>
                            <th class="px-4 py-3 text-left font-semibold">Email</th>
                            <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemagang as $value => $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 font-semibold text-gray-700">{{ $pemagang->firstItem() + $value }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="gov-badge-primary">{{ $item->kode }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                                            @if ($item->foto)
                                                <img src="{{ asset("storage/unggah/pemagang/$item->foto") }}"
                                                    class="w-full h-full object-cover" />
                                            @else
                                                <i class="ri-user-line text-gray-400"></i>
                                            @endif
                                        </div>
                                        <span class="font-medium text-gray-800">{{ $item->nama_lengkap }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-gray-600">{{ $item->jabatan }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $item->telepon }}</td>
                                <td class="px-4 py-3 text-gray-600 text-sm">{{ $item->email }}</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <label class="gov-btn-primary py-1 px-3 cursor-pointer" for="edit_button"
                                            onclick="return edit_button('{{ $item->nik }}')">
                                            <i class="ri-pencil-line"></i>
                                        </label>
                                        <button class="gov-btn-danger py-1 px-3"
                                            onclick="return delete_button('{{ $item->nik }}', '{{ $item->nama_lengkap }}')">
                                            <i class="ri-delete-bin-2-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $pemagang->links() }}
            </div>
        </div>
    </div>

    {{-- Modal Create --}}
    <input type="checkbox" id="create_modal" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box w-11/12 max-w-2xl">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gov-primary">Tambah {{ $title }}</h3>
                <label for="create_modal" class="cursor-pointer text-gray-500 hover:text-gray-700">
                    <i class="ri-close-large-fill text-xl"></i>
                </label>
            </div>

            <div class="max-h-96 overflow-y-auto">
                <form action="{{ route('admin.pemagang.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- NIK -->
                        <div>
                            <label class="gov-form-label">NIK <span class="text-red-500">*</span></label>
                            <input type="text" name="nik" placeholder="Nomor Induk Pemagang"
                                class="gov-form-input" value="{{ old('nik') }}" required />
                            @error('nik')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Instansi -->
                        <div>
                            <label class="gov-form-label">Instansi <span class="text-red-500">*</span></label>
                            <select name="instansi_id" class="gov-form-input" required>
                                <option disabled selected>Pilih Instansi</option>
                                @foreach ($departemen as $item)
                                    <option value="{{ $item->id }}"
                                        @if ($item->id == old('instansi_id')) selected @endif>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('instansi_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Lengkap -->
                        <div>
                            <label class="gov-form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap"
                                class="gov-form-input" value="{{ old('nama_lengkap') }}" required />
                            @error('nama_lengkap')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label class="gov-form-label">Jabatan <span class="text-red-500">*</span></label>
                            <input type="text" name="jabatan" placeholder="Jabatan" class="gov-form-input"
                                value="{{ old('jabatan') }}" required />
                            @error('jabatan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label class="gov-form-label">Telepon <span class="text-red-500">*</span></label>
                            <input type="text" name="telepon" placeholder="Nomor Telepon" class="gov-form-input"
                                value="{{ old('telepon') }}" required />
                            @error('telepon')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="gov-form-label">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" placeholder="Email" class="gov-form-input"
                                value="{{ old('email') }}" required />
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="gov-form-label">Password <span class="text-red-500">*</span></label>
                            <input type="password" name="password" placeholder="Password" class="gov-form-input"
                                value="{{ old('password') }}" required />
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto -->
                        <div class="md:col-span-2">
                            <label class="gov-form-label">Foto</label>
                            <input type="file" name="foto" id="foto" class="gov-form-input"
                                onchange="previewImage()" />
                            @error('foto')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <img class="img-preview my-3 rounded-lg max-h-48 hidden" />
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200 mt-6">
                        <label for="create_modal" class="gov-btn-secondary">Batal</label>
                        <button type="reset" class="gov-btn-secondary">Reset</button>
                        <button type="submit" class="gov-btn-primary">
                            <i class="ri-save-line"></i>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Create --}}

    {{-- Modal Edit --}}
    <input type="checkbox" id="edit_button" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box w-11/12 max-w-2xl">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gov-primary">Edit {{ $title }}</h3>
                <label for="edit_button" class="cursor-pointer text-gray-500 hover:text-gray-700">
                    <i class="ri-close-large-fill text-xl"></i>
                </label>
            </div>

            <div class="max-h-96 overflow-y-auto">
                <form action="{{ route('admin.pemagang.update') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    <input type="text" name="nik_lama" hidden>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- NIK -->
                        <div>
                            <label class="gov-form-label">NIK <span class="text-red-500">*</span></label>
                            <input type="text" name="nik" placeholder="Nomor Induk Pemagang"
                                class="gov-form-input" required />
                            @error('nik')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Instansi -->
                        <div>
                            <label class="gov-form-label">Instansi <span class="text-red-500">*</span></label>
                            <select name="instansi_id" id="departemen_id" class="gov-form-input" required>
                            </select>
                            @error('instansi_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Lengkap -->
                        <div>
                            <label class="gov-form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap"
                                class="gov-form-input" required />
                            @error('nama_lengkap')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label class="gov-form-label">Jabatan <span class="text-red-500">*</span></label>
                            <input type="text" name="jabatan" placeholder="Jabatan" class="gov-form-input"
                                required />
                            @error('jabatan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label class="gov-form-label">Telepon <span class="text-red-500">*</span></label>
                            <input type="text" name="telepon" placeholder="Nomor Telepon" class="gov-form-input"
                                required />
                            @error('telepon')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="gov-form-label">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" placeholder="Email" class="gov-form-input"
                                required />
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto -->
                        <div class="md:col-span-2">
                            <label class="gov-form-label">Foto</label>
                            <input type="file" name="foto" id="foto_edit" class="gov-form-input"
                                onchange="previewImageEdit()" />
                            @error('foto')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <img class="foto-edit-preview my-3 rounded-lg max-h-48 hidden" />
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200 mt-6">
                        <label for="edit_button" class="gov-btn-secondary">Batal</label>
                        <button type="submit" class="gov-btn-primary">
                            <i class="ri-check-line"></i>
                            Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Edit --}}

    <script>
        function previewImage() {
            const image = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            if (!image.files || !image.files[0]) return;

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        function previewImageEdit() {
            const image = document.querySelector('#foto_edit');
            const imgPreview = document.querySelector('.foto-edit-preview');

            if (!image.files || !image.files[0]) return;

            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }

        @if (session()->has('success'))
            Swal.fire({
                title: 'Berhasil',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#003DA5',
                confirmButtonText: 'OK',
            });
        @endif

        @if (session()->has('error'))
            Swal.fire({
                title: 'Gagal',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#003DA5',
                confirmButtonText: 'OK',
            });
        @endif

        function edit_button(nik) {
            $("select[id='departemen_id']").children().remove().end();

            $.ajax({
                type: "get",
                url: "{{ route('admin.pemagang.edit') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "nik": nik
                },
                success: function(data) {
                    let items = [];
                    $.each(data, function(key, val) {
                        items.push(val);
                    });

                    $("input[name='nik_lama']").val(items[0]);
                    $("input[name='nik']").val(items[0]);
                    $("input[name='nama_lengkap']").val(items[2]);
                    $("input[name='jabatan']").val(items[4]);
                    $("input[name='telepon']").val(items[5]);
                    $("input[name='email']").val(items[6]);

                    const departemen = @json($departemen);
                    let options = '<option disabled>Pilih Departemen</option>';
                    departemen.forEach(item => {
                        const isSelected = item.id == items[1] ? 'selected' : '';
                        options += `<option value="${item.id}" ${isSelected}>${item.nama}</option>`;
                    });
                    $("select[id='departemen_id']").html(options);

                    if (items[3] != null) {
                        $(".foto-edit-preview").attr("src",
                            `{{ asset('storage/unggah/pemagang/${items[3]}') }}`);
                        $(".foto-edit-preview").css("display", "block");
                    } else {
                        $(".foto-edit-preview").attr("src", ``);
                        $(".foto-edit-preview").css("display", "none");
                    }
                }
            });
        }

        function delete_button(nik, nama) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: "<p>Data yang dihapus tidak dapat dipulihkan kembali!</p>" +
                    "<div class='divider'></div>" +
                    "<div class='flex flex-col'>" +
                    "<b>Pemagang: " + nama + "</b>" +
                    "</div>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#003DA5',
                cancelButtonColor: '#D32F2F',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('admin.pemagang.delete') }}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "nik": nik
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: response.message,
                                icon: 'success',
                                confirmButtonColor: '#003DA5',
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
