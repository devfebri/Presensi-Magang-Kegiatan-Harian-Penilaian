<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Pemagang;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PemagangController extends Controller
{
    public function index()
    {
        $title = "Profile";
        $pemagang = Pemagang::where('nik', auth()->guard('pemagang')->user()->nik)->first();
        return view('dashboard.profile.index', compact('title', 'pemagang'));
    }

    public function update(Request $request)
    {
        $pemagang = Pemagang::where('nik', auth()->guard('pemagang')->user()->nik)->first();

        if ($request->hasFile('foto')) {
            $foto = $pemagang->nik . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $pemagang->foto;
        }

        if ($request->password != null) {
            $update = Pemagang::where('nik', auth()->guard('pemagang')->user()->nik)->update([
                'nama_lengkap' => $request->nama_lengkap,
                'telepon' => $request->telepon,
                'password' => Hash::make($request->password),
                'foto' => $foto,
                'updated_at' => Carbon::now(),
            ]);

        } elseif ($request->password == null) {
            $update = Pemagang::where('nik', auth()->guard('pemagang')->user()->nik)->update([
                'nama_lengkap' => $request->nama_lengkap,
                'telepon' => $request->telepon,
                'foto' => $foto,
                'updated_at' => Carbon::now(),
            ]);
        }

        if ($update) {
            if ($request->hasFile('foto')) {
                $folderPath = "public/unggah/pemagang/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return redirect()->back()->with('success', 'Profile updated successfully');
        } else {
            return redirect()->back()->with('error', 'Profile updated failed');
        }
    }

    public function indexAdmin(Request $request)
    {
        $title = "Data Pemagang";

        $departemen = Departemen::get();

        $query = Pemagang::join('departemen as d', 'pemagang.departemen_id', '=', 'd.id')->select('pemagang.*', 'd.kode')->orderBy('d.kode', 'asc')->orderBy('pemagang.nama_lengkap', 'asc');
        if ($request->nama_pemagang) {
            $query->where('pemagang.nama_lengkap', 'like', '%'.$request->nama_pemagang.'%');
        }
        if ($request->kode_departemen) {
            $query->where('d.kode', 'like', '%'.$request->kode_departemen.'%');
        }
        $pemagang = $query->paginate(10);

        return view('admin.pemagang.index', compact('title', 'pemagang', 'departemen'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nik' => 'required|unique:pemagang,nik',
            'departemen_id' => 'required',
            'nama_lengkap' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jabatan' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:pemagang,email',
            'password' => 'required',
        ]);
        $data['password'] = Hash::make($data['password']);
        if ($request->hasFile('foto')) {
            $foto = $request->nik . "." . $request->file('foto')->getClientOriginalExtension();
        }

        $create = Pemagang::create($data);

        if ($create) {
            if ($request->hasFile('foto')) {
                $folderPath = "public/unggah/pemagang/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return to_route('admin.pemagang')->with('success', 'Data Pemagang berhasil disimpan');
        } else {
            return to_route('admin.pemagang')->with('error', 'Data Pemagang gagal disimpan');
        }
    }

    public function edit(Request $request)
    {
        $data = Pemagang::where('nik', $request->nik)->first();
        return $data;
    }

    public function updateAdmin(Request $request)
    {
        $pemagang = Pemagang::where('nik', $request->nik_lama)->first();
        $data = $request->validate([
            'nik' => ['required', Rule::unique('pemagang')->ignore($pemagang)],
            'departemen_id' => 'required',
            'nama_lengkap' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'jabatan' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'email' => ['required', 'email', Rule::unique('pemagang')->ignore($pemagang)],
        ]);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->nik . "." . $request->file('foto')->getClientOriginalExtension();
        }

        $update = Pemagang::where('nik', $request->nik_lama)->update($data);

        if ($update) {
            if ($request->hasFile('foto')) {
                $folderPath = "public/unggah/pemagang/";
                $request->file('foto')->storeAs($folderPath, $data['foto']);
            }
            return to_route('admin.pemagang')->with('success', 'Data Pemagang berhasil diperbarui');
        } else {
            return to_route('admin.pemagang')->with('error', 'Data Pemagang gagal diperbarui');
        }
    }

    public function delete(Request $request)
    {
        $data = Pemagang::where('nik', $request->nik)->first();
        $delete = Pemagang::where('nik', $request->nik)->delete();
        if ($delete && $data->foto) {
            $folderPath = "public/unggah/pemagang/";
            Storage::delete($folderPath . $data->foto);
        }

        if ($delete) {
            return response()->json(['success' => true, 'message' => 'Data Pemagang Berhasil dihapus']);
        } else {
            return response()->json(['success' => false, 'message' => 'Data Pemagang Gagal dihapus']);
        }
    }
}
