@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-4 shadow-sm" style="background: #f5efe6; border-radius: 16px; max-width: 1500px; margin: auto;">
        <h2 class="mb-4 text-center">Edit Data Budaya</h2>

        @if($errors->any())
            <div class="alert alert-danger rounded-3">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.budaya.update', $budaya->id) }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-3">
                <label class="form-label">Nama Budaya</label>
                <input type="text" name="nama" class="form-control"
                    value="{{ old('nama', $budaya->nama) }}" required>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ old('deskripsi', $budaya->deskripsi) }}</textarea>
            </div>

            {{-- Asal Daerah --}}
            <div class="mb-3">
                <label class="form-label">Asal Daerah</label>
                <input type="text" name="asal_daerah" class="form-control"
                    value="{{ old('asal_daerah', $budaya->asal_daerah) }}" required>
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id }}" {{ $budaya->kategori == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- MAP --}}
            <div class="mb-3">
                <label class="form-label">Pilih Lokasi Budaya</label>
                <div id="map" style="height: 300px; border-radius: 12px;"></div>
            </div>

            <input type="hidden" name="latitude" id="latitude" value="{{ $budaya->latitude }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ $budaya->longitude }}">

            {{-- Gambar --}}
            <div class="mb-3">
                <label>Upload Gambar (opsional)</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" onchange="previewImage(event)">
                <img id="preview" class="mt-2" style="width:180px; :{{ $budaya->gambar ? 'block' : 'none' }}; border-radius:8px;"
                src="{{ $budaya->gambar ? asset('storage/'.$budaya->gambar) : '' }}">
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('budaya.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>

{{-- SCRIPT MAP --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    var lat = {{ $budaya->latitude ?? -8.2192 }};
    var lng = {{ $budaya->longitude ?? 113.6437 }};

    var map = L.map('map').setView([lat, lng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    var marker = L.marker([lat, lng]).addTo(map);

    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
    });
});
</script>

@endsection
