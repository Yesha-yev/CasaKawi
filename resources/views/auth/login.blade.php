<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login</title></head>
<body>
  <h2>Login</h2>
  <form method="POST" action="{{ route('login.post') }}">
    @csrf
    <label>Email</label><br>
    <input type="email" name="email" required value="{{ old('email') }}"><br>
    <label>Password</label><br>
    <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
  </form>
  @if($errors->any())
    <div style="color:red">{{ $errors->first() }}</div>
  @endif
  <p><a href="{{ route('register') }}">Daftar Seniman</a></p>
</body>
</html>
