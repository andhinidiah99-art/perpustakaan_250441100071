<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();

        // Redirection berdasarkan Role pengguna
        if ($user->hasRole('admin') || $user->hasRole('petugas')) {
            return redirect()->intended('/buku')->with('success', 'Selamat datang, ' . $user->name);
        }

        // Role Siswa / Anggota
        return redirect()->intended('/buku')->with('info', 'Selamat datang Siswa: ' . $user->name);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}