@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Tambah Pejabat</h4>
        <a href="{{ route('admin.pejabat.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.pejabat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- 1. Nama --}}
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                    @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    {{-- 2. NIP --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">NIP <span class="text-danger">*</span></label>
                        <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" required>
                        @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- 3. Pangkat / Golongan --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pangkat / Golongan <span class="text-danger">*</span></label>
                        <input type="text" name="pangkat_golongan" class="form-control @error('pangkat_golongan') is-invalid @enderror" value="{{ old('pangkat_golongan') }}" required>
                        @error('pangkat_golongan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- 4. Jabatan --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}" required>
                        @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- 5. Tipe Jabatan --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tipe Jabatan <span class="text-danger">*</span></label>
                        <select name="tipe_jabatan" class="form-select @error('tipe_jabatan') is-invalid @enderror" required>
                            <option value="">-- Pilih Tipe --</option>
                            <option value="kepala" {{ old('tipe_jabatan') == 'kepala' ? 'selected' : '' }}>Kepala</option>
                            <option value="struktural" {{ old('tipe_jabatan') == 'struktural' ? 'selected' : '' }}>Struktural</option>
                        </select>
                        @error('tipe_jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- KOLOM WARNA GRADIENT SUDAH DIHAPUS DARI SINI --}}

                <div class="row">
                    {{-- 6. Pendidikan --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Pendidikan Terakhir</label>
                        <input type="text" name="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" value="{{ old('pendidikan') }}">
                        @error('pendidikan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- 7. Tahun Menjabat --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tahun Menjabat</label>
                        <input type="text" name="tahun_menjabat" class="form-control @error('tahun_menjabat') is-invalid @enderror" value="{{ old('tahun_menjabat') }}">
                        @error('tahun_menjabat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    {{-- 8. Foto --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Foto Profil</label>
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                        <small class="text-muted">Max: 2MB (JPG, JPEG, PNG)</small>
                        @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- 9. Urutan --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror" value="{{ old('urutan', 0) }}">
                        @error('urutan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- 10. Status Aktif --}}
                <div class="mb-4 form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" checked>
                    <label class="form-check-label" for="isActive">Status Aktif</label>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Simpan Data
                </button>
            </form>
        </div>
    </div>
</div>
@endsection