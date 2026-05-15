<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\PenilaianLogbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    /**
     * Tampilkan daftar logbook pemagang yang sedang login.
     */
    public function index()
    {
        $title = 'Logbook Kegiatan';
        $user  = Auth::guard('pemagang')->user();

        $logbooks = Logbook::where('nik', $user->nik)
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        // Ambil semua penilaian dari seluruh pembimbing untuk pemagang ini
        $penilaian = PenilaianLogbook::where('nik', $user->nik)
            ->with('pembimbing')
            ->get();

        return view('dashboard.logbook.index', compact('title', 'logbooks', 'penilaian'));
    }

    /**
     * Tampilkan form tambah logbook.
     */
    public function create()
    {
        $title = 'Tambah Logbook';
        $user  = Auth::guard('pemagang')->user();

        // Cek apakah hari ini sudah ada logbook
        $sudahIsi = Logbook::where('nik', $user->nik)
            ->whereDate('tanggal', today())
            ->exists();

        return view('dashboard.logbook.create', compact('title', 'sudahIsi'));
    }

    /**
     * Simpan logbook baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal'            => 'required|date',
            'kegiatann_hari_ini' => 'required|string|min:10',
        ], [
            'tanggal.required'            => 'Tanggal wajib diisi.',
            'kegiatann_hari_ini.required' => 'Kegiatan hari ini wajib diisi.',
            'kegiatann_hari_ini.min'      => 'Kegiatan minimal 10 karakter.',
        ]);

        $user = Auth::guard('pemagang')->user();

        // Cek duplikat per tanggal
        $sudahAda = Logbook::where('nik', $user->nik)
            ->whereDate('tanggal', $request->tanggal)
            ->exists();

        if ($sudahAda) {
            return back()->withErrors([
                'tanggal' => 'Logbook untuk tanggal ini sudah pernah diisi.',
            ])->withInput();
        }

        Logbook::create([
            'nik'                => $user->nik,
            'instansi_id'        => $user->instansi_id,
            'tanggal'            => $request->tanggal,
            'kegiatann_hari_ini' => $request->kegiatann_hari_ini,
        ]);

        return redirect()->route('pemagang.logbook')
            ->with('success', 'Logbook berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit logbook.
     */
    public function edit($id)
    {
        $title   = 'Edit Logbook';
        $user    = Auth::guard('pemagang')->user();

        $logbook = Logbook::where('id', $id)
            ->where('nik', $user->nik)
            ->firstOrFail();

        return view('dashboard.logbook.edit', compact('title', 'logbook'));
    }

    /**
     * Update logbook.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'            => 'required|date',
            'kegiatann_hari_ini' => 'required|string|min:10',
        ], [
            'tanggal.required'            => 'Tanggal wajib diisi.',
            'kegiatann_hari_ini.required' => 'Kegiatan hari ini wajib diisi.',
            'kegiatann_hari_ini.min'      => 'Kegiatan minimal 10 karakter.',
        ]);

        $user    = Auth::guard('pemagang')->user();
        $logbook = Logbook::where('id', $id)
            ->where('nik', $user->nik)
            ->firstOrFail();

        // Cek duplikat tanggal (kecuali milik sendiri)
        $duplikat = Logbook::where('nik', $user->nik)
            ->whereDate('tanggal', $request->tanggal)
            ->where('id', '!=', $id)
            ->exists();

        if ($duplikat) {
            return back()->withErrors([
                'tanggal' => 'Logbook untuk tanggal ini sudah pernah diisi.',
            ])->withInput();
        }

        $logbook->update([
            'tanggal'            => $request->tanggal,
            'kegiatann_hari_ini' => $request->kegiatann_hari_ini,
        ]);

        return redirect()->route('pemagang.logbook')
            ->with('success', 'Logbook berhasil diperbarui!');
    }

    /**
     * Hapus logbook.
     */
    public function destroy($id)
    {
        $user    = Auth::guard('pemagang')->user();
        $logbook = Logbook::where('id', $id)
            ->where('nik', $user->nik)
            ->firstOrFail();

        $logbook->delete();

        return redirect()->route('pemagang.logbook')
            ->with('success', 'Logbook berhasil dihapus.');
    }
}
