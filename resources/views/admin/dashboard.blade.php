<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <i class="ri-dashboard-3-line text-2xl text-gov-primary"></i>
            <h2 class="text-2xl font-bold leading-tight text-gov-primary">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Total Pemagang -->
            <div
                class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-semibold">Total Pemagang</p>
                        <p class="text-3xl font-bold mt-2">{{ $totalPemagang }}</p>
                    </div>
                    <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="ri-team-line text-3xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-blue-100 text-sm">
                    <i class="ri-arrow-up-line"></i>
                    <span>Personel aktif</span>
                </div>
            </div>

            <!-- Pemagang Hadir -->
            <div
                class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-semibold">Hadir Hari Ini</p>
                        <p class="text-3xl font-bold mt-2">{{ $rekapPresensi->jml_kehadiran ?? 0 }}</p>
                    </div>
                    <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="ri-check-double-line text-3xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-green-100 text-sm">
                    <i class="ri-pulse-line"></i>
                    <span>Absensi normal</span>
                </div>
            </div>

            <!-- Pemagang Sakit -->
            <div
                class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-yellow-100 text-sm font-semibold">Pemagang Sakit</p>
                        <p class="text-3xl font-bold mt-2">{{ $rekapPengajuanPresensi->jml_sakit ?? 0 }}</p>
                    </div>
                    <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="ri-hospital-line text-3xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-yellow-100 text-sm">
                    <i class="ri-alert-line"></i>
                    <span>Memerlukan perhatian</span>
                </div>
            </div>

            <!-- Pemagang Izin -->
            <div
                class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-semibold">Pemagang Izin</p>
                        <p class="text-3xl font-bold mt-2">{{ $rekapPengajuanPresensi->jml_izin ?? 0 }}</p>
                    </div>
                    <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="ri-pass-valid-line text-3xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-purple-100 text-sm">
                    <i class="ri-document-line"></i>
                    <span>Perizinan sah</span>
                </div>
            </div>

            <!-- Pemagang Terlambat -->
            <div
                class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-lg p-6 text-white hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-semibold">Pemagang Terlambat</p>
                        <p class="text-3xl font-bold mt-2">{{ $rekapPresensi->jml_terlambat ?? 0 }}</p>
                    </div>
                    <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="ri-time-line text-3xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-red-100 text-sm">
                    <i class="ri-alert-fill"></i>
                    <span>Jadwal terganggu</span>
                </div>
            </div>
        </div>

        <!-- Additional Info Section (Optional) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            <!-- Quick Stats -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Statistik Presensi</h3>
                    <i class="ri-bar-chart-box-line text-2xl text-gov-primary"></i>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Tingkat kehadiran</span>
                        <div class="w-full mx-4 bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                        </div>
                        <span class="text-sm font-semibold text-green-600">85%</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Tingkat ketidakhadiran</span>
                        <div class="w-full mx-4 bg-gray-200 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full" style="width: 8%"></div>
                        </div>
                        <span class="text-sm font-semibold text-red-600">8%</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Tingkat keterlambatan</span>
                        <div class="w-full mx-4 bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: 7%"></div>
                        </div>
                        <span class="text-sm font-semibold text-yellow-600">7%</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Akses Cepat</h3>
                <div class="space-y-2">
                    <a href="{{ route('admin.pemagang') }}"
                        class="flex items-center space-x-2 p-3 rounded-lg bg-blue-50 hover:bg-blue-100 text-gov-primary font-semibold transition-colors">
                        <i class="ri-team-line"></i>
                        <span>Kelola Pemagang</span>
                    </a>
                    <a href="{{ route('admin.pembimbing') }}"
                        class="flex items-center space-x-2 p-3 rounded-lg bg-blue-50 hover:bg-blue-100 text-gov-primary font-semibold transition-colors">
                        <i class="ri-team-line"></i>
                        <span>Kelola Pembimbing</span>
                    </a>
                    <a href="{{ route('admin.instansi') }}"
                        class="flex items-center space-x-2 p-3 rounded-lg bg-purple-50 hover:bg-purple-100 text-purple-600 font-semibold transition-colors">
                        <i class="ri-organization-chart text-lg"></i>
                        <span>Kelola Instansi</span>`
                    </a>
                    <a href="{{ route('admin.lokasi-kantor') }}"
                        class="flex items-center space-x-2 p-3 rounded-lg bg-purple-50 hover:bg-purple-100 text-purple-600 font-semibold transition-colors">
                        <i class="ri-organization-chart text-lg"></i>
                        <span>Lokasi Absensi</span>
                    </a>
                    <a href="{{ route('admin.laporan.presensi') }}"
                        class="flex items-center space-x-2 p-3 rounded-lg bg-green-50 hover:bg-green-100 text-green-600 font-semibold transition-colors">
                        <i class="ri-file-chart-line"></i>
                        <span>Lihat Laporan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
