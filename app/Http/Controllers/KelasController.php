<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\User;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('waliKelas')->paginate(5);
        $users = User::where('role_id', 2)->get();

        return view('admin.kelas', compact('kelas', 'users'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'kode_kelas' => 'required|unique:kelas|regex:/^\d+$/',
            'nama_kelas' => 'required|string|max:50',
            'wali_kelas' => 'required',
        ]);

        // Buat objek Kelas baru
        $kelas = new Kelas();
        $kelas->kode_kelas = $request->kode_kelas;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->wali_kelas = $request->wali_kelas;

        // Simpan objek Kelas ke dalam database
        $kelas->save();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data kelas berhasil disimpan.');
    }

    public function update(Request $request, $kode_kelas)
    {
        // Validasi data yang diterima dari formulir
        $request->validate([
            'kode_kelas' => 'required|regex:/^\d+$/',
            'nama_kelas' => 'required|string|max:50',
            'wali_kelas' => 'required',
        ]);

        // Temukan kelas berdasarkan kode kelas
        $kelas = Kelas::findOrFail($kode_kelas);

        // Update atribut kelas dengan data yang diterima dari formulir
        // $kelas->update([
        //     'kode_kelas' => $request->kode_kelas,
        //     'nama_kelas' => $request->nama_kelas,
        // ]);

        $kelas->kode_kelas = $request->kode_kelas;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->wali_kelas = $request->wali_kelas;
        $kelas->save();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy($kode_kelas)
    {
        // Temukan kelas berdasarkan kode kelas
        $kelas = Kelas::findOrFail($kode_kelas);

        // Hapus kelas
        $kelas->delete();

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Data kelas berhasil dihapus.');
    }
}
