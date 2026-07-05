<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Rules\KodeBukuFormat;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukus = Buku::latest()->get();
        
        $totalBuku = Buku::count();
        $bukuTersedia = Buku::where('stok', '>', 0)->count();
        $bukuHabis = Buku::where('stok', '<=', 0)->count();
        
        $kategoris = Buku::select('kategori')
                        ->distinct()
                        ->pluck('kategori');

        $tahuns = Buku::select('tahun_terbit')
                    ->distinct()
                    ->orderBy('tahun_terbit', 'desc')
                    ->pluck('tahun_terbit');
        
        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'kategoris',
            'tahuns'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TUGAS 1: Validation Rules Advanced
        $rules = [
            'kode_buku'    => ['required', new KodeBukuFormat()],
            'kategori'     => 'required',
            'bahasa'       => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok'         => 'required|numeric',
            'judul'        => 'required',
            'pengarang'    => 'required',
            'penerbit'     => 'required',
            'isbn'         => 'required',
            'harga'        => 'required|numeric',
        ];

        $messages = [
            'required' => 'Kolom :attribute wajib diisi.',
            'numeric'  => 'Kolom :attribute harus berupa angka.',
            'bahasa.in'=> 'Karena kategori Programming, bahasa harus "Inggris".',
            'stok.max' => 'Buku terbitan di bawah tahun 2000 maksimal memiliki stok 5.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->sometimes('bahasa', 'in:Inggris', function ($input) {
            return $input->kategori === 'Programming';
        });

        $validator->sometimes('stok', 'max:5', function ($input) {
            return $input->tahun_terbit < 2000;
        });

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        try {
            Buku::create($request->all());
            
            return redirect()->route('buku.index')
                             ->with('success', 'Buku berhasil ditambahkan!');
                             
        } catch (\Exception $e) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Gagal menambahkan buku: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);
        
        return view('buku.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);

        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // TUGAS 1: Validation Rules Advanced
        $rules = [
            'kode_buku'    => ['required', new KodeBukuFormat()],
            'kategori'     => 'required',
            'bahasa'       => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok'         => 'required|numeric',
            'judul'        => 'required',
            'pengarang'    => 'required',
            'penerbit'     => 'required',
            'isbn'         => 'required',
            'harga'        => 'required|numeric',
        ];

        $messages = [
            'required' => 'Kolom :attribute wajib diisi.',
            'numeric'  => 'Kolom :attribute harus berupa angka.',
            'bahasa.in'=> 'Karena kategori Programming, bahasa harus "Inggris".',
            'stok.max' => 'Buku terbitan di bawah tahun 2000 maksimal memiliki stok 5.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->sometimes('bahasa', 'in:Inggris', function ($input) {
            return $input->kategori === 'Programming';
        });

        $validator->sometimes('stok', 'max:5', function ($input) {
            return $input->tahun_terbit < 2000;
        });

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        try {
            $buku = Buku::findOrFail($id);
            $buku->update($request->all());
            
            return redirect()->route('buku.show', $buku->id)
                             ->with('success', 'Buku berhasil diupdate!');
                             
        } catch (\Exception $e) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Gagal mengupdate buku: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $buku = Buku::findOrFail($id);
            $judulBuku = $buku->judul;
            
            $buku->delete();
            
            return redirect()->route('buku.index')
                             ->with('success', "Buku '{$judulBuku}' berhasil dihapus!");
                             
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Gagal menghapus buku: ' . $e->getMessage());
        }
    }
    
    /**
     * Filter buku berdasarkan kategori.
     */
    public function filterKategori($kategori)
    {
        $bukus = Buku::where('kategori', $kategori)
                    ->latest()
                    ->get();
        
        $totalBuku = $bukus->count();
        $bukuTersedia = $bukus->where('stok', '>', 0)->count();
        $bukuHabis = $bukus->where('stok', '<=', 0)->count();

        $kategoris = Buku::select('kategori')
                        ->distinct()
                        ->pluck('kategori');

        $tahuns = Buku::select('tahun_terbit')
                    ->distinct()
                    ->orderBy('tahun_terbit', 'desc')
                    ->pluck('tahun_terbit');
        
        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'kategori',
            'kategoris',
            'tahuns'
        ));
    }

    /**
     * Search & Filter Buku Advanced
     */
    public function search(Request $request)
    {
        $query = Buku::query();

        if ($request->keyword) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->keyword . '%')
                  ->orWhere('pengarang', 'like', '%' . $request->keyword . '%')
                  ->orWhere('penerbit', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->tahun) {
            $query->where('tahun_terbit', $request->tahun);
        }

        if ($request->ketersediaan == 'tersedia') {
            $query->where('stok', '>', 0);
        }

        if ($request->ketersediaan == 'habis') {
            $query->where('stok', '<=', 0);
        }

        $bukus = $query->latest()->get();

        $totalBuku = $bukus->count();
        $bukuTersedia = $bukus->where('stok', '>', 0)->count();
        $bukuHabis = $bukus->where('stok', '<=', 0)->count();

        $kategoris = Buku::select('kategori')
                        ->distinct()
                        ->pluck('kategori');

        $tahuns = Buku::select('tahun_terbit')
                    ->distinct()
                    ->orderBy('tahun_terbit', 'desc')
                    ->pluck('tahun_terbit');

        return view('buku.index', compact(
            'bukus',
            'totalBuku',
            'bukuTersedia',
            'bukuHabis',
            'kategoris',
            'tahuns'
        ));
    }

    /**
     * TUGAS 2: Bulk Delete Operations
     */
    public function bulkDelete(Request $request)
    {
        $ids = $request->buku_ids;
        
        // Pastikan ada data yang dipilih
        if (!$ids) {
            return redirect()->route('buku.index')->with('error', 'Tidak ada buku yang dipilih.');
        }

        \App\Models\Buku::whereIn('id', $ids)->delete();
        
        return redirect()->route('buku.index')
                        ->with('success', count($ids) . ' buku berhasil dihapus!');
    }

    /**
     * TUGAS 3: Export Buku ke CSV
     */
    public function export()
    {
        $bukus = \App\Models\Buku::all();
        
        $filename = 'buku_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($bukus) {
            $file = fopen('php://output', 'w');
            
            fputcsv($file, [
                'Kode Buku', 'Judul', 'Kategori', 'Pengarang', 
                'Penerbit', 'Tahun', 'ISBN', 'Harga', 'Stok'
            ]);
            
            foreach ($bukus as $buku) {
                fputcsv($file, [
                    $buku->kode_buku,
                    $buku->judul,
                    $buku->kategori,
                    $buku->pengarang,
                    $buku->penerbit,
                    $buku->tahun_terbit,
                    $buku->isbn,
                    $buku->harga,
                    $buku->stok,
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}