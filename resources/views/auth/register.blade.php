@extends('layouts.app')

@section('title', 'Daftar Seniman')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0">
                    <h4 class="fw-bold mb-0">Daftar Seniman</h4>
                </div>

                <div class="card-body">

                    {{-- ALERT ERROR GLOBAL --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- ALERT SUCCESS --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror"
                                required
                            >
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                required
                            >
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input
                                name="password"
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required
                            >
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input
                                name="password_confirmation"
                                type="password"
                                class="form-control"
                                required
                            >
                        </div>

                        <button class="btn btn-primary w-100">
                            Daftar
                        </button>

                        <div class="mt-3 text-center">
                            Sudah punya akun?
                            <a href="{{ route('login') }}">Login</a>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
