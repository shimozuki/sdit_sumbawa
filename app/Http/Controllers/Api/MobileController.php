<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NilaiTahsin;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Nilai;
use App\Models\NilaiPeforma;
use App\Models\Matpel;
use App\Models\Kelas;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class MobileController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        // Coba melakukan login
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->plainTextToken;

            // Mendapatkan data siswa dan kelas
            $siswa = $user->siswa;
            $kelas = $siswa ? $siswa->kelas : null;

            $userData = [
                'username' => $user->username,
                'role_id' => $user->role_id,
                'nama_wali' => $siswa ? $siswa->nama_wali : null,
                'siswa' => [
                    'nisn' => $siswa ? $siswa->nisn : null,
                    'nama' => $siswa ? $siswa->nama : null,
                    'kelas' => $kelas ? $kelas->nama_kelas : null
                ]
            ];

            return response()->json([
                'token' => $token,
                'user' => $userData
            ], 200);
        } else {
            return response()->json(['error' => 'Credentials do not match'], 401);
        }
    }

    public function list_siswa(Request $request)
    {
        $no_hp = $request->no_hp;

        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $data = Siswa::with('kelas')->where('no_tlpn_wali', $no_hp)->get();

        return response()->json(['data' => $data], 200);
    }

    public function hafalan(Request $request)
    {
        $nisn = $request->nisn;

        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $data = Nilai::with('matpel')->where('nisn_siswa', $nisn)->get();

        return response()->json(['data' => $data], 200);
    }

    public function showRapot(Request $request)
    {
        $id = $request->id;
        // @dd($request);
        $siswa = Siswa::where('nisn', '=', Auth::user()->nisn_siswa)->firstOrFail();
        $data_siswa = Siswa::where('nisn', '=', $id)->firstOrFail();
        $data_nilai = Nilai::where('nisn_siswa', '=', $id)->get();
        $data_nilaitahsin = NilaiTahsin::where('nisn_siswa', '=', $id)->get();
        $data_peforma = NilaiPeforma::where('nisn_siswa', '=', $id)->get();
        $data_matpel = Matpel::all();
        $ket_Tahsin = NilaiTahsin::select('ket')->first();
        $ket_tahfiz = Nilai::select('ket')->first();
        $kelas = Kelas::where('kode_kelas', '=', $data_siswa->kelas_id)->select('nama_kelas')->first();
        $years = date('Y');
        $nextyears = $years + 1;

        $pdf = PDF::loadView('rapot_pdf', compact('siswa', 'data_siswa', 'data_matpel', 'data_nilai', 'kelas', 'years', 'nextyears', 'data_nilaitahsin', 'data_peforma', 'ket_Tahsin', 'ket_tahfiz'));

        return $pdf->download('rapot.pdf');
    }

    public function kelas(Request $request)
    {
        $nisn = $request->nisn;

        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $data = Siswa::with('kelas')->where('nisn', $nisn)->get();

        return response()->json(['data' => $data], 200);
    }
}
