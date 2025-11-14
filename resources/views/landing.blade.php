<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Casa Kawi - Landing</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <!-- pilih styling: pakai Bootstrap CDN cepat -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
  <div class="container py-4">
    <h1 class="mb-4">Jumlah Karya per Kategori</h1>

    <div class="card p-3 mb-4">
      <canvas id="kategoriChart" height="120"></canvas>
    </div>

    <div class="card p-3">
      <h5>Data Kategori (raw)</h5>
      <pre>{{ json_encode($labels) }} => {{ json_encode($values) }}</pre>
    </div>
  </div>

  <script>
    // ambil data dari PHP yang dikirim controller
    const labels = {!! json_encode($labels) !!};
    const values = {!! json_encode($values) !!};

    const ctx = document.getElementById('kategoriChart').getContext('2d');
    const kategoriChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Jumlah Karya',
          data: values,
          backgroundColor: labels.map((l, idx) => 'rgba(54,162,235,0.6)'),
          borderColor: labels.map((l, idx) => 'rgba(54,162,235,1)'),
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { precision:0 } } }
      }
    });
  </script>
</body>
</html>
