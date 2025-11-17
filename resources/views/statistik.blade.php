@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="mb-4 text-center fw-bold">📊 Statistik Publik</h2>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h4 class="text-center mb-3">Jumlah Karya per Kategori</h4>
            <canvas id="kategoriChart" style="height: 300px"></canvas>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h4 class="text-center mb-3">Jumlah Budaya per Daerah</h4>
            <canvas id="lokasiChart" style="height: 300px"></canvas>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Data dari controller
    const kategoriLabels = @json($kategoriData->pluck('nama_kategori'));
    const kategoriCounts = @json($kategoriData->pluck('karyas_count')).map(Number);

    const lokasiLabels = @json($lokasiAgregat->pluck('asal_daerah'));
    const lokasiCounts = @json($lokasiAgregat->pluck('total')).map(Number);

    // Warna random aman Chart.js
    function randomColors(len) {
        return Array.from({ length: len }, () => {
            const r = Math.floor(Math.random() * 255);
            const g = Math.floor(Math.random() * 255);
            const b = Math.floor(Math.random() * 255);
            return `rgba(${r}, ${g}, ${b}, 0.7)`;
        });
    }

    // Bar Chart
    new Chart(document.getElementById('kategoriChart'), {
        type: 'line',
        data: {
            labels: kategoriLabels,
            datasets: [{
                label: 'Jumlah Karya',
                data: kategoriCounts,
                borderColor: 'purple',   // warna garis
                backgroundColor: 'rgba(128, 0, 128, 0.3)', // area fill opsional
                borderWidth: 2,
                tension: 0.4, // membuat garis smooth (0 = kaku)
                fill: true    // jika ingin ada area warna di bawah garis
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                tooltip: {
                    callbacks: {
                        label: ctx => `${ctx.raw} karya`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Pie Chart
    new Chart(document.getElementById('lokasiChart'), {
        type: 'pie',
        data: {
            labels: lokasiLabels,
            datasets: [{
                data: lokasiCounts,
                backgroundColor: randomColors(lokasiCounts.length),
            }]
        },
        options: { responsive: true }
    });
</script>
@endsection
