<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pejabat;

class PejabatSeeder extends Seeder
{
    public function run(): void
    {
        // Kepala Lapas
        Pejabat::create([
            'nama' => 'Dr. Ahmad Hidayat, S.H., M.H.',
            'nip' => '196501011990031001',
            'pangkat_golongan' => 'Pembina Utama Muda (IV/c)',
            'jabatan' => 'Kepala Lembaga Pemasyarakatan',
            'tipe_jabatan' => 'kepala',
            'pendidikan' => 'S3 Ilmu Hukum',
            'tahun_menjabat' => 'Sejak 2022',
            'urutan' => 0,
            'is_active' => true
        ]);

        // Pejabat Struktural
        $struktural = [
            [
                'nama' => 'Budi Santoso, S.H.',
                'nip' => '197203151995031002',
                'pangkat_golongan' => 'Pembina (IV/a)',
                'jabatan' => 'Kepala Seksi Bimbingan Narapidana',
                'urutan' => 1
            ],
            [
                'nama' => 'Dwi Rahayu, S.Sos.',
                'nip' => '197805102000032001',
                'pangkat_golongan' => 'Penata Tk. I (III/d)',
                'jabatan' => 'Kepala Seksi Kegiatan Kerja',
                'urutan' => 2
            ],
            [
                'nama' => 'Eko Prasetyo, S.H.',
                'nip' => '198201252005021001',
                'pangkat_golongan' => 'Penata (III/c)',
                'jabatan' => 'Kepala Seksi Administrasi Keamanan',
                'urutan' => 3
            ],
            [
                'nama' => 'Fitri Handayani, S.E.',
                'nip' => '198509112008032002',
                'pangkat_golongan' => 'Penata Muda Tk. I (III/b)',
                'jabatan' => 'Kepala Sub Bagian Tata Usaha',
                'urutan' => 4
            ],
            [
                'nama' => 'Gunawan Wijaya, S.Kom.',
                'nip' => '199003182012031001',
                'pangkat_golongan' => 'Penata Muda (III/a)',
                'jabatan' => 'Kepala Seksi Pelayanan Tahanan',
                'urutan' => 5
            ],
            [
                'nama' => 'Hendra Kurniawan, S.Psi.',
                'nip' => '199207152015031002',
                'pangkat_golongan' => 'Penata Muda (III/a)',
                'jabatan' => 'Kepala Seksi Registrasi dan Bimbingan Kemasyarakatan',
                'urutan' => 6
            ]
        ];

        foreach ($struktural as $data) {
            Pejabat::create(array_merge($data, [
                'tipe_jabatan' => 'struktural',
                'is_active' => true
            ]));
        }
    }
}