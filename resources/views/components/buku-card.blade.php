<div class="card shadow-sm mb-3">

    <div class="card-body">

        <div class="d-flex justify-content-between">

            <div>
                <h5>📚 {{ $buku->judul }}</h5>

                <p class="mb-1">
                    <strong>Pengarang:</strong>
                    {{ $buku->pengarang }}
                </p>

                <p class="mb-1">
                    <strong>Harga:</strong>
                    Rp {{ number_format($buku->harga, 0, ',', '.') }}
                </p>

                <p class="mb-1">
                    <strong>Stok:</strong>
                    {{ $buku->stok }}
                </p>
            </div>

            <div>
                <span class="badge bg-primary">
                    {{ $buku->kategori }}
                </span>
            </div>

        </div>

        {{-- Status --}}
        <div class="mt-2">
            @if($buku->stok > 0)
                <span class="badge bg-success">
                    Tersedia
                </span>
            @else
                <span class="badge bg-danger">
                    Habis
                </span>
            @endif
        </div>

        {{-- Actions --}}
        @if($showActions)
            <div class="mt-3">

                <a href="{{ route('buku.show', $buku->id) }}"
                    class="btn btn-info btn-sm">
                    Detail
                </a>

                <a href="{{ route('buku.edit', $buku->id) }}"
                    class="btn btn-warning btn-sm">
                    Edit
                </a>

            </div>
        @endif

    </div>
</div>