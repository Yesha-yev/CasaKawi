@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center" style="color: #694d28;">Daftar Budaya</h2>

    @if(auth()->check() && auth()->user()->role === 'admin')
        <a href="{{ route('admin.budaya.create') }}" class="btn btn-primary mb-3 px-4 py-2 fw-semibold">Tambah Budaya</a>
    @endif

    <div class="row">
        @foreach ($budaya as $item)
        <div class="col-md-4 mb-4 d-flex">
            <div class="card shadow-sm w-100" style="background: #f5efe6; border-radius: 16px">

                @if ($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="gambar budaya">
                @else
                    <img src="https://via.placeholder.com/300x200?text=Tidak+Ada+Gambar" class="card-img-top" style="height: 200px; object-fit: cover;">
                @endif

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $item->nama }}</h5>

                    <p class="card-text flex-grow-1">
                        {{ Str::limit($item->deskripsi, 120) }}
                    </p>

                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $item->id }}" style="background-color: #694d28; color: #ffff">
                        Lihat Selengkapnya
                    </button>

                    <p class="mb-1"><strong>Asal Daerah:</strong> {{ $item->asal_daerah }}</p>

                    <p class="mb-2"><strong>Kategori:</strong>
                        {{ $item->kategoriRelasi->nama_kategori ?? 'Tidak ada kategori' }}
                    </p>

                    <div class="d-flex justify-content-between mt-auto flex-wrap gap-2">
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <a href="{{ route('admin.budaya.edit', $item->id) }}" class="btn btn-warning btn-sm flex-grow-1">Edit</a>

                            <form action="{{ route('admin.budaya.destroy', $item->id) }}" method="POST" class="flex-grow-1">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-gradient btn-sm w-100" style="background: linear-gradient(90deg,#a67c52,#d9534f); color:#fff; border:none; border-radius:8px;">Hapus</button>
                            </form>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4 shadow-sm" style="background-color: #efe7db; border: 1px solid #e0d6c3;">

                    <div class="modal-header" style="background-color: #f8f0e0; color: #694d28; border-bottom: 1px solid #694d28;">
                        <h5 class="modal-title">{{ $item->nama }}</h5>
                        <button type="button"
                                class="btn btn-sm"
                                data-bs-dismiss="modal"
                                style="background-color: #694d28; color: #fff; border-radius: 50%; width: 30px; height: 30px; font-size: 20px; line-height: 1; border: none;">
                            &times;
                        </button>
                    </div>

                    <div class="modal-body" style="color: #343a40;">

                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid mb-3 rounded" style="max-height:300px; object-fit: cover;">
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

                            <button onclick="bukaNavigasi({{ $item->latitude }}, {{ $item->longitude }})"
                                class="btn btn-primary w-100 mt-3">
                                Navigasi ke Lokasi
                            </button>

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    var modal = document.getElementById("modalDetail{{ $item->id }}");

                                    modal.addEventListener("shown.bs.modal", function () {

                                        if (!modal.mapInitialized) {
                                            var map = L.map("map{{ $item->id }}").setView(
                                                [{{ $item->latitude }}, {{ $item->longitude }}],
                                                14
                                            );

                                            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                                                maxZoom: 19
                                            }).addTo(map);

                                            L.marker([{{ $item->latitude }}, {{ $item->longitude }}]).addTo(map);

                                            modal.mapInitialized = true;
                                            modal.leafletMap = map;
                                        }

                                        setTimeout(() => {
                                            modal.leafletMap.invalidateSize();
                                        }, 200);

                                    });
                                });

                                function bukaNavigasi(lat, lng) {
                                    if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition(function(pos) {
                                            const userLat = pos.coords.latitude;
                                            const userLng = pos.coords.longitude;

                                            const url = `https://www.google.com/maps/dir/?api=1&origin=${userLat},${userLng}&destination=${lat},${lng}`;
                                            window.open(url, "_blank");
                                        }, function() {
                                            window.open(`https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`, "_blank");
                                        });
                                    }
                                }
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
