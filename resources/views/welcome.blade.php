@extends('layouts.app')

@section('title', 'Beranda - Lapas Kelas IIA Besi Nusakambangan')

@push('styles')
<style>
    .hero-bg {
        background-size: cover;
        background-position: center;
        transition: background-image 0.5s ease-in-out;
    }
</style>
@endpush

@section('content')

{{-- HERO SECTION --}}
<header id="beranda" class="hero-bg relative h-screen flex items-center justify-center text-center px-6"
    style="background-image: linear-gradient(135deg, rgba(15, 39, 68, 0.92), rgba(0, 0, 0, 0.85)), url('https://assets-a1.kompasiana.com/items/album/2022/04/23/whatsapp-image-2022-04-23-at-09-28-38-62637d15bb44865f7f415972.jpeg')">
    <div class="pattern-overlay absolute inset-0"></div>
    <div class="relative z-10 max-w-5xl text-white">
        {{-- Badge --}}
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 px-4 py-2 rounded-full mb-6">
            <i class="fas fa-building text-lapas-accent"></i>
            <span class="text-sm font-semibold">Portal Resmi</span>
        </div>

        <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">Lembaga Pemasyarakatan Kelas IIA Besi</h1>
        <p class="text-xl md:text-2xl mb-4 text-gray-200 font-light">Nusakambangan, Jawa Tengah</p>
        <p class="text-lg mb-8 text-lapas-gold font-medium italic">
            "Griya Winaya Janma Wimarga Laksa Dharmmesti"
        </p>

        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <a href="#layanan" class="bg-lapas-accent hover:bg-blue-600 text-white font-bold py-4 px-8 rounded-lg shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
                <i class="fas fa-info-circle mr-2"></i> Informasi Layanan
            </a>
            <a href="{{ route('profil') }}" class="border-2 border-white hover:bg-white hover:text-lapas-navy text-white font-bold py-4 px-8 rounded-lg shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
                <i class="fas fa-landmark mr-2"></i> Profil Lapas
            </a>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <i class="fas fa-chevron-down text-white text-2xl"></i>
    </div>
</header>

{{-- SECTION PROFIL (NEW) --}}
<section id="profil" class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <div class="inline-block mb-4">
                <span class="bg-white text-lapas-navy px-4 py-2 rounded-full text-sm font-semibold border border-gray-200 shadow-sm">
                    TENTANG KAMI
                </span>
            </div>
            <h2 class="text-4xl font-bold text-lapas-navy mb-4">Profil Lembaga</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-lapas-navy via-lapas-accent to-lapas-navy mx-auto mb-4"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Mengenal lebih dekat Lembaga Pemasyarakatan Kelas IIA Besi Nusakambangan
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
            <div class="relative">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <img src="https://assets-a1.kompasiana.com/items/album/2022/04/23/whatsapp-image-2022-04-23-at-09-28-38-62637d15bb44865f7f415972.jpeg" 
                         alt="Lapas Besi" 
                         class="w-full h-96 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                </div>
            </div>

            <div>
                <h3 class="text-3xl font-bold text-lapas-navy mb-4">Lembaga Pemasyarakatan Kelas IIA Besi</h3>
                <p class="text-gray-600 mb-4 leading-relaxed">
                    Lembaga Pemasyarakatan Kelas IIA Besi merupakan salah satu unit pelaksana teknis di lingkungan Kementerian Imigrasi dan Pemasyarakatan yang berlokasi di Pulau Nusakambangan, Cilacap, Jawa Tengah.
                </p>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Sebagai lembaga pemasyarakatan dengan tingkat keamanan maksimum, kami berkomitmen untuk melaksanakan pembinaan narapidana dengan mengedepankan prinsip-prinsip hak asasi manusia dan keadilan.
                </p>
                <a href="{{ route('profil') }}" class="inline-flex items-center gap-2 bg-lapas-navy hover:bg-black text-white px-6 py-3 rounded-lg font-bold transition shadow-lg hover:shadow-xl">
                    Selengkapnya
                    <i class="fas fa-arrow-right"></i>
                </a>
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
                <a href="https://www.instagram.com/p/DSZY_iJkokC/?utm_source=ig_web_copy_link&igsh=MzRlODBiNWFlZA==" class="text-lapas-accent font-semibold hover:text-lapas-navy inline-flex items-center group-hover:gap-2 transition-all">
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
                <a href="https://bri.co.id/how-to-top-up-brizzi" class="text-lapas-accent font-semibold hover:text-lapas-navy inline-flex items-center group-hover:gap-2 transition-all">
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
                <a href="https://www.instagram.com/p/DSZY20Bkprl/?img_index=2" class="text-lapas-accent font-semibold hover:text-lapas-navy inline-flex items-center group-hover:gap-2 transition-all">
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
                <h2 class="text-4xl font-bold text-lapas-navy">Kabar Lapas Besi</h2>
                <p class="text-gray-600 mt-2">Update kegiatan dari Lapas Besi</p>
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

@endsection