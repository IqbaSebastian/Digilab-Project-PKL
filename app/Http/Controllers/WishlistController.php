<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    // Menampilkan halaman Daftar Wishlist
    public function index()
    {
        $userId = session('kodeUser');

        // Ambil data wishlist beserta data bukunya
        $wishlist = Wishlist::with('buku')
            ->where('kodeUser', $userId)
            ->get();

        return view('wishlist.index', compact('wishlist'));
    }

    // Menambah atau menghapus wishlist (Toggle)
    public function toggle($idBuku)
    {
        $userId = session('kodeUser');
        $role   = session('role');

        if (!$userId) {
            return back()->with('error', 'Silakan login terlebih dahulu');
        }

        $wishlist = Wishlist::where('kodeUser', $userId)
                            ->where('kodeBuku', $idBuku)
                            ->first();

        if ($wishlist) {
            $wishlist->delete();
        } else {
            Wishlist::create([
                'kodeUser' => $userId,
                'kodeBuku' => $idBuku,
                'role'     => $role ?? 'mahasiswa'
            ]);
        }

        return back();
    }
}