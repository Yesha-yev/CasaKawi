@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4 text-danger">Hapus Data Budaya</h2>

    <div class="alert alert-warning">
        <strong>Apakah kamu yakin ingin menghapus budaya berikut?</strong>
    </div>

    <p><strong>Nama:</strong> {{ $budaya->nama }}</p>
    <p><strong>Deskripsi:</strong> {{ $budaya->deskripsi }}</p>

    <form action="{{ route('admin.budaya.destroy', $budaya->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">Ya, Hapus</button>

        <a href="{{ route('budaya.index') }}" class="btn btn-secondary">Batal</a>
    </form>

</div>
@endsection
