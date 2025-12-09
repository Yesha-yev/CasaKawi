@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4 text-brown">Tambah Karya</h3>

    <div class="form-wrapper p-4 rounded-4 mb-4">
        <div class="alert alert-info rounded-3">
            <strong>Catatan:</strong> Audio penjelasan karya akan <strong>dibuat otomatis</strong> berdasarkan deskripsi
            menggunakan fitur Text-to-Speech. Pastikan deskripsi ditulis dengan jelas.
        </div>

        <form action="{{ route('seniman.karya.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label text-brown">Nama Karya</label>
                <input type="text" name="nama_karya" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-brown">Tahun Dibuat</label>
                <input type="number" name="tahun_dibuat" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label text-brown">Asal Daerah</label>
                <input type="text" name="asal_daerah" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-brown">Kategori</label>
                <select name="kategori_id" class="form-control" required>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label text-brown">Deskripsi <span class="text-danger">*</span></label>
                <textarea name="deskripsi" class="form-control" rows="4" required placeholder="Tulis deskripsi karya..."></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label text-brown">Pilih Lokasi Karya</label>
                <div id="map" class="rounded-3" style="height: 300px;"></div>
            </div>

            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">

            <div class="mb-3">
                <label class="form-label text-brown">Upload Gambar</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" onchange="previewImage(event)">
                <img id="preview" class="mt-2 rounded-2" style="width:180px; display:none;">
            </div>

            <button class="btn btn-brown">Simpan</button>
        </form>
    </div>
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

<style>
.text-brown { color: #c9c1b6 !important; }
.btn-brown { background-color: #694d28; color: #fff; border: none; }
.btn-brown:hover { background-color: #5a3e1f; }

.form-wrapper {
    background-color: #fff8f0;
    border: 2px solid #d8cbbd;
    color: #4b3b2a;
}

.alert-info { background-color: #f8f0e0; color: #694d28; border:1px solid #d8cbbd; }

.form-control, .form-select, textarea, #map, #preview { border-radius: 6px; }
</style>

@endsection
