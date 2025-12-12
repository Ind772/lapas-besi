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

    {{-- Kepala Lapas --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">Kepala Lembaga Pemasyarakatan</h6>
        </div>
        <div class="card-body">
            @php
                $kepala = $pejabat->where('tipe', 'kepala')->first();
            @endphp
            
            @if($kepala)
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th width="100">Foto</th>
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
                            <td>
                                @if($kepala->foto)
                                <img src="{{ $kepala->foto_url }}" alt="{{ $kepala->nama }}" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                <div class="bg-secondary d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                    <i class="fas fa-user text-white fa-2x"></i>
                                </div>
                                @endif
                            </td>
                            <td>{{ $kepala->nama }}</td>
                            <td>{{ $kepala->pangkat_golongan }}</td>
                            <td>{{ $kepala->nip }}</td>
                            <td>{{ $kepala->pendidikan ?? '-' }}</td>
                            <td>{{ $kepala->tahun_menjabat ?? '-' }}</td>
                            <td>
                                @if($kepala->is_active)
                                <span class="badge bg-success">Aktif</span>
                                @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.pejabat.edit', $kepala) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.pejabat.destroy', $kepala) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Belum ada data Kepala Lapas. 
                <a href="{{ route('admin.pejabat.create') }}">Tambahkan sekarang</a>
            </div>
            @endif
        </div>
    </div>

    {{-- Pejabat Struktural --}}
    <div class="card shadow">
        <div class="card-header py-3 bg-success text-white">
            <h6 class="m-0 font-weight-bold">Pejabat Struktural</h6>
        </div>
        <div class="card-body">
            @php
                $struktural = $pejabat->where('tipe', 'struktural');
            @endphp
            
            @if($struktural->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th width="80">Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Pangkat/Golongan</th>
                            <th>NIP</th>
                            <th>Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($struktural as $index => $p)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($p->foto)
                                <img src="{{ $p->foto_url }}" alt="{{ $p->nama }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                <div class="bg-secondary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                @endif
                            </td>
                            <td>{{ $p->nama }}</td>
                            <td><small>{{ $p->jabatan }}</small></td>
                            <td>{{ $p->pangkat_golongan }}</td>
                            <td>{{ $p->nip }}</td>
                            <td>
                                @if($p->is_active)
                                <span class="badge bg-success">Aktif</span>
                                @else
                                <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.pejabat.edit', $p) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.pejabat.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Belum ada data pejabat struktural. 
                <a href="{{ route('admin.pejabat.create') }}">Tambahkan sekarang</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection