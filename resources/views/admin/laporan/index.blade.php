@extends('layouts.app')

@section('title', 'Laporan Admin')

@section('content')
<div class="container py-4">

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ $status=='pending' ? 'active' : '' }}" href="?status=pending">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $status=='proses' ? 'active' : '' }}" href="?status=proses">Proses</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $status=='selesai' ? 'active' : '' }}" href="?status=selesai">Selesai</a>
        </li>
    </ul>

    <div class="row g-3">
        @foreach($laporan as $item)
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title mb-2">{{ $item->nama }} — {{ $item->email }}</h5>
                        <p class="card-text">{{ $item->pesan }}</p>
                    </div>
                    <div class="d-flex justify-content-between mt-3 align-items-center">
                        <form action="{{ route('admin.laporan.status', $item->id) }}" method="POST">
                            @csrf
                            <select name="status" class="status-select form-select form-select-sm"
                                onchange="this.className='status-select form-select form-select-sm '+this.options[this.selectedIndex].dataset.class; this.form.submit()">
                                <option value="pending" data-class="bg-warning" {{ $item->status=='pending' ? 'selected' : '' }}>Pending</option>
                                <option value="proses" data-class="bg-info" {{ $item->status=='proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" data-class="bg-success" {{ $item->status=='selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </form>
                        <form method="POST" action="{{ route('admin.laporan.destroy', $item->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus laporan ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@section('styles')
<style>
.card {
    border-radius: 0.75rem;
    overflow: hidden;
}

.status-select {
    border-radius: 50px;
    font-weight: 500;
    cursor: pointer;
    min-width: 100px;
    text-align: center;
    transition: 0.3s;
}

.status-select.bg-warning { background-color: #f0ad4e; color: #212529; }
.status-select.bg-info    { background-color: #5bc0de; color: #212529; }
.status-select.bg-success { background-color: #28a745; color: #fff; }

.status-select:hover {
    opacity: 0.85;
}

.btn-danger {
    border-radius: 50px;
    transition: 0.3s;
}

.btn-danger:hover {
    background-color: #5a3f22;
    border-color: #5a3f22;
}
.nav-tabs .nav-link.active {
    background-color: #C89F74 !important;
    color: #fff !important;
    border-color: #C89F74 !important;
}
.nav-tabs .nav-link {
    color: #4A2E17;
    border: 1px solid #C89F74;
}
</style>
@endsection
@endsection
