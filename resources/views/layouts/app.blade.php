<!DOCTYPE html>
<html>
<head>
    <title>Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f0f4ff; margin:0; padding:0; display: flex; flex-direction: column; min-height: 100vh;">

{{-- Navigasi Atas --}}
{{-- Navigasi Atas --}}
<nav style="background: #ffffff; padding: 0 32px; height: 70px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 1000;">
    
    {{-- Sisi Kiri: Logo & Menu --}}
    <div style="display: flex; gap: 40px; align-items: center;">
        <a href="/" style="text-decoration: none; display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 24px;">📚</span>
            <span style="color: #1e3a8a; font-size: 18px; font-weight: 700; letter-spacing: -0.5px;">Digital<span style="color: #2563eb;">Library</span></span>
        </a>
        
        @if(session('user'))
        <div style="display: flex; gap: 8px;">
            <a href="/buku" style="color: #64748b; font-size: 14px; font-weight: 500; text-decoration: none; padding: 8px 16px; border-radius: 8px; transition: all 0.3s;" 
               onmouseover="this.style.backgroundColor='#f1f5f9'; this.style.color='#1e3a8a'" 
               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#64748b'">
               Koleksi Buku
            </a>
            <a href="/pinjam" style="color: #64748b; font-size: 14px; font-weight: 500; text-decoration: none; padding: 8px 16px; border-radius: 8px; transition: all 0.3s;" 
               onmouseover="this.style.backgroundColor='#f1f5f9'; this.style.color='#1e3a8a'" 
               onmouseout="this.style.backgroundColor='transparent'; this.style.color='#64748b'">
               Peminjaman
            </a>
        </div>
        @endif
    </div>

    {{-- Sisi Kanan: User Actions --}}
    <div style="display: flex; align-items: center; gap: 20px;">
        @if(session('user'))
            <div style="height: 35px; width: 1px; background: #e2e8f0; margin: 0 10px;"></div>
            <form action="/logout" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3; border-radius: 8px; padding: 8px 18px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s;"
                        onmouseover="this.style.background='#ffe4e6'; this.style.transform='translateY(-1px)'"
                        onmouseout="this.style.background='#fff1f2'; this.style.transform='translateY(0)'">
                    Keluar
                </button>
            </form>
        @else
            <a href="/login" style="background: #2563eb; color: #fff; text-decoration: none; padding: 10px 24px; border-radius: 8px; font-size: 14px; font-weight: 600; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2); transition: all 0.3s;"
               onmouseover="this.style.background='#1d4ed8'; this.style.transform='translateY(-1px)'"
               onmouseout="this.style.background='#2563eb'; this.style.transform='translateY(0)'">
               Masuk Ke Akun
            </a>
        @endif
    </div>
</nav>

<div class="container-fluid py-4" style="flex: 1;">
    <div class="row">
        {{-- Area Sidebar Info Akun (Hanya muncul jika sudah login) --}}
        @if(session('user'))
        <div class="col-md-3 mb-4">
            <div style="background:#fff; border-radius:12px; border:1px solid #dee2e6; padding:20px; position: sticky; top: 20px;">
                <div style="text-align:center; margin-bottom:20px;">
                    <div style="font-size:60px; margin-bottom:10px;">👤</div>
                    <h5 style="color:#1e3a8a; margin:0; font-weight:600;">{{ session('nama') }}</h5>
                    <span style="background:#dcfce7; color:#166534; padding:2px 10px; border-radius:20px; font-size:11px; font-weight:600;">
                        {{ strtoupper(session('role')) }}
                    </span>
                </div>
                
                <div style="border-top: 1px solid #eee; padding-top: 15px;">
                    <p style="font-size:12px; color:#64748b; margin-bottom:5px; text-transform:uppercase; letter-spacing:1px;">Main Navigation</p>
                    <a href="/" style="display:block; padding:10px; color:#1e3a8a; text-decoration:none; border-radius:8px; background:#f0f4ff; margin-bottom:5px; font-weight:500;">📊 Dashboard</a>
                    <a href="/buku" style="display:block; padding:10px; color:#64748b; text-decoration:none; border-radius:8px;">📖 Inventori Buku</a>
                    <a href="/pinjam" style="display:block; padding:10px; color:#64748b; text-decoration:none; border-radius:8px;">🔄 Transaksi</a>
                    <a href="/wishlist" style="display:block; padding:10px; color:#64748b; text-decoration:none; border-radius:8px;">❤️ Wishlist</a>

                </div>

                <div style="margin-top:20px; padding:15px; background:#f8fafc; border-radius:8px; font-size:13px;">
    <div style="display:flex; justify-content:space-between; margin-bottom:5px;">
        <span style="color:#64748b;">Status:</span>
        <span style="color:#22c55e; font-weight:600;">● Online</span>
    </div>
    <div style="display:flex; justify-content:space-between; align-items: center;">
        <span style="color:#64748b;">ID User:</span>
        <span style="font-weight:600; color:#1e3a8a;">
            #@php
                $user = session('user');
                $role = strtolower(session('role'));
                
                // Cek ID berdasarkan role user
                if ($role == 'petugas') {
                    echo $user['kodePetugas'] ?? '1';
                } elseif ($role == 'mahasiswa') {
                    echo $user['kodeMhs'] ?? '-';
                } elseif ($role == 'dosen') {
                    echo $user['kodeDosen'] ?? '-';
                } else {
                    echo is_array($user) ? ($user['id'] ?? '-') : $user;
                }
            @endphp
        </span>
    </div>
</div>
            </div>
        </div>
        @endif

        {{-- Area Konten Utama --}}
        <div class="{{ session('user') ? 'col-md-9' : 'col-12' }}">
            @if(session('error'))
              <div class="alert alert-danger" style="font-size: 13px;">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </div>
</div>

{{-- Footer --}}
<footer style="background: #1e3a8a; color: #fff; padding: 60px 32px 20px; border-top: 4px solid #2563eb;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 40px; margin-bottom: 40px;">
            <div>
                <h3 style="font-size: 20px; margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                    📚 <span style="font-weight: 600;">Digital Library</span>
                </h3>
                <p style="color: #bfcfef; font-size: 14px; line-height: 1.6;">
                    Platform perpustakaan digital terpadu untuk memudahkan akses literasi.
                </p>
            </div>
            <div>
    <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 20px; color: #93c5fd;">Tautan Cepat</h4>
    <ul style="list-style: none; padding: 0; margin: 0; font-size: 14px;">
        <li style="margin-bottom: 10px;">
            <a href="/" style="color: #bfcfef; text-decoration: none;">Dashboard</a>
        </li>
        
        {{-- Logic Tautan Berdasarkan Status Login --}}
        @if(session('user'))
            <li style="margin-bottom: 10px;">
                <a href="/buku" style="color: #bfcfef; text-decoration: none;">Koleksi Buku</a>
            </li>
            <li style="margin-bottom: 10px;">
                <a href="/wishlist" style="color: #bfcfef; text-decoration: none;">Wishlist Buku</a>
            </li>
            <li style="margin-bottom: 10px;">
                <a href="/pinjam" style="color: #bfcfef; text-decoration: none;">Peminjaman</a>
            </li>
        @else
            <li style="margin-bottom: 10px;">
                <a href="/login" style="color: #bfcfef; text-decoration: none; font-weight: 600;">Masuk ke Akun</a>
            </li>
        @endif
    </ul>
</div>
            <div>
                <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 20px; color: #93c5fd;">Hubungi Kami</h4>
                <div style="font-size: 14px; color: #bfcfef; line-height: 1.8;">
                    <p style="margin-bottom: 8px;">TEST</p>
                    <p>✉️ perpustakaandigital111@digitallib.id</p>
                </div>
            </div>
            <div>
                <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 20px; color: #93c5fd;">Ikuti Kami</h4>
                <div style="display: flex; gap: 15px;">
                    <a href="https://web.facebook.com/iqbal.alhafiz.568" target="_blank" rel="noopener noreferrer" style="background: #2563eb; color: #fff; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 50%; text-decoration: none; font-size: 12px;">FB</a>
                    <a href="https://www.instagram.com/iqbassebastian/" target="_blank" rel="noopener noreferrer" style="background: #2563eb; color: #fff; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; border-radius: 50%; text-decoration: none; font-size: 12px;">IG</a>
                </div>
            </div>
        </div>
        <hr style="border: 0; border-top: 1px solid rgba(147, 197, 253, 0.2); margin-bottom: 20px;">
        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 13px; color: #93c5fd;">
            <div>&copy; 2026 <strong>Digital Library</strong>.</div>
            <div style="display: flex; gap: 20px;">
                <span>Privacy Policy</span>
            </div>
        </div>
    </div>
</footer>
</body>
</html>