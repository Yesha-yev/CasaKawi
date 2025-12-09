@extends('layouts.app')

@section('title','Casa Kawi — Beranda')

@section('content')

{{-- HERO SECTION --}}
<section class="hero-home text-white d-flex align-items-center"
    style="
        background: linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
                    url('/images/bg.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 70vh;
        border-radius: 16px;
        margin-bottom: 25px;
        opacity: 0;
        transform: translateY(30px);
        transition: 0.8s ease-out;
    "
>
    <div class="container text-center">
        <h1 class="fw-bold mb-3 display-4">Selamat Datang di Casa Kawi</h1>
        <p class="lead mx-auto" style="max-width: 650px;">
            Casa Kawi adalah Galeri Digital Budaya Jawa Timur yang menghadirkan peta interaktif,
            ragam budaya, serta karya para seniman lokal.
        </p>

        <a href="#map" class="btn btn-light mt-3 px-4 py-2 fw-bold">
            Jelajahi Sekarang
        </a>
    </div>
</section>

<div class="card p-3 mb-4 fade-in">
    <h5 class="fw-bold">Peta Persebaran Budaya</h5>
    <div id="map" style="height: 400px;"></div>
</div>

@if(isset($kategoriData) && $kategoriData->count() > 0)
<div class="card p-3 mb-4 fade-in">
    <h5 class="fw-bold">Grafik Karya per Kategori</h5>
    <canvas id="kategoriChart"></canvas>
</div>
@endif

<div class="card p-4 mb-4 fade-in" id="form-laporan">
    <h4 class="fw-bold">Laporan Karya / Budaya</h4>
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

    @php
        $isBlocked = auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'seniman');
    @endphp

    @if(!$isBlocked)
        <form action="{{ route('laporan.store') }}" method="POST">
            @csrf

            <input type="text" name="nama" class="form-control mb-2"
                placeholder="Nama Anda" required>

            <input type="email" name="email" class="form-control mb-2"
                placeholder="Email" required>

            <textarea name="pesan" class="form-control mb-2"
                placeholder="Apa yang ingin Anda laporkan?" required></textarea>

            <button class="btn btn-primary px-4">Kirim Laporan</button>
        </form>
    @else
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
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: "#ffffff" 
                    }
                },
                tooltip: {
                    titleColor: "#ffffff",
                    bodyColor: "#ffffff",
                    footerColor: "#ffffff"
                }
            },
            scales: {
                x: {
                    ticks: { color: "#ffffff" },
                    grid: { color: "rgba(255, 255, 255, 0.2)" }
                },
                y: {
                    beginAtZero: true,
                    ticks: { color: "#ffffff" },
                    grid: { color: "rgba(255, 255, 255, 0.2)" }
                }
            }
        }
        });
    }
</script>


<script>

    $('a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        let target = $($(this).attr('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 80
            }, 700);
        }
    });

    $(window).on('scroll', function () {
        $('.fade-in').each(function () {
            let top = $(this).offset().top;
            let scrollPos = $(window).scrollTop() + $(window).height();

            if (top < scrollPos - 50) {
                $(this).addClass('visible');
            }
        });
    });

    $(document).ready(function () {
        $('.hero-home').css({ opacity: 1, transform: 'translateY(0)' });
    });

    $('body').on('mouseenter', '.btn', function () {
        $(this).css({ filter: 'brightness(0.85)' });
    }).on('mouseleave', '.btn', function () {
        $(this).css({ filter: 'brightness(1)' });
    });

</script>
<style>
    .fade-in {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.7s ease-out;
    }
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

</style>
@endsection
