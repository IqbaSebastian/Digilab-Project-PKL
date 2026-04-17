@extends('layouts.app')

@section('content')
<div style="background:#f0f4ff; min-height:100vh; padding:32px;">

  <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <h1 style="color:#1a2a5e; font-size:24px; font-weight:500;">📖 Daftar Peminjaman</h1>
    <a href="/pinjam/create" style="background:#2563eb; color:#fff; padding:9px 18px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:500;">+ Tambah Peminjaman</a>
  </div>

  @if(session('success'))
    <div style="background:#dcfce7; border:0.5px solid #86efac; color:#166534; padding:12px 16px; border-radius:8px; margin-bottom:16px;">
      {{ session('success') }}
    </div>
  @endif

  <div style="background:#fff; border-radius:10px; overflow:hidden; border:0.5px solid #bfcfef;">
    <table style="width:100%; border-collapse:collapse; font-size:13px;">
      <thead>
        <tr style="background:#1e3a8a;">
          <th style="color:#bfcfef; font-weight:500; padding:12px 16px; text-align:left; font-size:12px;">No</th>
          @if(strtolower(session('role')) == 'petugas')
            <th style="color:#bfcfef; font-weight:500; padding:12px 16px; text-align:left; font-size:12px;">Peminjam</th>
          @endif
          <th style="color:#bfcfef; font-weight:500; padding:12px 16px; text-align:left; font-size:12px;">Buku</th>
          <th style="color:#bfcfef; font-weight:500; padding:12px 16px; text-align:left; font-size:12px;">Jatuh Tempo</th>
          <th style="color:#bfcfef; font-weight:500; padding:12px 16px; text-align:left; font-size:12px;">Denda</th>
          <th style="color:#bfcfef; font-weight:500; padding:12px 16px; text-align:left; font-size:12px;">Status</th>
          <th style="color:#bfcfef; font-weight:500; padding:12px 16px; text-align:left; font-size:12px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($pinjam as $i => $p)
        <tr style="border-bottom:0.5px solid #e8eef8;">
          <td style="padding:13px 16px; color:#94a3b8;">{{ $i + 1 }}</td>
          @if(strtolower(session('role')) == 'petugas')
            <td style="padding:13px 16px; color:#1e293b; font-weight:500;">{{ $p->namaPeminjam }}</td>
          @endif
          <td style="padding:13px 16px;">
            @foreach($p->detail as $d)
              <span style="display:block;">• {{ $d->buku->judul ?? '-' }}</span>
            @endforeach
          </td>
          <td style="padding:13px 16px; color:#334155;">{{ date('d M Y', strtotime($p->tglKembali)) }}</td>
          
          {{-- KOLOM DENDA --}}
          <td style="padding:13px 16px;">
            @if($p->denda > 0)
              <span style="color:#dc2626; font-weight:600;">Rp {{ number_format($p->denda, 0, ',', '.') }}</span>
              <div style="font-size:10px; color:#ef4444;">Terlambat</div>
            @else
              <span style="color:#166534;">-</span>
            @endif
          </td>

          <td style="padding:13px 16px;">
            @if($p->status == 1)
              <span style="background:#fef9c3; color:#a16207; padding:3px 10px; border-radius:20px; font-size:11px;">Dipinjam</span>
            @else
              <span style="background:#dcfce7; color:#166534; padding:3px 10px; border-radius:20px; font-size:11px;">Selesai</span>
            @endif
          </td>
          <td style="padding:13px 16px;">
            @if($p->status == 1 && strtolower(session('role')) == 'petugas')
              <form action="/pinjam/{{ $p->kodePinjam }}/kembalikan" method="POST">
                @csrf @method('PUT')
                <button style="background:#dbeafe; color:#1e40af; border:none; border-radius:6px; padding:5px 12px; font-size:12px; cursor:pointer;">Konfirmasi Kembali</button>
              </form>
            @elseif($p->status == 1)
              <span style="color:#64748b; font-size:12px;">Sedang Dipinjam</span>
            @else
              <span style="color:#94a3b8; font-size:12px;">Sudah Dikembalikan</span>
            @endif
          </td>
        </tr>
        @empty
        <tr><td colspan="7" style="padding:32px; text-align:center; color:#94a3b8;">Tidak ada data peminjaman.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection