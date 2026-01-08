@extends('layouts.admin')

@section('title', 'Kelola Informasi & Berita')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Informasi & Berita</h4>
        <a href="{{ route('informasi.create') }}" class="btn btn-primary btn-sm">+ Tambah Berita</a>
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
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Tanggal Posting</th>
                        <th>Gambar</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($informasi as $key => $item)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>
                            @if($item->kategori_info == 'kegiatan')
                                <span class="badge bg-primary">Kegiatan</span>
                            @elseif($item->kategori_info == 'pengumuman')
                                <span class="badge bg-warning text-dark">Pengumuman</span>
                            @else
                                <span class="badge bg-info">Helpdesk</span>
                            @endif
                        </td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->tgl_posting->format('d M Y, H:i') }}</td>
                        <td>
                            @if($item->gambar)
                                <img src="{{ asset('storage/'.$item->gambar) }}" width="80" class="img-thumbnail">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('informasi.edit', $item->id_informasi) }}" class="btn btn-warning btn-sm text-white">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('informasi.destroy', $item->id_informasi) }}" method="POST" onsubmit="return confirm('Yakin hapus berita ini?')">
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