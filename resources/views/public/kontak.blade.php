@extends('layouts.main')

@section('title', 'Hubungi Kami')

@section('content')

<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Hubungi Kami</h1>
            <p class="lead mb-0">Kami siap mendengar masukan, kritik, dan saran Anda.</p>
        </div>
    </div>
</header>

<div class="container mb-5">
    <div class="row">
        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm h-100 bg-success text-white">
                <div class="card-body p-4">
                    <h3 class="fw-bold mb-4"><i class="fas fa-info-circle me-2"></i> Informasi Kontak</h3>
                    <div class="mb-4">
                        <h5 class="fw-bold">Alamat:</h5>
                        <p>Jl. Raya Kesehatan No. 123, Kec. Sehat Selalu, Kota Bahagia, Indonesia 40123.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold">Telepon / WhatsApp:</h5>
                        <p>+62 812-3456-7890 (IGD 24 Jam)</p>
                        <p>+62 21-555-1234 (Kantor)</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold">Email:</h5>
                        <p>puskesmas@sehat.id</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold">Jam Operasional:</h5>
                        <p>IGD: 24 Jam<br>Poli Umum: Senin - Sabtu (08:00 - 14:00)</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-success"><i class="fas fa-envelope-open-text me-2"></i> Kirim Pesan / Masukan</h5>
                </div>
                <div class="card-body p-4">
                    
                    @if(session('success'))
                        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="formKontak" action="{{ route('public.kirim_pesan') }}" method="POST" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control @error('nama_pengirim') is-invalid @enderror" value="{{ old('nama_pengirim') }}" placeholder="Nama Anda">
                                
                                @error('nama_pengirim')
                                    <div class="invalid-feedback server-error d-block">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback client-error d-none" id="error-nama">Nama wajib diisi!</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="email@contoh.com">
                                
                                @error('email')
                                    <div class="invalid-feedback server-error d-block">{{ $message }}</div>
                                @enderror
                                <div class="invalid-feedback client-error d-none" id="error-email">Email wajib diisi!</div>
                                <div class="invalid-feedback client-error d-none" id="error-email-format">Format email salah! (harus ada @ dan .)</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subjek <span class="text-danger">*</span></label>
                            <input type="text" name="subjek" id="subjek" class="form-control @error('subjek') is-invalid @enderror" value="{{ old('subjek') }}" placeholder="Judul pesan">
                            
                            @error('subjek')
                                <div class="invalid-feedback server-error d-block">{{ $message }}</div>
                            @enderror
                            <div class="invalid-feedback client-error d-none" id="error-subjek">Subjek pesan wajib diisi!</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pesan <span class="text-danger">*</span></label>
                            <textarea name="pesan" id="pesan" class="form-control @error('pesan') is-invalid @enderror" rows="5" placeholder="Tuliskan pesan Anda (Min. 10 karakter)...">{{ old('pesan') }}</textarea>
                            
                            @error('pesan')
                                <div class="invalid-feedback server-error d-block">{{ $message }}</div>
                            @enderror
                            <div class="invalid-feedback client-error d-none" id="error-pesan">Isi pesan tidak boleh kosong!</div>
                        </div>

                        <button type="submit" class="btn btn-success px-4">
                            <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('formKontak');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        const fields = [
            { id: 'nama_pengirim', errorId: 'error-nama', minLength: 3, label: 'Nama' },
            { id: 'email', errorId: 'error-email', minLength: 0, label: 'Email' },
            { id: 'subjek', errorId: 'error-subjek', minLength: 5, label: 'Subjek' },
            { id: 'pesan', errorId: 'error-pesan', minLength: 10, label: 'Pesan' }
        ];

        function hideSuccessAlert() {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.style.display = 'none';
            }
        }

        fields.forEach(field => {
            const inputElement = document.getElementById(field.id);
            const errorElement = document.getElementById(field.errorId);
            
            if (inputElement) {
                inputElement.addEventListener('focus', function() {
                    hideSuccessAlert();
                });

                inputElement.addEventListener('input', function() {
                    hideSuccessAlert();

                    this.classList.remove('is-invalid');
                    if (errorElement) errorElement.classList.add('d-none');

                    if (field.id === 'email') {
                        const errorFormat = document.getElementById('error-email-format');
                        if (errorFormat) errorFormat.classList.add('d-none');
                    }

                    const parent = this.parentNode;
                    const serverError = parent.querySelector('.server-error');
                    if (serverError) serverError.style.display = 'none';
                });

                inputElement.addEventListener('blur', function() {
                    const val = this.value.trim();

                    if (!val) {
                        this.classList.add('is-invalid');
                        if (errorElement) {
                            errorElement.innerText = field.label + " wajib diisi!";
                            errorElement.classList.remove('d-none');
                            errorElement.classList.add('d-block');
                        }
                        return;
                    }

                    if (field.minLength > 0 && val.length < field.minLength) {
                        this.classList.add('is-invalid');
                        if (errorElement) {
                            errorElement.innerText = field.label + " minimal " + field.minLength + " karakter!";
                            errorElement.classList.remove('d-none');
                            errorElement.classList.add('d-block');
                        }
                    }

                    if (field.id === 'email') {
                        if (!emailPattern.test(val)) {
                            this.classList.add('is-invalid');
                            const errorFormat = document.getElementById('error-email-format');
                            if (errorFormat) {
                                errorFormat.classList.remove('d-none');
                                errorFormat.classList.add('d-block');
                            }
                        }
                    }
                });
            }
        });

        form.addEventListener('submit', function(event) {
            let isValid = true;

            fields.forEach(field => {
                const inputElement = document.getElementById(field.id);
                const errorElement = document.getElementById(field.errorId);
                const val = inputElement.value.trim();
                
                if (errorElement) errorElement.innerText = field.label + " wajib diisi!";

                if (!val) {
                    isValid = false;
                    inputElement.classList.add('is-invalid');
                    if (errorElement) {
                        errorElement.classList.remove('d-none');
                        errorElement.classList.add('d-block');
                    }
                }
                else if (field.minLength > 0 && val.length < field.minLength) {
                    isValid = false;
                    inputElement.classList.add('is-invalid');
                    if (errorElement) {
                        errorElement.innerText = field.label + " minimal " + field.minLength + " karakter!";
                        errorElement.classList.remove('d-none');
                        errorElement.classList.add('d-block');
                    }
                }
                else if (field.id === 'email') {
                    if (!emailPattern.test(val)) {
                        isValid = false;
                        inputElement.classList.add('is-invalid');
                        const errorFormat = document.getElementById('error-email-format');
                        if (errorFormat) {
                            errorFormat.classList.remove('d-none');
                            errorFormat.classList.add('d-block');
                        }
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