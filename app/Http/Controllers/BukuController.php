<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    // READ - Tampilkan semua buku
    public function index(Request $request)
{
    $search = $request->get('search');

    $buku = Buku::with(['penerbit', 'pengarang', 'kategori'])
        ->when($search, function($query) use ($search) {
            $query->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('tahun', 'like', '%' . $search . '%')
                  ->orWhereHas('penerbit', function($q) use ($search) {
                      $q->where('nama', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('pengarang', function($q) use ($search) {
                      $q->where('nama', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('kategori', function($q) use ($search) {
                      $q->where('namaKategori', 'like', '%' . $search . '%');
                  });
        })
        ->get();

    return view('buku.index', compact('buku', 'search'));
}

    // CREATE - Tampilkan form tambah
    public function create()
    {
        $penerbit  = Penerbit::all();
        $pengarang = Pengarang::all();
        $kategori  = Kategori::all();
        return view('buku.create', compact('penerbit', 'pengarang', 'kategori'));
    }

    public function store(Request $request)
{
    $request->validate([
        'judul'         => 'required',
        'tahun'         => 'required|numeric',
        'kodePenerbit'  => 'required',
        'kodePengarang' => 'required',
        'kodeKategori'  => 'required',
        'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('buku', 'public');
    }

    Buku::create($data);
    return redirect('/buku')->with('success', 'Buku berhasil ditambahkan!');
}

    // EDIT - Tampilkan form edit
    public function edit(Buku $buku)
    {
        $penerbit  = Penerbit::all();
        $pengarang = Pengarang::all();
        $kategori  = Kategori::all();
        return view('buku.edit', compact('buku', 'penerbit', 'pengarang', 'kategori'));
    }

    public function update(Request $request, Buku $buku)
{
    $request->validate([
        'judul'         => 'required',
        'tahun'         => 'required|numeric',
        'kodePenerbit'  => 'required',
        'kodePengarang' => 'required',
        'kodeKategori'  => 'required',
        'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('image')) {
        if ($buku->image) {
            Storage::disk('public')->delete($buku->image);
        }
        $data['image'] = $request->file('image')->store('buku', 'public');
    }

    $buku->update($data);
    return redirect('/buku')->with('success', 'Buku berhasil diupdate!');
}

    // DELETE - Hapus buku
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect('/buku')->with('success', 'Buku berhasil dihapus!');
    }
    public function show(Buku $buku)
{
    return view('buku.show', compact('buku'));
}
}