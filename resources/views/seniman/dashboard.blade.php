@extends('layouts.app')

@section('title', 'Dashboard Seniman')

@section('content')
<div class="container">

    <div class="card mb-4 p-3">
        <h3>Halo, {{ $user->name }}</h3>

        <div class="d-flex gap-2 mt-2">
            <a href="{{ route('seniman.karya.create') }}" class="btn btn-primary btn-sm">
                + Tambah Karya
            </a>
            <a href="{{ route('seniman.profil.edit') }}" class="btn btn-secondary btn-sm">
                Edit Profil
            </a>
        </div>
    </div>

    <div class="card p-3">
        <h5 class="mb-3">Daftar Karya ({{ $jumlahKarya }})</h5>

        @if($karyas->isEmpty())
            <div class="alert alert-info">
                Belum ada karya. Tambah karya untuk menampilkannya di sini.
            </div>
        @else

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th width="120">Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tahun</th>
                        <th>Asal Daerah</th>
                        <th width="250">Deskripsi</th>
                        <th width="150">Audio</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($karyas as $k)
                    <tr>

                        <td>
                            @if($k->gambar)
                                <img src="{{ asset($k->gambar) }}" width="100" class="img-thumbnail">
                            @else
                                <span class="text-muted">Tidak ada</span>
                            @endif
                        </td>

                        <td>{{ $k->nama_karya }}</td>
                        <td>{{ $k->kategori->nama_kategori ?? '-' }}</td>
                        <td>{{ $k->tahun_dibuat ?? '-' }}</td>
                        <td>{{ $k->asal_daerah }}</td>

                        <td style="max-width: 250px;">
                            {{ $k->deskripsi ?? '-' }}
                        </td>

                        <td>
                            @if($k->audio)
                                <audio controls style="width: 140px;">
                                    <source src="{{ asset($k->audio) }}" type="audio/mpeg">
                                </audio>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('seniman.karya.edit', $k->id) }}"
                               class="btn btn-warning btn-sm w-100 mb-1">Edit</a>

                            <form action="{{ route('seniman.karya.delete', $k->id) }}"
                                  method="POST" onsubmit="return confirm('Yakin hapus karya?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm w-100">Hapus</button>
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
