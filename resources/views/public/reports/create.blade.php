@extends('layouts.app')

@section('content')

<h2>Laporan Budaya Baru</h2>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form method="POST" enctype="multipart/form-data">
@csrf

<label>Judul</label>
<input type="text" name="title" class="form-control" required>

<label>Deskripsi</label>
<textarea name="description" class="form-control" required></textarea>

<label>Foto (opsional)</label>
<input type="file" name="image" class="form-control">

<button class="btn btn-primary mt-3">Kirim Laporan</button>

</form>

@endsection
