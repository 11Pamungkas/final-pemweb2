<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = [
        'kode_anggota',
        'nama',
        'email',
        'telepon',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'tanggal_daftar',
        'status'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_daftar' => 'date',
    ];

    // ACCESSOR UMUR
    public function getUmurAttribute(): int
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    // ACCESSOR STATUS BADGE
    public function getStatusBadgeAttribute(): string
    {
        return $this->status == 'Aktif'
            ? '<span class="badge bg-success">Aktif</span>'
            : '<span class="badge bg-secondary">Nonaktif</span>';
    }

    // ACCESSOR KATEGORI USIA
    public function getKategoriUsiaAttribute(): string
    {
        if ($this->umur < 20) {
            return 'Remaja';
        } elseif ($this->umur <= 50) {
            return 'Dewasa';
        } else {
            return 'Senior';
        }
    }

    // SCOPE JENIS KELAMIN
    public function scopeJenisKelamin(Builder $query, string $jk): Builder
    {
        return $query->where('jenis_kelamin', $jk);
    }

    // SCOPE TERDAFTAR BULAN INI
    public function scopeTerdaftarBulanIni(Builder $query): Builder
    {
        return $query->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year);
    }

    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }
}
