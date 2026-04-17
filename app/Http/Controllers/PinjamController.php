<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use App\Models\PinjamDetail;
use App\Models\Buku;
use App\Models\Mahasiswa;
use App\Models\Petugas;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Carbon\Carbon; // Pastikan Carbon diimport

class PinjamController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $role   = session('role');

        $pinjam = Pinjam::with(['mahasiswa', 'dosen', 'petugas', 'detail.buku'])
            ->when($role != 'petugas', function($query) {
                $query->where('kodePeminjam', session('kodeUser'))
                      ->where('tipePeminjam', session('role') == 'mahasiswa' ? 2 : 3);
            })
            ->orderBy('kodePinjam', 'desc')
            ->get();

        // --- LOGIKA HITUNG DENDA ---
        $tarifDenda = 1000; // Rp 1.000 per hari
        $hariIni = Carbon::now()->startOfDay();

        foreach ($pinjam as $p) {
            $p->denda = 0;
            
            // Denda hanya dihitung jika status masih "Dipinjam" (status == 1)
            if ($p->status == 1) {
                $jatuhTempo = Carbon::parse($p->tglKembali)->startOfDay();
                
                if ($hariIni->gt($jatuhTempo)) {
                    $selisihHari = $hariIni->diffInDays($jatuhTempo);
                    $p->denda = $selisihHari * $tarifDenda;
                }
            }
        }
        // ---------------------------

        return view('pinjam.index', compact('pinjam', 'search'));
    }

    public function create()
    {
        $buku      = Buku::all();
        $mahasiswa = Mahasiswa::all();
        $dosen     = Dosen::all();
        $petugas   = Petugas::all();
        return view('pinjam.create', compact('buku', 'mahasiswa', 'dosen', 'petugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tglPinjam'  => 'required|date',
            'tglKembali' => 'required|date|after:tglPinjam',
            'kodeBuku'   => 'required|array|min:1',
        ]);

        $role = session('role');
        $tipePeminjam = $role == 'mahasiswa' ? 2 : ($role == 'dosen' ? 3 : 1);
        $kodePeminjam = session('kodeUser');
        $kodePetugas  = 0;

        $lastPinjam = Pinjam::max('kodePinjam');
        $kodePinjam = $lastPinjam ? $lastPinjam + 1 : 1;

        Pinjam::create([
            'kodePinjam'   => $kodePinjam,
            'kodePetugas'  => $kodePetugas,
            'kodePeminjam' => $kodePeminjam,
            'tipePeminjam' => $tipePeminjam,
            'tglPinjam'    => $request->tglPinjam,
            'tglKembali'   => $request->tglKembali,
            'keterangan'   => $request->keterangan ?? '',
            'status'       => 1,
        ]);

        foreach ($request->kodeBuku as $kb) {
            PinjamDetail::create([
                'kodePinjam' => $kodePinjam,
                'kodeBuku'   => $kb,
            ]);
        }

        return redirect('/pinjam')->with('success', 'Peminjaman berhasil dicatat!');
    }

    public function kembalikan(Pinjam $pinjam)
    {
        // Saat dikembalikan, tglKembali diupdate ke hari ini
        $pinjam->update([
            'tglKembali' => now(),
            'status'     => 2,
        ]);

        return redirect('/pinjam')->with('success', 'Buku berhasil dikembalikan!');
    }
}