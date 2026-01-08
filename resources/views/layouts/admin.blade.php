<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Puskesmas')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --puskesmas-dark: #0f5132;   
            --puskesmas-main: #198754;
            --puskesmas-light: #e8f5e9;
            --sidebar-width: 250px;
        }
        
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        .sidebar {
            min-width: var(--sidebar-width);
            max-width: var(--sidebar-width);
            background-color: var(--puskesmas-dark);
            color: white;
            transition: all 0.3s;
            min-height: 100vh;
        }

        .sidebar a {
            color: #bdc3c7;
            text-decoration: none;
            padding: 15px 20px;
            display: block;
            border-left: 3px solid transparent;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: var(--puskesmas-main);
            color: white;
            border-left: 5px solid #fff;
        }

        .sidebar .brand {
            font-size: 1.2rem;
            font-weight: bold;
            padding: 20px;
            text-align: center;
            background-color: #0b3d26;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .content {
            width: 100%;
            padding: 20px;
            transition: all 0.3s;
        }

        .btn-toggle-sidebar {
            display: none;
            background-color: var(--puskesmas-main);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            margin-right: 15px;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: calc(var(--sidebar-width) * -1);
                position: fixed;
                height: 100%;
                z-index: 999;
            }
            
            .sidebar.active {
                margin-left: 0;
                box-shadow: 5px 0 15px rgba(0,0,0,0.2);
            }

            .btn-toggle-sidebar {
                display: inline-block;
            }
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div id="sidebar" class="sidebar d-flex flex-column flex-shrink-0 p-0">
        <div class="brand">
            ADMIN PUSKESMAS
        </div>
        
        <ul class="nav nav-pills flex-column mb-auto mt-2">
            <li>
                <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <small class="text-secondary ms-3 text-uppercase" style="font-size: 0.75rem; font-weight:bold;">Master Data</small>
            </li>
            <li>
                <a href="{{ route('profil.index') }}" class="{{ request()->is('admin/profil*') ? 'active' : '' }}">
                    Profil Puskesmas
                </a>
            </li>
            <li>
                <a href="#" class="{{ request()->is('admin/layanan*') ? 'active' : '' }}">Data Layanan</a>
            </li>
            <li>
                <a href="#" class="{{ request()->is('admin/informasi*') ? 'active' : '' }}">Informasi & Berita</a>
            </li>
            <li class="nav-item">
                <small class="text-secondary ms-3 text-uppercase" style="font-size: 0.75rem; font-weight:bold;">Lainnya</small>
            </li>
            <li>
                <a href="#" class="{{ request()->is('admin/pesan*') ? 'active' : '' }}">Pesan Masuk</a>
            </li>
            <li>
                <a href="{{ url('/logout') }}" class="text-danger">Logout</a>
            </li>
        </ul>
    </div>

    <div class="content">
        <nav class="navbar navbar-light bg-white shadow-sm mb-4 rounded px-3">
            <div class="d-flex align-items-center w-100">
                
                <button type="button" id="sidebarCollapse" class="btn-toggle-sidebar">
                    <i class="fas fa-bars"></i>
                </button>

                <span class="navbar-text ms-auto">
                    Selamat Datang, <strong>{{ Auth::user()->nama_lengkap ?? 'Admin' }}</strong>
                </span>
            </div>
        </nav>

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarCollapse');
        const content = document.querySelector('.content');

        if(toggleBtn) {
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault(); 
                sidebar.classList.toggle('active');
            });
        }

        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768 && 
                sidebar.classList.contains('active') && 
                !sidebar.contains(e.target) && 
                !toggleBtn.contains(e.target)) {
                sidebar.classList.remove('active');
            }
        });
    });
</script>

</body>
</html>