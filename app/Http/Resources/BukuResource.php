<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BukuResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'               => $this->id,
            'kategori_id'      => $this->kategori_id,
            'nama_kategori'    => $this->whenLoaded('kategori', fn() => $this->kategori->nama ?? null),
            'judul_buku'       => $this->judul_buku,
            'penulis'          => $this->penulis,
            'tahun_terbit'     => (int) $this->tahun_terbit,
            'total_peminjaman' => $this->whenCounted('peminjamans'),
            'created_at'       => $this->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}