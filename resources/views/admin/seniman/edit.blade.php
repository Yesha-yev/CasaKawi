@extends('layouts.app')

@section('title', 'Edit Seniman')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0">
                    <h4 class="fw-bold mb-0">Edit Seniman</h4>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.seniman.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password (kosongkan jika tidak diganti)</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
