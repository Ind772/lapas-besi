<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;
use App\Models\Layanan;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Slider
        Slider::create([
            'judul' => 'Lembaga Pemasyarakatan Kelas IIA Besi',
            'deskripsi' => 'Mewujudkan pembinaan warga binaan yang aman, tertib, dan produktif.',
            'gambar' => 'https://assets-a1.kompasiana.com/items/album/2022/04/23/whatsapp-image-2022-04-23-at-09-28-38-62637d15bb44865f7f415972.jpeg',
            'is_active' => true
        ]);

        // 2. Layanan
        Layanan::create([
            'judul' => 'Kunjungan Offline',
            'deskripsi' => 'Layanan pertemuan bagi keluarga warga binaan.',
            'icon' => 'images/people.png'
        ]);
        Layanan::create([
            'judul' => 'Titipan Barang',
            'deskripsi' => 'Prosedur penitipan barang dan makanan higienis.',
            'icon' => 'fas fa-box-open'
        ]);
        Layanan::create([
            'judul' => 'Integrasi PB/CB',
            'deskripsi' => 'Informasi pengurusan Pembebasan Bersyarat.',
            'icon' => 'fas fa-file-contract'
        ]);
    }
}