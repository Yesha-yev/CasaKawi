<!doctype html>
<html>
<head><meta charset="utf-8"><title>Admin Dashboard</title></head>
<body>
  <h1>Dashboard Admin</h1>

  <p>Jumlah Seniman: {{ $jumlahSeniman }}</p>
  <p>Jumlah Karya: {{ $jumlahKarya }}</p>
  <p>Jumlah Budaya: {{ $jumlahBudaya }}</p>
  <p>Jumlah Kategori: {{ $jumlahKategori }}</p>
  <p>Jumlah Laporan: {{ $jumlahLaporan }}</p>

  <hr>
  <h3>Grafik Karya per Kategori</h3>
  <canvas id="chartKategori" width="600" height="250"></canvas>

  <h3>Grafik Budaya per Daerah</h3>
  <canvas id="chartBudaya" width="600" height="250"></canvas>

  <hr>
  <p><a href="{{ route('admin.seniman.index') }}">Kelola Seniman</a> | <a href="{{ route('admin.laporan') }}">Lihat Laporan</a></p>

  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const labels = @json($kategoriData->pluck('nama_kategori')->toArray());
    const counts = @json($kategoriData->pluck('karyas_count')->toArray());
    new Chart(document.getElementById('chartKategori'), {
      type:'line', data:{ labels: labels, datasets:[{ label:'Jumlah Karya', data: counts, borderWidth:2, fill:false }]},
      options:{ scales:{ y:{ beginAtZero:true } } }
    });

    const daerahLabels = @json($budayaByDaerah->pluck('asal_daerah')->toArray());
    const daerahCounts = @json($budayaByDaerah->pluck('total')->toArray());
    new Chart(document.getElementById('chartBudaya'), {
      type:'bar', data:{ labels: daerahLabels, datasets:[{ label:'Jumlah Budaya', data: daerahCounts }]},
      options:{ scales:{ y:{ beginAtZero:true } } }
    });
  </script>
</body>
</html>
