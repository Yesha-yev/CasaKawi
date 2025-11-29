@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="mb-4">Dashboard Seniman</h2>

    {{-- Statistik --}}
    <div class="row mb-4">

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm text-center p-3">
                <h4 class="mb-0">{{ $total }}</h4>
                <p class="text-muted mb-0">Total Karya</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm text-center p-3">
                <h4 class="mb-0 text-success">{{ $approved }}</h4>
                <p class="text-success mb-0">Disetujui</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm text-center p-3">
                <h4 class="mb-0 text-warning">{{ $pending }}</h4>
                <p class="text-warning mb-0">Menunggu</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm text-center p-3">
                <h4 class="mb-0 text-info">{{ $considered }}</h4>
                <p class="text-info mb-0">Dipertimbangkan</p>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card shadow-sm text-center p-3">
                <h4 class="mb-0 text-danger">{{ $rejected }}</h4>
                <p class="text-danger mb-0">Ditolak</p>
            </div>
        </div>

    </div>

</div>
@endsection
