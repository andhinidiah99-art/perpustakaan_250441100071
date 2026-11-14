<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('kelola-buku', function (User $user) {
            
            if (method_exists($user, 'hasRole')) {
                return $user->hasRole('admin') || $user->hasRole('petugas');
            }

            return in_array($user->role, ['admin', 'petugas']);
        });
    }
}