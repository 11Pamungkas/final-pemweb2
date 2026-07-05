<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use App\Models\Anggota;
use App\Models\Buku;
use Carbon\Carbon;
 
class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing anggota and buku
        $anggota1 = Anggota::where('kode_anggota', 'AGT-001')->first();
        $anggota2 = Anggota::where('kode_anggota', 'AGT-002')->first();
        $anggota3 = Anggota::where('kode_anggota', 'AGT-003')->first();
        
        $buku1 = Buku::where('kode_buku', 'BK-001')->first();
        $buku2 = Buku::where('kode_buku', 'BK-002')->first();
        $buku3 = Buku::where('kode_buku', 'BK-003')->first();
        
        $transaksiList = [
            [
                'kode_transaksi' => 'TRX-001',
                'anggota_id' => $anggota1 ? $anggota1->id : 1,
                'buku_id' => $buku1 ? $buku1->id : 1,
                'tanggal_pinjam' => Carbon::now()->subDays(10),
                'tanggal_kembali' => Carbon::now()->subDays(3),
                'tanggal_dikembalikan' => Carbon::now()->subDays(2),
                'status' => 'Dikembalikan',
                'denda' => 5000, // 1 hari terlambat
                'keterangan' => 'Peminjaman pertama',
            ],
            [
                'kode_transaksi' => 'TRX-002',
                'anggota_id' => $anggota2 ? $anggota2->id : 2,
                'buku_id' => $buku2 ? $buku2->id : 2,
                'tanggal_pinjam' => Carbon::now()->subDays(5),
                'tanggal_kembali' => Carbon::now()->addDays(2),
                'tanggal_dikembalikan' => null,
                'status' => 'Dipinjam',
                'denda' => 0,
                'keterangan' => 'Pinjam untuk tugas kampus',
            ],
            [
                'kode_transaksi' => 'TRX-003',
                'anggota_id' => $anggota3 ? $anggota3->id : 3,
                'buku_id' => $buku3 ? $buku3->id : 3,
                'tanggal_pinjam' => Carbon::now()->subDays(2),
                'tanggal_kembali' => Carbon::now()->addDays(5),
                'tanggal_dikembalikan' => null,
                'status' => 'Dipinjam',
                'denda' => 0,
                'keterangan' => null,
            ],
        ];
        
        foreach ($transaksiList as $transaksi) {
            Transaksi::create($transaksi);
        }
    }
}
