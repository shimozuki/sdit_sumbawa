<?php

namespace App\Http\Controllers;

use App\Models\NilaiTahsin;
use Illuminate\Http\Request;

class NilaiTahsinController extends Controller
{
    public function store(Request $request)
    {
        $nilai = new NilaiTahsin();

        $data_nilai = NilaiTahsin::where([['nisn_siswa', $request->nisn], ['kode_tahsin', $request->kode_tahsin],])->first();
        if ($data_nilai) {
            return back()->with('info', 'Duplikat data (Data sudah terdaftar di dalam sistem)');
        }
        $nilai->nisn_siswa = $request->nisn;
        $nilai->kode_tahsin = $request->kode_tahsin;
        $nilai->nilai = $request->nilai;
        $nilai->ket = $request->ket;

        switch ($nilai->nilai) {
            case $nilai->nilai >= 93 && $nilai->nilai <= 100:
                $hasil = "A";
                break;

            case $nilai->nilai >= 85 && $nilai->nilai < 93:
                $hasil = "B";
                break;

            case $nilai->nilai >= 77 && $nilai->nilai < 85:
                $hasil = "C";
                break;

            default:
                $hasil = "D";
                break;
        }
        $nilai->predikat = $hasil;
        $nilai->save();
        return back()->with('success', 'Data Berhasil ditambah');
    }
}
