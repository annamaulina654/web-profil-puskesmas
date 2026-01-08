@extends('layouts.admin')

@section('title', 'Tambah Informasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Tambah Informasi / Berita Baru</h4>
    </div>
    <div class="card-body">
        <form id="formInfo" action="{{ route('informasi.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Kategori Informasi <span class="text-danger">*</span></label>
                <select name="kategori_info" id="kategori_info" class="form-control @error('kategori_info') is-invalid @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="kegiatan" {{ old('kategori_info') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="pengumuman" {{ old('kategori_info') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                    <option value="helpdesk" {{ old('kategori_info') == 'helpdesk' ? 'selected' : '' }}>Helpdesk</option>
                </select>
                
                @error('kategori_info')
                    <div class="invalid-feedback server-error d-block">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback client-error d-none" id="error-kategori">Kategori wajib dipilih!</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" placeholder="Judul berita/kegiatan" value="{{ old('judul') }}">
                
                @error('judul')
                    <div class="invalid-feedback server-error d-block">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback client-error d-none" id="error-judul">Judul wajib diisi!</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Berita <span class="text-danger">*</span></label>
                <textarea name="isi" id="isi" class="form-control @error('isi') is-invalid @enderror" rows="6" placeholder="Tulis isi berita lengkap di sini...">{{ old('isi') }}</textarea>
                
                @error('isi')
                    <div class="invalid-feedback server-error d-block">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback client-error d-none" id="error-isi">Isi berita tidak boleh kosong!</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Utama (Opsional)</label>
                <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror">
                <small class="text-muted">Format: JPG, PNG. Maks: 2MB</small>
                
                @error('gambar')
                    <div class="invalid-feedback server-error d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan & Posting</button>
            <a href="{{ route('informasi.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('formInfo');
        const fields = [
            { id: 'kategori_info', errorId: 'error-kategori', type: 'select' },
            { id: 'judul', errorId: 'error-judul', type: 'input' },
            { id: 'isi', errorId: 'error-isi', type: 'textarea' }
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
                    if (clientErrorElement) {
                        clientErrorElement.classList.remove('d-none');
                        clientErrorElement.classList.add('d-block');
                    }
                }
            });
            if (!isValid) {
                event.preventDefault();
            }
        });
    });
</script>
@endsection