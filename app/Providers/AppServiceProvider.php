<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    // Tambahkan import ini di paling atas
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

public function boot(): void
{
    // 1. Force HTTPS (Kode lama Anda)
    if($this->app->environment('production')) {
        \Illuminate\Support\Facades\URL::forceScheme('https');
    }

    // 2. AUTO-FIX STORAGE (Kode Baru)
    // Cek apakah ini lingkungan Production (Railway)
    if($this->app->environment('production')) {
        
        // A. Pastikan folder penyimpanan fisik ada
        $path = storage_path('app/public/pejabat');
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        // B. Pastikan Symlink (Jalur pintas public/storage) ada
        $linkPath = public_path('storage');
        if (!file_exists($linkPath)) {
            // Jalankan perintah linking secara diam-diam
            Artisan::call('storage:link');
        }
    }
}
}
