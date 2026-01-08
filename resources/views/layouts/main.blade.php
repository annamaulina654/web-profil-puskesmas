<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Puskesmas Sehat')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #198754;
            --dark: #0f5132;
            --light: #e8f5e9;
        }
        
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        .navbar-brand { font-weight: bold; font-size: 1.5rem; }
        .nav-link { font-weight: 500; font-size: 1.05rem; }
        .nav-link.active { color: #ffc107 !important; font-weight: bold; }
        
        .footer { background-color: var(--dark); color: white; padding: 40px 0; margin-top: 50px; }
        .footer a { color: #ddd; text-decoration: none; }
        .footer a:hover { color: white; text-decoration: underline; }
        
        .hero-section {
            background: linear-gradient(rgba(25, 135, 84, 0.8), rgba(15, 81, 50, 0.8)), url('https://source.unsplash.com/1200x600/?hospital,medical');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-hospital-alt me-2"></i> PUSKESMAS SEHAT
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('profil*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">Profil</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('public.profil', 'visi_misi') }}">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="{{ route('public.profil', 'struktur_organisasi') }}">Struktur Organisasi</a></li>
                            <li><a class="dropdown-item" href="{{ route('public.profil', 'inovasi') }}">Inovasi</a></li>
                            <li><a class="dropdown-item" href="{{ route('public.profil', 'tentang') }}">Tentang Kami</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.layanan') ? 'active' : '' }}" href="{{ route('public.layanan') }}">Layanan</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->is('informasi*') ? 'active' : '' }}" href="#" id="navbarDropdownInfo" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Informasi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownInfo">
                            <li><a class="dropdown-item" href="{{ route('public.informasi', ['kategori' => 'kegiatan']) }}">Kegiatan</a></li>
                            <li><a class="dropdown-item" href="{{ route('public.informasi', ['kategori' => 'pengumuman']) }}">Pengumuman</a></li>
                            <li><a class="dropdown-item" href="{{ route('public.informasi', ['kategori' => 'helpdesk']) }}">Helpdesk</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('public.informasi') }}">Semua Informasi</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.kontak') ? 'active' : '' }}" href="{{ route('public.kontak') }}">Hubungi Kami</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-outline-light btn-sm mt-1" href="{{ route('login') }}">Login Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5>PUSKESMAS SEHAT</h5>
                    <p>Melayani dengan hati, mengabdi untuk negeri. Kesehatan Anda adalah prioritas kami.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('public.layanan') }}">Layanan Medis</a></li>
                        <li><a href="{{ route('public.informasi') }}">Informasi Terkini</a></li>
                        <li><a href="{{ route('public.kontak') }}">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Hubungi Kami</h5>
                    <p>
                        <i class="fas fa-map-marker-alt me-2"></i> Jl. Kesehatan No. 123, Kota Sehat<br>
                        <i class="fas fa-phone me-2"></i> (021) 123-4567<br>
                        <i class="fas fa-envelope me-2"></i> info@puskesmas.id
                    </p>
                    <div class="mt-3">
                        <a href="#" class="me-3 fs-5"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="me-3 fs-5"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="me-3 fs-5"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="text-center">
                <small>&copy; {{ date('Y') }} Puskesmas Sehat. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>