<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data_siswa = User::with('siswa')->where('role_id', 2)->paginate(10);
        $kelas = Kelas::all();
        return view('admin.user', compact('data_siswa', 'kelas'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('admin.user_create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => 2, // Adjust as needed
            'nisn_siswa' => 1,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user_show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $kelas = Kelas::all();
        return view('admin.user_edit', compact('user', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username,' . $id,
            'password' => 'nullable|string|min:8',
            'nama' => 'required|string',
            'nama_wali' => 'required|string',
            'no_tlpn_wali' => 'required|string',
            'kelas_id' => 'required|string|exists:kelas,kode_kelas',
            'alamat' => 'nullable|string',
        ]);

        $user = User::findOrFail($id);
        $siswa = $user->siswa;

        $siswa->update([
            'nama' => $request->nama,
            'nama_wali' => $request->nama_wali,
            'no_tlpn_wali' => $request->no_tlpn_wali,
            'alamat' => $request->alamat,
            'kelas_id' => $request->kelas_id,
        ]);

        $user->update([
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
