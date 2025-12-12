<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - Lapas Kelas IIA Besi</title>
    
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    {{-- Custom Tailwind Config --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'lapas-navy': '#0F2744',
                        'lapas-blue': '#1E3A5F',
                        'lapas-slate': '#2C4A6B',
                        'lapas-accent': '#3B82F6',
                        'lapas-gold': '#D4AF37'
                    }
                }
            }
        }
    </script>
    
    <style>
        .sidebar-link.active {
            background: linear-gradient(135deg, #0F2744, #1E3A5F);
            color: white;
        }
        
        .sidebar-link:not(.active):hover {
            background: rgba(59, 130, 246, 0.1);
            color: #3B82F6;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    
    {{-- Sidebar --}}
    <aside class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl z-40 transform transition-transform duration-300 ease-in-out" id="sidebar">
        <div class="flex flex-col h-full">
            
            {{-- Logo --}}
            <div class="flex items-center gap-3 p-6 border-b border-gray-200">
                <div class="w-12 h-12 flex items-center justify-center">
                    <img src="{{ asset('images/logo-besi.png') }}" alt="Logo Besi" class="w-full h-full object-contain">
                </div>
                <div>
                    <h2 class="font-bold text-lapas-navy text-lg">Admin Panel</h2>
                    <p class="text-xs text-gray-500">Lapas Besi</p>
                </div>
            </div>
            
            {{-- User Info --}}
            <div class="p-6 border-b border-gray-200 bg-gradient-to-br from-lapas-navy to-lapas-blue">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center text-white font-bold text-lg">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="text-white">
                        <p class="font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-xs opacity-80">{{ ucfirst(auth()->user()->role) }}</p>
                    </div>
                </div>
            </div>
            
            {{-- Navigation --}}
            <nav class="flex-1 p-4 overflow-y-auto">
                <div class="space-y-1">
                    <a href="{{ route('admin.pejabat.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.pejabat.*') ? 'active' : '' }}">
                        <i class="fas fa-users w-5"></i>
                        <span class="font-medium">Kelola Pejabat</span>
                    </a>
                    
                    {{-- Link Menu Lainnya --}}
                    <a href="#" 
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition">
                        <i class="fas fa-newspaper w-5"></i>
                        <span class="font-medium">Kelola Berita</span>
                    </a>
                    
                    <a href="#" 
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition">
                        <i class="fas fa-cog w-5"></i>
                        <span class="font-medium">Pengaturan</span>
                    </a>
                </div>
            </nav>
            
            {{-- Footer Sidebar --}}
            <div class="p-4 border-t border-gray-200">
                <a href="{{ route('landing') }}" 
                   class="flex items-center justify-center gap-2 px-4 py-3 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium transition">
                    <i class="fas fa-globe"></i>
                    <span>Lihat Website</span>
                </a>
            </div>
            
        </div>
    </aside>
    
    {{-- Main Content --}}
    <div class="ml-64">
        
        {{-- Top Bar --}}
        <header class="bg-white shadow-sm sticky top-0 z-30">
            <div class="flex items-center justify-between px-6 py-4">
                
                {{-- Mobile Menu Button --}}
                <button id="sidebarToggle" class="lg:hidden text-gray-600 hover:text-gray-900">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <div class="flex-1"></div>
                
                {{-- User Menu --}}
                <div class="flex items-center gap-4">
                    <span class="hidden md:inline text-sm text-gray-600">
                        Halo, <strong class="text-gray-800">{{ auth()->user()->name }}</strong>
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition inline-flex items-center gap-2">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="hidden md:inline">Logout</span>
                        </button>
                    </form>
                </div>
                
            </div>
        </header>
        
        {{-- Content --}}
        <main class="min-h-screen">
            @yield('content')
        </main>
        
        {{-- Footer --}}
        <footer class="bg-white border-t border-gray-200 py-6">
            <div class="container mx-auto px-6 text-center text-gray-600 text-sm">
                <p>&copy; {{ date('Y') }} Lapas Kelas IIA Besi Nusakambangan. All rights reserved.</p>
            </div>
        </footer>
        
    </div>
    
    {{-- Mobile Sidebar Overlay --}}
    <div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden"></div>
    
    {{-- Scripts --}}
    <script>
        // Sidebar Toggle for Mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        
        sidebarToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        });
        
        sidebarOverlay?.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
        
        // Auto-dismiss alerts
        setTimeout(() => {
            document.querySelectorAll('[class*="alert"]').forEach(el => {
                el.style.transition = 'opacity 0.5s';
                el.style.opacity = '0';
                setTimeout(() => el.remove(), 500);
            });
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>