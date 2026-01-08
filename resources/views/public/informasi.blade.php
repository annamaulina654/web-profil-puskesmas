@extends('layouts.main')

@section('title', $title . ' - Puskesmas Sehat')

@section('content')

<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">{{ $title }}</h1>
            <p class="lead mb-0">Informasi terbaru seputar layanan, kegiatan, dan pengumuman kami.</p>
        </div>
    </div>
</header>

<div class="container mb-5">
    <div class="row">
        @forelse($informasi as $item)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0 hover-effect">
                
                @if($item->gambar)
                    <img class="card-img-top" src="{{ asset('storage/'.$item->gambar) }}" alt="{{ $item->judul }}" style="height: 220px; object-fit: cover;">
                @else
                    <div class="bg-light text-secondary d-flex align-items-center justify-content-center" style="height: 220px;">
                        <i class="far fa-newspaper fa-4x"></i>
                    </div>
                @endif
                
                <div class="card-body">
                    <div class="small text-muted mb-2">
                        <i class="far fa-calendar-alt me-1"></i> {{ $item->tgl_posting->format('d M Y') }}
                        &bull; 
                        <span class="badge {{ $item->kategori_info == 'pengumuman' ? 'bg-warning text-dark' : ($item->kategori_info == 'kegiatan' ? 'bg-primary' : 'bg-info') }}">
                            {{ ucfirst($item->kategori_info) }}
                        </span>
                    </div>

                    <h2 class="card-title h5 fw-bold mb-3">
                        <a href="{{ route('public.informasi.show', $item->id_informasi) }}" class="text-decoration-none text-dark stretched-link">
                            {{ Str::limit($item->judul, 50) }}
                        </a>
                    </h2>

                    <p class="card-text text-muted">
                        {{ Str::limit($item->isi, 100) }}
                    </p>
                </div>

                <div class="card-footer bg-transparent border-top-0 pb-4">
                    <a href="{{ route('public.informasi.show', $item->id_informasi) }}" class="btn btn-outline-success btn-sm">
                        Baca Selengkapnya &rarr;
                    </a>
                </div>
            </div>
        </div>

        @empty
        <div class="col-12 py-5 text-center">
            <div class="alert alert-light border shadow-sm d-inline-block px-5">
                <i class="fas fa-search fa-2x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada informasi</h4>
                <p class="mb-0">Saat ini belum ada postingan untuk kategori ini.</p>
                <a href="{{ route('public.informasi') }}" class="btn btn-sm btn-primary mt-3">Lihat Semua Kategori</a>
            </div>
        </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $informasi->links() }}
    </div>
</div>

@endsection