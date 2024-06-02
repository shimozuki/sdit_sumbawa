<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tahsin;

class TahsinController extends Controller
{
    public function index()
    {
        $tahsin = Tahsin::paginate(5);
        return view('admin.tahsin', compact('tahsin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_tahsin' => 'required|string|max:255|unique:tahsin,kode_tahsin',
            'nama' => 'required|string|max:50',
        ]);

        Tahsin::create([
            'kode_tahsin' => $request->kode_tahsin,
            'nama' => $request->nama,
        ]);

        return redirect()->route('tahsin.index')->with('success', 'Data Tahsin berhasil ditambahkan.');
    }

    public function update(Request $request, $kode)
    {
        // Validasi input
        $request->validate([
            'kode' => 'required|string|max:255|unique:tahsin,kode_tahsin,' . $kode . ',kode_tahsin',
            'nama' => 'required|string|max:50',
        ]);

        // Update data di database
        $tahsin = Tahsin::findOrFail($kode);
        $tahsin->update([
            'kode_tahsin' => $request->kode,
            'nama' => $request->nama,
        ]);

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('tahsin.index')->with('success', 'Data Tahsin berhasil diubah.');
    }

    public function destroy($kode)
    {
        // Hapus data dari database
        $tahsin = Tahsin::findOrFail($kode);
        $tahsin->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('tahsin.index')->with('success', 'Data Tahsin berhasil dihapus.');
    }
}
