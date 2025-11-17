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
                                <select name="status" class="form-select form-select-sm
                                    @if($item->status == 'pending') bg-warning text-dark
                                    @elseif($item->status == 'proses') bg-info text-dark
                                    @else bg-success text-white
                                    @endif
                                " onchange="this.className = 'form-select form-select-sm ' + this.options[this.selectedIndex].dataset.class; this.form.submit()">

                                    <option value="pending" data-class="bg-warning text-dark" {{ $item->status=='pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="proses" data-class="bg-info text-dark" {{ $item->status=='proses' ? 'selected' : '' }}>
                                        Proses
                                    </option>

                                    <option value="selesai" data-class="bg-success text-white" {{ $item->status=='selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>

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

@endsection
