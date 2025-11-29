@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Daftar Karya</h2>

    <div class="row">

        @foreach ($karya as $item)

            {{-- HANYA tampilkan karya dengan status APPROVED --}}
            @if ($item->status === 'approved')
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">

                    @if($item->gambar)
                        <img src="{{ asset($item->gambar) }}" class="card-img-top" alt="gambar karya">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama_karya }}</h5>

                        <p class="mb-1"><strong>Kategori:</strong> {{ $item->kategori->nama_kategori ?? '-' }}</p>

                        <p class="mb-1"><strong>Deskripsi:</strong></p>
                        <p class="card-text">
                            {{ Str::limit($item->deskripsi, 100) }}

                            <a href="#"
                               class="text-primary lihat-detail"
                               data-id="{{ $item->id }}"
                               data-nama="{{ $item->nama_karya }}"
                               data-deskripsi="{{ $item->deskripsi }}"
                               data-gambar="{{ asset($item->gambar) }}"
                               data-audio="{{ $item->audio ? asset($item->audio) : '' }}"
                               data-seniman="{{ $item->seniman->name ?? '-' }}"
                               data-tahun="{{ $item->tahun_dibuat }}"
                               data-daerah="{{ $item->asal_daerah }}"
                               data-kategori="{{ $item->kategori->nama_kategori ?? '-' }}">
                                Lihat Selengkapnya
                            </a>
                        </p>

                        <p class="mb-1"><strong>Seniman:</strong> {{ $item->seniman->name ?? '-' }}</p>
                        <p class="mb-1"><strong>Tahun Dibuat:</strong> {{ $item->tahun_dibuat ?? '-' }}</p>
                        <p class="mb-1"><strong>Asal Daerah:</strong> {{ $item->asal_daerah ?? '-' }}</p>

                    </div>
                </div>
            </div>
            @endif

        @endforeach

    </div>
</div>

<!-- MODAL DETAIL KARYA -->
<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalJudul"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <img id="modalGambar" class="img-fluid mb-3 rounded" style="max-height: 350px; object-fit: cover;">

                <p class="mb-1"><strong>Kategori:</strong> <span id="modalKategori"></span></p>
                <p class="mb-1"><strong>Seniman:</strong> <span id="modalSeniman"></span></p>
                <p class="mb-1"><strong>Tahun Dibuat:</strong> <span id="modalTahun"></span></p>
                <p class="mb-3"><strong>Asal Daerah:</strong> <span id="modalDaerah"></span></p>

                <p><strong>Deskripsi:</strong></p>
                <p id="modalDeskripsi" class="mb-3"></p>

                <div id="audioContainer" style="display:none;">
                    <strong>Audio:</strong>
                    <audio controls class="w-100 mt-2" id="modalAudio"></audio>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection


@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {

        document.querySelectorAll(".lihat-detail").forEach(btn => {
            btn.addEventListener("click", function(e) {
                e.preventDefault();

                document.getElementById("modalJudul").innerText   = this.dataset.nama;
                document.getElementById("modalDeskripsi").innerText = this.dataset.deskripsi;
                document.getElementById("modalKategori").innerText  = this.dataset.kategori;
                document.getElementById("modalSeniman").innerText   = this.dataset.seniman;
                document.getElementById("modalTahun").innerText     = this.dataset.tahun;
                document.getElementById("modalDaerah").innerText    = this.dataset.daerah;

                document.getElementById("modalGambar").src = this.dataset.gambar;

                if (this.dataset.audio !== "") {
                    document.getElementById("audioContainer").style.display = "block";
                    document.getElementById("modalAudio").src = this.dataset.audio;
                } else {
                    document.getElementById("audioContainer").style.display = "none";
                }

                new bootstrap.Modal(document.getElementById("detailModal")).show();
            });
        });

    });
</script>
@endsection
