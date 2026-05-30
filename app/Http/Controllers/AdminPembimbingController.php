<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Models\Pembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminPembimbingController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Data Pembimbing';
        $instansi = Instansi::orderBy('nama')->get();

        $query = Pembimbing::with('instansi')->orderBy('nama_lengkap');

        if ($request->cari_nama) {
            $query->where('nama_lengkap', 'like', '%' . $request->cari_nama . '%')
                  ->orWhere('nip', 'like', '%' . $request->cari_nama . '%')
                  ->orWhere('email', 'like', '%' . $request->cari_nama . '%');
        }

        if ($request->filter_instansi) {
            $query->where('instansi_id', $request->filter_instansi);
        }

        $pembimbing = $query->paginate(10)->withQueryString();

        return view('admin.pembimbing.index', compact('title', 'instansi', 'pembimbing'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'instansi_id'  => 'required|exists:instansi,id',
            'nama_lengkap' => 'required|string|max:255',
            'nip'          => 'nullable|string|max:50|unique:pembimbing,nip',
            'email'        => 'required|email|unique:pembimbing,email',
            'password'     => 'required|string|min:6',
            'telepon'      => 'nullable|string|max:20',
            'jabatan'      => 'nullable|string|max:100',
        ], [
            'instansi_id.required' => 'Instansi wajib dipilih.',
            'email.unique'         => 'Email sudah digunakan.',
            'nip.unique'           => 'NIP sudah digunakan.',
            'password.min'         => 'Password minimal 6 karakter.',
        ]);

        $data['password'] = Hash::make($data['password']);

        $create = Pembimbing::create($data);

        if ($create) {
            return to_route('admin.pembimbing')->with('success', 'Data Pembimbing berhasil ditambahkan');
        }
        return to_route('admin.pembimbing')->with('error', 'Data Pembimbing gagal ditambahkan');
    }

    public function edit(Request $request)
    {
        $data = Pembimbing::with('instansi')->where('id', $request->id)->first();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $pembimbing = Pembimbing::findOrFail($request->id);

        $rules = [
            'instansi_id'  => 'required|exists:instansi,id',
            'nama_lengkap' => 'required|string|max:255',
            'nip'          => ['nullable', 'string', 'max:50', Rule::unique('pembimbing', 'nip')->ignore($pembimbing->id)],
            'email'        => ['required', 'email', Rule::unique('pembimbing', 'email')->ignore($pembimbing->id)],
            'telepon'      => 'nullable|string|max:20',
            'jabatan'      => 'nullable|string|max:100',
            'password'     => 'nullable|string|min:6',
        ];

        $data = $request->validate($rules, [
            'email.unique' => 'Email sudah digunakan.',
            'nip.unique'   => 'NIP sudah digunakan.',
        ]);

        // Hanya update password jika diisi
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $update = $pembimbing->update($data);

        if ($update) {
            return to_route('admin.pembimbing')->with('success', 'Data Pembimbing berhasil diperbarui');
        }
        return to_route('admin.pembimbing')->with('error', 'Data Pembimbing gagal diperbarui');
    }

    public function delete(Request $request)
    {
        $pembimbing = Pembimbing::find($request->id);

        if (!$pembimbing) {
            return response()->json(['success' => false, 'message' => 'Data pembimbing tidak ditemukan']);
        }

        $delete = $pembimbing->delete();

        if ($delete) {
            return response()->json(['success' => true, 'message' => 'Data Pembimbing berhasil dihapus']);
        }
        return response()->json(['success' => false, 'message' => 'Data Pembimbing gagal dihapus']);
    }
}
