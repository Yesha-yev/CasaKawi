@extends('layouts.app')

@section('content')

<div class="row g-4">

@foreach($karyas as $karya)
<div class="col-md-4 col-lg-3 d-flex">
    <div class="card shadow-sm karya-card flex-fill d-flex flex-column">

        @if($karya->gambar)
            <img src="{{ asset($karya->gambar) }}" class="card-img-top">
        @else
            <div class="no-image-box">
                <span class="text-muted">Tidak ada gambar</span>
            </div>
        @endif

        <div class="card-body d-flex flex-column">

            <div class="karya-info-wrap">
                <h6 class="fw-bold">{{ $karya->nama_karya }}</h6>

                <p class="small mb-1"><strong>Kategori:</strong> {{ $karya->kategori->nama_kategori ?? '-' }}</p>
                <p class="small mb-1"><strong>Tahun:</strong> {{ $karya->tahun_dibuat ?? '-' }}</p>
                <p class="small mb-1"><strong>Daerah:</strong> {{ $karya->asal_daerah }}</p>

                <p class="small text-muted">{{ Str::limit($karya->deskripsi, 80) }}</p>
            </div>

            @if($karya->audio)
                <audio controls class="w-100 mb-2 audio-control">
                    <source src="{{ asset($karya->audio) }}" type="audio/mpeg">
                </audio>
            @endif

            <div class="mb-2 status-center">
                @if($karya->status == 'pending')
                    <span class="badge status-badge bg-warning text-dark">Pending</span>
                @elseif($karya->status == 'approved')
                    <span class="badge status-badge bg-success">Diterima</span>
                @elseif($karya->status == 'rejected')
                    <span class="badge status-badge bg-danger">Ditolak</span>
                @elseif($karya->status == 'considered')
                    <span class="badge status-badge bg-info text-dark">Dipertimbangkan</span>
                @endif
            </div>

            @if($karya->keterangan)
                <p class="small text-muted mb-2"><em>Alasan: {{ $karya->keterangan }}</em></p>
            @endif

            <div class="mt-auto">
                <a href="{{ route('seniman.karya.edit', $karya->id) }}"
                   class="btn btn-brown btn-sm w-100 mb-1">
                   Edit
                </a>

                <form action="{{ route('seniman.karya.delete', $karya->id) }}"
                      method="POST"
                      onsubmit="return confirm('Hapus karya ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm w-100">Hapus</button>
                </form>
            </div>

        </div>
    </div>
</div>
@endforeach

</div>

@endsection


@section('styles')
<style>

.karya-card {
    background: rgba(239, 231, 219, 0.80) !important;
    border-radius: 16px;
    min-height: 480px;
    display: flex;
    flex-direction: column;
}

.no-image-box {
    height: 220px;
    background: rgba(255,255,255,0.4);
    border-bottom: 4px solid var(--brown-soft);
    display: flex;
    justify-content: center;
    align-items: center;
}

.status-center {
    display: flex;
    justify-content: center;
    margin: 10px 0;
    min-height: 40px;
}
.status-badge {
    padding: 7px 12px;
    font-size: 0.85rem;
    border-radius: 10px;
    width: fit-content;
    height: 27px;
    text-align: center;
}
.karya-info-wrap {
    min-height: 170px;
}
.audio-control {
    height: 32px;
}
.btn-brown {
    background-color: var(--brown-primary) !important;
    border-color: var(--brown-primary) !important;
    border-radius: 10px;
    font-weight: 600;
    color: #fff;
}
.btn-brown:hover {
    background-color: var(--brown-soft) !important;
    border-color: var(--brown-soft) !important;
}

.btn-danger {
    border-radius: 10px;
    font-weight: 600;
}

</style>
@endsection
