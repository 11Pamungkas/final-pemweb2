@extends('layouts.app')

@section('title', 'Kategori Buku')

@section('content')

<h1 class="mb-4">Daftar Kategori</h1>

<div class="row">

@foreach($kategori_list as $kategori)

<div class="col-md-4 mb-4">

    <div class="card h-100">

        <div class="card-body">

            <h4>{{ $kategori['nama'] }}</h4>

            <p>{{ $kategori['deskripsi'] }}</p>

            <span class="badge bg-primary">
                {{ $kategori['jumlah_buku'] }} Buku
            </span>

        </div>

        <div class="card-footer">

            <a href="/kategori/{{ $kategori['id'] }}"
               class="btn btn-success btn-sm">
                Detail
            </a>

        </div>

    </div>

</div>

@endforeach

</div>

@endsection