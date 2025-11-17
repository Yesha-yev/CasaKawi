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

                    <form method="POST" action="{{ route('register.post') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input name="name" value="{{ old('name') }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input name="email" type="email" value="{{ old('email') }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input name="password_confirmation" type="password" class="form-control" required>
                        </div>

                        <button class="btn btn-primary w-100">Daftar</button>

                    </form>

                    @if($errors->any())
                        <div class="alert alert-danger mt-3">
                            {{ $errors->first() }}
                        </div>
                    @endif

                </div>

            </div>

        </div>
    </div>
</div>
@endsection
