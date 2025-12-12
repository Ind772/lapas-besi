<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Lapas Besi Nusakambangan')</title>
    
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
                        'lapas-blue': '#1e3a5f',
                        'lapas-slate': '#2d4a6f',
                        'lapas-accent': '#2563EB',
                        'lapas-gold': '#D4AF37',
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Pattern Overlay */
        .pattern-overlay {
            position: relative;
        }
        .pattern-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,.03) 10px, rgba(255,255,255,.03) 20px);
            pointer-events: none;
        }
        
        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
    </style>
    
    @stack('styles')
</head>
<body class="font-sans antialiased">
    {{-- Public Navbar --}}
    @include('layouts.navbar')
    
    {{-- Content --}}
    @yield('content')
    
    {{-- Footer --}}
    @include('layouts.footer')
    
    @stack('scripts')
</body>
</html>