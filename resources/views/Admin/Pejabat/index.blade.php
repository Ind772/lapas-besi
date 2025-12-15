@extends('layouts.admin')

@section('title', 'Kelola Pejabat')

@section('content')
<div class="container-fluid px-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-2 text-gray-800">Kelola Profil Pejabat</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Pejabat</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.pejabat.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pejabat
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    {{-- 1. BAGIAN KEPALA LAPAS --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Kepala Lembaga Pemasyarakatan</h6>
        </div>
        <div class="card-body">
            @php
                // PERBAIKAN: Menggunakan 'tipe_jabatan' sesuai database, bukan 'tipe'
                $kepala = $pejabat->where('tipe_jabatan', 'kepala')->first();
            @endphp
            
            @if($kepala)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="120">Foto</th>
                            <th>Nama</th>
                            <th>Pangkat/Golongan</th>
                            <th>NIP</th>
                            <th>Pendidikan</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                @if($kepala->foto)
                                {{-- PERBAIKAN: Menggunakan asset storage --}}
                                <img src="{{ asset('storage/' . $kepala->foto) }}" alt="Foto Kepala" class="img-thumbnail rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                <div class="bg-secondary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                    <i class="fas fa-user text-white fa-2x"></i>
                                </div>
                                @endif
                            </td>
                            <td class="align-middle fw-bold">{{ $kepala->nama }}</td>
                            <td class="align-middle">{{ $kepala->pangkat_golongan }}</td>
                            <td class="align-middle">{{ $kepala->nip }}</td>
                            <td class="align-middle">{{ $kepala->pendidikan ?? '-' }}</td>
                            <td class="align-middle">{{ $kepala->tahun_menjabat ?? '-' }}</td>
                            <td class="align-middle">
                                @if($kepala->is_active)
                                <span class="badge bg-success">Aktif</span>
                                @else
                                <span class="badge bg-secondary">Non-Aktif</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('admin.pejabat.edit', $kepala->id) }}" class="btn btn-sm btn-warning mb-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.pejabat.destroy', $kepala->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data Kepala Lapas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mb-1">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-warning border-start border-warning border-4">
                <i class="fas fa-exclamation-triangle me-2"></i> 
                <strong>Data Kosong!</strong> Belum ada data Kepala Lapas. 
                <a href="{{ route('admin.pejabat.create') }}" class="fw-bold text-dark text-decoration-underline">Tambahkan sekarang</a>
            </div>
            @endif
        </div>
    </div>

    {{-- 2. BAGIAN PEJABAT STRUKTURAL --}}
    <div class="card shadow">
        <div class="card-header py-3 bg-success text-white">
            <h6 class="m-0 font-weight-bold">Pejabat Struktural</h6>
        </div>
        <div class="card-body">
            @php
                // PERBAIKAN: Menggunakan 'tipe_jabatan' sesuai database
                $struktural = $pejabat->where('tipe_jabatan', 'struktural')->sortBy('urutan');
            @endphp
            
            @if($struktural->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="50" class="text-center">No</th>
                            <th width="100" class="text-center">Foto</th>
                            <th>Nama & NIP</th>
                            <th>Jabatan</th>
                            <th>Pangkat</th>
                            <th class="text-center">Status</th>
                            <th width="150" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop manual untuk penomoran karena collection hasil filter --}}
                        @foreach($struktural as $p)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                @if($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}" alt="Foto" class="img-thumbnail rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                <div class="bg-secondary d-inline-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold">{{ $p->nama }}</div>
                                <small class="text-muted">NIP: {{ $p->nip }}</small>
                            </td>
                            <td>{{ $p->jabatan }}</td>
                            <td>{{ $p->pangkat_golongan }}</td>
                            <td class="text-center">
                                @if($p->is_active)
                                <span class="badge bg-success">Aktif</span>
                                @else
                                <span class="badge bg-secondary">Non-Aktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.pejabat.edit', $p->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.pejabat.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pejabat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-info border-start border-info border-4">
                <i class="fas fa-info-circle me-2"></i> Belum ada data pejabat struktural. 
                <a href="{{ route('admin.pejabat.create') }}" class="fw-bold text-dark text-decoration-underline">Tambahkan sekarang</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection