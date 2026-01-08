@extends('layouts.admin')

@section('title', 'Edit Profil')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Data Profil</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('profil.update', $profil->id_profil) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label>Kategori Profil</label>
                <input type="text" class="form-control" value="{{ $profil->kategori_profil }}" disabled>
                <input type="hidden" name="kategori_profil" value="{{ $profil->kategori_profil }}">
            </div>

            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ $profil->judul }}" required>
            </div>

            <div class="mb-3">
                <label>Isi Konten</label>
                <textarea name="isi_konten" class="form-control" rows="8">{{ $profil->isi_konten }}</textarea>
            </div>

            <div class="mb-3">
                <label>Gambar Saat Ini</label><br>
                @if($profil->gambar)
                    <img src="{{ asset('storage/'.$profil->gambar) }}" width="150" class="mb-2">
                @else
                    <span class="text-muted">Tidak ada gambar</span>
                @endif
                <input type="file" name="gambar" class="form-control mt-2">
                <small class="text-muted">Upload gambar baru jika ingin mengganti.</small>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('profil.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection