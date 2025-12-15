<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Pejabat; // Pastikan Model Pejabat di-import

class ProfilController extends Controller
{
    /**
     * Menampilkan halaman profil publik.
     */
    public function index(): View
    {
        // 1. Ambil data Kepala Lapas
        // Logikanya: Cari yang jabatannya mengandung kata "Kepala" atau "Kalapas"
        // Sesuaikan string 'Kepala Lembaga' dengan isi database Anda sebenarnya
        $kepalaLapas = Pejabat::where('jabatan', 'LIKE', '%Kepala Lembaga%')
                        ->orWhere('jabatan', 'LIKE', '%Kalapas%')
                        ->first();

        // 2. Ambil Pejabat Struktural (Sisanya)
        if ($kepalaLapas) {
            // Jika Kalapas ditemukan, ambil semua pejabat KECUALI Kalapas tersebut
            $pejabatStruktural = Pejabat::where('id', '!=', $kepalaLapas->id)->get();
        } else {
            // Jika Kalapas belum diinput, ambil semua data sebagai pejabat struktural (untuk menghindari error)
            $pejabatStruktural = Pejabat::all();
        }

        // 3. Kirim variabel ke view 'profil'
        return view('profil', [
            'kepalaLapas' => $kepalaLapas,
            'pejabatStruktural' => $pejabatStruktural
        ]);
    }
}