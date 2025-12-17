<footer id="kontak" class="bg-lapas-navy text-gray-300">
    <div class="pattern-overlay py-16">
        <div class="container mx-auto px-6 grid md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-16 h-16 flex items-center justify-center">
                        <img src="{{ asset('images/logo-besi.png') }}" alt="Logo Besi" class="w-15 h-15 object-contain">
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
                    <a href="https://www.facebook.com/lapasbesimax/" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-lapas-accent flex items-center justify-center transition group">
                        <i class="fab fa-facebook-f group-hover:text-white"></i>
                    </a>
                    <a href="https://www.instagram.com/lapasbesimax/" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-lapas-accent flex items-center justify-center transition group">
                        <i class="fab fa-instagram group-hover:text-white"></i>
                    </a>
                    <a href="https://www.tiktok.com/@humasbesimax" class="w-10 h-10 rounded-lg bg-white/10 hover:bg-lapas-accent flex items-center justify-center transition group">
                        <i class="fab fa-tiktok group-hover:text-white"></i>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-bold mb-4 flex items-center gap-2">
                    <i class="fas fa-link text-lapas-accent"></i>
                    Tautan Cepat
                </h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('profil') }}" class="hover:text-white transition flex items-center gap-2">
                        <i class="fas fa-chevron-right text-xs text-lapas-accent"></i> Profil Pejabat
                    </a></li>
                    <li><a href="#" class="hover:text-white transition flex items-center gap-2">
                        <i class="fas fa-chevron-right text-xs text-lapas-accent"></i> Pengaduan Masyarakat
                    </a></li>
                    <li><a href="https://www.kemenimipas.go.id" target="_blank" class="hover:text-white transition flex items-center gap-2">
                        <i class="fas fa-chevron-right text-xs text-lapas-accent"></i> Kemenimipas RI
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
                    &copy; {{ date('Y') }} Lembaga Pemasyarakatan Kelas IIA Besi Nusakambangan. 
                    <span class="text-white font-medium">Kementerian Imigrasi dan Pemasyarakatan</span>
                </p>
                <p class="flex items-center gap-2">
                    <i class="fas fa-code text-lapas-accent"></i>
                    <span class="text-red-400"></span>
                </p>
            </div>
        </div>
    </div>
</footer>