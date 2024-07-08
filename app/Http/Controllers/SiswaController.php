<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::all();
        $siswa = Siswa::whereNOT('nisn', '=', Auth::user()->nisn_siswa)->first();
        $data_siswa = DB::table('siswa')
            ->join('users', 'siswa.nisn', '=', 'users.nisn_siswa')
            ->join('kelas', 'siswa.kelas_id', '=', 'kelas.kode_kelas')
            ->where('users.role_id', 0)
            ->select('siswa.*', 'users.username', 'kelas.nama_kelas')
            ->paginate(6);


        return view('admin.siswa', compact('siswa', 'data_siswa', 'kelas'));
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

        $siswa = new Siswa();
        $user = new User();
        $data_siswa = Siswa::where('nisn', '=', $request->nisn)->first();
        if ($data_siswa) {
            return back()->with('info', 'Duplikat data (Data NISN sudah terdaftar di dalam sistem)');
        }

        $siswa->nisn = $request->nisn;
        $siswa->nama = $request->nama;
        $siswa->alamat = $request->alamat;
        $siswa->nama_wali = $request->nama_wali;
        $siswa->no_tlpn_wali = $request->no_tlpn_wali;
        $siswa->kelas_id = $request->kelas_id;
        $user->username = $request->no_tlpn_wali;
        $user->password = bcrypt($request->password);
        $user->nisn_siswa = $request->nisn;


        $siswa->save();
        $user->save();
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
        $siswa = Siswa::findorfail($id);
        $pass = bcrypt($request->password);
        $user = User::where('nisn_siswa', '=', $id)->update(array('username' => $request->username, 'password' => $pass));

        // $siswa->update($request->all());
        $siswa->nisn = $request->nisn;
        $siswa->nama = $request->nama;
        $siswa->alamat = $request->alamat;
        $siswa->nama_wali = $request->nama_wali;
        $siswa->no_tlpn_wali = $request->no_tlpn_wali;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->save();
        return back()->with('success', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // @dd($id);
        $siswa = Siswa::where('nisn', '=', $id)->firstOrFail();
        $siswa->delete();
        return back()->with('info', 'Data Berhasil Dihapus');
    }

    public function sendWhatsApp($username)
    {


        $message = "Informasi Akun username: $username password: $username";

        $encodedMessage = urlencode($message);

        $whatsappLink = "https://wa.me/$username?text=$encodedMessage";

        return redirect($whatsappLink);
    }
}
