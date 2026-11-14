<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        Buku::create([
            'kategori_id'  => 1,
            'judul_buku'   => 'Pemrograman Web dengan Laravel 11',
            'penulis'      => 'Andi Wijaya',
            'tahun_terbit' => 2024,
        ]);

        Buku::create([
            'kategori_id'  => 2,
            'judul_buku'   => 'Dasar-Dasar Sains Modern',
            'penulis'      => 'Budi Santoso',
            'tahun_terbit' => 2022,
        ]);
    }
}