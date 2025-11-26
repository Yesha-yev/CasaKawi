@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container mt-4">

    <h3>Edit Profil</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('seniman.profil.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="mb-3">
            <label>Password Baru (opsional)</label>
            <input type="password" name="password" class="form-control"
                   placeholder="Kosongkan jika tidak diganti">
        </div>

        <button class="btn btn-primary">Simpan Perubahan</button>
    </form>

</div>
@endsection
