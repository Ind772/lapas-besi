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
                <a href="{{ route('landing') }}" 
                data-nav="beranda"
                class="nav-link px-4 py-2 rounded transition {{ request()->routeIs('landing') && !request()->has('_fragment') ? 'text-lapas-navy font-semibold' : 'text-gray-600 hover:text-lapas-navy hover:bg-gray-100' }}">
                    Beranda
                </a>
                
                {{-- Link Profil: Jika di landing scroll ke section, jika tidak redirect ke halaman profil --}}
                @if(request()->routeIs('landing'))
                    <a href="#profil" 
                    data-nav="profil"
                    class="nav-link px-4 py-2 rounded transition text-gray-600 hover:text-lapas-navy hover:bg-gray-100">
                        Profil
                    </a>
                @else
                    <a href="{{ route('profil') }}" 
                    data-nav="profil"
                    class="nav-link px-4 py-2 rounded transition {{ request()->routeIs('profil') ? 'text-lapas-navy font-semibold' : 'text-gray-600 hover:text-lapas-navy hover:bg-gray-100' }}">
                        Profil
                    </a>
                @endif
                
                <a href="{{ route('landing') }}#layanan" 
                data-nav="layanan"
                class="nav-link px-4 py-2 text-gray-600 hover:text-lapas-navy hover:bg-gray-100 rounded transition">
                    Layanan
                </a>
                <a href="{{ route('landing') }}#berita" 
                data-nav="berita"
                class="nav-link px-4 py-2 text-gray-600 hover:text-lapas-navy hover:bg-gray-100 rounded transition">
                    Berita
                </a>
                <a href="{{ route('landing') }}#kontak" 
                data-nav="kontak"
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
            <a href="{{ route('landing') }}" 
               class="block px-4 py-2 rounded {{ request()->routeIs('landing') ? 'bg-lapas-navy text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                Beranda
            </a>
            <a href="{{ route('profil') }}" 
               class="block px-4 py-2 rounded {{ request()->routeIs('profil') ? 'bg-lapas-navy text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                Profil
            </a>
            <a href="{{ route('landing') }}#layanan" 
               class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">
                Layanan
            </a>
            <a href="{{ route('landing') }}#berita" 
               class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">
                Berita
            </a>
            <a href="{{ route('landing') }}#kontak" 
               class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">
                Kontak
            </a>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Animated Underline for Desktop Navigation
        const navLinks = document.querySelectorAll('.nav-link');
        const underline = document.getElementById('navUnderline');
        
        if (underline && navLinks.length > 0) {
            // Function untuk move underline (dibuat global agar bisa diakses dari app.blade.php)
            window.moveUnderline = function(link) {
                if (!link) return;
                
                const linkRect = link.getBoundingClientRect();
                const navRect = link.parentElement.getBoundingClientRect();
                
                underline.style.width = linkRect.width + 'px';
                underline.style.left = (linkRect.left - navRect.left) + 'px';
                underline.style.opacity = '1';
            };
            
            // Set initial position based on active link
            const activeLink = document.querySelector('.nav-link.font-semibold') || navLinks[0];
            window.moveUnderline(activeLink);
            
            // Add hover effect
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', function() {
                    window.moveUnderline(this);
                });
            });
            
            // Reset to active link when mouse leaves nav
            const navMenu = document.getElementById('navbarMenu');
            if (navMenu) {
                navMenu.addEventListener('mouseleave', function() {
                    const activeLink = document.querySelector('.nav-link.font-semibold') || navLinks[0];
                    window.moveUnderline(activeLink);
                });
            }
            
            // Update underline on window resize
            window.addEventListener('resize', function() {
                const activeLink = document.querySelector('.nav-link.font-semibold') || navLinks[0];
                window.moveUnderline(activeLink);
            });
        }
    });
</script>
@endpush