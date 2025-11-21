@extends('layouts.app')

@section('content')

<h2>{{ $artifact->name }}</h2>

<img src="{{ asset('storage/'.$artifact->image) }}" class="img-fluid mb-3">

<p>{{ $artifact->description }}</p>

@if($artifact->audio)
<h4>Dengarkan Penjelasan</h4>
<audio controls>
    <source src="{{ asset('storage/'.$artifact->audio) }}" type="audio/mpeg">
</audio>
@endif

@if($artifact->latitude)
<h4>Lokasi Persebaran</h4>
<div id="map" style="height: 400px;"></div>

<script>
var map = L.map('map').setView([{{ $artifact->latitude }}, {{ $artifact->longitude }}], 13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
L.marker([{{ $artifact->latitude }}, {{ $artifact->longitude }}]).addTo(map);
</script>
@endif

@endsection
