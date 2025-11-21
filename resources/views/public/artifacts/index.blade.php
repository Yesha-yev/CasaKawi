@extends('layouts.app')

@section('content')
<h2>Galeri Budaya</h2>

<div class="row">
@foreach($artifacts as $item)
    <div class="col-md-3 mb-3">
        <a href="{{ route('gallery.show', $item->id) }}">
            <img src="{{ asset('storage/'.$item->image) }}" class="img-fluid rounded">
            <h5>{{ $item->name }}</h5>
        </a>
    </div>
@endforeach
</div>
@endsection
