<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfilController;

// Route utama
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Route untuk clear cache berita
Route::get('/clear-berita-cache', [LandingController::class, 'clearCache'])
    ->name('clear.berita.cache');

// Profil Page
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

// Route debugging (hanya untuk local development)
if (app()->environment('local')) {
    
    // Debug scraping - return JSON
    Route::get('/debug-scraping', [LandingController::class, 'debugScraping']);
    
    // Test scraping dengan view
    Route::get('/test-scraping', function() {
        // Clear cache terlebih dahulu
        Cache::forget('kompasiana_berita_v6');
        
        // Jalankan scraping
        $controller = new LandingController();
        
        // Ambil method private dengan Reflection
        $reflection = new \ReflectionClass($controller); // ← Perhatikan backslash (\)
        $method = $reflection->getMethod('scrapeKompasiana');
        $method->setAccessible(true);
        
        $berita = $method->invoke($controller);
        
        return view('debug-scraping', compact('berita'));
    });
}