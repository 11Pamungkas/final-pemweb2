@extends('layouts.app')

@section('title', 'Pencarian Kategori')

@section('content')

<h1 class="mb-4">
    Hasil pencarian:
    <span class="text-danger">{{ $keyword }}</span>
</h1>

<div class="row">

@foreach($hasil as $item)

<div class="col-md-4 mb-4">

    <div class="card">

        <div class="card-body">

            <h4>{{ $item['nama'] }}</h4>

            <p>{{ $item['deskripsi'] }}</p>

        </div>

    </div>

</div>

@endforeach

</div>

@endsection