@extends('layouts.admin')

@section('title', 'Kelola Profil Puskesmas')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Data Profil Puskesmas</h4>
        @if($bisaTambah)
            <a href="{{ route('profil.create') }}" class="btn btn-primary btn-sm">
                + Tambah Data
            </a>
        @else
            <button class="btn btn-secondary btn-sm" disabled title="Semua kategori (Visi, Misi, dll) sudah terisi. Silakan edit data yang ada.">
                + Tambah Data (Penuh)
            </button>
        @endif
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
                        <th>Gambar</th>
                        <th>Terakhir Update</th>
                        <th class="text-center" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profil as $key => $item)
                    <tr>
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>
                            @if($item->kategori_profil == 'visi_misi')
                                <span class="badge bg-info">Visi & Misi</span>
                            @elseif($item->kategori_profil == 'struktur_organisasi')
                                <span class="badge bg-warning text-dark">Struktur</span>
                            @elseif($item->kategori_profil == 'inovasi')
                                <span class="badge bg-success">Inovasi</span>
                            @else
                                <span class="badge bg-secondary">Tentang</span>
                            @endif
                        </td>
                        <td>{{ $item->judul }}</td>
                        <td>
                            @if($item->gambar)
                                <img src="{{ asset('storage/'.$item->gambar) }}" width="100" class="img-thumbnail">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $item->updated_at }}</td>
                        
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('profil.edit', $item->id_profil) }}" class="btn btn-warning btn-sm text-white">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                
                                <form action="{{ route('profil.destroy', $item->id_profil) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
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