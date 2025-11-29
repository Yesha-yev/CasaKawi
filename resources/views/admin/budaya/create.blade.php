@extends('layouts.app')

@section('title', 'Tambah Budaya / Artefak')

@section('content')
<div class="card p-4">
    <h3 class="mb-3">Tambah Budaya / Artefak</h3>

    @if($errors->any())
        <div class="alert alert-danger">
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
            <label class="form-label">Nama Budaya / Artefak</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
        </div>

        {{-- Asal Daerah --}}
        <div class="mb-3">
            <label class="form-label">Asal Daerah</label>
            <input type="text" name="asal_daerah" class="form-control" required>
        </div>

        {{-- Kategori --}}
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="kategori" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        {{-- MAP --}}
        <div class="mb-3">
            <label class="form-label">Pilih Lokasi Budaya</label>
            <div id="map" style="height: 300px;"></div>
        </div>

        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">

        {{-- Upload Gambar --}}
        <div class="mb-3">
            <label class="form-label">Foto / Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('budaya.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

{{-- SCRIPT MAP --}}
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

@endsection
