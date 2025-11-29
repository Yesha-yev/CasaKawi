@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3">Daftar Karya Saya</h2>

    <a href="{{ route('seniman.karya.create') }}" class="btn btn-primary mb-3">
        + Tambah Karya
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th width="120">Gambar</th>
                    <th>Nama Karya</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                    <th>Asal Daerah</th>
                    <th>Deskripsi</th>
                    <th>Audio</th>
                    <th>Status</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($karyas as $karya)
                <tr>
                    <td>
                        @if($karya->gambar)
                            <img src="{{ asset($karya->gambar) }}" class="img-thumbnail" width="100">
                        @else
                            <span class="text-muted">Tidak ada</span>
                        @endif
                    </td>

                    <td>{{ $karya->nama_karya }}</td>
                    <td>{{ $karya->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $karya->tahun_dibuat ?? '-' }}</td>
                    <td>{{ $karya->asal_daerah }}</td>

                    <td style="max-width: 250px;">
                        {{ $karya->deskripsi ?? '-' }}
                    </td>

                    <td>
                        @if($karya->audio)
                            <audio controls style="width: 140px;">
                                <source src="{{ asset($karya->audio) }}" type="audio/mpeg">
                                Browser kamu tidak mendukung audio.
                            </audio>
                        @else
                            <span class="text-muted">Belum ada audio</span>
                        @endif
                    </td>

                    <td>
                        @if($karya->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($karya->status == 'approved')
                            <span class="badge bg-success">Diterima</span>
                        @elseif($karya->status == 'rejected')
                            <span class="badge bg-danger">Ditolak</span>
                        @elseif($karya->status == 'considered')
                            <span class="badge bg-info text-dark">Dipertimbangkan</span>
                        @endif

                        @if($karya->keterangan)
                            <div class="small text-muted">Alasan: {{ $karya->keterangan }}</div>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('seniman.karya.edit', $karya->id) }}"
                           class="btn btn-warning btn-sm mb-1 w-100">Edit</a>

                        <form action="{{ route('seniman.karya.delete', $karya->id) }}"
                              method="POST" onsubmit="return confirm('Hapus karya ini?')">
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

</div>
@endsection
