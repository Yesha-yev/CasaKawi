@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 text-brown">Edit Profil</h3>

    <div class="form-wrapper p-4 rounded-4">

        <a href="{{ route('seniman.dashboard') }}" class="btn btn-secondary mb-3 rounded-2">Kembali</a>

        @if(session('success'))
            <div class="alert alert-success rounded-3">{{ session('success') }}</div>
        @endif

        <form action="{{ route('seniman.profil.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label text-brown">Nama</label>
                <input type="text" name="name" class="form-control rounded-2"value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-brown">Email</label>
                <input type="email" name="email" class="form-control rounded-2"value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-brown">Password Baru (opsional)</label>
                <input type="password" name="password" class="form-control rounded-2"placeholder="Kosongkan jika tidak diganti">
            </div>

            <button class="btn btn-brown">Simpan Perubahan</button>
        </form>

    </div>
</div>

<style>
.text-brown { color: #c9c1b6 !important; }
.btn-brown { background-color: #694d28; color: #fff; border: none; }
.btn-brown:hover { background-color: #5a3e1f; }

.btn-secondary {
    background-color: #b8a898;
    border: none;
    color: #fff;
}
.btn-secondary:hover {
    background-color: #a29384;
}

.form-wrapper {
    background-color: #fff8f0;
    border: 2px solid #d8cbbd;
    color: #4b3b2a;
}

.alert-success { border-radius: 6px; }
.form-control { border-radius: 6px; }
</style>

@endsection
