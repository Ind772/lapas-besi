<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

// Route utama
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Route untuk clear cache berita
Route::get('/clear-berita-cache', [LandingController::class, 'clearCache'])
    ->name('clear.berita.cache');

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
        $reflection = new ReflectionClass($controller);
        $method = $reflection->getMethod('scrapeKompasiana');
        $method->setAccessible(true);
        
        $berita = $method->invoke($controller);
        
        return view('debug-scraping', compact('berita'));
    });
}