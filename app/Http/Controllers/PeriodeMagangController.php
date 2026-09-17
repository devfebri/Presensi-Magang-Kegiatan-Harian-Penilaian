<?php

namespace App\Http\Controllers;

use App\Models\PeriodeMagang;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PeriodeMagangController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Periode Magang';

        $query = PeriodeMagang::orderBy('tanggal_mulai', 'desc');

        if ($request->cari) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }

        $periode = $query->paginate(10);

        return view('admin.periode-magang.index', compact('title', 'periode'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'            => 'required|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan'      => 'nullable|string',
        ]);

        // Jika is_aktif di-centang, nonaktifkan semua periode lain
        if ($request->has('is_aktif')) {
            PeriodeMagang::where('is_aktif', true)->update(['is_aktif' => false]);
            $data['is_aktif'] = true;
        } else {
            $data['is_aktif'] = false;
        }

        $create = PeriodeMagang::create($data);

        if ($create) {
            return to_route('admin.periode-magang')->with('success', 'Periode magang berhasil disimpan');
        } else {
            return to_route('admin.periode-magang')->with('error', 'Periode magang gagal disimpan');
        }
    }

    public function edit(Request $request)
    {
        $data = PeriodeMagang::where('id', $request->id)->first();
        return $data;
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama'            => 'required|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan'      => 'nullable|string',
        ]);

        // Jika is_aktif di-centang, nonaktifkan semua periode lain
        if ($request->has('is_aktif')) {
            PeriodeMagang::where('is_aktif', true)->where('id', '!=', $request->id)->update(['is_aktif' => false]);
            $data['is_aktif'] = true;
        } else {
            $data['is_aktif'] = false;
        }

        $update = PeriodeMagang::where('id', $request->id)->update($data);

        if ($update !== false) {
            return to_route('admin.periode-magang')->with('success', 'Periode magang berhasil diperbarui');
        } else {
            return to_route('admin.periode-magang')->with('error', 'Periode magang gagal diperbarui');
        }
    }

    public function delete(Request $request)
    {
        $periode = PeriodeMagang::find($request->id);

        if (!$periode) {
            return response()->json(['success' => false, 'message' => 'Data periode magang tidak ditemukan']);
        }

        $delete = $periode->delete();

        if ($delete) {
            return response()->json(['success' => true, 'message' => 'Data periode magang berhasil dihapus']);
        } else {
            return response()->json(['success' => false, 'message' => 'Data periode magang gagal dihapus']);
        }
    }
}
