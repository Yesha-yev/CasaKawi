@extends('layouts.app')

@section('content')
<div class="card p-4 shadow-sm"
    style="background: #f5efe6; border-radius: 16px; max-width: 700px; margin: 2rem auto;">

    <h3 class="mb-4 text-center" style="color: #5a4328;">Hapus Data Budaya</h3>

    <div class="alert alert-warning rounded-3">
        <strong>Apakah kamu yakin ingin menghapus budaya berikut?</strong>
    </div>

    <div class="mb-3">
        <p><strong>Nama:</strong> {{ $budaya->nama }}</p>
        <p><strong>Deskripsi:</strong> {{ $budaya->deskripsi }}</p>
    </div>

    <div class="d-flex justify-content-center gap-3">
        <form action="{{ route('admin.budaya.destroy', $budaya->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-gradient px-4 py-2 fw-semibold"
                style="background: linear-gradient(90deg,#a67c52,#d9534f); color:#fff; border:none; border-radius:10px; transition:0.3s;">
                Ya, Hapus
            </button>
        </form>

        <a href="{{ route('budaya.index') }}" class="btn btn-secondary px-4 py-2 fw-semibold" style="border-radius:10px;">
            Batal
        </a>
    </div>
</div>

<style>
    .btn-gradient:hover {
        filter: brightness(1.1);
    }
</style>
@endsection
