@extends('layouts.app')

@section('content')
<div style="background:#f0f4ff; min-height:100vh; padding:32px;">

  <div style="max-width:640px; margin:0 auto;">
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
      <a href="/buku" style="color:#2563eb; text-decoration:none; font-size:13px;">← Kembali</a>
      <h1 style="color:#1a2a5e; font-size:22px; font-weight:500;">Tambah Buku</h1>
    </div>

    @if ($errors->any())
      <div style="background:#fef2f2; border:0.5px solid #fca5a5; color:#dc2626; padding:12px 16px; border-radius:8px; margin-bottom:20px;">
        <ul style="margin:0; padding-left:16px;">
          @foreach ($errors->all() as $error)
            <li style="font-size:13px;">{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div style="background:#fff; border-radius:10px; border:0.5px solid #bfcfef; padding:28px;">
      <form action="/buku" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Judul -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Judul</label>
          <input type="text" name="judul" value="{{ old('judul') }}"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
          @error('judul') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <!-- Tahun -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Tahun</label>
          <input type="number" name="tahun" value="{{ old('tahun') }}"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
          @error('tahun') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <!-- Edisi -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Edisi <span style="color:#94a3b8; font-weight:400;">(Opsional)</span></label>
          <input type="text" name="edisi" value="{{ old('edisi') }}"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
          @error('edisi') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <!-- Seri -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Seri <span style="color:#94a3b8; font-weight:400;">(Opsional)</span></label>
          <input type="text" name="seri" value="{{ old('seri') }}"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
          @error('seri') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <!-- Abstraksi -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Abstraksi <span style="color:#94a3b8; font-weight:400;">(Opsional)</span></label>
          <textarea name="abstraksi" rows="4"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff; resize:vertical;">{{ old('abstraksi') }}</textarea>
          @error('abstraksi') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <!-- Gambar -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">
            Cover Buku <span style="color:#94a3b8; font-weight:400;">(Opsional)</span>
          </label>
          <input type="file" name="image" accept="image/*"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; background:#f8faff;">
          @error('image')
            <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div>
          @enderror
        </div>

        <!-- Penerbit -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Penerbit</label>
          <select name="kodePenerbit" style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
            <option value="">-- Pilih Penerbit --</option>
            @foreach($penerbit as $p)
              <option value="{{ $p->kodePenerbit }}" {{ old('kodePenerbit') == $p->kodePenerbit ? 'selected' : '' }}>{{ $p->nama }}</option>
            @endforeach
          </select>
        </div>

        <!-- Pengarang -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Pengarang</label>
          <select name="kodePengarang" style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
            <option value="">-- Pilih Pengarang --</option>
            @foreach($pengarang as $pg)
              <option value="{{ $pg->kodePengarang }}" {{ old('kodePengarang') == $pg->kodePengarang ? 'selected' : '' }}>{{ $pg->nama }}</option>
            @endforeach
          </select>
        </div>

        <!-- Kategori -->
        <div style="margin-bottom:24px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Kategori</label>
          <select name="kodeKategori" style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategori as $k)
              <option value="{{ $k->kodeKategori }}" {{ old('kodeKategori') == $k->kodeKategori ? 'selected' : '' }}>{{ $k->namaKategori }}</option>
            @endforeach
          </select>
        </div>

        <button type="submit" style="background:#2563eb; color:#fff; border:none; border-radius:8px; padding:10px 24px; font-size:13px; font-weight:500; cursor:pointer;">Simpan</button>
      </form>
    </div>
  </div>

</div>
@endsection