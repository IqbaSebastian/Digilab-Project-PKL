@extends('layouts.app')

@section('content')
<div style="background:#f0f4ff; min-height:100vh; padding:32px;">

  <div style="max-width:640px; margin:0 auto;">
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
      <a href="/buku" style="color:#2563eb; text-decoration:none; font-size:13px;">← Kembali</a>
      <h1 style="color:#1a2a5e; font-size:22px; font-weight:500;">Edit Buku</h1>
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
      <form action="/buku/{{ $buku->kodeBuku }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Judul</label>
          <input type="text" name="judul" value="{{ old('judul', $buku->judul) }}"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
          @error('judul') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <!-- Tahun -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Tahun</label>
          <input type="number" name="tahun" value="{{ old('tahun', $buku->tahun) }}"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
          @error('tahun') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <!-- Edisi -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Edisi <span style="color:#94a3b8; font-weight:400;">(Opsional)</span></label>
          <input type="text" name="edisi" value="{{ old('edisi', $buku->edisi) }}"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
          @error('edisi') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <!-- Seri -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Seri <span style="color:#94a3b8; font-weight:400;">(Opsional)</span></label>
          <input type="text" name="seri" value="{{ old('seri', $buku->seri) }}"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
          @error('seri') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <!-- Abstraksi -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Abstraksi <span style="color:#94a3b8; font-weight:400;">(Opsional)</span></label>
          <textarea name="abstraksi" rows="4"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff; resize:vertical;">{{ old('abstraksi', $buku->abstraksi) }}</textarea>
          @error('abstraksi') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <!-- Penerbit -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Penerbit</label>
          <select name="kodePenerbit" style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
            <option value="">-- Pilih Penerbit --</option>
            @foreach($penerbit as $p)
              <option value="{{ $p->kodePenerbit }}" {{ old('kodePenerbit', $buku->kodePenerbit) == $p->kodePenerbit ? 'selected' : '' }}>{{ $p->nama }}</option>
            @endforeach
          </select>
        </div>

        <!-- Pengarang -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Pengarang</label>
          <select name="kodePengarang" style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
            <option value="">-- Pilih Pengarang --</option>
            @foreach($pengarang as $pg)
              <option value="{{ $pg->kodePengarang }}" {{ old('kodePengarang', $buku->kodePengarang) == $pg->kodePengarang ? 'selected' : '' }}>{{ $pg->nama }}</option>
            @endforeach
          </select>
        </div>

        <!-- Gambar -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">
            Cover Buku <span style="color:#94a3b8; font-weight:400;">(Opsional)</span>
          </label>
          @if($buku->image)
            <img src="{{ asset('storage/' . $buku->image) }}"
              style="width:100px; border-radius:8px; margin-bottom:10px; border:0.5px solid #93c5fd; display:block;">
            <p style="font-size:12px; color:#64748b; margin-bottom:8px;">Upload baru untuk mengganti.</p>
          @endif
          <input type="file" name="image" accept="image/*"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; background:#f8faff;">
          @error('image')
            <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div>
          @enderror
        </div>

        <!-- Kategori -->
        <div style="margin-bottom:24px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Kategori</label>
          <select name="kodeKategori" style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategori as $k)
              <option value="{{ $k->kodeKategori }}" {{ old('kodeKategori', $buku->kodeKategori) == $k->kodeKategori ? 'selected' : '' }}>{{ $k->namaKategori }}</option>
            @endforeach
          </select>
        </div>

        <div style="display:flex; gap:10px;">
          <button type="submit" style="background:#2563eb; color:#fff; border:none; border-radius:8px; padding:10px 24px; font-size:13px; font-weight:500; cursor:pointer;">Update</button>
          <a href="/buku" style="background:#f1f5f9; color:#64748b; border:0.5px solid #cbd5e1; border-radius:8px; padding:10px 24px; font-size:13px; font-weight:500; text-decoration:none;">Batal</a>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection