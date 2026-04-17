@extends('layouts.app')

@section('content')
<div style="background:#f0f4ff; min-height:100vh; padding:32px;">
  <div style="max-width:640px; margin:0 auto;">

    <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
      <a href="/pinjam" style="color:#2563eb; text-decoration:none; font-size:13px;">← Kembali</a>
      <h1 style="color:#1a2a5e; font-size:22px; font-weight:500;">Tambah Peminjaman</h1>
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

      {{-- Info peminjam dari session --}}
      <div style="background:#f0f4ff; border-radius:8px; padding:12px 16px; margin-bottom:24px; font-size:13px; color:#1e3a8a;">
        Peminjam: <strong>{{ session('nama') }}</strong>
        <span style="background:#2563eb; color:#fff; padding:2px 8px; border-radius:20px; font-size:11px; margin-left:6px;">{{ ucfirst(session('role')) }}</span>
      </div>

      <form action="/pinjam" method="POST">
        @csrf

        <!-- Buku -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">
            Buku <span style="color:#94a3b8; font-weight:400;">(bisa pilih lebih dari 1)</span>
          </label>
          <div style="border:0.5px solid #93c5fd; border-radius:8px; background:#f8faff; max-height:200px; overflow-y:auto; padding:8px 12px;">
            @foreach($buku as $b)
              <label style="display:flex; align-items:center; gap:8px; padding:6px 0; cursor:pointer; font-size:13px; color:#1e293b;">
                <input type="checkbox" name="kodeBuku[]" value="{{ $b->kodeBuku }}"
                  {{ in_array($b->kodeBuku, old('kodeBuku', [])) ? 'checked' : '' }}>
                {{ $b->judul }}
              </label>
            @endforeach
          </div>
          @error('kodeBuku') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <!-- Tanggal Pinjam -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Tanggal Pinjam</label>
          <input type="datetime-local" name="tglPinjam" value="{{ old('tglPinjam', now()->format('Y-m-d\TH:i')) }}"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
          @error('tglPinjam') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <!-- Tanggal Kembali -->
        <div style="margin-bottom:18px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Tanggal Kembali</label>
          <input type="datetime-local" name="tglKembali" value="{{ old('tglKembali') }}"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff;">
          @error('tglKembali') <div style="color:#dc2626; font-size:12px; margin-top:4px;">{{ $message }}</div> @enderror
        </div>

        <!-- Keterangan -->
        <div style="margin-bottom:24px;">
          <label style="display:block; color:#1e3a8a; font-size:13px; font-weight:500; margin-bottom:6px;">Keterangan <span style="color:#94a3b8; font-weight:400;">(Opsional)</span></label>
          <textarea name="keterangan" rows="3"
            style="width:100%; padding:9px 12px; border:0.5px solid #93c5fd; border-radius:8px; font-size:13px; color:#1e293b; outline:none; background:#f8faff; resize:vertical;">{{ old('keterangan') }}</textarea>
        </div>

        <div style="display:flex; gap:10px;">
          <button type="submit" style="background:#2563eb; color:#fff; border:none; border-radius:8px; padding:10px 24px; font-size:13px; font-weight:500; cursor:pointer;">Simpan</button>
          <a href="/pinjam" style="background:#f1f5f9; color:#64748b; border:0.5px solid #cbd5e1; border-radius:8px; padding:10px 24px; font-size:13px; font-weight:500; text-decoration:none;">Batal</a>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection