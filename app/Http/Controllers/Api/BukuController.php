<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Http\Resources\BukuResource;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategori')->latest();

        // Pencarian judul / penulis
        $query->when($request->filled('cari'), function ($q) use ($request) {
            $q->where(function ($sub) use ($request) {
                $sub->where('judul_buku', 'like', '%' . $request->cari . '%')
                    ->orWhere('penulis', 'like', '%' . $request->cari . '%');
            });
        });

        // Filter kategori
        $query->when($request->filled('kategori'), function ($q) use ($request) {
            $q->where('kategori_id', $request->kategori);
        });

        // Filter tahun
        $query->when($request->filled('tahun'), function ($q) use ($request) {
            $q->where('tahun_terbit', $request->tahun);
        });

        return BukuResource::collection($query->get());
    }

    public function cari(Request $request)
    {
        $judul = $request->query('judul');
        $results = \DB::select("SELECT * FROM bukus WHERE judul_buku = ?", [$judul]);
        return response()->json($results);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id'  => 'required|exists:kategoris,id',
            'judul_buku'   => 'required|string|min:3|max:255',
            'penulis'      => 'required|string|max:255',
            'tahun_terbit' => 'required|numeric|digits:4',
        ], [
            'kategori_id.required' => 'ID Kategori wajib diisi.',
            'kategori_id.exists'   => 'Kategori yang dipilih tidak terdaftar.',
            'judul_buku.required'  => 'Judul buku wajib diisi.',
            'judul_buku.min'       => 'Judul buku minimal 3 karakter.',
            'penulis.required'     => 'Nama penulis wajib diisi.',
            'tahun_terbit.required'=> 'Tahun terbit wajib diisi.',
            'tahun_terbit.digits'  => 'Tahun terbit harus 4 digit.',
        ]);

        $buku = Buku::create($validated);

        return (new BukuResource($buku->load('kategori')))
            ->additional(['message' => 'Buku berhasil ditambahkan']);
    }

    public function show($id)
    {
        $buku = Buku::with('kategori')->find($id);

        if (!$buku) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data buku tidak ditemukan'
            ], 404);
        }

        return new BukuResource($buku);
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data buku tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'kategori_id'  => 'required|exists:kategoris,id',
            'judul_buku'   => 'required|string|min:3|max:255',
            'penulis'      => 'required|string|max:255',
            'tahun_terbit' => 'required|numeric|digits:4',
        ]);

        $buku->update($validated);

        return (new BukuResource($buku->load('kategori')))
            ->additional(['message' => 'Buku berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data buku tidak ditemukan'
            ], 404);
        }

        $buku->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Buku berhasil dihapus'
        ], 200);
    }
}