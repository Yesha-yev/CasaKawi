@extends('layouts.app')

@section('content')
<div class="container">

<h2 class="text-center text-brown">Daftar Budaya</h2>

@if(auth()->check() && auth()->user()->role === 'admin')
    <div class="mb-4 text-end">
        <a href="{{ route('admin.budaya.create') }}" class="btn btn-brown px-4">Tambah Budaya</a>
    </div>
@endif

<div class="row g-4">

@foreach ($budaya as $item)

<div class="col-12 col-sm-6 col-md-4 col-lg-3">
    <div class="card h-100 shadow-sm budaya-card">

        <div class="img-wrapper teks-gambar">
            @if ($item->gambar)
                <img src="{{ asset('storage/' . $item->gambar) }}">
            @else
                <span>Tidak ada gambar</span>
            @endif
        </div>

        <div class="card-body d-flex flex-column">
            <h6 class="fw-semibold">{{ $item->nama }}</h6>

            <small class="text-muted mb-2 teks-des">
                {{ $item->asal_daerah }} •
                {{ $item->kategoriRelasi->nama_kategori ?? '-' }}
            </small>

            <p class="small budaya-desc">
                {{ Str::limit($item->deskripsi, 90) }}
            </p>

            <button class="btn btn-brown btn-sm mt-auto"
                data-bs-toggle="modal"
                data-bs-target="#modalDetail{{ $item->id }}">Lihat Selengkapnya</button>

            @if(auth()->check() && auth()->user()->role === 'admin')
                <div class="d-flex gap-2 mt-2">
                    <a href="{{ route('admin.budaya.edit', $item->id) }}"
                       class="btn btn-warning btn-sm flex-grow-1">
                        Edit
                    </a>

                    <form action="{{ route('admin.budaya.destroy', $item->id) }}"
                          method="POST" class="flex-grow-1">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm w-100">
                            Hapus
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content modal-budaya">

            <div class="modal-header">
                <h5 class="modal-title">{{ $item->nama }}</h5>
                <button type="button" class="btn-close"
                        data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                @if($item->gambar)
                    <img src="{{ asset('storage/'.$item->gambar) }}"
                         class="img-fluid mb-3 rounded">
                @endif

                <p><strong>Asal Daerah:</strong> {{ $item->asal_daerah }}</p>
                <p><strong>Kategori:</strong> {{ $item->kategoriRelasi->nama_kategori ?? '-' }}</p>

                <hr>

                <p style="text-align: justify;">
                    {{ $item->deskripsi }}
                </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>

@endforeach
</div>
</div>

<style>
.text-brown { color: #c9c1b6; }
.btn-brown {
    background: #694d28;
    color: #fff;
    border: none;
}
.btn-brown:hover { background: #5a3e1f; }

.budaya-card {
    border-radius: 12px;
    overflow: hidden;
    background: #f5efe6;
}

.img-wrapper {
    height: 160px;
    overflow: hidden;
    background: #e9e1d4;
    display: flex;
    align-items: center;
    justify-content: center;
}
.img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .3s ease;
}
.img-wrapper img:hover {
    transform: scale(1.05);
}
.img-wrapper.placeholder {
    color: #8a7f72;
    font-size: 14px;
}
.teks-des {
    color: #6b4400 !important;
}
.modal-budaya{
    background-color: efe7db;
    color: #5a3e1f;
}
.modal-budaya.modal-tittle{
    color: #251c0f;
}
.modal-budaya .modal-body p,
.modal-budaya .modal-body h5,
.modal-budaya .modal-body h6 {
    color: #3e2b18;
}
.modal-budaya .modal-body strong {
    color: #5a3e1f;
}
.teks-gambar span {
    font-size: 14px;
    color: #4e4234;
}
.modal-budaya .modal-footer {
    background: #f8f0e0;
}
.budaya-desc {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

@endsection
