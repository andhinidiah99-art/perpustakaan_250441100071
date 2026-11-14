<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roleAdmin   = Role::firstOrCreate(['name' => 'admin']);
        $rolePetugas = Role::firstOrCreate(['name' => 'petugas']);
        $roleAnggota = Role::firstOrCreate(['name' => 'anggota']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Administrator', 'password' => Hash::make('password')]
        );
        $admin->assignRole($roleAdmin);

        $petugas = User::firstOrCreate(
            ['email' => 'petugas@gmail.com'],
            ['name' => 'Petugas Perpustakaan', 'password' => Hash::make('password')]
        );
        $petugas->assignRole($rolePetugas);

        $siswa = User::firstOrCreate(
            ['email' => 'siswa@gmail.com'],
            ['name' => 'Siswa Perpustakaan', 'password' => Hash::make('password')]
        );
        $siswa->assignRole($roleAnggota);
    }
}