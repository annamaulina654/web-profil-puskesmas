@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Tambah Layanan Baru</h4>
    </div>
    <div class="card-body">
        <form id="formLayanan" action="{{ route('layanan.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nama Layanan <span class="text-danger">*</span></label>
                <input type="text" name="nama_layanan" id="nama_layanan" class="form-control @error('nama_layanan') is-invalid @enderror" placeholder="Contoh: Poli Umum" value="{{ old('nama_layanan') }}">
                
                @error('nama_layanan')
                    <div class="invalid-feedback server-error d-block">
                        {{ $message }}
                    </div>
                @enderror
                
                <div class="invalid-feedback client-error d-none" id="error-nama">
                    Nama layanan wajib diisi!
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Jam Operasional <span class="text-danger">*</span></label>
                <input type="text" name="jam_operasional" id="jam_operasional" class="form-control @error('jam_operasional') is-invalid @enderror" placeholder="Contoh: Senin - Jumat, 08:00 - 14:00" value="{{ old('jam_operasional') }}">
                
                @error('jam_operasional')
                    <div class="invalid-feedback server-error d-block">
                        {{ $message }}
                    </div>
                @enderror

                <div class="invalid-feedback client-error d-none" id="error-jam">
                    Jam operasional wajib diisi!
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4" placeholder="Jelaskan tentang layanan ini...">{{ old('deskripsi') }}</textarea>
                
                @error('deskripsi')
                    <div class="invalid-feedback server-error d-block">
                        {{ $message }}
                    </div>
                @enderror

                <div class="invalid-feedback client-error d-none" id="error-deskripsi">
                    Deskripsi layanan tidak boleh kosong!
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Layanan (Opsional)</label>
                <input type="file" name="foto_layanan" class="form-control @error('foto_layanan') is-invalid @enderror">
                <small class="text-muted">Format: JPG, PNG. Maks: 2MB</small>
                
                @error('foto_layanan')
                    <div class="invalid-feedback server-error d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('formLayanan');
        
        const fields = [
            { id: 'nama_layanan', errorId: 'error-nama', type: 'input' },
            { id: 'jam_operasional', errorId: 'error-jam', type: 'input' },
            { id: 'deskripsi', errorId: 'error-deskripsi', type: 'textarea' }
        ];

        fields.forEach(field => {
            const inputElement = document.getElementById(field.id);
            const clientErrorElement = document.getElementById(field.errorId);

            if (inputElement) {
                inputElement.addEventListener('input', function() {
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
                event.stopPropagation();
            }
        });
    });
</script>
@endsection