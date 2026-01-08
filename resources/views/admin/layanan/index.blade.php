@extends('layouts.admin')

@section('title', 'Kelola Layanan')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Data Layanan Puskesmas</h4>
        <a href="{{ route('layanan.create') }}" class="btn btn-primary btn-sm">+ Tambah Layanan</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">No</th>
                        <th>Nama Layanan</th>
                        <th>Jam Operasional</th>
                        <th>Foto</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($layanan as $key => $item)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $item->nama_layanan }}</td>
                        <td><span class="badge bg-info text-dark">{{ $item->jam_operasional }}</span></td>
                        <td>
                            @if($item->foto_layanan)
                                <img src="{{ asset('storage/'.$item->foto_layanan) }}" width="80" class="img-thumbnail">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('layanan.edit', $item->id_layanan) }}" class="btn btn-warning btn-sm text-white">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('layanan.destroy', $item->id_layanan) }}" method="POST" onsubmit="return confirm('Yakin hapus layanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection