@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Karya Seni</h3>

    {{-- 🔊 Info Audio --}}
    <div class="alert alert-info">
        Audio penjelasan karya dibuat otomatis berdasarkan deskripsi.
        Jika Anda mengubah deskripsi, audio akan diperbarui otomatis setelah menekan tombol "Update".
    </div>

    {{-- 🔊 Audio Player --}}
    @if($karya->audio)
    <div class="mb-3">
        <label>Audio Saat Ini</label>
        <audio controls class="w-100">
            <source src="{{ asset($karya->audio) }}" type="audio/mpeg">
            Browser tidak mendukung audio.
        </audio>
    </div>
    @endif

    <form action="{{ route('seniman.karya.update', $karya->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Karya</label>
            <input type="text" name="nama_karya" value="{{ $karya->nama_karya }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tahun Dibuat</label>
            <input type="number" name="tahun_dibuat" value="{{ $karya->tahun_dibuat }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Asal Daerah</label>
            <input type="text" name="asal_daerah" value="{{ $karya->asal_daerah }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}" {{ $karya->kategori_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required>{{ $karya->deskripsi }}</textarea>
        </div>

        <!-- MAP -->
        <div class="mb-3">
            <label>Pilih Lokasi Karya</label>
            <div id="map" style="height: 300px;"></div>
        </div>

        <input type="hidden" name="latitude" id="latitude" value="{{ $karya->latitude }}">
        <input type="hidden" name="longitude" id="longitude" value="{{ $karya->longitude }}">

        <div class="mb-3">
            <label>Gambar Saat Ini</label><br>

            @if($karya->gambar)
                <img id="oldImage" src="/{{ $karya->gambar }}" alt="gambar" width="180" class="mb-2">
            @else
                <p><i>Tidak ada gambar</i></p>
            @endif
        </div>

        <div class="mb-3">
            <label>Ganti Gambar (opsional)</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" onchange="previewImage(event)">
            <img id="preview" class="mt-2" style="width:180px; display:none;">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection


@section('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    // MAP
    var lat = {{ $karya->latitude ?? -7.250445 }};
    var lng = {{ $karya->longitude ?? 112.768845 }};
    var map = L.map('map').setView([lat, lng], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
    }).addTo(map);

    var marker = L.marker([lat, lng]).addTo(map);

    map.on('click', function(e){
        if (marker) map.removeLayer(marker);
        marker = L.marker(e.latlng).addTo(map);

        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
    });

    // IMAGE PREVIEW
    function previewImage(event) {
        var img = document.getElementById('preview');
        img.src = URL.createObjectURL(event.target.files[0]);
        img.style.display = "block";

        var old = document.getElementById('oldImage');
        if (old) old.style.opacity = "0.3";
    }
</script>
@endsection
