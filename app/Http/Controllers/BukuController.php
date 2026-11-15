<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->orderBy('id')->get();
        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        Gate::authorize('kelola-buku');
        return view('buku.index');
    }

    public function store(Request $request)
    {
        Gate::authorize('kelola-buku');

        $request->validate([
            'kategori_id' => 'required|integer',
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
        ]);

        // Pastikan kategori_id tersedia di tabel kategoris agar tidak gagal foreign key di Supabase
        Kategori::firstOrCreate(
            ['id' => $request->kategori_id],
            ['nama' => 'Teknologi']
        );

        Buku::create([
            'kategori_id' => $request->kategori_id,
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
        ]);

        return redirect('/buku');
    }

    public function show($id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);
        return view('buku.show', compact('buku'));
    }

    public function edit($id)
    {
        Gate::authorize('kelola-buku');
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('kelola-buku');

        $buku = Buku::findOrFail($id);

        if ($request->filled('kategori_id')) {
            Kategori::firstOrCreate(
                ['id' => $request->kategori_id],
                ['nama' => 'Teknologi']
            );
        }

        $buku->update([
            'kategori_id' => $request->kategori_id ?? $buku->kategori_id,
            'judul_buku' => $request->judul_buku ?? $buku->judul_buku,
            'penulis' => $request->penulis ?? $buku->penulis,
            'tahun_terbit' => $request->tahun_terbit ?? $buku->tahun_terbit,
        ]);

        return redirect('/buku');
    }

    public function destroy($id)
    {
        Gate::authorize('kelola-buku');

        $buku = Buku::findOrFail($id);
        $buku->delete();

        return redirect('/buku');
    }
}