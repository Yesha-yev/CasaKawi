@extends('layouts.app')

@section('title', 'Kelola Seniman')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-light">Kelola Seniman</h3>
        <a href="{{ route('admin.seniman.create') }}" class="btn btn-brown px-4 py-2">Tambah Seniman</a>
    </div>

    <div class="row g-4">

        @foreach($senimans as $s)
        <div class="col-md-4">
            <div class="card seniman-card shadow-sm h-100">

                <div class="card-body d-flex flex-column text-center">
                    <div class="info-wrap top-section">
                        <h5 class="fw-bold text-brown-dark">{{ $s->name }}</h5>
                        <p class="text-muted mb-1 teks-email">{{ $s->email }}</p>
                    </div>
                    <span class="badge seniman-status {{ $s->status ? 'bg-success' : 'bg-secondary' }}">
                        {{ $s->status ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                    <div class="mt-auto pt-3">
                        <a href="{{ route('admin.seniman.edit', $s->id) }}" class="btn btn-brown w-100">Edit</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

</div>

@endsection


@section('styles')
<style>

.seniman-card {
    background: rgba(239, 231, 219, 0.85) !important;
    border-radius: 16px;
    border: none;
    min-height: 230px;
    height: auto;
    display: flex;
    flex-direction: column;
    transition: transform 0.25s ease, box-shadow 0.3s ease;
}

.seniman-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 25px rgba(0,0,0,0.35);
}

.text-brown-dark {
    color: var(--brown-dark);
}
.seniman-status {
    margin-top: 8px;
    font-size: 0.85rem;
    padding: 6px 12px;
    border-radius: 8px;
    width: fit-content;
    min-height: 32px;
    margin-left: auto;
    margin-right: auto;
}
.top-section {
    min-height: 120px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.card-body {
    display: flex;
    flex-direction: column;
}
.btn-brown {
    background-color: var(--brown-primary) !important;
    border-color: var(--brown-primary) !important;
    border-radius: 10px;
    font-weight: 600;
    color: #fff;
}
.info-wrap {
    min-height: 70px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.teks-email {
    color: #3a342e !important;
    min-height: 40px;
}
.nama-email-wrap {
    min-height: 80px;
}
.btn-brown:hover {
    background-color: var(--brown-soft) !important;
    border-color: var(--brown-soft) !important;
    color: #fff;
}
</style>
@endsection
