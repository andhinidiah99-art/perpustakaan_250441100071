<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="font-bold text-lg mb-4">Form Edit Buku (ID: {{ $buku->id }})</h3>

                <form action="/buku/{{ $buku->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div style="margin-bottom: 10px;">
                        <label style="display:inline-block; width: 120px;">Judul Buku</label>
                        <input type="text" name="judul_buku" value="{{ $buku->judul_buku ?? $buku->judul }}" style="border:1px solid #ccc; padding:4px 8px; width: 300px;" required>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label style="display:inline-block; width: 120px;">Penulis</label>
                        <input type="text" name="penulis" value="{{ $buku->penulis }}" style="border:1px solid #ccc; padding:4px 8px; width: 300px;" required>
                    </div>

                    <div style="margin-bottom: 10px;">
                        <label style="display:inline-block; width: 120px;">Tahun Terbit</label>
                        <input type="text" name="tahun_terbit" value="{{ $buku->tahun_terbit }}" style="border:1px solid #ccc; padding:4px 8px; width: 300px;" required>
                    </div>

                    <div style="margin-bottom: 15px;">
                        <label style="display:inline-block; width: 120px;">Kategori</label>
                        <input type="text" name="kategori" value="{{ $buku->kategori ?? 'Novel' }}" style="border:1px solid #ccc; padding:4px 8px; width: 300px;" required>
                    </div>

                    <div>
                        <button type="submit" style="background:#e1e1e1; border:1px solid #767676; padding:4px 12px; cursor:pointer;">Update Buku</button>
                        <a href="/buku" style="margin-left: 10px; text-decoration: none; color: #333;">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>