@extends('layouts.main')

@section('title', 'Beranda - Puskesmas Sehat')

@section('content')

<style>
    .carousel-item {
        height: 85vh;
        min-height: 500px;
        background: no-repeat center center scroll;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    
    .carousel-caption {
        background: rgba(0, 0, 0, 0.5);
        padding: 20px;
        border-radius: 15px;
        bottom: 30%;
        max-width: 800px;
        margin: 0 auto;
    }

    @media (max-width: 768px) {
        .carousel-caption {
            bottom: 20%;
            padding: 15px;
            width: 90%;
            left: 5%; 
            right: 5%;
        }
        .carousel-caption h1 {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .carousel-caption p {
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        .carousel-caption .btn {
            padding: 5px 15px;
            font-size: 0.85rem;
        }
    }

    .service-card {
        border: none;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
    }

    .service-card .card-img-top {
        transition: transform 0.5s ease;
    }

    .service-card:hover .card-img-top {
        transform: scale(1.1);
    }

    .news-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        background-color: #fff;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(25, 135, 84, 0.15);
    }

    .news-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 220px;
    }

    .news-card .card-img-top,
    .news-img-placeholder {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease, filter 0.4s ease;
    }

    .news-card:hover .card-img-top,
    .news-card:hover .news-img-placeholder {
        transform: scale(1.1) rotate(1.5deg);
        filter: brightness(80%);
    }

    .news-category-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 2;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
    }

    .news-btn {
        border-radius: 50px;
        padding-left: 20px;
        padding-right: 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .news-card:hover .news-btn {
        background-color: var(--primary) !important;
        border-color: var(--primary) !important;
        color: white !important;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(25, 135, 84, 0.4);
    }
</style>

<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
        
        <div class="carousel-item active" style="background-image: url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&q=80&w=1000')">
            <div class="carousel-caption">
                <h1 class="display-4 fw-bolder text-white">Selamat Datang di Puskesmas Sehat</h1>
                <p class="lead text-white">Melayani dengan Hati, Mengabdi untuk Negeri. Kesehatan Anda adalah Prioritas Kami.</p>
                <div class="mt-4">
                    <a href="{{ route('public.layanan') }}" class="btn btn-warning btn-lg me-2">Lihat Fasilitas</a>
                </div>
            </div>
        </div>

        <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&q=80&w=1000')">
            <div class="carousel-caption">
                <h1 class="display-4 fw-bolder text-white">Informasi & Kegiatan</h1>
                <p class="lead text-white">Dapatkan kabar terbaru seputar kegiatan posyandu, penyuluhan kesehatan, dan pengumuman penting.</p>
                <div class="mt-4">
                    <a href="{{ route('public.informasi') }}" class="btn btn-primary btn-lg">Baca Informasi</a>
                </div>
            </div>
        </div>

        <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1516574187841-693018f37bdd?auto=format&fit=crop&q=80&w=1000')">
            <div class="carousel-caption">
                <h1 class="display-4 fw-bolder text-white">Layanan IGD 24 Jam</h1>
                <p class="lead text-white">Siap melayani kebutuhan darurat Anda kapan saja. Jangan ragu untuk menghubungi kami.</p>
                <div class="mt-4">
                    <a href="{{ route('public.kontak') }}" class="btn btn-danger btn-lg"><i class="fas fa-phone-alt me-2"></i> Hubungi Kami</a>
                </div>
            </div>
        </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                @if($tentang && $tentang->gambar)
                    <img class="img-fluid rounded mb-4 mb-lg-0 shadow" src="{{ asset('storage/'.$tentang->gambar) }}" alt="Tentang Puskesmas">
                @else
                    <img class="img-fluid rounded mb-4 mb-lg-0" src="https://dummyimage.com/600x400/dee2e6/6c757d.jpg" alt="...">
                @endif
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold text-success">Tentang Puskesmas Kami</h2>
                <p class="lead text-muted">Kami berkomitmen memberikan pelayanan kesehatan terbaik bagi masyarakat.</p>
                <p class="mb-4">
                    {{ Str::limit($tentang->isi_konten ?? 'Deskripsi profil puskesmas belum diisi oleh admin.', 300) }}
                </p>
                <a href="{{ route('public.profil', 'tentang') }}" class="btn btn-success">Baca Selengkapnya &rarr;</a>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Layanan Unggulan</h2>
            <p class="text-muted">Fasilitas dan layanan kesehatan yang kami sediakan.</p>
        </div>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-3 justify-content-center">
            
            @forelse($layanan as $item)
            <div class="col mb-5">
                <div class="card h-100 shadow-sm service-card">
                    
                    @if($item->foto_layanan)
                        <img class="card-img-top" src="{{ asset('storage/'.$item->foto_layanan) }}" alt="{{ $item->nama_layanan }}" style="height: 200px; object-fit: cover;" />
                    @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-medkit fa-3x"></i>
                        </div>
                    @endif
                    
                    <div class="card-body p-4 text-center">
                        <div class="text-center">
                            <h5 class="fw-bolder">{{ $item->nama_layanan }}</h5>
                            <span class="badge bg-success mb-2">{{ $item->jam_operasional }}</span>
                            <p class="text-muted small text-truncate">{{ Str::limit($item->deskripsi, 80) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted">
                <p>Belum ada data layanan.</p>
            </div>
            @endforelse

        </div>
        <div class="text-center mt-3">
            <a href="{{ route('public.layanan') }}" class="btn btn-outline-success">Lihat Semua Layanan</a>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Informasi & Berita Terkini</h2>
            <p class="text-muted">Kabar terbaru seputar kegiatan dan pengumuman puskesmas.</p>
        </div>
        <div class="row">
            @forelse($berita as $news)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 news-card">
                    
                    <div class="news-img-wrapper">
                        <span class="badge news-category-badge {{ $news->kategori_info == 'pengumuman' ? 'bg-warning text-dark' : ($news->kategori_info == 'kegiatan' ? 'bg-primary' : 'bg-info') }} text-uppercase py-2 px-3">
                            {{ $news->kategori_info }}
                        </span>

                        @if($news->gambar)
                            <img class="card-img-top" src="{{ asset('storage/'.$news->gambar) }}" alt="{{ $news->judul }}">
                        @else
                            <div class="news-img-placeholder bg-light text-secondary d-flex align-items-center justify-content-center">
                                <i class="fas fa-newspaper fa-4x opacity-50"></i>
                            </div>
                        @endif
                    </div>

                    <div class="card-body d-flex flex-column">
                        <div class="small text-muted mb-3 mt-2">
                            <i class="far fa-calendar-alt me-2 text-success"></i> {{ $news->tgl_posting->format('d F Y') }}
                        </div>
                        
                        <h5 class="card-title h4 fw-bold mb-3">{{ $news->judul }}</h5>
                        
                        <p class="card-text text-muted mb-4 flex-grow-1">
                            {{ Str::limit($news->isi, 100) }}
                        </p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('public.informasi.show', $news->id_informasi) }}" class="btn btn-outline-success news-btn w-100">
                                Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-5">
                <div class="bg-light rounded p-5">
                    <i class="far fa-folder-open fa-4x mb-3 text-secondary"></i>
                    <p class="fs-5 mb-0">Belum ada informasi terbaru.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection