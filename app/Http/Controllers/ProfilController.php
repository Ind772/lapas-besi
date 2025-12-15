<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        // 1. Ambil Kepala Lapas
        // Menggunakan scopeKepala() dan scopeActive() dari Model
        $kepalaLapas = Pejabat::kepala()
                              ->active()
                              ->first();

        // 2. Ambil Pejabat Struktural
        // Menggunakan scopeStruktural() dan scopeActive() dari Model
        $struktural = Pejabat::struktural()
                             ->active()
                             ->orderBy('urutan', 'asc')
                             ->get();

        // Kirim ke View
        // Array key 'pejabatStruktural' ini PENTING agar view tidak error
        return view('profil', [
            'kepalaLapas'       => $kepalaLapas,
            'pejabatStruktural' => $struktural 
        ]);
    }
}