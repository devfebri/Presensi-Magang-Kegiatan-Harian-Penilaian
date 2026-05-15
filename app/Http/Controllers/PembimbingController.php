<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Pemagang;
use App\Models\PenilaianLogbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PembimbingController extends Controller
{
    /**
     * Dashboard utama pembimbing.
     */
    public function dashboard()
    {
        $title      = 'Dashboard Pembimbing';
        $pembimbing = Auth::guard('pembimbing')->user();
        $instansiId = $pembimbing->instansi_id;

        $totalPemagang = Pemagang::where('instansi_id', $instansiId)->count();
        $hariIni       = Carbon::now()->format('Y-m-d');

        $hadir = DB::table('presensi as p')
            ->join('pemagang as k', 'k.nik', '=', 'p.nik')
            ->where('k.instansi_id', $instansiId)
            ->where('p.tanggal_presensi', $hariIni)
            ->count();

        $rekapBulanIni = DB::table('presensi as p')
            ->join('pemagang as k', 'k.nik', '=', 'p.nik')
            ->where('k.instansi_id', $instansiId)
            ->selectRaw("COUNT(p.nik) as jml_kehadiran, SUM(IF(p.jam_masuk > '08:00',1,0)) as jml_terlambat")
            ->whereMonth('p.tanggal_presensi', date('m'))
            ->whereYear('p.tanggal_presensi', date('Y'))
            ->first();

        $daftarPemagang = DB::table('pemagang as k')
            ->leftJoin('presensi as p', function ($join) use ($hariIni) {
                $join->on('p.nik', '=', 'k.nik')
                     ->where('p.tanggal_presensi', '=', $hariIni);
            })
            ->leftJoin('instansi as i', 'i.id', '=', 'k.instansi_id')
            ->where('k.instansi_id', $instansiId)
            ->select('k.nik', 'k.nama_lengkap', 'k.jabatan', 'i.nama as instansi',
                     'p.jam_masuk', 'p.jam_keluar', 'p.tanggal_presensi')
            ->orderBy('k.nama_lengkap')
            ->paginate(10);

        $namaInstansi = DB::table('instansi')->where('id', $instansiId)->value('nama');

        return view('pembimbing.dashboard', compact(
            'title', 'pembimbing', 'totalPemagang', 'hadir',
            'rekapBulanIni', 'daftarPemagang', 'namaInstansi'
        ));
    }

    /**
     * Daftar pemagang + jumlah logbook + nilai (hanya satu instansi).
     */
    public function logbookIndex()
    {
        $title      = 'Logbook Pemagang';
        $pembimbing = Auth::guard('pembimbing')->user();
        $instansiId = $pembimbing->instansi_id;

        $namaInstansi = DB::table('instansi')->where('id', $instansiId)->value('nama');

        $daftarPemagang = Pemagang::where('instansi_id', $instansiId)
            ->withCount(['logbooks'])
            ->with(['penilaianLogbook' => function ($q) use ($pembimbing) {
                $q->where('pembimbing_id', $pembimbing->id);
            }])
            ->orderBy('nama_lengkap')
            ->get();

        return view('pembimbing.logbook.index', compact(
            'title', 'pembimbing', 'namaInstansi', 'daftarPemagang'
        ));
    }

    /**
     * Detail logbook satu pemagang + penilaian yang sudah ada.
     */
    public function logbookPemagang($nik)
    {
        $title      = 'Detail Logbook';
        $pembimbing = Auth::guard('pembimbing')->user();
        $instansiId = $pembimbing->instansi_id;

        $pemagang = Pemagang::where('nik', $nik)
            ->where('instansi_id', $instansiId)
            ->firstOrFail();

        $namaInstansi = DB::table('instansi')->where('id', $instansiId)->value('nama');

        $logbooks = Logbook::where('nik', $nik)
            ->orderBy('tanggal', 'desc')
            ->paginate(15);

        // Cek apakah sudah ada penilaian dari pembimbing ini
        $penilaian = PenilaianLogbook::where('pembimbing_id', $pembimbing->id)
            ->where('nik', $nik)
            ->first();

        $totalLogbook = Logbook::where('nik', $nik)->count();

        return view('pembimbing.logbook.show', compact(
            'title', 'pembimbing', 'namaInstansi', 'pemagang',
            'logbooks', 'penilaian', 'totalLogbook'
        ));
    }

    /**
     * Simpan atau update penilaian keseluruhan logbook pemagang.
     */
    public function nilaiLogbook(Request $request, $nik)
    {
        $request->validate([
            'nilai'   => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string|max:1000',
        ], [
            'nilai.required' => 'Nilai wajib diisi.',
            'nilai.min'      => 'Nilai minimal 0.',
            'nilai.max'      => 'Nilai maksimal 100.',
        ]);

        $pembimbing = Auth::guard('pembimbing')->user();
        $instansiId = $pembimbing->instansi_id;

        // Pastikan pemagang satu instansi
        Pemagang::where('nik', $nik)
            ->where('instansi_id', $instansiId)
            ->firstOrFail();

        PenilaianLogbook::updateOrCreate(
            [
                'pembimbing_id' => $pembimbing->id,
                'nik'           => $nik,
            ],
            [
                'nilai'   => $request->nilai,
                'catatan' => $request->catatan,
            ]
        );

        return redirect()->route('pembimbing.logbook.pemagang', $nik)
            ->with('success', 'Penilaian logbook berhasil disimpan!');
    }
}
