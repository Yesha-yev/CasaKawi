@extends('layouts.app')

@section('content')
<h2>Peta Persebaran Budaya</h2>

<div id="map" style="height: 500px;"></div>

<script>
var map = L.map('map').setView([-7.8, 113.6], 7);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

@foreach($locations as $loc)
    L.marker([{{ $loc->latitude }}, {{ $loc->longitude }}]).addTo(map)
        .bindPopup("<b>{{ $loc->name }}</b>");
@endforeach
</script>
@endsection
