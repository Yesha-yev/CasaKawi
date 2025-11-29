@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Budaya</h2>

    {{-- Tombol Tambah --}}
    @if(auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('admin.budaya.create') }}" class="btn btn-primary mb-3">Tambah Budaya</a>
    @endif

    <div class="row">
        @foreach ($budaya as $item)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">

                {{-- Gambar --}}
                @if ($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="gambar budaya">
                @else
                    <img src="https://via.placeholder.com/300x200?text=Tidak+Ada+Gambar" class="card-img-top">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $item->nama }}</h5>

                    <p class="card-text">
                        {{ Str::limit($item->deskripsi, 120) }}
                    </p>

                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item->id }}">
                        Lihat Selengkapnya
                    </button>

                    <p class="mt-2"><strong>Asal Daerah:</strong> {{ $item->asal_daerah }}</p>

                    <p><strong>Kategori:</strong>
                        {{ $item->kategoriRelasi->nama_kategori ?? 'Tidak ada kategori' }}
                    </p>

                    {{-- Tombol Admin --}}
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <a href="{{ route('admin.budaya.edit', $item->id) }}"
                           class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('admin.budaya.destroy', $item->id) }}"
                              method="POST"
                              style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>

        {{-- Modal Detail --}}
        <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">{{ $item->nama }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid mb-3">
                        @endif

                        <h6><strong>Asal Daerah:</strong> {{ $item->asal_daerah }}</h6>
                        <h6><strong>Kategori:</strong> {{ $item->kategoriRelasi->nama_kategori ?? '-' }}</h6>

                        <hr>

                        <h5>Deskripsi Lengkap</h5>
                        <p style="text-align: justify;">
                            {!! nl2br(e($item->deskripsi)) !!}
                        </p>

                        @if($item->latitude && $item->longitude)
                            <hr>
                            <h5>Lokasi Peta</h5>
                            <div id="map{{ $item->id }}" style="height: 250px;"></div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    var map = L.map("map{{ $item->id }}").setView(
                                        [{{ $item->latitude }}, {{ $item->longitude }}],
                                        14
                                    );

                                    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                                        maxZoom: 19
                                    }).addTo(map);

                                    L.marker([{{ $item->latitude }}, {{ $item->longitude }}]).addTo(map);
                                });
                            </script>
                        @endif

                    </div>

                </div>
            </div>
        </div>

        @endforeach
    </div>

</div>
@endsection
