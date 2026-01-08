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
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Berhasil!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('public.kirim_pesan') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_pengirim" class="form-control" required placeholder="Nama Anda">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required placeholder="email@contoh.com">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subjek</label>
                            <input type="text" name="subjek" class="form-control" required placeholder="Judul pesan, misal: Kritik Pelayanan">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pesan</label>
                            <textarea name="pesan" class="form-control" rows="5" required placeholder="Tuliskan pesan Anda di sini..."></textarea>
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

@endsection