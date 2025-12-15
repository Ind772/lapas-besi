<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        {{-- CSS GLOBAL UNTUK SCROLLING --}}
        <style>
            /* DEFINISI ID SECTION */
            #beranda, #profil, #layanan, #berita, #kontak {
                /* 1. Tampilan Default (HP/Mobile) */
                /* Navbar di HP biasanya lebih kecil, jadi jarak scroll-nya jangan terlalu besar */
                scroll-margin-top: 5rem; /* Sekitar 80px */
            }

            /* 2. Tampilan Desktop (Layar Besar) */
            /* Tailwind 'lg' breakpoint biasanya mulai dari 1024px */
            @media (min-width: 1024px) {
                #beranda, #profil, #layanan, #berita, #kontak {
                    /* Navbar di Desktop biasanya lebih tinggi, butuh jarak lebih */
                    scroll-margin-top: 5rem; /* Sekitar 112px */
                }
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col">
            
            {{-- LOGIKA NAVBAR --}}
            @auth
                @include('layouts.navigation')
            @else
                @include('layouts.navbar')
            @endauth

            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            {{-- KONTEN UTAMA --}}
            <main class="flex-grow">
                {{ $slot ?? '' }}
                @yield('content')
            </main>

            {{-- LOGIKA FOOTER --}}
            @guest
                @include('layouts.footer')
            @endguest
        </div>
        
        @stack('scripts')
    </body>
</html>