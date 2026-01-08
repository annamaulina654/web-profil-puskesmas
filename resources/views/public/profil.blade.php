@extends('layouts.main')

@section('title', $kategori ? ucfirst(str_replace('_', ' ', $kategori)) : 'Profil')

@section('content')

<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder text-uppercase">
                {{ str_replace('_', ' ', $kategori) }}
            </h1>
            <p class="lead mb-0">Profil Puskesmas Sehat</p>
        </div>
    </div>
</header>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-lg-5">
                    
                    @if($data)
                        <h2 class="fw-bold mb-4">{{ $data->judul }}</h2>
                        
                        @if($data->gambar)
                            <div class="text-center mb-4">
                                <img src="{{ asset('storage/'.$data->gambar) }}" class="img-fluid rounded shadow" alt="{{ $data->judul }}" style="max-height: 500px;">
                            </div>
                        @endif

                        <div class="content-text fs-5" style="text-align: justify; line-height: 1.8;">
                            {!! nl2br(e($data->isi_konten)) !!}
                        </div>

                        <div class="mt-4 text-muted small">
                            <i class="far fa-clock me-1"></i> Terakhir diperbarui: {{ \Carbon\Carbon::parse($data->updated_at)->format('d M Y') }}
                        </div>

                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-clipboard-list fa-4x text-muted mb-3"></i>
                            <h3 class="text-muted">Data Belum Tersedia</h3>
                            <p>Mohon maaf, admin belum mengisi data untuk kategori <strong>{{ str_replace('_', ' ', $kategori) }}</strong>.</p>
                            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection