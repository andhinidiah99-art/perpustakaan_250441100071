<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Form Tambah Buku (Hanya tampil untuk Admin/Petugas) --}}
                @can('kelola-buku')
                <h3 class="font-bold text-lg mb-3">Form Tambah Buku</h3>
                <form action="/buku" method="POST" class="mb-6">
                    @csrf
                    <div style="margin-bottom: 5px;">
                        <label style="display:inline-block; width: 100px;">ID Kategori</label>
                        <input type="text" name="kategori_id" placeholder="Contoh: 1" style="border:1px solid #ccc; padding:3px 6px;" required>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label style="display:inline-block; width: 100px;">Judul Buku</label>
                        <input type="text" name="judul_buku" placeholder="Judul Buku" style="border:1px solid #ccc; padding:3px 6px;" required>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label style="display:inline-block; width: 100px;">Penulis</label>
                        <input type="text" name="penulis" placeholder="Nama Penulis" style="border:1px solid #ccc; padding:3px 6px;" required>
                    </div>
                    <div style="margin-bottom: 5px;">
                        <label style="display:inline-block; width: 100px;">Tahun Terbit</label>
                        <input type="text" name="tahun_terbit" placeholder="2024" style="border:1px solid #ccc; padding:3px 6px;" required>
                    </div>
                    
                    <div style="margin-top: 10px; margin-bottom: 15px;">
                        <button type="submit" style="background:#e1e1e1; border:1px solid #767676; padding:2px 8px; cursor:pointer;">Simpan Buku</button>
                    </div>
                </form>
                @endcan

                <table cellpadding="4" cellspacing="0" style="width: 100%; text-align: left;">
                    <thead>
                        <tr>
                            <th style="width: 120px;">ID Kategori</th>
                            <th style="width: 220px;">Judul</th>
                            <th style="width: 180px;">Penulis</th>
                            <th style="width: 100px;">Tahun Terbit</th>
                            
                            {{-- Header Kolom Aksi --}}
                            @can('kelola-buku')
                                <th style="width: 120px;">Aksi</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bukus as $buku)
                        <tr>
                              
                            <td>{{ $buku->id }} {{ optional($buku->kategori)->nama ?? 'Teknologi' }}</td>
                            <td>{{ $buku->judul ?? $buku->judul_buku }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ $buku->tahun_terbit }}</td>

                            {{-- Tombol Edit & Hapus (Hanya tampil untuk Admin/Petugas) --}}
                            @can('kelola-buku')
                            <td>
                                <a href="/buku/{{ $buku->id }}/edit" style="background:#e1e1e1; border:1px solid #767676; padding:1px 5px; font-size:12px; text-decoration:none; color:black; margin-right: 3px;">Edit</a>
                                <a href="/buku/{{ $buku->id }}/hapus" style="background:#e1e1e1; border:1px solid #767676; padding:1px 5px; font-size:12px; text-decoration:none; color:black;">Hapus</a>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>