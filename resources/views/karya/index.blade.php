@extends('layouts.app')

@section('content')
<div calss="container py-5">
    <h2 class="mb-4">Daftar Karya</h2>
    <div class="row">
        @foreach ($karya as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="gambar karya">
                    @endif
                    <div clss="card-body">
                        <h5 class="card-title">{{$item->nama_karya}}</h5>
                        <p class="card-text">
                            {{Str::limit($item->deskripsi, 120)}}
                        </p>
                        <p><strong>Seniman:</strong>{{$item->seniman->nama ?? '-'}}</p>
                        <p><strong>Timeline:</strong>{{$item->timeline->nama ?? '-'}}</p>
                        <p><strong>Lokasi:</strong>{{$item->lokasi->nama ?? '-'}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
