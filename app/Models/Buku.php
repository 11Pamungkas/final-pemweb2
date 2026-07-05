<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;

class Buku extends Model
{
    protected $table = 'buku';

    protected $fillable = [
        'kode_buku',
        'judul',
        'kategori',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'harga',
        'stok',
        'deskripsi',
        'bahasa'
    ];

    // ACCESSOR STATUS STOK BADGE
    public function getStatusStokBadgeAttribute(): string
    {
        if ($this->stok == 0) {
            return '<span class="badge bg-danger">Habis</span>';
        } elseif ($this->stok >= 1 && $this->stok <= 5) {
            return '<span class="badge bg-warning">Menipis</span>';
        } elseif ($this->stok >= 6 && $this->stok <= 15) {
            return '<span class="badge bg-info">Sedang</span>';
        } else {
            return '<span class="badge bg-success">Aman</span>';
        }
    }

    // ACCESSOR TAHUN LABEL
    public function getTahunLabelAttribute(): string
    {
        return $this->tahun_terbit >= 2024
            ? 'Buku Baru'
            : 'Buku Lama';
    }

    // SCOPE STOK MENIPIS
    public function scopeStokMenipis($query)
    {
        return $query->where('stok', '<', 5);
    }

    // SCOPE HARGA RANGE
    public function scopeHargaRange($query, $min, $max)
    {
        return $query->whereBetween('harga', [$min, $max]);
    }

    // SCOPE TERBARU
    public function scopeTerbaru($query)
    {
        return $query->where('tahun_terbit', '>=', 2024);
    }

        public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}