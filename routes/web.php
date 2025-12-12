<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Admin\AdminPejabatController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Route utama
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Profil Page
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
| Dashboard Routes (Authenticated Users)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        // Redirect based on user role
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.pejabat.index');
        }
        
        // Regular users redirect to home
        return redirect()->route('landing');
    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Admin Only)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin (redirect to pejabat index)
    Route::get('/dashboard', function() {
        return redirect()->route('admin.pejabat.index');
    })->name('dashboard');
    
    // CRUD Pejabat
    Route::resource('pejabat', AdminPejabatController::class);
    
    // Optional: Toggle active status pejabat (jika ingin tambah fitur ini)
    // Route::patch('pejabat/{pejabat}/toggle-active', [AdminPejabatController::class, 'toggleActive'])
    //     ->name('pejabat.toggle-active');
});

/*
|--------------------------------------------------------------------------
| Development Routes (Local Environment Only)
|--------------------------------------------------------------------------
*/

if (app()->environment('local')) {
    
    // Debug scraping - return JSON
    Route::get('/debug-scraping', [LandingController::class, 'debugScraping'])
        ->name('debug.scraping');
    
    // Test scraping dengan view
    Route::get('/test-scraping', function() {
        Cache::forget('kompasiana_berita_v6');
        
        $controller = new LandingController();
        
        $reflection = new \ReflectionClass($controller);
        $method = $reflection->getMethod('scrapeKompasiana');
        $method->setAccessible(true);
        
        $berita = $method->invoke($controller);
        
        return view('debug-scraping', compact('berita'));
    })->name('test.scraping');
    
    // Route untuk test email, test database, dll (optional)
    // Route::get('/test-db', function() {
    //     return \App\Models\User::count();
    // });
}