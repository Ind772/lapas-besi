<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - Lapas Besi</title>

    {{-- 1. BOOTSTRAP 5 CSS (CDN) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- 2. FONT AWESOME (CDN) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- 3. CUSTOM CSS UNTUK LAYOUT ADMIN --}}
    <style>
        body {
            overflow-x: hidden;
            background-color: #f8f9fa;
        }

        /* Sidebar Styling */
        #sidebar-wrapper {
            min-height: 100vh;
            margin-left: -15rem;
            transition: margin .25s ease-out;
            background-color: #0F2744; /* Warna Navy Lapas */
            color: white;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 1.5rem 1.25rem;
            font-size: 1.2rem;
            font-weight: bold;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        #sidebar-wrapper .list-group {
            width: 15rem;
        }

        .list-group-item {
            border: none;
            padding: 1rem 1.25rem;
            background-color: transparent; /* Transparan agar ikut warna sidebar */
            color: rgba(255, 255, 255, 0.8);
        }

        .list-group-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .list-group-item.active {
            background-color: #1E3A5F; /* Biru lebih terang */
            color: #fff;
            font-weight: bold;
            border-left: 4px solid #3B82F6;
        }

        /* Wrapper Toggled State */
        #wrapper.toggled #sidebar-wrapper {
            margin-left: 0;
        }

        /* Page Content */
        #page-content-wrapper {
            width: 100%;
        }

        /* Navbar Custom */
        .navbar-custom {
            background-color: #fff;
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
        }

        /* Responsive Fix */
        @media (min-width: 768px) {
            #sidebar-wrapper {
                margin-left: 0;
            }

            #page-content-wrapper {
                min-width: 0;
                width: 100%;
            }

            #wrapper.toggled #sidebar-wrapper {
                margin-left: -15rem;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <div class="d-flex" id="wrapper">
        
        {{-- SIDEBAR --}}
        <div class="" id="sidebar-wrapper">
            <div class="sidebar-heading text-center">
                <i class="fas fa-building me-2"></i> ADMIN LAPAS
            </div>
            <div class="list-group list-group-flush mt-3">
                <a href="{{ route('admin.pejabat.index') }}" 
                   class="list-group-item list-group-item-action {{ request()->routeIs('admin.pejabat.*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie me-2" style="width: 20px;"></i> Kelola Pejabat
                </a>
                
                {{-- Menu Tambahan (Contoh) --}}
                <a href="{{ route('admin.berita.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper me-2" style="width: 20px;"></i> Kelola Berita
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-cogs me-2" style="width: 20px;"></i> Pengaturan
                </a>
                
                <a href="{{ url('/') }}" target="_blank" class="list-group-item list-group-item-action mt-5 border-top border-secondary">
                    <i class="fas fa-external-link-alt me-2"></i> Lihat Website
                </a>
            </div>
        </div>

        {{-- PAGE CONTENT WRAPPER --}}
        <div id="page-content-wrapper">

            {{-- TOP NAVBAR --}}
            <nav class="navbar navbar-expand-lg navbar-light navbar-custom py-3 px-4">
                <div class="d-flex align-items-center w-100 justify-content-between">
                    
                    {{-- Tombol Toggle Sidebar --}}
                    <button class="btn btn-outline-secondary" id="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    {{-- User Dropdown --}}
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle fa-lg me-1 text-primary"></i>
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Profil Saya</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            {{-- MAIN CONTENT --}}
            <div class="container-fluid py-4">
                @yield('content')
            </div>

            {{-- FOOTER --}}
            <footer class="bg-white text-center py-3 border-top mt-auto">
                <small class="text-muted">&copy; {{ date('Y') }} Lapas Kelas IIA Besi Nusakambangan</small>
            </footer>

        </div>
    </div>

    {{-- 4. BOOTSTRAP JS BUNDLE (Termasuk Popper) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script Toggle Sidebar --}}
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

        // Auto hide alert
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>