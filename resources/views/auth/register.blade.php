<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>REGISTER - CasaKawi</title>
</head>
<body>
    <h2>Register (Seniman)</h2>
    <form method="POST" action="{{ route('register.post') }}"></form>
    @csrf
    <label for="">Nama</label>
    <input type="text" name="name" value="{{ old('name') }}" required>
    <label for="">Email</label>
    <input type="text" name="email" value="{{ old('email') }}" required>
    <label for="">Password</label>
    <input type="password" name="password" required>
    <label for="">Konfirmasi Password</label>
    <input type="password" name="password_confirmation" required>
    <button type="submit">Register</button>
    </form>
    @if($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
    @endif
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</body>
</html>
