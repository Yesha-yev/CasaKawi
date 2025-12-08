@extends('layouts.app')

@section('content')

<div class="container">

    <ul class="nav nav-tabs mb-3">
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

    <div class="card">
        <div class="card-header">
            Data Laporan — <strong>{{ ucfirst($status) }}</strong>
        </div>
        <div class="card-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Isi Laporan</th>
                        <th>Status</th>
                        <th width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($laporan as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->pesan }}</td>

                        <td>
                            <form action="{{ route('admin.laporan.status', $item->id) }}" method="POST">
                                @csrf
                                <select name="status" class="status-select
                                    @if($item->status == 'pending') bg-warning
                                    @elseif($item->status == 'proses') bg-info
                                    @else bg-success
                                    @endif
                                " onchange="this.className = 'status-select ' + this.options[this.selectedIndex].dataset.class; this.form.submit()">

                                    <option value="pending" data-class="bg-warning" {{ $item->status=='pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="proses" data-class="bg-info" {{ $item->status=='proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="selesai" data-class="bg-success" {{ $item->status=='selesai' ? 'selected' : '' }}>Selesai</option>

                                </select>
                            </form>
                        </td>

                        <td>
                            <form method="POST" action="{{ route('admin.laporan.destroy', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus laporan ini?')" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

<style>
    .card {
        box-shadow: none;
        transition: none;
    }

    .card:hover {
        transform: none;
        box-shadow: none;
    }

    .status-select {
        border-radius: 50px;
        padding: 4px 12px;
        font-weight: 500;
        text-align: center;
        cursor: pointer;
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
        padding: 4px 12px;
        font-size: 0.85rem;
        transition: 0.3s;
    }

    .btn-danger:hover {
        background-color: #5a3f22;
        border-color: #5a3f22;
    }
</style>

@endsection
