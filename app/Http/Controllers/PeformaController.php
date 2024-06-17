<?php

namespace App\Http\Controllers;

use App\Models\Peforma;
use Illuminate\Http\Request;

class PeformaController extends Controller
{
    public function index()
    {
        $peforma = Peforma::paginate(5);
        return view('admin.peforma', compact('peforma'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_peforma' => 'required|string|max:255|unique:peforma,kode_peforma',
            'nama' => 'required|string|max:50',
        ]);

        Peforma::create([
            'kode_peforma' => $request->kode_peforma,
            'nama' => $request->nama,
        ]);

        return redirect()->route('peforma.index')->with('success', 'Data peforma berhasil ditambahkan.');
    }

    public function update(Request $request, $kode)
    {
        // Validasi input
        $request->validate([
            'kode' => 'required|string|max:255|unique:peforma,kode_peforma,' . $kode . ',kode_peforma',
            'nama' => 'required|string|max:50',
        ]);

        // Update data di database
        $peforma = peforma::findOrFail($kode);
        $peforma->update([
            'kode_peforma' => $request->kode,
            'nama' => $request->nama,
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('peforma.index')->with('success', 'Data peforma berhasil diubah.');
    }

    public function destroy($kode)
    {
        // Hapus data dari database
        $peforma = peforma::findOrFail($kode);
        $peforma->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('peforma.index')->with('success', 'Data peforma berhasil dihapus.');
    }
}
