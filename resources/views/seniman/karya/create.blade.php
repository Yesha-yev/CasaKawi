@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Karya Seni</h3>

    <div class="alert alert-info">
        <strong>Catatan:</strong> Audio penjelasan karya akan <strong>dibuat otomatis</strong> berdasarkan deskripsi
        menggunakan fitur Text-to-Speech. Pastikan deskripsi ditulis dengan jelas.
    </div>

    <form action="{{ route('seniman.karya.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Karya</label>
            <input type="text" name="nama_karya" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tahun Dibuat</label>
            <input type="number" name="tahun_dibuat" class="form-control">
        </div>

        <div class="mb-3">
            <label>Asal Daerah</label>
            <input type="text" name="asal_daerah" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Deskripsi <span class="text-danger">*</span></label>
            {{-- 🔊 Wajib diisi agar audio bisa digenerate --}}
            <textarea name="deskripsi" class="form-control" rows="4" required placeholder="Tulis deskripsi karya..."></textarea>
        </div>

        <!-- MAP -->
        <div class="mb-3">
            <label>Pilih Lokasi Karya</label>
            <div id="map" style="height: 300px;"></div>
        </div>

        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">

        <div class="mb-3">
            <label>Upload Gambar</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" onchange="previewImage(event)">
            <img id="preview" class="mt-2" style="width:180px; display:none;">
        </div>

        <button class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    var map = L.map('map').setView([-7.250445, 112.768845], 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(map);

    var marker;

    map.on('click', function(e){
        if (marker) map.removeLayer(marker);

        marker = L.marker(e.latlng).addTo(map);

        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
    });

    function previewImage(event) {
        var img = document.getElementById('preview');
        img.src = URL.createObjectURL(event.target.files[0]);
        img.style.display = "block";
    }
</script>
@endsection
