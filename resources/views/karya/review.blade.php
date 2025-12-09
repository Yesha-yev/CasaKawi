@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- LIST KARYA YANG PENDING --}}
    @if(isset($karyas))
        <h3 class="mb-4 text-brown">Tinjauan Karya (Pending)</h3>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-brown text-white">
                    <tr>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Seniman</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($karyas as $k)
                    <tr>
                        <td width="120">
                            @if($k->gambar)
                                <img src="{{ asset($k->gambar) }}" width="100" class="img-thumbnail" style="max-width: 100px; max-height: 80px;">
                            @else
                                <span class="text-muted">Tidak ada gambar</span>
                            @endif
                        </td>

                        <td>{{ $k->nama_karya }}</td>
                        <td>{{ $k->seniman->name }}</td>
                        <td>{{ $k->kategori->nama_kategori }}</td>

                        <td>
                            <a href="{{ route('admin.karya.review.detail', $k->id) }}"class="btn btn-brown btn-sm">Tinjau</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    {{-- HALAMAN DETAIL KARYA --}}
    @elseif(isset($karya))
        <a href="{{ route('admin.karya.review') }}" class="btn btn-light mb-3">Kembali</a>

        <div class="row g-4">
            <div class="col-md-6">
                <h4 class="text-brown">{{ $karya->nama_karya }}</h4>

                @if($karya->gambar)
                    <img src="{{ asset($karya->gambar) }}" class="img-fluid mb-3" style="max-height: 400px; object-fit: cover;">
                @endif

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Seniman:</strong> {{ $karya->seniman->name }}</li>
                    <li class="list-group-item"><strong>Kategori:</strong> {{ $karya->kategori->nama_kategori }}</li>
                    <li class="list-group-item"><strong>Deskripsi:</strong> {{ $karya->deskripsi }}</li>
                </ul>
            </div>

            <div class="col-md-6">
                <div class="card shadow-sm p-3">
                    <h5>Update Status Karya</h5>
                    <form action="{{ route('admin.karya.review.update', $karya->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label>Status Karya</label>
                            <select name="status" class="form-select">
                                <option value="pending"    {{ $karya->status=='pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved"   {{ $karya->status=='approved' ? 'selected' : '' }}>Diterima</option>
                                <option value="considered" {{ $karya->status=='considered' ? 'selected' : '' }}>Dipertimbangkan</option>
                                <option value="rejected"   {{ $karya->status=='rejected' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Alasan</label>
                            <textarea name="keterangan" class="form-control">{{ $karya->keterangan }}</textarea>
                        </div>

                        <button class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.text-brown { color: #694d28 !important; }
.btn-brown { background-color: #694d28; color: #fff; border: none; }
.btn-brown:hover { background-color: #5a3e1f; color: #fff; }

.table-brown { background-color: #d8cbbd; }
.table-brown th { border: none; }

.table-striped>tbody>tr:nth-of-type(odd) { background-color: #f8f0e0; }
.table-hover>tbody>tr:hover { background-color: #f0e4d1; }

.img-thumbnail { border-radius: 8px; }

.table { border-collapse: separate !important; border-spacing: 0; border-radius: 12px; overflow: hidden; }
.table thead th:first-child { border-top-left-radius: 12px; }
.table thead th:last-child { border-top-right-radius: 12px; }
.table tbody tr:last-child td:first-child { border-bottom-left-radius: 12px; }
.table tbody tr:last-child td:last-child { border-bottom-right-radius: 12px; }

</style>

@endsection
