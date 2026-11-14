<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            KategoriSeeder::class,
            BukuSeeder::class,
        ]);

        DB::table('anggotas')->updateOrInsert(['id' => 1], [
            'nama' => 'Anggota 1 - 250441100071',
            'email' => 'anggota1@gmail.com',
            'no_telepon' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('anggotas')->updateOrInsert(['id' => 2], [
            'nama' => 'Anggota 2 - 250441100071',
            'email' => 'anggota2@gmail.com',
            'no_telepon' => '081234567891',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('anggotas')->updateOrInsert(['id' => 3], [
            'nama' => 'Siswa 250441100071',
            'email' => 'siswa@gmail.com',
            'no_telepon' => '081234567892',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $bukuId = DB::table('bukus')->value('id');

        if ($bukuId) {
            DB::table('peminjamans')->updateOrInsert(['id' => 1], [
                'anggota_id' => 1,
                'buku_id' => $bukuId,
                'tanggal_pinjam' => '2026-11-14',
                'tanggal_kembali' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('peminjamans')->updateOrInsert(['id' => 2], [
                'anggota_id' => 3,
                'buku_id' => $bukuId,
                'tanggal_pinjam' => '2026-11-14',
                'tanggal_kembali' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if (DB::getDriverName() === 'pgsql') {
            DB::statement("SELECT setval(pg_get_serial_sequence('anggotas', 'id'), COALESCE((SELECT MAX(id) FROM anggotas), 1))");
            DB::statement("SELECT setval(pg_get_serial_sequence('peminjamans', 'id'), COALESCE((SELECT MAX(id) FROM peminjamans), 1))");
        }
    }
}