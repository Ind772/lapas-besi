{{-- CSS KHUSUS UNTUK SMOOTH SCROLL --}}
@push('styles')
<style>
    html {
        scroll-behavior: smooth;
    }
</style>
@endpush

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
                <a href="{{ route('landing') }}" class="flex items-center gap-3">
                    <div class="w-16 h-16 flex items-center justify-center">
                        <img src="{{ asset('images/logo-besi.png') }}" alt="Logo Besi" class="w-15 h-15 object-contain">
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-lapas-navy uppercase tracking-wide">Lapas Kelas IIA Besi</h1>
                        <p class="text-xs text-gray-500">Kementerian Imigrasi dan Pemasyarakatan</p>
                    </div>
                </a>
            </div>

            {{-- Navigation Menu --}}
            <div class="hidden md:flex space-x-1 relative" id="navbarMenu">
                {{-- Perhatikan penambahan ID atau data-target untuk memudahkan JS --}}
                <a href="{{ route('landing') }}#beranda" 
                   data-target="beranda"
                   class="nav-link px-4 py-2 rounded transition text-gray-600 hover:text-lapas-navy hover:bg-gray-100">
                    Beranda
                </a>
                
                {{-- Logika Profil: Tetap aktif jika di halaman profil --}}
                @if(request()->routeIs('landing'))
                    <a href="#profil" data-target="profil" class="nav-link px-4 py-2 rounded transition text-gray-600 hover:text-lapas-navy hover:bg-gray-100">
                        Profil
                    </a>
                @else
                    <a href="{{ route('profil') }}" class="nav-link px-4 py-2 rounded transition {{ request()->routeIs('profil') ? 'text-lapas-navy font-semibold' : 'text-gray-600 hover:text-lapas-navy hover:bg-gray-100' }}">
                        Profil
                    </a>
                @endif
                
                <a href="{{ route('landing') }}#layanan" 
                   data-target="layanan"
                   class="nav-link px-4 py-2 text-gray-600 hover:text-lapas-navy hover:bg-gray-100 rounded transition">
                    Layanan
                </a>
                <a href="{{ route('landing') }}#berita" 
                   data-target="berita"
                   class="nav-link px-4 py-2 text-gray-600 hover:text-lapas-navy hover:bg-gray-100 rounded transition">
                    Berita
                </a>
                <a href="{{ route('landing') }}#kontak" 
                   data-target="kontak"
                   class="nav-link px-4 py-2 text-gray-600 hover:text-lapas-navy hover:bg-gray-100 rounded transition">
                    Kontak
                </a>
                
                {{-- Animated Underline --}}
                <div id="navUnderline" class="absolute bottom-0 h-0.5 bg-lapas-accent transition-all duration-300 ease-out"></div>
            </div>

            {{-- Mobile Menu Button --}}
            <button id="mobileMenuBtn" class="md:hidden text-lapas-navy text-2xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4 space-y-2">
            <a href="{{ route('landing') }}#beranda" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">Beranda</a>
            <a href="{{ route('landing') }}#profil" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">Profil</a>
            <a href="{{ route('landing') }}#layanan" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">Layanan</a>
            <a href="{{ route('landing') }}#berita" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">Berita</a>
            <a href="{{ route('landing') }}#kontak" class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">Kontak</a>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // ============================================================
        // 1. LOGIKA KLIK MENU (AGAR SMOOTH & OFFSET PAS)
        // ============================================================
        // Cari semua link yang berawalan #
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                // Matikan fungsi lompat bawaan browser (yang kasar)
                e.preventDefault(); 
                
                // Ambil ID target dari href
                const href = this.getAttribute('href');
                // Pastikan ada tanda pagar
                if (!href || !href.includes('#')) return;
                
                // Ambil nama ID (misal: "beranda" dari "#beranda")
                const targetId = href.split('#')[1];
                if (!targetId) return;

                // --- KHUSUS BERANDA: SCROLL KE PALING ATAS (PIXEL 0) ---
                if (targetId === 'beranda') {
                    window.scrollTo({
                        top: 0,
                        behavior: "smooth" // <--- Ini yang bikin halus
                    });
                    // Update URL tanpa reload
                    history.pushState(null, null, '#' + targetId);
                    return; 
                }

                // --- UNTUK MENU LAIN (Layanan, Berita, Kontak) ---
                const targetElement = document.getElementById(targetId);
                if (targetElement) {
                    const navbarHeight = 100; // Tinggi navbar + jarak aman
                    const elementPosition = targetElement.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - navbarHeight;
        
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: "smooth" // <--- Ini yang bikin halus
                    });
                    
                    history.pushState(null, null, '#' + targetId);
                }
            });
        });

        // ============================================================
        // 2. MOBILE MENU
        // ============================================================
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // ============================================================
        // 3. LOGIKA GARIS BAWAH & SCROLLSPY (ACTIVE ON SCROLL)
        // ============================================================
        const navLinks = document.querySelectorAll('.nav-link');
        const underline = document.getElementById('navUnderline');
        const navMenu = document.getElementById('navbarMenu');

        window.moveUnderline = function(link) {
            if (!link || !underline) return;
            const linkRect = link.getBoundingClientRect();
            const navRect = link.parentElement.getBoundingClientRect();
            underline.style.width = linkRect.width + 'px';
            underline.style.left = (linkRect.left - navRect.left) + 'px';
            underline.style.opacity = '1';
        };

        const isLandingPage = document.getElementById('beranda');

        if (isLandingPage && navLinks.length > 0 && underline) {
            const sections = document.querySelectorAll('header[id], section[id], footer[id]');
            
            function onScroll() {
                let currentSection = '';
                const scrollY = window.scrollY + 120; 

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    
                    if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                        currentSection = section.getAttribute('id');
                    }
                });

                if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
                    currentSection = 'kontak';
                }

                if (window.scrollY < 100) {
                    currentSection = 'beranda';
                }

                navLinks.forEach(link => {
                    link.classList.remove('font-semibold', 'text-lapas-navy');
                    link.classList.add('text-gray-600');
                    
                    const dataTarget = link.getAttribute('data-target');
                    // Ambil ID dari href untuk dicocokkan
                    const hrefTarget = link.getAttribute('href').includes('#') ? link.getAttribute('href').split('#')[1] : '';

                    if (dataTarget === currentSection || hrefTarget === currentSection) {
                        link.classList.remove('text-gray-600');
                        link.classList.add('font-semibold', 'text-lapas-navy');
                        window.moveUnderline(link);
                    }
                });
            }

            window.addEventListener('scroll', onScroll);
            setTimeout(onScroll, 100);
        } 
        else {
            const activeLink = document.querySelector('.nav-link.font-semibold');
            if(activeLink) setTimeout(() => window.moveUnderline(activeLink), 100);
        }

        if (underline) {
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() { window.moveUnderline(this); });
            });
            if (navMenu) {
                navMenu.addEventListener('mouseleave', function() {
                    const activeLink = document.querySelector('.nav-link.font-semibold');
                    if (activeLink) window.moveUnderline(activeLink);
                    else underline.style.opacity = '0';
                });
            }
        }
    });
</script>
@endpush