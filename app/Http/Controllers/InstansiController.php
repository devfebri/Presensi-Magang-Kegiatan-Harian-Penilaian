<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InstansiController extends Controller
{
    public function index(Request $request)
    {
        $title = "Data Instansi";

        $query = Instansi::orderBy('kode', 'asc');
        if ($request->cari_instansi) {
            $query->where('nama', 'like', '%' . $request->cari_instansi . '%');
            $query->orWhere('kode', 'like', '%' . $request->cari_instansi . '%');
        }
        $instansi = $query->paginate(10);

        return view('admin.instansi.index', compact('title', 'instansi'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode' => 'required|unique:instansi,kode',
            'nama' => 'required|string|max:255',
        ]);

        $create = Instansi::create($data);

        if ($create) {
            return to_route('admin.instansi')->with('success', 'Data Instansi berhasil disimpan');
        } else {
            return to_route('admin.instansi')->with('error', 'Data Instansi gagal disimpan');
        }
    }

    public function edit(Request $request)
    {
        $data = Instansi::where('id', $request->id)->first();
        return $data;
    }

    public function update(Request $request)
    {
        $instansi = Instansi::where('id', $request->id)->first();
        $data = $request->validate([
            'kode' => ['required', Rule::unique('instansi')->ignore($instansi)],
            'nama' => 'required|string|max:255',
        ]);

        $update = Instansi::where('id', $request->id)->update($data);

        if ($update) {
            return to_route('admin.instansi')->with('success', 'Data instansi berhasil diperbarui');
        } else {
            return to_route('admin.instansi')->with('error', 'Data instansi gagal diperbarui');
        }
    }

    public function delete(Request $request)
    {
        $instansi = Instansi::find($request->id);

        if (!$instansi) {
            return response()->json(['success' => false, 'message' => 'Data instansi tidak ditemukan']);
        }

        // Check if there are related pemagang
        if ($instansi->pemagang()->count() > 0) {
            return response()->json(['success' => false, 'message' => 'Tidak dapat menghapus instansi karena masih ada data pemagang yang terkait']);
        }

        $delete = $instansi->delete();

        if ($delete) {
            return response()->json(['success' => true, 'message' => 'Data instansi Berhasil dihapus']);
        } else {
            return response()->json(['success' => false, 'message' => 'Data instansi Gagal dihapus']);
        }
    }
}
