@extends('layouts.app')

@section('title','Casa Kawi — Beranda')

@section('content')

<div class="card p-4 mb-4">
    <h2>Selamat datang di Casa Kawi</h2>
    <p>Galeri Digital Budaya Jawa Timur — jelajahi peta, timeline, dan karya seniman.</p>
</div>

<div class="card p-3 mb-4">
    <h5>Peta Persebaran Budaya</h5>
    <div id="map" style="height: 400px;"></div>
</div>

@if(isset($kategoriData))
<div class="card p-3 mb-4">
    <h5>Grafik Karya per Kategori</h5>
    <canvas id="kategoriChart"></canvas>
</div>
@endif

@endsection

@push('scripts')
<script>
    const map = L.map('map').setView([-7.9778, 112.6347], 7); // Jawa Timur

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18
    }).addTo(map);

    const lokasi = {!! json_encode($lokasi) !!};

    lokasi.forEach(item => {
        L.marker([item.latitude, item.longitude])
            .addTo(map)
            .bindPopup(`<b>${item.nama}</b><br>${item.asal_daerah}`);
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = {!! json_encode($kategoriData->pluck('nama_kategori')) !!};
    const values = {!! json_encode($kategoriData->pluck('karyas_count')) !!};

    if (labels.length) {
        new Chart(document.getElementById('kategoriChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Karya',
                    data: values,
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }
</script>

@endpush
