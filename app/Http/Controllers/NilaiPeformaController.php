<?php

namespace App\Http\Controllers;

use App\Models\NilaiPeforma;
use Illuminate\Http\Request;

class NilaiPeformaController extends Controller
{
    public function store(Request $request)
    {
        $nilai = new NilaiPeforma();

        $data_nilai = NilaiPeforma::where([['nisn_siswa', $request->nisn], ['kode_peforma', $request->kode_peforma],])->first();
        if ($data_nilai) {
            return back()->with('info', 'Duplikat data (Data sudah terdaftar di dalam sistem)');
        }
        $nilai->nisn_siswa = $request->nisn;
        $nilai->kode_peforma = $request->kode_peforma;

        switch ($nilai->predik) {
            case $nilai->predik == "Sangat Baik" :
                $hasil = "A";
                break;

            case $nilai->predik == "Baik":
                $hasil = "B";
                break;

            case $nilai->predik == "Cukup":
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
