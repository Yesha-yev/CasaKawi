@extends('layouts.app')

@section('title','Admin Dashboard')

@section('content')
<div class="container py-4">

    <h2 class="mb-4 text-center fw-bold">📊 Dashboard Admin</h2>

    <div class="row mb-4">

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5>Jumlah Seniman</h5>
                    <h3 class="fw-bold">{{ $jumlahSeniman }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5>Jumlah Karya</h5>
                    <h3 class="fw-bold">{{ $jumlahKarya }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5>Jumlah Budaya</h5>
                    <h3 class="fw-bold">{{ $jumlahBudaya }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5>Jumlah Kategori</h5>
                    <h3 class="fw-bold">{{ $jumlahKategori }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5>Jumlah Laporan</h5>
                    <h3 class="fw-bold">{{ $jumlahLaporan }}</h3>
                </div>
            </div>
        </div>

    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h4 class="text-center mb-3">Grafik Karya per Kategori</h4>
            <canvas id="chartKategori" style="height: 300px"></canvas>
        </div>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h4 class="text-center mb-3">Grafik Budaya per Daerah</h4>
            <canvas id="chartBudaya" style="height: 300px"></canvas>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="{{ route('admin.seniman.index') }}" class="btn btn-primary me-2">Kelola Seniman</a>
        <a href="{{ route('admin.laporan') }}" class="btn btn-warning">Lihat Laporan</a>
    </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = @json($kategoriData->pluck('nama_kategori'));
    const counts = @json($kategoriData->pluck('karyas_count')).map(Number);

    new Chart(document.getElementById('chartKategori'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Karya',
                data: counts,
                borderColor: 'purple',
                backgroundColor: 'rgba(128, 0, 128, 0.3)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
            }]
        },
        options: {
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    color: "#ffffff"
                }
            },
            tooltip: {
                titleColor: "#ffffff",
                bodyColor: "#ffffff",
                footerColor: "#ffffff"
            }
        },
        scales: {
            x: {
                ticks: { color: "#ffffff" },
                grid: { color: "rgba(255, 255, 255, 0.2)" }
            },
            y: {
                beginAtZero: true,
                ticks: { color: "#ffffff" },
                grid: { color: "rgba(255, 255, 255, 0.2)" }
            }
        }
    }
    });

    const daerahLabels = @json($budayaByDaerah->pluck('asal_daerah'));
    const daerahCounts = @json($budayaByDaerah->pluck('total')).map(Number);

    function randomColors(len) {
        return Array.from({ length: len }, () => {
            const r = Math.floor(Math.random() * 255);
            const g = Math.floor(Math.random() * 255);
            const b = Math.floor(Math.random() * 255);
            return `rgba(${r}, ${g}, ${b}, 0.7)`;
        });
    }

    new Chart(document.getElementById('chartBudaya'), {
        type: 'pie',
        data: {
            labels: daerahLabels,
            datasets: [{
                data: daerahCounts,
                backgroundColor: randomColors(daerahCounts.length),
            }]
        },
        options: {
        responsive: true,
        plugins: {
            legend: {
                labels: {
                    color: "#ffffff"
                }
            },
            tooltip: {
                titleColor: "#ffffff",
                bodyColor: "#ffffff"
            }
        }
}
    });
</script>
@endsection
