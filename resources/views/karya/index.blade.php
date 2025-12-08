@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center" style="color: #694d28;">Daftar Karya</h2>

    <div class="row g-4">

        @foreach ($karya as $item)

            @if ($item->status === 'approved')
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm" style="background:#f5efe6; border-radius:16px; cursor:pointer;">

                    @if($item->gambar)
                        <img src="{{ asset($item->gambar) }}" class="card-img-top rounded-top" style="height:200px; object-fit:cover;" alt="gambar karya">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama_karya }}</h5>

                        <p class="mb-1"><strong>Kategori:</strong> {{ $item->kategori->nama_kategori ?? '-' }}</p>

                        <p class="mb-1"><strong>Deskripsi:</strong></p>
                        <p class="card-text">
                            {{ Str::limit($item->deskripsi, 100) }}

                            <a href="#"
                                class="btn btn-primary btn-sm w-100 lihat-detail mt-3"
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

<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 shadow" style="border: 2px solid #d8cbbd; background-color: #fff8f0;">

            <div class="modal-header" style="background-color: #f8f0e0; color: #694d28; border-bottom: 2px solid #d8cbbd;">
                <h5 class="modal-title" id="modalJudul"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" style="color: #4b3b2a;">
                <div class="text-center mb-3">
                    <img id="modalGambar" class="img-fluid rounded mb-3" style="max-height: 350px; object-fit: cover; border: 1px solid #e0d7c3;">
                </div>

                <div class="row mb-2">
                    <div class="col-md-6"><strong>Kategori:</strong> <span id="modalKategori"></span></div>
                    <div class="col-md-6"><strong>Seniman:</strong> <span id="modalSeniman"></span></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6"><strong>Tahun Dibuat:</strong> <span id="modalTahun"></span></div>
                    <div class="col-md-6"><strong>Asal Daerah:</strong> <span id="modalDaerah"></span></div>
                </div>

                <hr style="border-color: #d8cbbd;">

                <h6 style="color:#694d28;">Deskripsi:</h6>
                <p id="modalDeskripsi" style="text-align: justify;"></p>

                <div id="audioContainer" class="mb-3" style="display:none;">
                    <strong>Audio:</strong>
                    <audio controls class="w-100 mt-2" id="modalAudio" style="border: 1px solid #d8cbbd; border-radius: 6px; background-color: #fdf5ec;"></audio>
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
    $(document).ready(function () {

    $(".card").css({opacity: 0, transform: "translateY(20px)"});

    $(".card").each(function(i){
        $(this).delay(150 * i).animate({
            opacity: 1,
            top: 0
        }, 400);
    });

    $(".card").hover(
        function () {
            $(this).css({
                transform: "translateY(-8px)",
                boxShadow: "0 12px 25px rgba(0,0,0,0.2)"
            });
            $(this).find("img").css("filter", "brightness(85%)");
        },
        function () {
            $(this).css({
                transform: "translateY(0)",
                boxShadow: "0 4px 10px rgba(0,0,0,0.1)"
            });
            $(this).find("img").css("filter", "brightness(100%)");
        }
    );

    $(".card").on("click", function(e){
        let link = $(this).find(".lihat-detail");
        if (link.length > 0) link.click();
    });
});
</script>
@endsection
