@extends('layouts.main')

@section('title', 'Layanan Kami')

@section('content')

<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Layanan Kesehatan</h1>
            <p class="lead mb-0">Daftar fasilitas dan poli yang tersedia untuk Anda.</p>
        </div>
    </div>
</header>

<div class="container mb-5">
    <div class="row">
        @forelse($layanan as $item)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow border-0 hover-effect">
                @if($item->foto_layanan)
                    <img class="card-img-top" src="{{ asset('storage/'.$item->foto_layanan) }}" alt="{{ $item->nama_layanan }}" style="height: 220px; object-fit: cover;">
                @else
                    <div class="bg-success text-white d-flex align-items-center justify-content-center" style="height: 220px;">
                        <i class="fas fa-stethoscope fa-4x"></i>
                    </div>
                @endif
                
                <div class="card-body">
                    <div class="badge bg-warning text-dark mb-2">
                        <i class="far fa-clock"></i> {{ $item->jam_operasional }}
                    </div>
                    <h3 class="card-title h4 fw-bold">{{ $item->nama_layanan }}</h3>
                    <p class="card-text text-muted">{{ $item->deskripsi }}</p>
                </div>
                <div class="card-footer bg-transparent border-top-0 pb-4">
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20bertanya%20tentang%20layanan%20{{ urlencode($item->nama_layanan) }}" target="_blank" class="btn btn-outline-success w-100">
                        <i class="fab fa-whatsapp"></i> Tanya via WA
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted fs-4">Belum ada data layanan yang ditambahkan.</p>
        </div>
        @endforelse
    </div>
</div>

@endsection