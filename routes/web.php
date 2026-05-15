<?php

use App\Http\Controllers\AuthPemagangController;
use App\Http\Controllers\AuthPembimbingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\PemagangController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\LokasiKantorController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogbookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([
    'prefix' => 'login-pemagang',
    'middleware' => ['guest', 'login-pemagang'],
], function () {
    Route::get('/', [AuthPemagangController::class, 'create'])->name('login.view');
    Route::post('/', [AuthPemagangController::class, 'store'])->name('login.auth');
});

Route::group([
    'prefix' => 'pemagang',
    'middleware' => ['pemagang'],
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('pemagang.dashboard');
    Route::post('/logout', [AuthPemagangController::class, 'destroy'])->name('logout.auth');

    Route::group([
        'prefix' => 'presensi',
    ], function () {
        Route::get('/', [PresensiController::class, 'index'])->name('pemagang.presensi');
        Route::post('/', [PresensiController::class, 'store'])->name('pemagang.presensi.store');

        Route::group([
            'prefix' => 'history',
        ], function () {
            Route::get('/', [PresensiController::class, 'history'])->name('pemagang.history');
            Route::post('/search-history', [PresensiController::class, 'searchHistory'])->name('pemagang.history.search');
        });

        Route::group([
            'prefix' => 'izin',
        ], function () {
            Route::get('/', [PresensiController::class, 'pengajuanPresensi'])->name('pemagang.izin');
            Route::get('/pengajuan-presensi', [PresensiController::class, 'pengajuanPresensiCreate'])->name('pemagang.izin.create');
            Route::post('/pengajuan-presensi', [PresensiController::class, 'pengajuanPresensiStore'])->name('pemagang.izin.store');
            Route::post('/search-history', [PresensiController::class, 'searchPengajuanHistory'])->name('pemagang.izin.search');
        });
    });

    Route::group([
        'prefix' => 'logbook',
    ], function () {
        Route::get('/', [LogbookController::class, 'index'])->name('pemagang.logbook');
        Route::get('/tambah', [LogbookController::class, 'create'])->name('pemagang.logbook.tambah');
        Route::post('/store', [LogbookController::class, 'store'])->name('pemagang.logbook.store');
        Route::get('/{id}/edit', [LogbookController::class, 'edit'])->name('pemagang.logbook.edit');
        Route::post('/{id}/update', [LogbookController::class, 'update'])->name('pemagang.logbook.update');
        Route::delete('/{id}', [LogbookController::class, 'destroy'])->name('pemagang.logbook.destroy');
    });

    Route::group([
        'prefix' => 'profile',
    ], function () {
        Route::get('/', [PemagangController::class, 'index'])->name('pemagang.profile');
        Route::post('/update', [PemagangController::class, 'update'])->name('pemagang.profile.update');
    });
});

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth'],
], function () {
    Route::get('/dashboard', [DashboardController::class, 'indexAdmin'])->name('admin.dashboard');

    Route::get('/pemagang', [PemagangController::class, 'indexAdmin'])->name('admin.pemagang');
    Route::post('/pemagang/tambah', [PemagangController::class, 'store'])->name('admin.pemagang.store');
    Route::get('/pemagang/perbarui', [PemagangController::class, 'edit'])->name('admin.pemagang.edit');
    Route::post('/pemagang/perbarui', [PemagangController::class, 'updateAdmin'])->name('admin.pemagang.update');
    Route::post('/pemagang/hapus', [PemagangController::class, 'delete'])->name('admin.pemagang.delete');

    Route::get('/instansi', [InstansiController::class, 'index'])->name('admin.instansi');
    Route::post('/instansi/tambah', [InstansiController::class, 'store'])->name('admin.instansi.store');
    Route::get('/instansi/perbarui', [InstansiController::class, 'edit'])->name('admin.instansi.edit');
    Route::post('/instansi/perbarui', [InstansiController::class, 'update'])->name('admin.instansi.update');
    Route::post('/instansi/hapus', [InstansiController::class, 'delete'])->name('admin.instansi.delete');

    Route::get('/monitoring-presensi', [PresensiController::class, 'monitoringPresensi'])->name('admin.monitoring-presensi');
    Route::post('/monitoring-presensi', [PresensiController::class, 'viewLokasi'])->name('admin.monitoring-presensi.lokasi');

    Route::get('/laporan/presensi', [PresensiController::class, 'laporan'])->name('admin.laporan.presensi');
    Route::post('/laporan/presensi/pemagang', [PresensiController::class, 'laporanPresensiPemagang'])->name('admin.laporan.presensi.pemagang');
    Route::post('/laporan/presensi/semua-pemagang', [PresensiController::class, 'laporanPresensiSemuaPemagang'])->name('admin.laporan.presensi.semua-pemagang');

    Route::get('/lokasi', [LokasiKantorController::class, 'index'])->name('admin.lokasi-kantor');
    Route::post('/lokasi/tambah', [LokasiKantorController::class, 'store'])->name('admin.lokasi-kantor.store');
    Route::get('/lokasi/perbarui', [LokasiKantorController::class, 'edit'])->name('admin.lokasi-kantor.edit');
    Route::post('/lokasi/perbarui', [LokasiKantorController::class, 'update'])->name('admin.lokasi-kantor.update');
    Route::post('/lokasi/hapus', [LokasiKantorController::class, 'delete'])->name('admin.lokasi-kantor.delete');

    Route::get('/administrasi-presensi', [PresensiController::class, 'indexAdmin'])->name('admin.administrasi-presensi');
    Route::post('/administrasi-presensi/status', [PresensiController::class, 'persetujuanPresensi'])->name('admin.administrasi-presensi.persetujuan');
});

// ===================== PEMBIMBING ROUTES =====================
Route::group([
    'prefix'     => 'login-pembimbing',
    'middleware' => ['login-pembimbing'],
], function () {
    Route::get('/', [AuthPembimbingController::class, 'create'])->name('login.pembimbing');
    Route::post('/', [AuthPembimbingController::class, 'store'])->name('login.pembimbing.auth');
});

Route::group([
    'prefix'     => 'pembimbing',
    'middleware' => ['pembimbing'],
], function () {
    Route::get('/dashboard', [PembimbingController::class, 'dashboard'])->name('pembimbing.dashboard');
    Route::post('/logout', [AuthPembimbingController::class, 'destroy'])->name('pembimbing.logout');

    // Logbook
    Route::get('/logbook', [PembimbingController::class, 'logbookIndex'])->name('pembimbing.logbook');
    Route::get('/logbook/{nik}', [PembimbingController::class, 'logbookPemagang'])->name('pembimbing.logbook.pemagang');
    Route::post('/logbook/{nik}/nilai', [PembimbingController::class, 'nilaiLogbook'])->name('pembimbing.logbook.nilai');
});

require __DIR__ . '/auth.php';
