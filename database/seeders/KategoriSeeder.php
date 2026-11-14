<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::firstOrCreate(['id' => 1], ['nama' => 'Teknologi']);
        Kategori::firstOrCreate(['id' => 2], ['nama' => 'Sains']);
        Kategori::firstOrCreate(['id' => 3], ['nama' => 'Sejarah']);
    }
}