@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
<div class="container-fluid px-4">
    
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4 mt-2">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-bold">Scraping Kompasiana</h1>
            <p class="text-muted small mb-0">Mengambil data terbaru dari Kompasiana Lapas Besi</p>
        </div>
        <div>
            <a href="{{ route('admin.berita.index') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-sync-alt me-1"></i> Refresh Data
            </a>
            <a href="{{ route('landing') }}" target="_blank" class="btn btn-outline-secondary btn-sm ms-2">
                <i class="fas fa-external-link-alt me-1"></i> Cek Landing Page
            </a>
        </div>
    </div>

    {{-- Status Alert --}}
    @if(isset($berita) && count($berita) > 0)
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div>
                <strong>Berhasil!</strong> Ditemukan {{ count($berita) }} artikel terbaru.
            </div>
        </div>

        {{-- Daftar Berita --}}
        <div class="row">
            @foreach($berita as $index => $item)
            <div class="col-md-6 col-xl-12 mb-4">
                <div class="card shadow-sm h-100 border-start-primary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            
                            {{-- Gambar --}}
                            <div class="col-md-2 mb-3 mb-md-0 text-center">
                                <img src="{{ $item['gambar'] }}" 
                                     alt="Thumbnail" 
                                     class="img-fluid rounded shadow-sm" 
                                     style="max-height: 100px; object-fit: cover;"
                                     onerror="this.src='https://via.placeholder.com/150?text=No+Image'">
                            </div>

                            {{-- Konten --}}
                            <div class="col-md-10 ps-md-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ $item['tanggal'] }}
                                    </div>
                                    <span class="badge bg-warning text-dark">#{{ $index + 1 }}</span>
                                </div>
                                
                                <h5 class="h6 mb-1 font-weight-bold text-gray-800">
                                    <a href="{{ $item['link'] }}" target="_blank" class="text-decoration-none text-dark hover-primary">
                                        {{ $item['judul'] }}
                                    </a>
                                </h5>
                                <p class="mb-2 text-muted small" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $item['ringkasan'] }}
                                </p>
                                
                                <div class="mt-2">
                                    <a href="{{ $item['link'] }}" target="_blank" class="btn btn-sm btn-outline-primary py-0" style="font-size: 0.75rem;">
                                        <i class="fas fa-book-open me-1"></i> Baca Artikel
                                    </a>
                                    
                                    <button type="button" class="btn btn-sm btn-outline-info py-0 ms-1" style="font-size: 0.75rem;" data-bs-toggle="collapse" data-bs-target="#debug-{{ $index }}">
                                        <i class="fas fa-code me-1"></i> Raw Data
                                    </button>
                                </div>
                                
                                {{-- Debug Raw Data (Hidden) --}}
                                <div class="collapse mt-2" id="debug-{{ $index }}">
                                    <div class="card card-body bg-light py-2 px-3 border-0">
                                        <pre class="mb-0 text-muted" style="font-size: 0.7rem;">{{ json_encode($item, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Gagal Mengambil Data!</h4>
            <p>Tidak ada artikel yang ditemukan atau terjadi kesalahan saat menghubungi server Kompasiana.</p>
            <hr>
            <p class="mb-0 small">Pastikan koneksi internet server stabil dan struktur HTML Kompasiana tidak berubah.</p>
        </div>
    @endif

</div>
@endsection