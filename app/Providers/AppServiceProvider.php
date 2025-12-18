<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// ------------------------------------------------------------
// PERBAIKAN: Baris 'use' WAJIB ada di sini (Sebelum 'class')
// ------------------------------------------------------------
use Illuminate\Support\Facades\Artisan;
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
        // 1. Force HTTPS (Wajib untuk Railway)
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // 2. Auto-Fix Storage Link (Hanya di Railway/Production)
        if($this->app->environment('production')) {
            
            // A. Cek folder penyimpanan asli
            $path = storage_path('app/public/pejabat');
            if (!file_exists($path)) {
                @mkdir($path, 0777, true); // Pakai @ agar tidak error jika sudah ada
            }

            // B. Cek Symlink (Jembatan)
            $linkPath = public_path('storage');
            if (!file_exists($linkPath)) {
                // Jalankan perintah link
                Artisan::call('storage:link');
            }
        }
    }
}