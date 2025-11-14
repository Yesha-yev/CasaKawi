<!doctype html>
<html>
<head><meta charset="utf-8"><title>Kelola Seniman</title></head>
<body>
  <h1>Kelola Seniman</h1>
  <p><a href="{{ route('admin.seniman.create') }}">Tambah Seniman</a></p>
  <table border="1" cellpadding="6">
    <thead><tr><th>ID</th><th>Nama</th><th>Email</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
      @foreach($senimans as $s)
        <tr>
          <td>{{ $s->id }}</td>
          <td>{{ $s->name }}</td>
          <td>{{ $s->email }}</td>
          <td>{{ $s->status ? 'Aktif' : 'Tidak Aktif' }}</td>
          <td><a href="{{ route('admin.seniman.edit', $s->id) }}">Edit</a></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
