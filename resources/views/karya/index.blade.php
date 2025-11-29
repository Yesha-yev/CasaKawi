@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2 class="mb-4">Daftar Karya</h2>

    <div class="row">

        @forelse ($karya as $item)

            {{-- HANYA tampilkan karya dengan status APPROVED --}}
            @if ($item->status === 'approved')
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">

                        {{-- Gambar --}}
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                 class="card-img-top"
                                 alt="{{ $item->nama_karya }}">
                        @endif

                        <div class="card-body">

                            {{-- Nama Karya --}}
                            <h5 class="card-title">
                                {{ $item->nama_karya }}
                            </h5>

                            {{-- Deskripsi --}}
                            <p class="card-text">
                                {{ Str::limit($item->deskripsi, 120) }}
                            </p>

                            {{-- Seniman --}}
                            <p>
                                <strong>Seniman:</strong>
                                {{ $item->seniman->name ?? '-' }}
                            </p>

                            {{-- Timeline --}}
                            <p>
                                <strong>Timeline:</strong>
                                {{ $item->timeline->nama ?? '-' }}
                            </p>

                            {{-- Lokasi --}}
                            <p>
                                <strong>Lokasi:</strong>
                                {{ $item->lokasi->nama ?? '-' }}
                            </p>

                        </div>
                    </div>
                </div>
            @endif

        @empty
            <p class="text-muted">Belum ada karya.</p>
        @endforelse

    </div>

</div>
@endsection
