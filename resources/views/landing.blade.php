@extends('layouts.app')

@section('title','Casa Kawi — Beranda')

@section('content')

<div class="card p-4 mb-4">
    <h2>Selamat datang di Casa Kawi</h2>
    <p>Galeri Digital Budaya Jawa Timur — jelajahi peta, timeline, dan karya seniman.</p>
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

    @if($errors->any())
        <div class="alert alert-danger p-2">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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
</div>

@endsection



{{-- =====================
     SCRIPTS SECTION
===================== --}}
@section('scripts')

{{-- Leaflet Map --}}
<script>
    const map = L.map('map').setView([-7.9778, 112.6347], 7);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18
    }).addTo(map);

    const lokasi = {!! json_encode($lokasi ?? []) !!};

    // TTS Active Store
    let activeAudios = {};

    function createPopup(item) {
        const deskripsi = item.deskripsi ?? "Tidak ada deskripsi.";
        const escapedText = deskripsi.replace(/'/g, "\\'");
        const audioId = "audio-" + item.id;

        return `
            <b>${item.nama}</b><br>
            ${item.asal_daerah}<br><br>
            <small>${deskripsi}</small><br><br>

            <button id="btn-${audioId}" class="btn btn-sm btn-primary"
                onclick="toggleTTS('${escapedText}', '${audioId}')">
                ▶ Putar Audio
            </button>
        `;
    }

    function toggleTTS(text, audioId) {
        if (!activeAudios[audioId]) {
            const utter = new SpeechSynthesisUtterance(text);
            utter.lang = "id-ID";
            utter.rate = 1;
            utter.pitch = 1;

            activeAudios[audioId] = utter;

            utter.onend = () => {
                const btn = document.getElementById("btn-" + audioId);
                if (btn) btn.innerText = "▶ Putar Audio";
            };
        }

        const btn = document.getElementById("btn-" + audioId);

        if (speechSynthesis.speaking) {
            speechSynthesis.cancel();
            btn.innerText = "▶ Putar Audio";
        } else {
            speechSynthesis.speak(activeAudios[audioId]);
            btn.innerText = "⏸ Jeda";
        }
    }

    // Add markers
    lokasi.forEach(item => {
        const marker = L.marker([item.latitude, item.longitude]).addTo(map);

        marker.bindPopup(createPopup(item));

        marker.on("popupclose", () => {
            speechSynthesis.cancel();
        });
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
