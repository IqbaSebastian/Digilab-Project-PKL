@extends('layouts.app')

@section('content')
<div style="background:#f0f4ff; min-height:100vh; padding:32px;">

  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <h1 style="color:#1a2a5e; font-size:24px; font-weight:500;">📚 Daftar Buku</h1>
    @if(session('role') == 'petugas')
      <a href="/buku/create" style="background:#2563eb; color:#fff; padding:9px 18px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:500;">+ Tambah Buku</a>
    @endif
  </div>

  @if(session('success'))
    <div style="background:#dcfce7; border:0.5px solid #86efac; color:#166534; padding:12px 16px; border-radius:8px; margin-bottom:16px;">
      {{ session('success') }}
    </div>
  @endif

  <form method="GET" action="/buku" style="margin-bottom:24px;">
    <div style="display:flex; gap:10px;">
      <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari judul, pengarang, penerbit, kategori..."
        style="flex:1; padding:10px 14px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#fff;">
      <button type="submit" style="background:#2563eb; color:#fff; border:none; border-radius:8px; padding:10px 20px; font-size:13px; font-weight:500; cursor:pointer;">Cari</button>
      @if($search)
        <a href="/buku" style="background:#f1f5f9; color:#64748b; border:0.5px solid #cbd5e1; border-radius:8px; padding:10px 16px; font-size:13px; text-decoration:none;">Reset</a>
      @endif
    </div>
  </form>

  @if($search)
    <p style="color:#64748b; font-size:13px; margin-bottom:16px;">
      Hasil untuk <strong style="color:#1e3a8a;">"{{ $search }}"</strong> — {{ $buku->count() }} buku ditemukan
    </p>
  @endif

  {{-- Card Grid --}}
  <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap:20px;">
    @forelse($buku as $b)
    <div style="background:#fff; border-radius:12px; border:0.5px solid #bfcfef; overflow:hidden; transition:box-shadow 0.2s; position:relative;"> 

      {{-- TOMBOL WISHLIST (Pindah ke Pojok Kanan Atas Gambar agar tidak bertabrakan) --}}
      @if(session('kodeUser'))
      <div style="position: absolute; top: 12px; right: 12px; z-index: 20;">
          <form action="/wishlist/toggle/{{ $b->kodeBuku }}" method="POST">
              @csrf
              @php
                  $isWishlist = \App\Models\Wishlist::where('kodeUser', session('kodeUser'))
                                                   ->where('kodeBuku', $b->kodeBuku)
                                                   ->exists();
              @endphp
              <button type="submit" style="background: rgba(255,255,255,0.9); border: none; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.15); transition: transform 0.2s;"
                      onmouseover="this.style.transform='scale(1.1)'" 
                      onmouseout="this.style.transform='scale(1)'">
                  <span style="color: {{ $isWishlist ? '#dc2626' : '#94a3b8' }}; font-size: 16px;">
                      {{ $isWishlist ? '❤️' : '🤍' }}
                  </span>
              </button>
          </form>
      </div>
      @endif

      {{-- Cover Gambar --}}
      <a href="/buku/{{ $b->kodeBuku }}">
        @if($b->image)
          <img src="{{ asset('storage/' . $b->image) }}" style="width:100%; height:300px; object-fit:cover; display:block;">
        @else
          <div style="width:100%; height:300px; background:#e8eef8; display:flex; align-items:center; justify-content:center;">
            <span style="font-size:48px;">📖</span>
          </div>
        @endif
      </a>

      {{-- Info Buku --}}
      <div style="padding:14px;">
        <a href="/buku/{{ $b->kodeBuku }}" style="text-decoration:none;">
          <h3 style="color:#1e3a8a; font-size:14px; font-weight:500; margin:0 0 6px; line-height:1.4;">{{ $b->judul }}</h3>
        </a>
        <p style="color:#64748b; font-size:12px; margin:0 0 4px;">{{ $b->pengarang->nama ?? '-' }}</p>
        <p style="color:#94a3b8; font-size:11px; margin:0 0 10px;">{{ $b->penerbit->nama ?? '-' }} · {{ $b->tahun }}</p>

        <div style="display:flex; justify-content:space-between; align-items:center;">
          <span style="background:#e0f2fe; color:#0369a1; border:0.5px solid #7dd3fc; padding:2px 8px; border-radius:20px; font-size:11px;">{{ $b->kategori->namaKategori ?? '-' }}</span>

          {{-- Navigasi Petugas (Hanya Edit & Hapus agar lebih lega) --}}
          @if(session('role') == 'petugas')
            <div style="display:flex; gap:4px;">
              <a href="/buku/{{ $b->kodeBuku }}/edit" style="background:#fefce8; color:#a16207; border:0.5px solid #fde68a; border-radius:6px; padding:4px 8px; font-size:11px; text-decoration:none;">Edit</a>
              <form action="/buku/{{ $b->kodeBuku }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Yakin hapus?')" style="background:#fef2f2; color:#dc2626; border:0.5px solid #fca5a5; border-radius:6px; padding:4px 8px; font-size:11px; cursor:pointer;">Hapus</button>
              </form>
            </div>
          @endif
        </div>
      </div>

    </div>
    @empty
    <div style="grid-column:1/-1; text-align:center; padding:48px; color:#94a3b8; font-size:13px;">
      Tidak ada buku ditemukan
    </div>
    @endforelse
  </div>

</div>
@endsection