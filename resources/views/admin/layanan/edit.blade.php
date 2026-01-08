@extends('layouts.admin')

@section('title', 'Edit Layanan')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Data Layanan</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('layanan.update', $layanan->id_layanan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label>Nama Layanan</label>
                <input type="text" name="nama_layanan" class="form-control" value="{{ $layanan->nama_layanan }}" required>
            </div>

            <div class="mb-3">
                <label>Jam Operasional</label>
                <input type="text" name="jam_operasional" class="form-control" value="{{ $layanan->jam_operasional }}" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ $layanan->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label>Foto Saat Ini</label><br>
                @if($layanan->foto_layanan)
                    <img src="{{ asset('storage/'.$layanan->foto_layanan) }}" width="150" class="mb-2 img-thumbnail">
                @else
                    <span class="text-muted">Tidak ada foto</span>
                @endif
                <input type="file" name="foto_layanan" class="form-control mt-2">
                <small class="text-muted">Upload foto baru jika ingin mengganti.</small>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection