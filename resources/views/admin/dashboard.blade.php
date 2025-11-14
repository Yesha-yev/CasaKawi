<!doctype html>
<html>
<head><meta charset="utf-8"><title>Admin Dashboard</title></head>
<body>
  <h1>Dashboard Admin</h1>
  <p>Jumlah seniman: {{ $jumlahSeniman }}</p>
  <p>Jumlah karya: {{ $jumlahKarya }}</p>
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
  </form>
</body>
</html>
