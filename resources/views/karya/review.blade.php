@extends('layouts.app')

@section('content')
<div class="container mt-4">

@if(($mode ?? '') === 'list')
    <h3 class="mb-4 text-brown">Tinjauan Karya</h3>
    <div class="mb-4 d-flex gap-2 flex-wrap">
        <button class="btn btn-status btn-all filter-btn" data-status="all">Semua</button>
        <button class="btn btn-status btn-pending filter-btn" data-status="pending">Pending</button>
        <button class="btn btn-status btn-pertimbangkan filter-btn" data-status="considered">Dipertimbangkan</button>
        <button class="btn btn-status btn-terima filter-btn" data-status="approved">Diterima</button>
        <button class="btn btn-status btn-rejected filter-btn" data-status="rejected">Ditolak</button>
    </div>
    <div class="row g-4">
        @forelse($karyas as $k)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 karya-item" data-status="{{ $k->status }}">
                <div class="card h-100 shadow-sm karya-card">
                    @if($k->gambar)
                        <div class="card-img-top-wrapper">
                            <img src="{{ asset($k->gambar) }}"
                                 class="card-img-top"
                                 alt="Gambar {{ $k->nama_karya }} oleh {{ $k->seniman->name }}"
                                 style="height:160px; object-fit:cover; width:100%;">
                        </div>
                    @else
                        <div class="card-img-top-placeholder" style="height:160px; display:flex; align-items:center; justify-content:center;">
                            <span class="text-muted">Tidak ada gambar</span>
                        </div>
                    @endif


                    <div class="card-body d-flex flex-column karyb">
                        <h5 class="card-title mb-1">{{ \Illuminate\Support\Str::limit($k->nama_karya, 40) }}</h5>
                        <p class="card-subtitle mb-2 text-muted small">
                            {{ $k->seniman->name }} — <span class="kategori">{{ $k->kategori->nama_kategori }}</span>
                        </p>

                        <p class="card-text mt-2 mb-3 small text-truncate-desc">
                            {{ \Illuminate\Support\Str::limit($k->deskripsi ?? '—', 100) }}
                        </p>

                        <div class="mt-auto d-flex gap-2">
                            <a href="{{ route('admin.karya.review.detail', $k->id) }}" class="btn btn-brown btn-sm flex-grow-1">Tinjau</a>

                            <form action="{{ route('admin.karya.review.update', $k->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="status" value="approved">
                                <button class="btn btn-outline-success btn-sm" type="submit" title="Terima cepat">Terima</button>
                            </form>
                        </div>
                    </div>

                    <div class="card-footer small text-muted">
                        <span>Tanggal: {{ $k->created_at ? $k->created_at->format('d M Y') : '-' }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary">Tidak ada karya yang perlu ditinjau.</div>
            </div>
        @endforelse
    </div>
@endif
@if(($mode ?? '') === 'detail')

<h3 class="mb-4 text-brown">Review Karya</h3>

<a href="{{ route('admin.karya.review') }}" class="btn btn-light mb-3">Kembali</a>

<div class="card shadow-sm">
    <div class="card-body">

        <h4>{{ $karya->nama_karya }}</h4>

        <p><strong>Seniman:</strong> {{ $karya->seniman->name }}</p>
        <p><strong>Kategori:</strong> {{ $karya->kategori->nama_kategori }}</p>

        <p>{{ $karya->deskripsi }}</p>

        @if($karya->gambar)
            <img src="{{ asset($karya->gambar) }}"
                 class="img-fluid mb-3"
                 style="max-height:300px;">
        @endif

        <form action="{{ route('admin.karya.review.update', $karya->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="pending"     {{ $karya->status=='pending'?'selected':'' }}>Pending</option>
                    <option value="considered"  {{ $karya->status=='considered'?'selected':'' }}>Dipertimbangkan</option>
                    <option value="approved"    {{ $karya->status=='approved'?'selected':'' }}>Diterima</option>
                    <option value="rejected"    {{ $karya->status=='rejected'?'selected':'' }}>Ditolak</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Catatan</label>
                <textarea name="keterangan" class="form-control" rows="3">{{ $karya->keterangan }}</textarea>
            </div>

            <button class="btn btn-success">
                Simpan Perubahan
            </button>
        </form>

    </div>
</div>

@endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.filter-btn');
        const items   = document.querySelectorAll('.karya-item');

        buttons.forEach(btn => {
            btn.addEventListener('click', function () {
                buttons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const status = this.dataset.status;

                items.forEach(item => {
                    if (status === 'all' || item.dataset.status === status) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    });
</script>

<style>
.text-brown {
    color: #c9c1b6 !important;
}
.btn-brown {
    background-color: #694d28;
    color: #fff;
    border: none;
}
.btn-brown:hover {
    background-color: #5a3e1f;
    color: #fff;
}

.table-brown {
    background-color: #d8cbbd;
}
.table-brown th {
    border: none;
}

.table-striped>tbody>tr:nth-of-type(odd) {
    background-color: #f8f0e0;
}
.table-hover>tbody>tr:hover {
    background-color: #f0e4d1;
}

.img-thumbnail {
    border-radius: 8px;
}

.table {
    border-collapse: separate !important;
    border-spacing: 0;
    border-radius: 12px;
    overflow: hidden;
}
.table thead th:first-child {
    border-top-left-radius: 12px;
}
.table thead th:last-child {
    border-top-right-radius: 12px;
}
.table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 12px;
}
.table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 12px;
}
.karya-card {
    border-radius: 12px;
    overflow: hidden;
}
.card-img-top-wrapper {
    overflow: hidden;
}
.card-img-top {
    transition: transform .3s ease;
}
.card-img-top:hover {
    transform: scale(1.05);
}

.karya-card .card-footer {
    background: #fff;
    border-top: none;
}
.btn-brown {
    background-color: #694d28;
    color: #fff;
    border: none;
}
.btn-brown:hover {
    background-color: #5a3e1f;
    color: #fff;
}

.text-truncate-desc {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.card-img-top-placeholder {
    background: #f4f1ed;
    color: #8a7f72;
}
.karyb{
    background-color: #9e9075;
}

@media (max-width: 575.98px) {
    .karya-card { min-height: 320px; }
}
.btn-outline-brown {
    border: 1px solid #694d28;
    color: #694d28;
}
.btn-outline-brown.active,
.btn-outline-brown:hover {
    background: #694d28;
    color: #fff;
}
.btn-status {
    border-width: 1.5px;
    font-weight: 500;
}

.btn-pertimbangkan {
    border-color: #ffb300;
    color: #c9c1b6;
}
.btn-pertimbangkan:hover,
.btn-pertimbangkan.active {
    background-color: #c79a2d;
    color: #fff;
}
.btn-pending{
    border-color: #0088ff;
    color: #c9c1b6;
}
.btn-pending:hover,
.btn-pending.active {
    background-color: #354f66;
    color: #ffffff;
}
.btn-terima {
    border-color: #00ff88;
    color: #c9c1b6;
}
.btn-terima:hover,
.btn-terima.active {
    background-color: #3d7a5e;
    color: #fff;
}

.btn-rejected {
    border-color: #ff0000;
    color: #c9c1b6;
}
.btn-rejected:hover,
.btn-rejected.active {
    background-color: #b04a4a;
    color: #fff;
}
.btn-all{
    border-color: #ffd39a;
    color: #c9c1b6;
}
.btn-all:hover,
.btn-all.active {
    background-color: #694d28;
    color: #ffffff;

</style>
