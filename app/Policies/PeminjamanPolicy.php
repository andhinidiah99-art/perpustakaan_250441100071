<?php

namespace App\Policies;

use App\Models\Peminjaman;
use App\Models\User;

class PeminjamanPolicy
{

    public function before(User $user, string $ability): ?bool
    {

        if (
            (method_exists($user, 'hasRole') && ($user->hasRole('admin') || $user->hasRole('petugas'))) ||
            (isset($user->role) && in_array($user->role, ['admin', 'petugas']))
        ) {
            return true;
        }

        return null;
    }

    public function view(User $user, Peminjaman $peminjaman): bool
    {
      
        return (int) $user->id === (int) $peminjaman->anggota_id;
    }
}