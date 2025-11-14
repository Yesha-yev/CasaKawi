<!doctype html>
<html>
<head><meta charset="utf-8"><title>Laporan</title></head>
<body>
  <h1>Daftar Laporan</h1>
  <table border="1" cellpadding="6">
    <thead><tr><th>ID</th><th>Judul</th><th>Isi</th><th>Kontak</th><th>User</th><th>Tanggal</th></tr></thead>
    <tbody>
      @foreach($laporans as $lap)
        <tr>
          <td>{{ $lap->id }}</td>
          <td>{{ $lap->judul }}</td>
          <td>{{ $lap->isi }}</td>
          <td>{{ $lap->kontak }}</td>
          <td>{{ $lap->user?->name ?? 'Guest' }}</td>
          <td>{{ $lap->created_at }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
