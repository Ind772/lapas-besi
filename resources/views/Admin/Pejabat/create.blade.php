@extends('layouts.admin')

@section('content')
<div class="container">
    <h4 class="mb-4">Tambah Pejabat</h4>

    <form action="{{ route('admin.pejabat.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control" maxlength="18" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pangkat / Golongan</label>
            <input type="text" name="pangkat_golongan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipe Jabatan</label>
            <select name="tipe_jabatan" class="form-control">
                <option value="kepala">Kepala</option>
                <option value="struktural" selected>Struktural</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Pendidikan</label>
            <input type="text" name="pendidikan" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun Menjabat</label>
            <input type="text" name="tahun_menjabat" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Urutan Tampil</label>
            <input type="number" name="urutan" class="form-control" value="0">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
