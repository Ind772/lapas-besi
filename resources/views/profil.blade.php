@extends('layouts.app')

@section('title', 'Profil - Lapas Kelas IIA Besi Nusakambangan')

@section('content')

{{-- HERO SECTION --}}
<header class="relative h-96 flex items-center justify-center text-center px-6"
    style="background-image: linear-gradient(135deg, rgba(15, 39, 68, 0.92), rgba(0, 0, 0, 0.85)), url('https://assets-a1.kompasiana.com/items/album/2022/04/23/whatsapp-image-2022-04-23-at-09-28-38-62637d15bb44865f7f415972.jpeg'); background-size: cover; background-position: center;">
    <div class="pattern-overlay absolute inset-0"></div>
    <div class="relative z-10 max-w-4xl text-white">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 px-4 py-2 rounded-full mb-6">
            <i class="fas fa-info-circle text-lapas-accent"></i>
            <span class="text-sm font-semibold">Profil Lembaga</span>
        </div>
        <h1 class="text-5xl md:text-6xl font-bold mb-4 leading-tight">Profil Lapas Kelas IIA Besi</h1>
        <p class="text-xl text-gray-200">Mengenal lebih dekat tentang sejarah, visi misi, dan struktur organisasi kami</p>
    </div>
</header>

{{-- BREADCRUMB --}}
<div class="bg-white border-b border-gray-200">
    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <a href="{{ route('landing') }}" class="hover:text-lapas-accent transition">
                <i class="fas fa-home"></i> Beranda
            </a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-lapas-navy font-semibold">Profil</span>
        </div>
    </div>
</div>

{{-- SECTION TENTANG KAMI --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-block mb-4">
                    <span class="bg-gray-100 text-lapas-navy px-4 py-2 rounded-full text-sm font-semibold border border-gray-200">
                        TENTANG KAMI
                    </span>
                </div>
                <h2 class="text-4xl font-bold text-lapas-navy mb-4">Lembaga Pemasyarakatan Kelas IIA Besi</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-lapas-navy via-lapas-accent to-lapas-navy mb-6"></div>
                
                <p class="text-gray-600 mb-4 leading-relaxed">
                    Lembaga Pemasyarakatan Kelas IIA Besi merupakan salah satu unit pelaksana teknis di lingkungan Kementerian Imigrasi dan Pemasyarakatan yang berlokasi di Pulau Nusakambangan, Cilacap, Jawa Tengah.
                </p>
                
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Sebagai lembaga pemasyarakatan dengan tingkat keamanan maksimum, kami berkomitmen untuk melaksanakan pembinaan narapidana dengan mengedepankan prinsip-prinsip hak asasi manusia dan keadilan.
                </p>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gradient-to-br from-lapas-navy to-lapas-blue p-6 rounded-xl text-white shadow-lg flex items-center gap-4">
                        <div class="w-12 h-12 bg-lapas-accent rounded-lg flex items-center justify-center">
                            <!-- ICON WBP -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm0 1.5c-2.7 0-8 1.35-8 4v1h16v-1c0-2.65-5.3-4-8-4Zm7-8.5a3 3 0 1 1-3 3" />
                            </svg>
                        </div>

                        <div>
                            <div class="text-3xl font-bold text-gray-200">500+</div>
                            <div class="text-sm text-gray-200">WBP</div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-lapas-navy to-lapas-blue p-6 rounded-xl text-white shadow-lg flex items-center gap-4">
                        <div class="w-12 h-12 bg-lapas-accent rounded-lg flex items-center justify-center">
                            <i class="fas fa-award text-white text-xl"></i>
                        </div>

                        <div>
                            <div class="text-sm text-gray-200">Status</div>
                            <div class="font-bold text-gray-200">Zona Integritas WBK</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <img src="https://assets-a1.kompasiana.com/items/album/2022/04/23/whatsapp-image-2022-04-23-at-09-28-38-62637d15bb44865f7f415972.jpeg" 
                         alt="Lapas Besi" 
                         class="w-full h-96 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- VISI MISI --}}
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <div class="inline-block mb-4">
                <span class="bg-white text-lapas-navy px-4 py-2 rounded-full text-sm font-semibold border border-gray-200 shadow-sm">
                    ARAH ORGANISASI
                </span>
            </div>
            <h2 class="text-4xl font-bold text-lapas-navy mb-4">Visi & Misi</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-lapas-navy via-lapas-accent to-lapas-navy mx-auto"></div>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            {{-- VISI --}}
            <div class="bg-gradient-to-br from-lapas-navy to-lapas-blue rounded-2xl p-10 text-white shadow-2xl relative overflow-hidden">
                <div class="pattern-overlay absolute inset-0 opacity-30"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-6">
                        <i class="fas fa-eye text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                        <span>VISI</span>
                    </h3>
                    <p class="text-lg leading-relaxed text-gray-100">
                        "Terwujudnya Penegakan Hukum dan Pelayanan Keimigrasian dan Pemasyarakatan untuk Stabilitas Keamanan yang Tangguh menuju Indonesia Emas 2045".
                    </p>
                </div>
            </div>

            {{-- MISI --}}
            <div class="bg-white rounded-2xl p-10 shadow-xl border border-gray-200">
                <div class="w-16 h-16 bg-gradient-to-br from-lapas-accent to-blue-600 rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-bullseye text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold mb-6 text-lapas-navy flex items-center gap-3">
                    <span>MISI & TUJUAN</span>
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-lapas-accent rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <span class="text-gray-700">Mewujudkan Penegakan Hukum dan pelayanan serta jaminan pelindungan Imigrasi dan Pemasyarakatan yang transparan dan berkeadilan.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-lapas-accent rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <span class="text-gray-700">Menciptakan penegakan dan pelayanan hukum untuk mendukung kedaulatan negara serta reintegrasi sosial secara transparan dan berkeadilan.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-lapas-accent rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <span class="text-gray-700">Meningkatkan kapasitas kelembagaan Imigrasi dan Pemasyarakatan yang modern, profesional, dan berintegritas.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-lapas-accent rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <i class="fas fa-check text-white text-sm"></i>
                        </div>
                        <span class="text-gray-700">Menciptakan sistem keimigrasian dan pemasyarakatan yang modern, terintegrasi dan akuntabel melalui peningkatan kompetensi dan profesionalisme sumber daya manusia yang berintegritas, responsif dan adaptif di bidang Imigrasi dan Pemasyarakatan.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- MOTTO --}}
<section class="py-16 bg-gradient-to-br from-lapas-navy via-lapas-blue to-lapas-slate text-white">
    <div class="pattern-overlay">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <div class="mb-6">
                    <i class="fas fa-quote-left text-4xl text-lapas-gold opacity-50"></i>
                </div>
                <h3 class="text-3xl md:text-4xl font-bold mb-4 italic">
                    "Griya Winaya Janma Wimarga Laksa Dharmmesti"
                </h3>
                <p class="text-xl text-gray-300 mb-6">
                    Rumah Pembinaan yang Melahirkan Karakter Mulia dan Berintegritas
                </p>
                <div class="w-32 h-1 bg-lapas-gold mx-auto"></div>
            </div>
        </div>
    </div>
</section>

{{-- PROFIL PEJABAT --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <div class="inline-block mb-4">
                <span class="bg-gray-100 text-lapas-navy px-4 py-2 rounded-full text-sm font-semibold border border-gray-200">
                    PIMPINAN KAMI
                </span>
            </div>
            <h2 class="text-4xl font-bold text-lapas-navy mb-4">Profil Pejabat</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-lapas-navy via-lapas-accent to-lapas-navy mx-auto mb-4"></div>
            <p class="text-gray-600 max-w-3xl mx-auto">
                Tim kepemimpinan yang berpengalaman dan berdedikasi dalam menjalankan tugas pemasyarakatan
            </p>
        </div>

        {{-- Kepala Lapas --}}
        <div class="max-w-5xl mx-auto mb-16">
            <div class="bg-gradient-to-br from-lapas-navy to-lapas-blue rounded-2xl shadow-2xl overflow-hidden">
                <div class="pattern-overlay p-10 md:p-12">
                    <div class="grid md:grid-cols-3 gap-8 items-center">
                        <div class="md:col-span-1 flex justify-center">
                            <div class="relative">
                                <div class="w-48 h-48 rounded-2xl bg-white/10 backdrop-blur-sm border-4 border-white/30 overflow-hidden shadow-2xl">
                                    <div class="w-full h-full bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                                        <i class="fas fa-user text-6xl text-gray-500"></i>
                                    </div>
                                </div>
                                <div class="absolute -bottom-3 -right-3 bg-lapas-gold text-white w-16 h-16 rounded-xl flex items-center justify-center shadow-xl">
                                    <i class="fas fa-star text-2xl"></i>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-2 text-white">
                            <div class="inline-block bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-4">
                                <span class="text-sm font-semibold">Kepala Lembaga Pemasyarakatan</span>
                            </div>
                            <h3 class="text-3xl md:text-4xl font-bold mb-2">[Nama Kepala Lapas]</h3>
                            <p class="text-xl text-gray-200 mb-4">[Pangkat/Golongan]</p>
                            <p class="text-lg text-gray-300 mb-6 leading-relaxed">
                                NIP: [Nomor Induk Pegawai]
                            </p>
                            <div class="flex flex-wrap gap-3">
                                <div class="bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                                    <i class="fas fa-graduation-cap mr-2"></i>
                                    <span class="text-sm">[Pendidikan Terakhir]</span>
                                </div>
                                <div class="bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                                    <i class="fas fa-briefcase mr-2"></i>
                                    <span class="text-sm">[Tahun Menjabat]</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pejabat Struktural --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @php
            $pejabat = [
                ['nama' => '[Nama Kasubag TU]', 'jabatan' => 'Kepala Sub Bagian Tata Usaha', 'color' => 'from-lapas-navy to-lapas-accent'],
                ['nama' => '[Nama Kasi Binadik]', 'jabatan' => 'Kepala Seksi Bimbingan Narapidana & Anak Didik', 'color' => 'from-lapas-accent to-blue-600'],
                ['nama' => '[Nama Kasi Kegiatan]', 'jabatan' => 'Kepala Seksi Kegiatan Kerja', 'color' => 'from-green-600 to-green-700'],
                ['nama' => '[Nama Kasi Adm Kamtib]', 'jabatan' => 'Kepala Seksi Administrasi Keamanan & Ketertiban', 'color' => 'from-red-600 to-red-700'],
                ['nama' => '[Nama Kasi PBS]', 'jabatan' => 'Kepala Seksi Pengelolaan Benda Sitaan & Barang Rampasan', 'color' => 'from-yellow-600 to-yellow-700'],
                ['nama' => '[Nama Kasi Regbimsyar]', 'jabatan' => 'Kepala Seksi Registrasi & Bimbingan Kemasyarakatan', 'color' => 'from-purple-600 to-purple-700'],
            ];
            @endphp

            @foreach($pejabat as $p)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition border border-gray-200 overflow-hidden group">
                <div class="h-2 bg-gradient-to-r {{ $p['color'] }}"></div>
                <div class="p-8">
                    <div class="w-32 h-32 mx-auto mb-6 rounded-xl bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform overflow-hidden">
                        <i class="fas fa-user text-5xl text-gray-500"></i>
                    </div>
                    <div class="text-center">
                        <h4 class="text-xl font-bold text-lapas-navy mb-1">{{ $p['nama'] }}</h4>
                        <p class="text-sm text-gray-500 mb-2">[Pangkat/Golongan]</p>
                        <div class="inline-block bg-lapas-accent/10 text-lapas-accent px-4 py-2 rounded-full text-sm font-semibold mb-4">
                            {{ $p['jabatan'] }}
                        </div>
                        <p class="text-xs text-gray-600">NIP: [Nomor Induk Pegawai]</p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        {{-- Note --}}
        <div class="mt-12 text-center">
            <div class="inline-block bg-gray-100 border border-gray-300 rounded-xl p-6 max-w-2xl">
                <i class="fas fa-info-circle text-lapas-accent text-2xl mb-3"></i>
                <p class="text-gray-600 text-sm">
                    <strong>Catatan:</strong> Informasi profil pejabat dapat berubah sewaktu-waktu sesuai dengan kebijakan organisasi. 
                    Untuk informasi terkini, silakan hubungi Sub Bagian Tata Usaha.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- NILAI-NILAI --}}
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <div class="inline-block mb-4">
                <span class="bg-white text-lapas-navy px-4 py-2 rounded-full text-sm font-semibold border border-gray-200 shadow-sm">
                    NILAI ORGANISASI
                </span>
            </div>
            <h2 class="text-4xl font-bold text-lapas-navy mb-4">Nilai-Nilai Kami</h2>
            <div class="w-24 h-1 bg-gradient-to-r from-lapas-navy via-lapas-accent to-lapas-navy mx-auto"></div>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-6">
            @php
            $nilai = [
                ['icon' => 'fa-user-tie', 'title' => 'Profesional', 'desc' => 'Kementerian Imigrasi dan Pemasyarakatan menjalankan tugas dan fungsi secara profesional, sesuai dengan keahlian dan kompetensi, berlandaskan dengan ilmu terkait bidangnya serta dilakukan dengan pendekatan yang humanis dengan menjunjung tinggi nilai-nilai kemanusiaan.', 'color' => 'from-lapas-navy to-lapas-blue', 'border' => 'border-lapas-navy'],
                ['icon' => 'fa-bolt', 'title' => 'Responsif', 'desc' => 'Kementerian Imigrasi dan Pemasyarakatan memberikan layanan secara cepat, tepat dan tanggap dalam melayani kebutuhan masyarakat baik kebutuhan yang terkait bidang imigrasi maupun pemasyarkatan.', 'color' => 'from-lapas-accent to-blue-600', 'border' => 'border-lapas-accent'],
                ['icon' => 'fa-certificate', 'title' => 'Integritas', 'desc' => 'Kementerian Imigrasi dan Pemasyarakatan menjunjung tinggi nilai integritas dalam menjalankan tugas dan fungsinya. Integritas dicerminkan dalam bentuk perilaku jujur dalam bersikap dan bertindak dan berkeadilan dalam penegakkan hukum.', 'color' => 'from-yellow-600 to-yellow-700', 'border' => 'border-lapas-gold'],
                ['icon' => 'fa-laptop-code', 'title' => 'Modern', 'desc' => 'Kementerian Imigrasi dan Pemasyarakatan menggunakan sistem dan teknologi informasi yang modern dalam mendukung pelaksanaan tugas dan fungsi serta dilakukan secara transparan dalam memberikan pelayanan kepada masyarakat.', 'color' => 'from-green-600 to-green-700', 'border' => 'border-green-600'],
                ['icon' => 'fa-check-circle', 'title' => 'Akuntabel', 'desc' => 'Kementerian Imigrasi dan Pemasyarakatan menjalankan tugas dan fungsi secara bertanggungjawab sesuai dengan ketentuan hukum dan peraturan yang berlaku.', 'color' => 'from-lapas-navy to-lapas-blue', 'border' => 'border-lapas-navy']
            ];
            @endphp
            @foreach($nilai as $n)
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition group border-t-4 {{ $n['border'] }} flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-gradient-to-br {{ $n['color'] }} rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <i class="fas {{ $n['icon'] }} text-2xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold text-lapas-navy mb-3">{{ $n['title'] }}</h3>
                <p class="text-gray-600 text-m">
                    {{ $n['desc'] }}
                </p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="py-20 bg-gradient-to-br from-lapas-navy via-lapas-blue to-lapas-slate text-white">
    <div class="pattern-overlay">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-4xl font-bold mb-6">Butuh Informasi Lebih Lanjut?</h2>
                <p class="text-xl mb-8 text-gray-200">
                    Hubungi kami untuk informasi layanan, kunjungan, atau pertanyaan lainnya
                </p>
                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <a href="http://wa.me/6281393456571" class="bg-white text-lapas-navy hover:bg-gray-100 font-bold py-4 px-8 rounded-lg shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1 inline-flex items-center justify-center gap-2">
                        <i class="fas fa-phone"></i> Hubungi Kami
                    </a>
                    <a href="{{ route('landing') }}" class="border-2 border-white hover:bg-white hover:text-lapas-navy font-bold py-4 px-8 rounded-lg shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1 inline-flex items-center justify-center gap-2">
                        <i class="fas fa-home"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection