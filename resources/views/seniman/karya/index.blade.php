@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-3 text-brown">Daftar Karya Saya</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table align-middle rounded-4">
            <thead>
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

                    <td style="max-width: 250px;">{{ $karya->deskripsi ?? '-' }}</td>

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
                            <span class="badge btn-brown">Diterima</span>
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

<style>
.text-brown { color: #694d28 !important; }
.btn-brown { background-color: #694d28; color: #fff; border: none; }
.btn-brown:hover { background-color: #5a3e1f; }

.table { border-collapse: separate !important; border-spacing: 0; border-radius: 12px; overflow: hidden; }
.table thead th:first-child { border-top-left-radius: 12px; }
.table thead th:last-child { border-top-right-radius: 12px; }
.table tbody tr:last-child td:first-child { border-bottom-left-radius: 12px; }
.table tbody tr:last-child td:last-child { border-bottom-right-radius: 12px; }

.table tbody tr:hover { background-color: #f0e4d1; transition: 0.3s; }

.badge.btn-brown { background-color: #694d28; color: #fff; }
</style>
@endsection
