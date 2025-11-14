<!doctype html>
<html>
<head><meta charset="utf-8"><title>Tambah Seniman</title></head>
<body>
  <h1>Tambah Seniman</h1>
  <form method="POST" action="{{ route('admin.seniman.store') }}">
    @csrf
    <label>Nama</label><br><input name="name" required><br>
    <label>Email</label><br><input name="email" type="email" required><br>
    <label>Password</label><br><input name="password" type="password" required><br>
    <label>Konfirmasi Password</label><br><input name="password_confirmation" type="password" required><br>
    <label>Status (1=aktif,0=tidak)</label><br><input name="status" value="1"><br><br>
    <button type="submit">Simpan</button>
  </form>
</body>
</html>
