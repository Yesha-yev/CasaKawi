@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Budaya</h2>
    <div class="row">
        @foreach ($budaya as $item)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                @if ($item->$gambar)
                <img src="{{asset('storage/' .$item->$gambar) }}" class="card-img-top" alt="gambar budaya">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{$item->nama_budaya}}</h5>
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
