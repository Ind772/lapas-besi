<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lapas Kelas IIA Besi Nusakambangan')</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'lapas': {
                            'navy': '#0f2744',
                            'blue': '#1e3a5f',
                            'slate': '#2d4356',
                            'light': '#435c7a',
                            'accent': '#3b82f6',
                            'gold': '#c7a15c',
                        }
                    }
                }
            }
        }
    </script>

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .pattern-overlay {
            background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,.02) 10px, rgba(255,255,255,.02) 20px);
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 0;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #3b82f6;
            border: 4px solid white;
            box-shadow: 0 0 0 4px #3b82f6;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    {{-- Include Navbar --}}
    @include('layouts.navbar')

    {{-- Main Content --}}
    @yield('content')

    {{-- Include Footer --}}
    @include('layouts.footer')

    @stack('scripts')
</body>
</html>