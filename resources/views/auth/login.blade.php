<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN - CasaKawi</title>
</head>
<body>
    <h2>Login</h2>
    <form methode="POST" action="{{ route('login.post') }}"></form>
        @csrf
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    @if($errors->any())
        <p style="color:red">{{ $errors->first() }}</p>
    @endif
    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
</body>
</html>
