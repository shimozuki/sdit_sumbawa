<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use App\Models\Matpel;
use App\Models\Nilai;
use App\Models\NilaiTahsin;
use App\Models\Peforma;
use App\Models\Siswa;
use App\Models\Tahsin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RaporController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_matpel = Matpel::all();
        $data_nilai = Nilai::all();
        $data_tahsin = Tahsin::all();
        $data_peforma = Peforma::all();
        $bacaan = Tahsin::where('nama', 'Bacaan Terakhir')->first();
        $kelas = Kelas::where('wali_kelas', Auth::user()->id)->select('kode_kelas')->first();
        $message = null;

        if (Auth::user()->role_id == 1) {
            $data_siswa = Siswa::all();
        } else {
            if ($kelas) {
                $data_siswa = Siswa::where('kelas_id', $kelas->kode_kelas)->get();
                if ($data_siswa->isEmpty()) {
                    $message = 'Belum ada siswa pada kelas Anda';
                }
            } else {
                $data_siswa = collect();
                $message = 'Belum ada siswa pada kelas Anda';
            }
        }

        return view('admin.rapor', compact('data_nilai', 'data_matpel', 'data_siswa', 'data_tahsin', 'data_peforma', 'bacaan', 'message'));
    }

    public function checkKeterangan($nisn)
    {
        $keterangan = NilaiTahsin::select('ket')->where('nisn_siswa', $nisn)->first();
        return response()->json(['ket' => $keterangan ? $keterangan->ket : null]);
    }

    public function checkNilai($nisn)
    {
        $nilai = Nilai::select('ket')->where('nisn_siswa', $nisn)->first();
        return response()->json(['ket' => $nilai ? $nilai->ket : null]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nilai = new Nilai();

        $data_nilai = Nilai::where([['nisn_siswa', $request->nisn], ['kode_matpel', $request->kode_matpel],])->first();
        if ($data_nilai) {
            return back()->with('info', 'Duplikat data (Data sudah terdaftar di dalam sistem)');
        }
        $nilai->nisn_siswa = $request->nisn;
        $nilai->kode_matpel = $request->kode_matpel;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sw = Siswa::findorfail($id);
        return view('rapor-siswa', compact('sw'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
