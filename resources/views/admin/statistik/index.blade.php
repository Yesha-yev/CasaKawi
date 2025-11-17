@extends('layouts.app')

@section('title', 'Statistik Admin')

@section('content')
<h1>Statistik Admin</h1>

<h3>Jumlah Karya per Kategori</h3>
<canvas id="chartKategori"></canvas>

<h3>Jumlah Budaya per Daerah</h3>
<canvas id="chartDaerah"></canvas>

<h3>Statistik Laporan (Sensitif)</h3>
<ul>
    @foreach($laporanStats as $status => $total)
        <li>{{ $status }} : {{ $total }}</li>
    @endforeach
</ul>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('chartKategori'), {
    type: 'bar',
    data: {
        labels: @json($kategoriData->pluck('nama_kategori')),
        datasets: [{
            label: 'Jumlah Karya',
            data: @json($kategoriData->pluck('karyas_count')),
        }]
    }
});

new Chart(document.getElementById('chartDaerah'), {
    type: 'pie',
    data: {
        labels: @json($budayaByDaerah->pluck('asal_daerah')),
        datasets: [{
            label: 'Jumlah Budaya',
            data: @json($budayaByDaerah->pluck('total')),
        }]
    }
});
</script>
@endpush
