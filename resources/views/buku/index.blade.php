@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    
    <h1>
        <i class="bi bi-book"></i>
        Daftar Buku
    </h1>

    <div class="d-flex gap-2">
        {{-- TUGAS 3: Tombol Export CSV --}}
        <a href="{{ route('buku.export') }}" class="btn btn-success">
            <i class="bi bi-download"></i> Export CSV
        </a>

        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Buku
        </a>

        <a href="{{ route('buku.export') }}" class="btn btn-success mb-3">
            <i class="bi bi-download"></i> Export CSV
</a>
    </div>

</div>

{{-- Statistik --}}
<div class="row mb-4">

    <div class="col-md-4">
        <div class="card border-primary shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Total Buku</h6>
                        <h2>{{ $totalBuku }}</h2>
                    </div>
                    <i class="bi bi-book-fill text-primary" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-success shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Buku Tersedia</h6>
                        <h2>{{ $bukuTersedia }}</h2>
                    </div>
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-danger shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted">Buku Habis</h6>
                        <h2>{{ $bukuHabis }}</h2>
                    </div>
                    <i class="bi bi-x-circle-fill text-danger" style="font-size: 3rem;"></i>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Search & Filter --}}
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('buku.search') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari judul/pengarang/penerbit..." value="{{ request('keyword') }}">
                </div>
                <div class="col-md-2">
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $item)
                            <option value="{{ $item }}" {{ request('kategori') == $item ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="tahun" class="form-select">
                        <option value="">Semua Tahun</option>
                        @foreach($tahuns as $tahun)
                            <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="ketersediaan" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="tersedia" {{ request('ketersediaan') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="habis" {{ request('ketersediaan') == 'habis' ? 'selected' : '' }}>Habis</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Cari
                    </button>
                    <a href="{{ route('buku.index') }}" class="btn btn-secondary w-100">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- TUGAS 2: Form Bulk Delete membungkus area List Buku --}}
<form action="{{ route('buku.bulk-delete') }}" method="POST" id="bulk-delete-form">
    @csrf

    {{-- TUGAS 2: Tombol Hapus Terpilih dan Checkbox Select All --}}
    @if($bukus->count() > 0)
    <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded border">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="select-all">
            <label class="form-check-label fw-bold" for="select-all">
                Pilih Semua Buku
            </label>
        </div>
        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus semua buku yang dipilih?')">
            <i class="bi bi-trash"></i> Hapus Terpilih
        </button>
    </div>
    @endif

    {{-- List Buku --}}
    <div class="row">
        @forelse($bukus as $buku)
            <div class="col-md-4 mb-4">
                
                {{-- TUGAS 2: Checkbox individu diletakkan di atas tiap Card --}}
                <div class="form-check mb-2">
                    <input class="form-check-input buku-checkbox" type="checkbox" name="buku_ids[]" value="{{ $buku->id }}" id="check-{{ $buku->id }}">
                    <label class="form-check-label text-muted small" for="check-{{ $buku->id }}">
                        Tandai untuk dihapus
                    </label>
                </div>

                <x-buku-card :buku="$buku" />
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i>
                    Tidak ada data buku ditemukan.
                </div>
            </div>
        @endforelse
    </div>

</form>

{{-- Footer Info --}}
@if($bukus->count() > 0)
    <div class="text-center mt-4 mb-5">
        <p class="text-muted">
            Menampilkan {{ $bukus->count() }} buku
        </p>
    </div>
@endif

{{-- TUGAS 2: Script untuk fitur Select All Checkbox --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('select-all');
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                document.querySelectorAll('input[name="buku_ids[]"]').forEach(cb => {
                    cb.checked = this.checked;
                });
            });
        }
    });
</script>

@endsection