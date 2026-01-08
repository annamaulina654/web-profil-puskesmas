@extends('layouts.admin')

@section('title', 'Edit Informasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Informasi</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('informasi.update', $informasi->id_informasi) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label>Kategori Informasi</label>
                <select name="kategori_info" class="form-control" required>
                    <option value="kegiatan" {{ $informasi->kategori_info == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="pengumuman" {{ $informasi->kategori_info == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="helpdesk" {{ $informasi->kategori_info == 'helpdesk' ? 'selected' : '' }}>Helpdesk</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ $informasi->judul }}" required>
            </div>

            <div class="mb-3">
                <label>Isi Berita</label>
                <textarea name="isi" class="form-control" rows="8" required>{{ $informasi->isi }}</textarea>
            </div>

            <div class="mb-3">
                <label>Gambar Saat Ini</label><br>
                @if($informasi->gambar)
                    <img src="{{ asset('storage/'.$informasi->gambar) }}" width="150" class="mb-2 img-thumbnail">
                @else
                    <span class="text-muted">Tidak ada gambar</span>
                @endif
                <input type="file" name="gambar" class="form-control mt-2">
                <small class="text-muted">Upload gambar baru jika ingin mengganti.</small>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('informasi.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection