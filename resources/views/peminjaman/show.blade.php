<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Peminjaman #{{ $peminjaman->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p class="mb-2"><strong>ID Peminjaman:</strong> {{ $peminjaman->id }}</p>
                <p class="mb-2"><strong>ID Anggota:</strong> {{ $peminjaman->anggota_id }}</p>
                <p class="mb-2"><strong>ID Buku:</strong> {{ $peminjaman->buku_id }}</p>
                <p class="mb-2"><strong>Tanggal Pinjam:</strong> {{ $peminjaman->tanggal_pinjam ?? '-' }}</p>
            </div>
        </div>
    </div>
</x-app-layout>