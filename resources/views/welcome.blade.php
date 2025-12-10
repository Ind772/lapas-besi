<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapas Kelas IIA Besi Nusakambangan</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'lapas': {
                            'navy': '#0f2744',       // Dark Navy
                            'blue': '#1e3a5f',       // Navy Blue
                            'slate': '#2d4356',      // Blue Slate
                            'light': '#435c7a',      // Light Navy
                            'accent': '#3b82f6',     // Bright Blue Accent
                            'gold': '#c7a15c',       // Muted Gold
                        }
                    }
                }
            }
        }
    </script>

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .hero-bg {
            background-size: cover;
            background-position: center;
            transition: background-image 0.5s ease-in-out;
        }
        
        /* Subtle pattern overlay */
        .pattern-overlay {
            background-image: 
                repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255,255,255,.02) 10px, rgba(255,255,255,.02) 20px);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    {{-- TOP BAR --}}
    <div class="bg-black text-gray-300 text-xs py-2">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-2">
            <div class="flex gap-4">
                <span><i class="far fa-clock mr-1"></i> Senin-Kamis: 08:00-15:00 | Jumat: 08:00-13:00</span>
            </div>
            <div class="flex gap-4">
                <a href="tel:081393456571" class="hover:text-white transition"><i class="fas fa-phone mr-1"></i> 0282 (5255261) / 081393456571</a>
                <a href="mailto:lapasbesimax@gmail.com" class="hover:text-white transition"><i class="far fa-envelope mr-1"></i> lapasbesimax@gmail.com</a>
            </div>
        </div>
    </div>

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-lg sticky top-0 z-50 border-b border-gray-200">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                {{-- Logo & Brand --}}
                <div class="flex items-center space-x-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-14 bg-gradient-to-br from-lapas-navy to-lapas-blue rounded-lg flex items-center justify-center shadow-md">
                             <img src="{{ asset('images/logo_kemenimipas.png') }}" alt="Logo Kemenimipas" class="w-10 h-10 object-contain">
                        </div>
                        <div>
                            <h1 class="text-lg font-bold text-lapas-navy uppercase tracking-wide">Lapas Kelas IIA Besi</h1>
                            <p class="text-xs text-gray-500">Kementerian Imigrasi dan Pemasyarakatan</p>
                        </div>
                    </div>
                </div>

                {{-- Navigation Menu --}}
                <div class="hidden md:flex space-x-1">
                    <a href="#" class="px-4 py-2 text-lapas-navy font-semibold border-b-2 border-lapas-accent">Beranda</a>
                    <a href="#profil" class="px-4 py-2 text-gray-600 hover:text-lapas-navy hover:bg-gray-100 rounded transition">Profil</a>
                    <a href="#layanan" class="px-4 py-2 text-gray-600 hover:text-lapas-navy hover:bg-gray-100 rounded transition">Layanan</a>
                    <a href="#berita" class="px-4 py-2 text-gray-600 hover:text-lapas-navy hover:bg-gray-100 rounded transition">Berita</a>
                    <a href="#kontak" class="px-4 py-2 text-gray-600 hover:text-lapas-navy hover:bg-gray-100 rounded transition">Kontak</a>
                </div>

                {{-- Mobile Menu Button --}}
                <button class="md:hidden text-lapas-navy text-2xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    @php
        $bgImage = $sliders->first() ? $sliders->first()->gambar : 'https://assets-a1.kompasiana.com/items/album/2022/04/23/whatsapp-image-2022-04-23-at-09-28-38-62637d15bb44865f7f415972.jpeg';
        $judul = $sliders->first() ? $sliders->first()->judul : 'Lembaga Pemasyarakatan Kelas IIA Besi';
        $deskripsi = $sliders->first() ? $sliders->first()->deskripsi : 'Nusakambangan, Jawa Tengah';
    @endphp

    <header class="hero-bg relative h-screen flex items-center justify-center text-center px-6"
        style="background-image: linear-gradient(135deg, rgba(15, 39, 68, 0.92), rgba(0, 0, 0, 0.85)), url('{{ $bgImage }}')">
        <div class="pattern-overlay absolute inset-0"></div>
        <div class="relative z-10 max-w-5xl text-white">
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 px-4 py-2 rounded-full mb-6">
                <i class="fas fa-building text-lapas-accent"></i>
                <span class="text-sm font-semibold">Website Resmi Satuan Kerja Kemenkumham RI</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">{{ $judul }}</h1>
            <p class="text-xl md:text-2xl mb-4 text-gray-200 font-light">{{ $deskripsi }}</p>
            <p class="text-lg mb-8 text-lapas-gold font-medium italic">
                "Griya Winaya Janma Wimarga Laksa Dharmmesti"
            </p>

            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="#layanan" class="bg-lapas-accent hover:bg-blue-600 text-white font-bold py-4 px-8 rounded-lg shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
                    <i class="fas fa-info-circle mr-2"></i> Informasi Layanan
                </a>
                <a href="#profil" class="border-2 border-white hover:bg-white hover:text-lapas-navy text-white font-bold py-4 px-8 rounded-lg shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
                    <i class="fas fa-landmark mr-2"></i> Profil Lapas
                </a>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <i class="fas fa-chevron-down text-white text-2xl"></i>
        </div>
    </header>

    {{-- INFO CARDS --}}
    <section class="relative -mt-20 z-20">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-xl p-8 hover:shadow-2xl transition border-t-4 border-lapas-navy">
                    <div class="w-16 h-16 bg-gradient-to-br from-lapas-navy to-lapas-blue rounded-lg flex items-center justify-center mb-4 mx-auto shadow-md">
                        <i class="fas fa-shield-alt text-3xl text-white"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-2 text-center text-lapas-navy">Keamanan Maksimal</h3>
                    <p class="text-gray-600 text-center text-sm">Standar keamanan tinggi dengan sistem pengawasan 24/7</p>
                </div>

                <div class="bg-white rounded-xl shadow-xl p-8 hover:shadow-2xl transition border-t-4 border-lapas-accent">
                    <div class="w-16 h-16 bg-gradient-to-br from-lapas-accent to-blue-600 rounded-lg flex items-center justify-center mb-4 mx-auto shadow-md">
                        <i class="fas fa-balance-scale text-3xl text-white"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-2 text-center text-lapas-navy">Berbasis HAM</h3>
                    <p class="text-gray-600 text-center text-sm">Pembinaan yang menghormati hak asasi manusia</p>
                </div>

                <div class="bg-white rounded-xl shadow-xl p-8 hover:shadow-2xl transition border-t-4 border-gray-800">
                    <div class="w-16 h-16 bg-gradient-to-br from-gray-800 to-black rounded-lg flex items-center justify-center mb-4 mx-auto shadow-md">
                        <i class="fas fa-star text-3xl text-white"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-2 text-center text-lapas-navy">Zona Integritas</h3>
                    <p class="text-gray-600 text-center text-sm">Wilayah Bebas dari Korupsi (WBK)</p>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION LAYANAN --}}
    <section id="layanan" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <div class="inline-block mb-4">
                    <span class="bg-gray-100 text-lapas-navy px-4 py-2 rounded-full text-sm font-semibold border border-gray-200">
                        LAYANAN PUBLIK
                    </span>
                </div>
                <h2 class="text-4xl font-bold text-lapas-navy mb-4">Layanan & Informasi</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-lapas-navy via-lapas-accent to-lapas-navy mx-auto mb-4"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Informasi terkait prosedur kunjungan dan layanan bagi keluarga Warga Binaan Pemasyarakatan
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                {{-- Layanan 1: Kunjungan --}}
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition border border-gray-200 hover:border-lapas-accent group">
                    <div class="text-lapas-navy group-hover:text-lapas-accent text-4xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-lapas-navy">Kunjungan Offline</h3>
                    <p class="text-gray-600 mb-4">Layanan pertemuan langsung bagi keluarga warga binaan dengan jadwal dan prosedur yang telah ditentukan.</p>
                    <a href="#" class="text-lapas-accent font-semibold hover:text-lapas-navy inline-flex items-center group-hover:gap-2 transition-all">
                        Selengkapnya 
                        <i class="fas fa-arrow-right ml-1 group-hover:ml-2 transition-all"></i>
                    </a>
                </div>

                {{-- Layanan 2: Tutorial Topup Brizzi --}}
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition border border-gray-200 hover:border-lapas-accent group">
                    <div class="text-lapas-navy group-hover:text-lapas-accent text-4xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-lapas-navy">Tutorial Topup Brizzi</h3>
                    <p class="text-gray-600 mb-4">Panduan lengkap pengisian kartu Brizzi bagi warga binaan yang dilakukan oleh pihak keluarga.</p>
                    <a href="#" class="text-lapas-accent font-semibold hover:text-lapas-navy inline-flex items-center group-hover:gap-2 transition-all">
                        Selengkapnya 
                        <i class="fas fa-arrow-right ml-1 group-hover:ml-2 transition-all"></i>
                    </a>
                </div>

                {{-- Layanan 3: Layanan Pengaduan --}}
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition border border-gray-200 hover:border-lapas-accent group">
                    <div class="text-lapas-navy group-hover:text-lapas-accent text-4xl mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-lapas-navy">Layanan Pengaduan</h3>
                    <p class="text-gray-600 mb-4">Layanan pengaduan disediakan untuk memudahkan masyarakat menyampaikan keluhan dan mendapatkan solusi.</p>
                    <a href="#" class="text-lapas-accent font-semibold hover:text-lapas-navy inline-flex items-center group-hover:gap-2 transition-all">
                        Selengkapnya 
                        <i class="fas fa-arrow-right ml-1 group-hover:ml-2 transition-all"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION BERITA --}}
    <section id="berita" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">

            <div class="flex justify-between items-end mb-10">
                <div>
                    <div class="inline-block mb-2">
                        <span class="bg-gray-100 text-lapas-navy px-4 py-2 rounded-full text-sm font-semibold border border-gray-200">
                            BERITA TERKINI
                        </span>
                    </div>
                    <h2 class="text-4xl font-bold text-lapas-navy">Kabar Nusakambangan</h2>
                    <p class="text-gray-600 mt-2">Update kegiatan dari Kompasiana Lapas Besi</p>
                </div>
                <a href="https://www.kompasiana.com/rezanaagustyan8132" 
                   target="_blank" 
                   class="hidden md:inline-flex items-center gap-2 bg-lapas-navy hover:bg-black text-white px-6 py-3 rounded-lg font-bold transition shadow-lg hover:shadow-xl">
                    Lihat Semua 
                    <i class="fas fa-external-link-alt"></i>
                </a>
            </div>

            <div class="grid md:grid-cols-2 gap-8">

                {{-- Berita Highlight --}}
                @if($highlight)
                <div class="relative rounded-xl overflow-hidden group h-96 shadow-xl">
                    <img src="{{ $highlight['gambar'] }}" 
                         alt="{{ $highlight['judul'] }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                         onerror="this.src='https://via.placeholder.com/800x400?text=Image+Not+Available'">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                        <span class="bg-lapas-accent text-white text-xs font-bold px-3 py-1 rounded-full mb-3 inline-block">
                            <i class="fas fa-newspaper mr-1"></i> {{ $highlight['kategori'] }}
                        </span>
                        <a href="{{ $highlight['link'] }}" target="_blank">
                            <h3 class="text-2xl md:text-3xl font-bold mb-3 hover:text-lapas-accent transition leading-tight">
                                {{ $highlight['judul'] }}
                            </h3>
                        </a>
                        <p class="text-sm text-gray-300 flex items-center gap-2">
                            <i class="far fa-calendar-alt"></i>
                            {{ $highlight['tanggal'] }}
                        </p>
                    </div>
                </div>
                @else
                <div class="h-96 bg-gray-100 rounded-xl flex flex-col items-center justify-center text-gray-400 border-2 border-dashed border-gray-300">
                    <i class="fas fa-newspaper text-6xl mb-4 opacity-30"></i>
                    <p>Belum ada berita tersedia</p>
                </div>
                @endif

                {{-- List Berita Kecil --}}
                <div class="space-y-4">
                    @forelse($beritas as $berita)
                        <div class="flex gap-4 items-start bg-white p-5 rounded-xl shadow-md hover:shadow-xl transition group border border-gray-100">
                            <img src="{{ $berita['gambar'] }}" 
                                 alt="{{ $berita['judul'] }}"
                                 class="w-28 h-28 object-cover rounded-lg flex-shrink-0 group-hover:scale-105 transition border border-gray-200"
                                 onerror="this.src='https://via.placeholder.com/150?text=No+Image'">
                            <div class="flex-1">
                                <a href="{{ $berita['link'] }}" target="_blank">
                                    <h4 class="font-bold text-lg hover:text-lapas-accent transition leading-tight mb-2 line-clamp-2 text-gray-800">
                                        {{ $berita['judul'] }}
                                    </h4>
                                </a>
                                <p class="text-gray-600 text-sm mb-2 line-clamp-2">
                                    {{ $berita['ringkasan'] }}
                                </p>
                                <span class="text-xs text-gray-500 flex items-center gap-1">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ $berita['tanggal'] }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-400 py-12 bg-white rounded-xl border-2 border-dashed border-gray-200">
                            <i class="fas fa-newspaper text-4xl mb-3 opacity-30"></i>
                            <p>Belum ada berita lainnya</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </section>

    {{-- FOOTER --}}
    <footer id="kontak" class="bg-lapas-navy text-gray-300">
        <div class="pattern-overlay py-16">
            <div class="container mx-auto px-6 grid md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-14 h-14 bg-white rounded-lg flex items-center justify-center shadow-lg">
                            <i class="fas fa-shield-alt text-2xl text-lapas-navy"></i>
                        </div>
                        <div>
                            <h3 class="text-white text-xl font-bold uppercase">Lapas Kelas IIA Besi</h3>
                            <p class="text-sm text-gray-400">Nusakambangan</p>
                        </div>
                    </div>
                    <p class="mb-6 leading-relaxed text-gray-400">
                        Lembaga Pemasyarakatan yang mengedepankan keamanan serta pembinaan kepribadian dan kemandirian Warga Binaan Pemasyarakatan.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-lapas-accent flex items-center justify-center transition group">
                            <i class="fab fa-facebook-f group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-lapas-accent flex items-center justify-center transition group">
                            <i class="fab fa-instagram group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-lapas-accent flex items-center justify-center transition group">
                            <i class="fab fa-youtube group-hover:text-white"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-4 flex items-center gap-2">
                        <i class="fas fa-link text-lapas-accent"></i>
                        Tautan Cepat
                    </h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-lapas-accent"></i> Profil Pejabat
                        </a></li>
                        <li><a href="#" class="hover:text-white transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-lapas-accent"></i> Standar Pelayanan
                        </a></li>
                        <li><a href="#" class="hover:text-white transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-lapas-accent"></i> Pengaduan Masyarakat
                        </a></li>
                        <li><a href="https://www.kemenkumham.go.id" target="_blank" class="hover:text-white transition flex items-center gap-2">
                            <i class="fas fa-chevron-right text-xs text-lapas-accent"></i> Kemenkumham RI
                        </a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-4 flex items-center gap-2">
                        <i class="fas fa-phone text-lapas-accent"></i>
                        Kontak Kami
                    </h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt mt-1 text-lapas-accent"></i>
                            <span class="text-sm">Pulau Nusakambangan, Tambakreja, Kec. Cilacap Selatan, Kab. Cilacap, Jawa Tengah 53263</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone text-lapas-accent"></i>
                            <span class="text-sm">0282 (5255261) / 081393456571</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-lapas-accent"></i>
                            <span class="text-sm">lapasbesimax@gmail.com</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border-t border-white/10 py-6 bg-black/30">
            <div class="container mx-auto px-6">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-400">
                    <p>
                        &copy; 2025 Lembaga Pemasyarakatan Kelas IIA Besi Nusakambangan. 
                        <span class="text-white font-medium">Kementerian Imigrasi dan Pemasyarakatan</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <i class="fas fa-code text-lapas-accent"></i>
                        Dikembangkan dengan <span class="text-red-400">❤</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>