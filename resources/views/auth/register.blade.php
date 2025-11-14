<!doctype html>
<html>
<head><meta charset="utf-8"><title>Register</title></head>
<body>
  <h2>Daftar (Seniman)</h2>
  <form method="POST" action="{{ route('register.post') }}">
    @csrf
    <label>Nama</label><br>
    <input name="name" required value="{{ old('name') }}"><br>
    <label>Email</label><br>
    <input name="email" type="email" required value="{{ old('email') }}"><br>
    <label>Password</label><br>
    <input name="password" type="password" required><br>
    <label>Konfirmasi Password</label><br>
    <input name="password_confirmation" type="password" required><br><br>
    <button type="submit">Daftar</button>
  </form>
  @if($errors->any())
    <div style="color:red">{{ $errors->first() }}</div>
  @endif
</body>
</html>
