@extends('layouts.admin')

@section('title', 'Tambah Profil')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Tambah Data Profil</h4>
    </div>
    <div class="card-body">
        <form id="formProfil" action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Kategori Profil <span class="text-danger">*</span></label>
                <select name="kategori_profil" id="kategori_profil" class="form-control @error('kategori_profil') is-invalid @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="visi_misi" {{ old('kategori_profil') == 'visi_misi' ? 'selected' : '' }}>Visi & Misi</option>
                    <option value="struktur_organisasi" {{ old('kategori_profil') == 'struktur_organisasi' ? 'selected' : '' }}>Struktur Organisasi</option>
                    <option value="inovasi" {{ old('kategori_profil') == 'inovasi' ? 'selected' : '' }}>Inovasi</option>
                    <option value="tentang" {{ old('kategori_profil') == 'tentang' ? 'selected' : '' }}>Tentang Puskesmas</option>
                </select>
                
                @error('kategori_profil')
                    <div class="invalid-feedback server-error d-block">
                        {{ $message }}
                    </div>
                @enderror

                <div class="invalid-feedback client-error d-none" id="error-kategori">
                    Kategori profil wajib dipilih!
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="Contoh: Visi Misi Kami" value="{{ old('judul') }}">
                
                @error('judul')
                    <div class="invalid-feedback server-error d-block">
                        {{ $message }}
                    </div>
                @enderror
                
                <div class="invalid-feedback client-error d-none" id="error-judul">
                    Judul wajib diisi!
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Konten <span class="text-danger">*</span></label>
                <textarea name="isi_konten" id="isi_konten" class="form-control @error('isi_konten') is-invalid @enderror" rows="5" placeholder="Tulis isi profil di sini...">{{ old('isi_konten') }}</textarea>
                
                @error('isi_konten')
                    <div class="invalid-feedback server-error d-block">
                        {{ $message }}
                    </div>
                @enderror

                <div class="invalid-feedback client-error d-none" id="error-konten">
                    Isi konten tidak boleh kosong!
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar (Opsional)</label>
                <input type="file" name="gambar" class="form-control">
                <small class="text-muted">Format: JPG, PNG. Maks: 2MB</small>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('profil.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('formProfil');
        
        const fields = [
            { id: 'kategori_profil', errorId: 'error-kategori', type: 'select' },
            { id: 'judul', errorId: 'error-judul', type: 'input' },
            { id: 'isi_konten', errorId: 'error-konten', type: 'input' }
        ];

        fields.forEach(field => {
            const inputElement = document.getElementById(field.id);
            const clientErrorElement = document.getElementById(field.errorId);

            if (inputElement) {
                const eventType = field.type === 'select' ? 'change' : 'input';

                inputElement.addEventListener(eventType, function() {
                    this.classList.remove('is-invalid');

                    if (clientErrorElement) {
                        clientErrorElement.classList.remove('d-block');
                        clientErrorElement.classList.add('d-none');
                    }

                    const serverErrorDiv = this.parentNode.querySelector('.server-error');
                    if (serverErrorDiv) {
                        serverErrorDiv.classList.remove('d-block');
                        serverErrorDiv.style.display = 'none';
                    }
                });
            }
        });

        form.addEventListener('submit', function(event) {
            let isValid = true;

            fields.forEach(field => {
                const inputElement = document.getElementById(field.id);
                const clientErrorElement = document.getElementById(field.errorId);

                if (!inputElement.value.trim()) {
                    isValid = false;
                    
                    inputElement.classList.add('is-invalid');
                    
\                    if (clientErrorElement) {
                        clientErrorElement.classList.remove('d-none');
                        clientErrorElement.classList.add('d-block');
                    }
                }
            });

            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    });
</script>
@endsection