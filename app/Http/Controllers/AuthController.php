<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('user')) {
            return redirect('/buku');
        }
        return view('auth.login');
    }

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $username = $request->username;
    $password = md5($request->password);

    // Cek ke tabel Petugas
    $user = Petugas::where('username', $username)
                   ->where('password', $password)
                   ->first();

    if ($user) {
        session([
            'user'     => $user,
            'role'     => 'petugas',
            'nama'     => $user->nama,
            'kodeUser' => $user->kodePetugas,
        ]);
        return redirect('/buku');
    }

    // Cek ke tabel Mahasiswa
    $user = Mahasiswa::where('username', $username)
                     ->where('password', $password)
                     ->first();

    if ($user) {
        session([
            'user'     => $user,
            'role'     => 'mahasiswa',
            'nama'     => $user->nama,
            'kodeUser' => $user->kodeMhs,
        ]);
        return redirect('/buku');
    }

    // Cek ke tabel Dosen
    $user = Dosen::where('username', $username)
                 ->where('password', $password)
                 ->first();

    if ($user) {
        session([
            'user'     => $user,
            'role'     => 'dosen',
            'nama'     => $user->nama,
            'kodeUser' => $user->kodeDosen,
        ]);
        return redirect('/buku');
    }

    return back()->with('error', 'Username atau password salah!');
}

    public function logout()
{
    session()->flush();
    return redirect('/');
}
}