@extends('layouts.app')

@section('title', 'Dashboard Seniman')

@section('content')
<div class="container">
  <div class="card mb-4 p-3">
    <h3>Halo, {{ $user->username ?? $user->name }}</h3>
    <p class="text-muted">Profil singkat: {{ $user->deskripsi ?? '-' }}</p>

    <div class="d-flex gap-2">
      <a href="{{ route('seniman.karya.create') ?? '#' }}" class="btn btn-primary btn-sm">Tambah Karya</a>
    </div>
  </div>

  <div class="card p-3">
    <h5>Daftar Karya ({{ $jumlahKarya }})</h5>

    @if($karyas->isEmpty())
      <div class="alert alert-info">Belum ada karya. Tambah karya untuk menampilkannya di sini.</div>
    @else
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Judul</th>
              <th>Tahun</th>
              <th>Asal Daerah</th>
              <th>Kategori</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($karyas as $k)
            <tr>
              <td>{{ $k->nama_karya }}</td>
              <td>{{ $k->tahun_dibuat ?? '-' }}</td>
              <td>{{ $k->asal_daerah }}</td>
              <td>{{ $k->kategori->nama_kategori ?? '-' }}</td>
              <td>
                <a href="{{ route('seniman.karya.edit', $k->id) ?? '#' }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('seniman.karya.destroy', $k->id) ?? '#' }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus karya?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
</div>
@endsection
