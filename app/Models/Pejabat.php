<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    use HasFactory;

    protected $table = 'pejabat';

    protected $fillable = [
        'nama',
        'nip',
        'pangkat_golongan',
        'jabatan',
        'tipe_jabatan',
        'pendidikan',
        'tahun_menjabat',
        'foto',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope untuk filter kepala lapas
    public function scopeKepala($query)
    {
        // PERBAIKAN: Menggunakan 'tipe_jabatan' sesuai migration
        return $query->where('tipe_jabatan', 'kepala');
    }

    // Scope untuk filter pejabat struktural
    public function scopeStruktural($query)
    {
        // PERBAIKAN: Menggunakan 'tipe_jabatan' sesuai migration
        return $query->where('tipe_jabatan', 'struktural');
    }

    // Scope untuk filter yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessor untuk URL foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }
        return null; // Bisa diganti dengan path ke placeholder image jika kosong
    }
}