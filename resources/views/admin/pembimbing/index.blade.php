<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gov-primary rounded-lg flex items-center justify-center text-white">
                    <i class="ri-user-star-fill text-lg"></i>
                </div>
                <h2 class="text-2xl font-bold leading-tight text-gov-primary">
                    {{ __('Kelola Pembimbing') }}
                </h2>
            </div>
            <label class="gov-btn-primary cursor-pointer" for="create_modal">
                <i class="ri-add-line"></i>
                Tambah Pembimbing
            </label>
        </div>
    </x-slot>

    <div class="space-y-6">
        {{-- Search & Filter --}}
        <div class="bg-white rounded-xl shadow-md p-6">
            <form action="{{ route('admin.pembimbing') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="gov-form-label">Cari Nama / NIP / Email</label>
                        <input type="text" name="cari_nama" placeholder="Ketik untuk mencari..."
                            class="gov-form-input" value="{{ request()->cari_nama }}" />
                    </div>
                    <div>
                        <label class="gov-form-label">Filter Instansi</label>
                        <select name="filter_instansi" class="gov-form-input">
                            <option value="">-- Semua Instansi --</option>
                            @foreach ($instansi as $ins)
                                <option value="{{ $ins->id }}" @if($ins->id == request()->filter_instansi) selected @endif>
                                    {{ $ins->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="gov-btn-primary w-full">
                            <i class="ri-search-2-line"></i> Cari
                        </button>
                        <a href="{{ route('admin.pembimbing') }}" class="gov-btn-secondary w-full text-center">
                            <i class="ri-refresh-line"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="overflow-x-auto">
                <table class="gov-table w-full">
                    <thead class="bg-gradient-to-r from-gov-primary to-blue-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">#</th>
                            <th class="px-4 py-3 text-left font-semibold">Nama Lengkap</th>
                            <th class="px-4 py-3 text-left font-semibold">NIP</th>
                            <th class="px-4 py-3 text-left font-semibold">Instansi</th>
                            <th class="px-4 py-3 text-left font-semibold">Jabatan</th>
                            <th class="px-4 py-3 text-left font-semibold">Email</th>
                            <th class="px-4 py-3 text-left font-semibold">Telepon</th>
                            <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pembimbing as $index => $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 font-semibold text-gray-700">
                                    {{ $pembimbing->firstItem() + $index }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-gov-primary/10 flex items-center justify-center text-gov-primary font-bold text-sm flex-shrink-0">
                                            {{ strtoupper(substr($item->nama_lengkap, 0, 1)) }}
                                        </div>
                                        <span class="font-medium text-gray-800">{{ $item->nama_lengkap }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-gray-600 text-sm">{{ $item->nip ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <span class="gov-badge-primary">{{ $item->instansi->nama ?? '-' }}</span>
                                </td>
                                <td class="px-4 py-3 text-gray-600 text-sm">{{ $item->jabatan ?? '-' }}</td>
                                <td class="px-4 py-3 text-gray-600 text-sm">{{ $item->email }}</td>
                                <td class="px-4 py-3 text-gray-600 text-sm">{{ $item->telepon ?? '-' }}</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="gov-btn-warning py-1 px-3 text-sm"
                                            onclick="editPembimbing('{{ $item->id }}')">
                                            <i class="ri-pencil-line"></i>
                                        </button>
                                        <button class="gov-btn-danger py-1 px-3 text-sm"
                                            onclick="deletePembimbing('{{ $item->id }}', '{{ $item->nama_lengkap }}')">
                                            <i class="ri-delete-bin-2-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-10 text-center text-gray-400">
                                    <i class="ri-user-search-line text-4xl block mb-2"></i>
                                    Tidak ada data pembimbing
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $pembimbing->links() }}
            </div>
        </div>
    </div>

    {{-- ==================== MODAL CREATE ==================== --}}
    <input type="checkbox" id="create_modal" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box w-11/12 max-w-2xl">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gov-primary">Tambah Pembimbing</h3>
                <label for="create_modal" class="cursor-pointer text-gray-500 hover:text-gray-700">
                    <i class="ri-close-large-fill text-xl"></i>
                </label>
            </div>
            <div class="max-h-[70vh] overflow-y-auto pr-1">
                <form action="{{ route('admin.pembimbing.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Instansi --}}
                        <div class="md:col-span-2">
                            <label class="gov-form-label">Instansi <span class="text-red-500">*</span></label>
                            <select name="instansi_id" class="gov-form-input" required>
                                <option disabled selected>-- Pilih Instansi --</option>
                                @foreach ($instansi as $ins)
                                    <option value="{{ $ins->id }}" @if($ins->id == old('instansi_id')) selected @endif>
                                        {{ $ins->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('instansi_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Nama Lengkap --}}
                        <div>
                            <label class="gov-form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap"
                                class="gov-form-input" value="{{ old('nama_lengkap') }}" required />
                            @error('nama_lengkap') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- NIP --}}
                        <div>
                            <label class="gov-form-label">NIP</label>
                            <input type="text" name="nip" placeholder="NIP (opsional)"
                                class="gov-form-input" value="{{ old('nip') }}" />
                            @error('nip') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Jabatan --}}
                        <div>
                            <label class="gov-form-label">Jabatan</label>
                            <input type="text" name="jabatan" placeholder="Jabatan (opsional)"
                                class="gov-form-input" value="{{ old('jabatan') }}" />
                            @error('jabatan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Telepon --}}
                        <div>
                            <label class="gov-form-label">Telepon</label>
                            <input type="text" name="telepon" placeholder="Nomor Telepon (opsional)"
                                class="gov-form-input" value="{{ old('telepon') }}" />
                            @error('telepon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="gov-form-label">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" placeholder="Alamat Email"
                                class="gov-form-input" value="{{ old('email') }}" required />
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="gov-form-label">Password <span class="text-red-500">*</span></label>
                            <input type="password" name="password" placeholder="Minimal 6 karakter"
                                class="gov-form-input" required />
                            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                    </div>
                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200 mt-4">
                        <label for="create_modal" class="gov-btn-secondary cursor-pointer">Batal</label>
                        <button type="reset" class="gov-btn-secondary">Reset</button>
                        <button type="submit" class="gov-btn-primary">
                            <i class="ri-save-line"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ==================== MODAL EDIT ==================== --}}
    <input type="checkbox" id="edit_modal" class="modal-toggle" />
    <div class="modal" role="dialog">
        <div class="modal-box w-11/12 max-w-2xl">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200">
                <h3 class="text-xl font-bold text-gov-primary">Edit Pembimbing</h3>
                <label for="edit_modal" class="cursor-pointer text-gray-500 hover:text-gray-700">
                    <i class="ri-close-large-fill text-xl"></i>
                </label>
            </div>
            <div class="max-h-[70vh] overflow-y-auto pr-1">
                <form action="{{ route('admin.pembimbing.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" id="edit_id" name="id">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Instansi --}}
                        <div class="md:col-span-2">
                            <label class="gov-form-label">Instansi <span class="text-red-500">*</span></label>
                            <select id="edit_instansi_id" name="instansi_id" class="gov-form-input" required>
                                <option disabled>-- Pilih Instansi --</option>
                                @foreach ($instansi as $ins)
                                    <option value="{{ $ins->id }}">{{ $ins->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Nama Lengkap --}}
                        <div>
                            <label class="gov-form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="edit_nama_lengkap" name="nama_lengkap"
                                placeholder="Nama Lengkap" class="gov-form-input" required />
                        </div>

                        {{-- NIP --}}
                        <div>
                            <label class="gov-form-label">NIP</label>
                            <input type="text" id="edit_nip" name="nip"
                                placeholder="NIP (opsional)" class="gov-form-input" />
                        </div>

                        {{-- Jabatan --}}
                        <div>
                            <label class="gov-form-label">Jabatan</label>
                            <input type="text" id="edit_jabatan" name="jabatan"
                                placeholder="Jabatan (opsional)" class="gov-form-input" />
                        </div>

                        {{-- Telepon --}}
                        <div>
                            <label class="gov-form-label">Telepon</label>
                            <input type="text" id="edit_telepon" name="telepon"
                                placeholder="Nomor Telepon (opsional)" class="gov-form-input" />
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="gov-form-label">Email <span class="text-red-500">*</span></label>
                            <input type="email" id="edit_email" name="email"
                                placeholder="Alamat Email" class="gov-form-input" required />
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="gov-form-label">Password Baru</label>
                            <input type="password" id="edit_password" name="password"
                                placeholder="Kosongkan jika tidak diubah" class="gov-form-input" />
                            <p class="text-xs text-gray-400 mt-1">Kosongkan jika tidak ingin mengubah password.</p>
                        </div>

                    </div>
                    <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200 mt-4">
                        <label for="edit_modal" class="gov-btn-secondary cursor-pointer">Batal</label>
                        <button type="submit" class="gov-btn-primary">
                            <i class="ri-check-line"></i> Perbarui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
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

        function editPembimbing(id) {
            // Tampilkan loading
            document.getElementById('edit_modal').checked = true;

            axios.get("{{ route('admin.pembimbing.edit') }}", { params: { id: id } })
                .then(function(response) {
                    const data = response.data;
                    document.getElementById('edit_id').value          = data.id;
                    document.getElementById('edit_nama_lengkap').value = data.nama_lengkap;
                    document.getElementById('edit_nip').value          = data.nip ?? '';
                    document.getElementById('edit_jabatan').value      = data.jabatan ?? '';
                    document.getElementById('edit_telepon').value      = data.telepon ?? '';
                    document.getElementById('edit_email').value        = data.email;
                    document.getElementById('edit_password').value     = '';

                    // Set instansi
                    const instansiSelect = document.getElementById('edit_instansi_id');
                    for (let i = 0; i < instansiSelect.options.length; i++) {
                        if (instansiSelect.options[i].value == data.instansi_id) {
                            instansiSelect.selectedIndex = i;
                            break;
                        }
                    }
                })
                .catch(function(error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal memuat data pembimbing'
                    });
                });
        }

        function deletePembimbing(id, nama) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: "<p>Data yang dihapus tidak dapat dipulihkan!</p>" +
                    "<div class='divider'></div>" +
                    "<b>Pembimbing: " + nama + "</b>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#D32F2F',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("{{ route('admin.pembimbing.delete') }}", {
                            id: id,
                            _token: "{{ csrf_token() }}"
                        })
                        .then(function(response) {
                            Swal.fire({
                                title: 'Berhasil',
                                text: response.data.message,
                                icon: 'success',
                                confirmButtonColor: '#003DA5',
                                confirmButtonText: 'OK'
                            }).then((r) => {
                                if (r.isConfirmed) location.reload();
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
