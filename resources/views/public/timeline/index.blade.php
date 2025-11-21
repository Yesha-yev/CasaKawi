@extends('layouts.app')

@section('content')

<h2>Timeline Sejarah Budaya</h2>

@foreach($timelines as $item)
<div class="card mb-3">
    <div class="card-body">
        <h4>{{ $item->title }}</h4>
        <small>{{ $item->event_date }}</small>
        <p>{{ $item->description }}</p>
    </div>
</div>
@endforeach

@endsection
