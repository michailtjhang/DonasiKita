<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ConfigController;
use App\Http\Controllers\Backend\DashboardController;

/*
Route::get('/', [HomeController::class, 'index']);
*/

Route::get('/', function () {
    return view('front.home.home');
});


Route::get('/home', function () {
    return view('front.home.home');
});

Route::get('/about', function () {
    return view('front.about.about');
});

Route::get('/donation', function () {
    return view('front.donation.donation');
});

Route::get('/event', function () {
    return view('front.event.event');
});

Route::get('/donasibarang_login', function () {
    return view('front.payment.donasibarang_login');
});

Route::get('/donasibarang_guest', function () {
    return view('front.payment.donasibarang_guest');
});

Route::get('/confirmationbarang', function () {
    return view('front.payment.confirmationbarang');
});

Route::post('/confirmationbarang', function () {
    // Tambahkan logika backend untuk menangani data yang dikirim (opsional)
    return response()->json(['message' => 'Form submitted successfully!']);
})->name('confirmation.barang.submit');

Route::post('/donasi-barang-submit', [DonationController::class, 'store'])->name('donasi.barang.submit');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth_login']);

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'auth_register']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'useradmin']], function () {

    Route::prefix('admin')->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('role', RoleController::class);
        Route::resource('user', UserController::class);
        Route::resource('config', ConfigController::class)
            ->only(['index', 'update']);
        Route::resource('category', CategoryController::class)
            ->only(['index', 'store', 'update', 'destroy']);
        Route::resource('article', BlogController::class);
        
        Route::post('/article/upload-image', [BlogController::class, 'uploadImage'])->name('article.uploadImage');
    });
});
