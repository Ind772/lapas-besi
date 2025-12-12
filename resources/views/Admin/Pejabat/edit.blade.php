@extends('layouts.admin')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Pejabat</h4>

    <form action="{{ route('admin.pejabat.update', $pejabat->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $pejabat->nama }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control" maxlength="18" value="{{ $pejabat->nip }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pangkat / Golongan</label>
            <input type="text" name="pangkat_golongan" class="form-control" value="{{ $pejabat->pangkat_golongan }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="{{ $pejabat->jabatan }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipe Jabatan</label>
            <select name="tipe_jabatan" class="form-control">
                <option value="kepala" {{ $pejabat->tipe_jabatan == 'kepala' ? 'selected' : '' }}>Kepala</option>
                <option value="struktural" {{ $pejabat->tipe_jabatan == 'struktural' ? 'selected' : '' }}>Struktural</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Pendidikan</label>
            <input type="text" name="pendidikan" class="form-control" value="{{ $pejabat->pendidikan }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Tahun Menjabat</label>
            <input type="text" name="tahun_menjabat" class="form-control" value="{{ $pejabat->tahun_menjabat }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Foto</label><br>

            @if ($pejabat->foto)
                <img src="{{ asset('storage/' . $pejabat->foto) }}" width="120" class="mb-2 rounded">
            @endif

            <input type="file" name="foto" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Urutan Tampil</label>
            <input type="number" name="urutan" class="form-control" value="{{ $pejabat->urutan }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
