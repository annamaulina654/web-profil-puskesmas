@extends('layouts.main')

@section('title', 'Beranda - Puskesmas Sehat')

@section('content')

<header class="py-5 bg-light border-bottom mb-4" style="background: linear-gradient(rgba(25, 135, 84, 0.9), rgba(15, 81, 50, 0.8)), url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&q=80&w=1000'); background-size: cover; background-position: center;">
    <div class="container text-center my-5">
        <h1 class="fw-bolder text-white display-4">Selamat Datang di Puskesmas Sehat</h1>
        <p class="lead text-white-50 mb-0">Melayani dengan Hati, Mengabdi untuk Negeri</p>
        <div class="mt-4">
            <a href="{{ route('public.layanan') }}" class="btn btn-warning btn-lg me-2">Lihat Layanan</a>
            <a href="{{ route('public.kontak') }}" class="btn btn-outline-light btn-lg">Hubungi Kami</a>
        </div>
    </div>
</header>

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
                <div class="card h-100 shadow-sm border-0">
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
            <div class="col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($news->gambar)
                        <img class="card-img-top" src="{{ asset('storage/'.$news->gambar) }}" alt="..." style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-light text-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-newspaper fa-3x"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="small text-muted mb-2">
                            <i class="far fa-calendar-alt me-1"></i> {{ $news->tgl_posting->format('d M Y') }}
                            &bull; 
                            <span class="text-primary fw-bold text-uppercase" style="font-size: 0.8rem;">{{ $news->kategori_info }}</span>
                        </div>
                        <h5 class="card-title h4">{{ $news->judul }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($news->isi, 100) }}</p>
                        <a href="{{ route('public.informasi.show', $news->id_informasi) }}" class="btn btn-sm btn-primary">Baca Selengkapnya &rarr;</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted">
                <p>Belum ada berita terbaru.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection