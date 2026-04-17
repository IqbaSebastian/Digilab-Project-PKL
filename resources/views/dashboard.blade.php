@extends('layouts.app')

@section('content')
    {{-- Hero Section --}}
    <div style="text-align:center; padding:40px 32px;">
        <div style="font-size:64px; margin-bottom:16px;">📚</div>
        <h1 style="color:#1a2a5e; font-size:32px; font-weight:600; margin-bottom:12px;">Selamat Datang!</h1>
        <p style="color:#64748b; font-size:16px; max-width:550px; margin:0 auto 32px; line-height:1.7;">
            Pantau aktivitas perpustakaan digital Anda melalui panel statistik di bawah ini.
        </p>
    </div>

    {{-- Stats Card --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(200px, 1fr)); gap:20px; padding-bottom: 40px;">
        
        <div style="background:#fff; border-radius:12px; border:1px solid #dee2e6; padding:24px; text-align:center; transition: 0.3s;">
            <div style="font-size:32px; margin-bottom:8px;">📖</div>
            <div style="color:#1e3a8a; font-size:28px; font-weight:700;">{{ \App\Models\Buku::count() }}</div>
            <div style="color:#64748b; font-size:13px; font-weight:500; text-transform:uppercase; letter-spacing:0.5px;">Total Buku</div>
        </div>

        <div style="background:#fff; border-radius:12px; border:1px solid #dee2e6; padding:24px; text-align:center;">
            <div style="font-size:32px; margin-bottom:8px;">👥</div>
            <div style="color:#1e3a8a; font-size:28px; font-weight:700;">{{ \App\Models\Mahasiswa::count() + \App\Models\Dosen::count() }}</div>
            <div style="color:#64748b; font-size:13px; font-weight:500; text-transform:uppercase; letter-spacing:0.5px;">Total Anggota</div>
        </div>

        <div style="background:#fff; border-radius:12px; border:1px solid #dee2e6; padding:24px; text-align:center;">
            <div style="font-size:32px; margin-bottom:8px;">🔄</div>
            <div style="color:#1e3a8a; font-size:28px; font-weight:700;">{{ \App\Models\Pinjam::where('status', 1)->count() }}</div>
            <div style="color:#64748b; font-size:13px; font-weight:500; text-transform:uppercase; letter-spacing:0.5px;">Buku Dipinjam</div>
        </div>
        
    </div>
@endsection