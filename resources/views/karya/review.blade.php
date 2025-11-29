@extends('layouts.app')

@section('content')
<div class="container mt-4">

    @if(isset($karyas))
        <h3 class="mb-3">Tinjauan Karya (Pending)</h3>

        <table class="table table-bordered">
            <thead>
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
                            <img src="{{ asset($k->gambar) }}" width="100" class="img-fluid">
                        @endif
                    </td>

                    <td>{{ $k->nama_karya }}</td>
                    <td>{{ $k->seniman->name ?? '-' }}</td>
                    <td>{{ $k->kategori->nama_kategori }}</td>

                    <td>
                        <a href="{{ route('admin.karya.review.detail', $k->id) }}"
                           class="btn btn-primary btn-sm">Tinjau</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @elseif(isset($karya))
        <a href="{{ route('admin.karya.review') }}" class="btn btn-light mb-3">← Kembali</a>

        <div class="row">
            <div class="col-md-6">

                <h4>{{ $karya->nama_karya }}</h4>
                @if($karya->gambar)
                    <img src="{{ asset($karya->gambar) }}" class="img-fluid mb-3">
                @endif

                <p><strong>Seniman:</strong> {{ $karya->seniman->name ?? 'Tidak ada'}}</p>
                <p><strong>Kategori:</strong> {{ $karya->kategori->nama_kategori }}</p>
                <p><strong>Deskripsi:</strong> {{ $karya->deskripsi }}</p>
            </div>

            <div class="col-md-6">
                <form action="{{ route('admin.karya.review.update', $karya->id) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Status Karya</label>
                        <select name="status" class="form-select" required>
                            <option value="pending"    {{ $karya->status=='pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved"   {{ $karya->status=='approved' ? 'selected' : '' }}>Diterima</option>
                            <option value="considered" {{ $karya->status=='considered' ? 'selected' : '' }}>Dipertimbangkan</option>
                            <option value="rejected"   {{ $karya->status=='rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Alasan (jika ditolak / dipertimbangkan)</label>
                        <textarea name="keterangan" class="form-control" rows="3">{{ $karya->keterangan}}</textarea>
                    </div>

                    <button class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>

    @endif
</div>
@endsection
