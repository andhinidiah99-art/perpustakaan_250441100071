<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BukuController extends Controller
{
    private $bukuAwal = [
        ['id' => 1, 'judul_buku' => 'Laskar Pelangi', 'penulis' => 'Andrea Hirata', 'tahun_terbit' => 2005, 'kategori' => 'Novel'],
        ['id' => 2, 'judul_buku' => 'Bumi Manusia', 'penulis' => 'Pramoedya Ananta Toer', 'tahun_terbit' => 1980, 'kategori' => 'Sejarah'],
        ['id' => 3, 'judul_buku' => 'Negeri 5 Menara', 'penulis' => 'Ahmad Fuadi', 'tahun_terbit' => 2009, 'kategori' => 'Novel'],
        ['id' => 4, 'judul_buku' => 'Atomic Habits', 'penulis' => 'James Clear', 'tahun_terbit' => 2018, 'kategori' => 'Self Improvement'],
        ['id' => 5, 'judul_buku' => 'Filosofi Teras', 'penulis' => 'Henry Manampiring', 'tahun_terbit' => 2018, 'kategori' => 'Filsafat'],
        ['id' => 6, 'judul_buku' => 'Bumi', 'penulis' => 'Tere Liye', 'tahun_terbit' => 2014, 'kategori' => 'Novel'],
        ['id' => 7, 'judul_buku' => 'Laut Bercerita', 'penulis' => 'Leila S. Chudori', 'tahun_terbit' => 2017, 'kategori' => 'Novel'],
        ['id' => 8, 'judul_buku' => 'Sapiens', 'penulis' => 'Yuval Noah Harari', 'tahun_terbit' => 2014, 'kategori' => 'Sejarah'],
        ['id' => 9, 'judul_buku' => 'Sebuah Seni untuk Bersikap Bodo Amat', 'penulis' => 'Mark Manson', 'tahun_terbit' => 2016, 'kategori' => 'Self Improvement'],
        ['id' => 10, 'judul_buku' => 'Cantik Itu Luka', 'penulis' => 'Eka Kurniawan', 'tahun_terbit' => 2002, 'kategori' => 'Novel'],
        ['id' => 11, 'judul_buku' => 'Dunia Sophie', 'penulis' => 'Jostein Gaarder', 'tahun_terbit' => 1991, 'kategori' => 'Filsafat'],
        ['id' => 12, 'judul_buku' => 'Dilan 1990', 'penulis' => 'Pidi Baiq', 'tahun_terbit' => 2014, 'kategori' => 'Novel'],
    ];

    private function getBuku()
    {
        if (!session()->has('buku_data')) {
            session(['buku_data' => $this->bukuAwal]);
        }
        return session('buku_data');
    }

    public function index()
    {
        $bukus = json_decode(json_encode($this->getBuku()));
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

        $data = $this->getBuku();
        $newId = count($data) > 0 ? max(array_column($data, 'id')) + 1 : 1;

        $data[] = [
            'id' => $newId,
            'judul_buku' => $request->judul_buku,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'kategori' => $request->kategori_id ?? 'Teknologi'
        ];

        session(['buku_data' => $data]);

        return redirect('/buku');
    }

    public function show($id)
    {
        $buku = collect($this->getBuku())->firstWhere('id', (int) $id);
        if (!$buku) return response()->json(['message' => 'Buku tidak ditemukan'], 404);
        return view('buku.show', ['buku' => $buku]);
    }

    public function edit($id)
    {
        Gate::authorize('kelola-buku');
        $bukuData = collect($this->getBuku())->firstWhere('id', (int) $id);

        if (!$bukuData) return redirect('/buku');

        $buku = json_decode(json_encode($bukuData));
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('kelola-buku');

        $data = $this->getBuku();
        foreach ($data as &$buku) {
            if ($buku['id'] == (int) $id) {
                $buku['judul_buku'] = $request->judul_buku ?? $buku['judul_buku'];
                $buku['penulis'] = $request->penulis ?? $buku['penulis'];
                $buku['tahun_terbit'] = $request->tahun_terbit ?? $buku['tahun_terbit'];
                $buku['kategori'] = $request->kategori ?? $buku['kategori'];
            }
        }

        session(['buku_data' => $data]);
        return redirect('/buku');
    }

    public function destroy($id)
    {
        Gate::authorize('kelola-buku');

        $data = array_filter($this->getBuku(), fn($b) => $b['id'] != (int) $id);
        session(['buku_data' => array_values($data)]);

        return redirect('/buku');
    }
}