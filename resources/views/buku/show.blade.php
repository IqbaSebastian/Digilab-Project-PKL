@extends('layouts.app')

@section('content')

<div style="background:#f0f4ff; min-height:100vh; padding:32px;">

  <div style="max-width:640px; margin:0 auto;">
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:24px;">
      <a href="/buku" style="color:#2563eb; text-decoration:none; font-size:13px;">← Kembali</a>
      <h1 style="color:#1a2a5e; font-size:22px; font-weight:500;">Detail Buku</h1>
    </div>

    <div style="background:#fff; border-radius:10px; border:0.5px solid #bfcfef; padding:28px;">

      <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:24px;">
        <div>
          <h2 style="color:#1e3a8a; font-size:20px; font-weight:500; margin-bottom:4px;">{{ $buku->judul }}</h2>
          <span style="background:#dbeafe; color:#1e40af; border:0.5px solid #93c5fd; padding:3px 10px; border-radius:20px; font-size:11px;">{{ $buku->tahun }}</span>
        </div>
        @if(session('role') == 'petugas')
        <a href="/buku/{{ $buku->kodeBuku }}/edit" style="background:#2563eb; color:#fff; padding:8px 16px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:500;">Edit</a>
        @endif
      </div>

      <table style="width:100%; border-collapse:collapse; font-size:13px;">
        <tr style="border-bottom:0.5px solid #e8eef8;">
          <td style="padding:12px 0; color:#64748b; width:160px;">Kode Buku</td>
          <td style="padding:12px 0; color:#1e293b; font-weight:500;">{{ $buku->kodeBuku }}</td>
        </tr>
        <tr style="border-bottom:0.5px solid #e8eef8;">
          <td style="padding:12px 0; color:#64748b;">Penerbit</td>
          <td style="padding:12px 0; color:#1e293b;">{{ $buku->penerbit->nama ?? '-' }}</td>
        </tr>
        <tr style="border-bottom:0.5px solid #e8eef8;">
          <td style="padding:12px 0; color:#64748b;">Pengarang</td>
          <td style="padding:12px 0; color:#1e293b;">{{ $buku->pengarang->nama ?? '-' }}</td>
        </tr>
        <tr style="border-bottom:0.5px solid #e8eef8;">
          <td style="padding:12px 0; color:#64748b;">Kategori</td>
          <td style="padding:12px 0;">
            <span style="background:#e0f2fe; color:#0369a1; border:0.5px solid #7dd3fc; padding:3px 10px; border-radius:20px; font-size:11px;">{{ $buku->kategori->namaKategori ?? '-' }}</span>
          </td>
        </tr>
        <tr style="border-bottom:0.5px solid #e8eef8;">
          <td style="padding:12px 0; color:#64748b;">Edisi</td>
          <td style="padding:12px 0; color:#1e293b;">{{ $buku->edisi ?? '-' }}</td>
        </tr>
        <tr style="border-bottom:0.5px solid #e8eef8;">
          <td style="padding:12px 0; color:#64748b;">Seri</td>
          <td style="padding:12px 0; color:#1e293b;">{{ $buku->seri ?? '-' }}</td>
        </tr>
        <tr>
          <td style="padding:12px 0; color:#64748b; vertical-align:top;">Abstraksi</td>
          <td style="padding:12px 0; color:#1e293b; line-height:1.6;">{{ $buku->abstraksi ?? '-' }}</td>
        </tr>
      </table>

    </div>
  </div>

</div>
@endsection