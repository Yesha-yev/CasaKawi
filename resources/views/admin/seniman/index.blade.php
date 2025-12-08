@extends('layouts.app')

@section('title', 'Kelola Seniman')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-brown">Kelola Seniman</h3>
        <a href="{{ route('admin.seniman.create') }}" class="btn btn-brown">Tambah Seniman</a>
    </div>

    <div class="card border-0 rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0 align-middle rounded-4">
                    <thead class="table-brown text-white rounded-top">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($senimans as $s)
                            <tr>
                                <td>{{ $s->id }}</td>
                                <td>{{ $s->name }}</td>
                                <td>{{ $s->email }}</td>
                                <td>
                                    <span class="badge {{ $s->status ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $s->status ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.seniman.edit', $s->id) }}" class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>

<style>
.text-brown { color: #694d28 !important; }
.btn-brown { background-color: #694d28; color: #fff; border: none; }
.btn-brown:hover { background-color: #5a3e1f; color: #fff; }

.table-brown { background-color: #d8cbbd; }
.table-brown th { border: none; }

.table-striped>tbody>tr:nth-of-type(odd) { background-color: #f8f0e0; }
.table-hover>tbody>tr:hover { background-color: #f0e4d1; }

.card { box-shadow: none; transition: none; }
.card:hover { box-shadow: none; transform: none; }

.table { border-collapse: separate !important; border-spacing: 0; border-radius: 12px; overflow: hidden; }
.table thead th:first-child { border-top-left-radius: 12px; }
.table thead th:last-child { border-top-right-radius: 12px; }
.table tbody tr:last-child td:first-child { border-bottom-left-radius: 12px; }
.table tbody tr:last-child td:last-child { border-bottom-right-radius: 12px; }

.badge { font-size: 0.85rem; }
</style>

@endsection
