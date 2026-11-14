@extends('layouts.app')

@section('title', 'Detail Buku - ' . ($buku['judul'] ?? 'Tidak Ditemukan'))

@section('content')
    <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        @if ($buku)
            <h2 style="color: #2c3e50; margin-bottom: 15px;">{{ $buku['judul'] }}</h2>
            <p><strong>Penulis:</strong> {{ $buku['penulis'] }}</p>
            <p><strong>Tahun Terbit:</strong> {{ $buku['tahun_terbit'] }}</p>
            <p><strong>Kategori:</strong> {{ $buku['kategori'] }}</p>
            <p><strong>ID Buku:</strong> {{ $buku['id'] }}</p>
            
            <div style="margin-top: 25px;">
                <a href="{{ route('buku.index') }}" class="btn-detail" style="background-color: #7f8c8d; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px;">← Kembali ke Daftar Buku</a>
            </div>
        @else
            <h2>Buku Tidak Ditemukan</h2>
            <p>Maaf, buku yang Anda cari tidak tersedia.</p>
            <div style="margin-top: 20px;">
                <a href="{{ route('buku.index') }}" class="btn-detail">Kembali ke Daftar Buku</a>
            </div>
        @endif
    </div>
@endsection