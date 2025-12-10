@extends('layouts.app')

@section('title', 'Tambah Budaya / Artefak')

@section('content')
<div class="card p-4 shadow-sm" style="background: #f5efe6; border-radius: 16px; max-width: 1500px; margin: auto;">
    <h3 class="mb-4 text-center" style="color: #5a4328;">Tambah Budaya / Artefak</h3>

    @if($errors->any())
        <div class="alert alert-danger rounded-3">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.budaya.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Nama Budaya --}}
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color: #5a4328;">Nama Budaya / Artefak</label>
            <input type="text" name="nama" class="form-control border-0 shadow-sm" placeholder="Contoh: Reog Ponorogo" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color:#5a4328;">Deskripsi</label>
            <textarea name="deskripsi" class="form-control border-0 shadow-sm" rows="4" placeholder="Deskripsikan budaya / artefak tersebut"></textarea>
        </div>

        {{-- Asal Daerah --}}
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color: #5a4328;">Asal Daerah</label>
            <input type="text" name="asal_daerah" class="form-control border-0 shadow-sm" placeholder="Contoh: Ponorogo" required>
        </div>

        {{-- Kategori --}}
        <div class="mb-3">
            <label class="form-label fw-semibold" style="color: #5a4328;">Kategori</label>
            <select name="kategori" class="form-control border-0 shadow-sm" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        {{-- MAP --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Pilih Lokasi Budaya</label>
            <div id="map" style="height: 300px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px rgba(0,0,0,0.1)"></div>
        </div>

        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">

        {{-- Upload Gambar --}}
        <div class="mb-4">
            <label class="form-label fw-semibold" style="color: #5a4328;">Foto / Gambar</label>
            <input type="file" name="gambar" class="form-control border-0 shadow-sm" accept="image/*" required>
        </div>

        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-gradient px-4 py-2 fw-semibold" style="background: linear-gradient(90deg,#a67c52,#d4b483); color: #fff; border-radius: 10px; transition: 0.3s;">Simpan</button>
            <a href="{{ route('budaya.index') }}" class="btn btn-secondary px-4 py-2 fw-semibold" style="border-radius: 10px; transition: 0.3s;">Batal</a>
        </div>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    var defaultLat = -8.2192;
    var defaultLng = 113.6437;

    var map = L.map('map').setView([defaultLat, defaultLng], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    var marker;

    map.on('click', function(e) {

        if (!marker) {
            marker = L.marker(e.latlng).addTo(map);
        } else {
            marker.setLatLng(e.latlng);
        }

        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
    });
});
</script>

<style>
    .btn-gradient:hover {
        filter: brightness(1.1)
    }

    input:focus, textarea:focus, select:focus {
        box-shadow: 0 0 8px rgba(166, 124, 82, 0.4);
        outline: none;
    }

</style>

@endsection
