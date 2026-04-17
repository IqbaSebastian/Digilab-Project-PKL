@extends('layouts.app')

@section('content')
<div style="background:#f0f4ff; min-height:100vh; padding:32px;"> {{-- Tambahkan background agar konsisten --}}
    <h1 style="color:#1a2a5e; font-size:24px; font-weight:500; margin-bottom: 24px;">❤️ Wishlist Saya</h1>

    @if($wishlist->isEmpty())
        <div style="text-align: center; padding: 50px; background: white; border-radius: 12px; border:0.5px solid #bfcfef;">
            <p style="color: #64748b; font-size: 14px;">Belum ada buku di wishlist Anda.</p>
            <a href="/buku" style="color: #2563eb; text-decoration: none; font-weight: 500;">Cari buku sekarang →</a>
        </div>
    @else
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
            @foreach($wishlist as $w)
                <div style="background: white; border-radius: 12px; padding: 14px; border: 0.5px solid #bfcfef; position: relative; transition: transform 0.2s;">
                    
                    {{-- Perbaikan: Gunakan $w->buku->image (sesuai database Anda) bukan 'cover' --}}
                    @if($w->buku && $w->buku->image)
                        <img src="{{ asset('storage/'.$w->buku->image) }}" 
                             style="width: 100%; height: 250px; object-fit: cover; border-radius: 8px; margin-bottom: 12px;">
                    @else
                        <div style="width: 100%; height: 250px; background: #e8eef8; border-radius: 8px; margin-bottom: 12px; display: flex; align-items: center; justify-content: center;">
                            <span style="font-size: 40px;">📖</span>
                        </div>
                    @endif

                    <h5 style="color: #1e3a8a; font-size: 14px; font-weight: 500; margin: 0 0 10px; line-height: 1.4; height: 40px; overflow: hidden;">
                        {{ $w->buku->judul ?? 'Judul tidak ditemukan' }}
                    </h5>
                    
                    <form action="/wishlist/toggle/{{ $w->kodeBuku }}" method="POST">
                        @csrf
                        <button type="submit" style="width: 100%; background: #fef2f2; color: #dc2626; border: 0.5px solid #fca5a5; padding: 8px; border-radius: 8px; font-size: 12px; font-weight: 500; cursor: pointer;">
                            🗑️ Hapus dari Wishlist
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection