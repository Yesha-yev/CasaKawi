@extends('layouts.app')

@section('title','Casa Kawi — Beranda')

@section('content')

<div class="card p-4 mb-4">
    <h2>Selamat datang di Casa Kawi</h2>
    <p>Galeri Digital Budaya Jawa Timur — jelajahi peta, budaya, dan karya seniman.</p>
</div>

<div class="card p-3 mb-4">
    <h5>Peta Persebaran Budaya</h5>
    <div id="map" style="height: 400px;"></div>
</div>

@if(isset($kategoriData) && $kategoriData->count() > 0)
<div class="card p-3 mb-4">
    <h5>Grafik Karya per Kategori</h5>
    <canvas id="kategoriChart"></canvas>
</div>
@endif

<div class="card p-4 mb-4" id="form-laporan">
    <h4>Laporan Karya / Budaya</h4>
    <p>Jika kamu menemukan informasi yang salah, silakan laporkan.</p>

    {{-- Error --}}
    @if($errors->any())
        <div class="alert alert-danger p-2">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Success --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- CEK ROLE --}}
    @php
        $isBlocked = auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'seniman');
    @endphp

    @if(!$isBlocked)
        {{-- FORM UNTUK PENGGUNA UMUM --}}
        <form action="{{ route('laporan.store') }}" method="POST">
            @csrf

            <input type="text" name="nama" class="form-control mb-2"
                placeholder="Nama Anda" required>

            <input type="email" name="email" class="form-control mb-2"
                placeholder="Email" required>

            <textarea name="pesan" class="form-control mb-2"
                placeholder="Apa yang ingin Anda laporkan?" required></textarea>

            <button class="btn btn-primary">Kirim Laporan</button>
        </form>
    @else
        {{-- ROLE ADMIN & SENIMAN --}}
        <div class="alert alert-info mt-3">
            <strong>Hanya pengguna umum yang bisa mengirim laporan.</strong>
        </div>
    @endif

</div>

@endsection


@section('scripts')

{{-- Leaflet Map --}}
<script>
    const lokasi = @json($lokasi);

    const map = L.map('map').setView([-7.9778, 112.6347], 7);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18
    }).addTo(map);

    let activeAudios = {};

    function createPopup(item) {
        const deskripsi = item.deskripsi ?? "Tidak ada deskripsi.";
        const audioId = "audio-" + item.id;

        return `
            <b>${item.nama}</b> <small class="text-muted">(${item.type})</small><br>
            ${item.asal_daerah ?? ''}<br><br>
            <small>${deskripsi}</small><br><br>

            <button id="btn-${audioId}" class="btn btn-sm btn-primary"
                onclick='toggleTTS(${JSON.stringify(deskripsi)}, "${audioId}")'>
                ▶ Putar Audio
            </button>
        `;
    }

    function toggleTTS(text, audioId) {
        if (activeAudios[audioId]) {
            speechSynthesis.cancel();
            activeAudios[audioId] = false;
            document.getElementById("btn-" + audioId).innerText = "▶ Putar Audio";
            return;
        }

        const utter = new SpeechSynthesisUtterance(text);
        utter.lang = "id-ID";

        utter.onend = () => {
            activeAudios[audioId] = false;
            document.getElementById("btn-" + audioId).innerText = "▶ Putar Audio";
        };

        activeAudios[audioId] = true;
        document.getElementById("btn-" + audioId).innerText = "⏸ Hentikan";

        speechSynthesis.speak(utter);
    }

    lokasi.forEach(item => {
        L.marker([item.latitude, item.longitude])
            .addTo(map)
            .bindPopup(createPopup(item));
    });

    map.on('popupclose', function () {
        speechSynthesis.cancel();
        activeAudios = {};
    });
</script>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = {!! json_encode($kategoriData->pluck('nama_kategori') ?? []) !!};
    const values = {!! json_encode($kategoriData->pluck('karyas_count') ?? []) !!};

    if (labels.length > 0) {
        new Chart(document.getElementById('kategoriChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Karya',
                    data: values,
                    borderWidth: 2,
                    tension: 0.25,
                    fill: false,
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }
</script>

@endsection
