<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfilController; // Controller Halaman Profil Publik (Lembaga)
use App\Http\Controllers\ProfileController; // Controller Edit Akun User (Bawaan Breeze/Laravel)
use App\Http\Controllers\Admin\AdminPejabatController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Route utama
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Profil Page (Halaman Publik / Tentang Kami)
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

// Route untuk clear cache berita
Route::get('/clear-berita-cache', [LandingController::class, 'clearCache'])
    ->name('clear.berita.cache');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard & User Profile Routes (Authenticated Users)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    
    // Dashboard Logic
    Route::get('/dashboard', function() {
        // Redirect based on user role
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.pejabat.index');
        }
        // Regular users redirect to home
        return redirect()->route('landing');
    })->name('dashboard');

    // --- TAMBAHAN: User Account Settings (ProfileController) ---
    // Menggunakan URL /account-profile agar tidak bentrok dengan /profil publik
    Route::get('/account-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/account-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/account-profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Admin Only)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function() {
        return redirect()->route('admin.pejabat.index');
    })->name('dashboard');
    
    // CRUD Pejabat
    Route::resource('pejabat', AdminPejabatController::class);

    // --- Rute Baru: Kelola Berita (Scraping) ---
    Route::get('/berita', function() {
        // Logika scraping dipindah ke sini
        // Kita clear cache dulu agar admin selalu dapat data terbaru saat klik menu ini
        \Illuminate\Support\Facades\Cache::forget('kompasiana_berita_v6');
        
        $controller = new \App\Http\Controllers\LandingController();
        $berita = $controller->scrapeKompasiana();
        
        return view('debug-scraping', compact('berita'));
    })->name('berita.index'); // Nama route: admin.berita.index
});

/*
|--------------------------------------------------------------------------
| Development Routes (Local Environment Only)
|--------------------------------------------------------------------------
*/

if (app()->environment('local')) {
    Route::get('/debug-scraping', [LandingController::class, 'debugScraping'])->name('debug.scraping');
    
    Route::get('/test-scraping', function() {
        Cache::forget('kompasiana_berita_v6');
        $controller = new LandingController();
        $reflection = new \ReflectionClass($controller);
        $method = $reflection->getMethod('scrapeKompasiana');
        $method->setAccessible(true);
        $berita = $method->invoke($controller);
        return view('debug-scraping', compact('berita'));
    })->name('test.scraping');
}