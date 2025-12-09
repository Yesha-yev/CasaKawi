@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">

            <div class="card shadow-sm border-0">
                <div class="card-header border-0">
                    <h4 class="fw-bold mb-0">Login</h4>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100">Login</button>

                    </form>

                    @if($errors->any())
                        <div class="alert alert-danger mt-3">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <p class="text-center mt-3">
                        Belum punya akun?
                        <a href="{{ route('register') }}">Daftar Seniman</a>
                    </p>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
