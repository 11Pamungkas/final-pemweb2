@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')

<nav class="mb-3">
    <a href="/kategori">Kategori</a> /
    {{ $kategori['nama'] }}
</nav>

<div class="card mb-4">

    <div class="card-body">

        <h2>{{ $kategori['nama'] }}</h2>

        <p>{{ $kategori['deskripsi'] }}</p>

        <span class="badge bg-primary">
            {{ $kategori['jumlah_buku'] }} Buku
        </span>

    </div>

</div>

<h3>Daftar Buku</h3>

<table class="table table-bordered">

    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Pengarang</th>
        </tr>
    </thead>

    <tbody>

        @foreach($buku_list as $index => $buku)

        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $buku['judul'] }}</td>
            <td>{{ $buku['pengarang'] }}</td>
        </tr>

        @endforeach

    </tbody>

</table>

@endsection