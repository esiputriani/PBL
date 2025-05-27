<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BorrowController;

// -------------------- LANDING --------------------
Route::get('/', [LandingController::class, 'showLanding'])->name('landing');


// -------------------- USER --------------------
Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::get('/pinjam/{id}', [PeminjamanController::class, 'create'])->name('pinjam.form');
    Route::post('/pinjam/{id}', [PeminjamanController::class, 'store'])->name('pinjam.barang');
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
    Route::get('/return/{id}', [BorrowController::class, 'returnItem'])->name('return.item');
});


// -------------------- ADMIN --------------------
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('barang', BarangController::class);
    Route::resource('peminjaman', PeminjamanController::class);
});

Route::patch('/admin/peminjaman/{id}/return', [PeminjamanController::class, 'return'])->name('admin.peminjaman.return');


// -------------------- AUTH --------------------
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
