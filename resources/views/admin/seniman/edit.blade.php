<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Seniman</title></head>
<body>
  <h1>Edit Seniman</h1>
  <form method="POST" action="{{ route('admin.seniman.update', $user->id) }}">
    @csrf
    @method('PUT')
    <label>Nama</label><br><input name="name" value="{{ $user->name }}" required><br>
    <label>Email</label><br><input name="email" type="email" value="{{ $user->email }}" required><br>
    <label>Password (biarkan kosong jika tidak ingin ganti)</label><br><input name="password" type="password"><br>
    <label>Konfirmasi Password</label><br><input name="password_confirmation" type="password"><br>
    <label>Status (1=aktif,0=tidak)</label><br><input name="status" value="{{ $user->status }}"><br><br>
    <button type="submit">Update</button>
  </form>
</body>
</html>
