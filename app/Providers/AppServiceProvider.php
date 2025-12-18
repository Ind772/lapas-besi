<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// ---------------------------------------------------------
// PERHATIKAN: Posisi 'use' harus DISINI (Di atas class)
// ---------------------------------------------------------
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Force HTTPS untuk Railway
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // 2. AUTO-FIX STORAGE (Jalankan hanya di Production/Railway)
        if($this->app->environment('production')) {
            
            // A. Pastikan folder penyimpanan fisik ada
            $path = storage_path('app/public/pejabat');
            if (!file_exists($path)) {
                // Buat folder dengan izin akses penuh (0777)
                mkdir($path, 0777, true);
            }

            // B. Pastikan Symlink (Jembatan) ada
            $linkPath = public_path('storage');
            
            // Cek apakah linknya putus atau belum ada
            if (!file_exists($linkPath)) {
                // Jalankan perintah artisan storage:link
                Artisan::call('storage:link');
            }
        }
    }
}