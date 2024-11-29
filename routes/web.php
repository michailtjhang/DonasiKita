<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Front\ArticleController;
use App\Http\Controllers\Backend\ConfigController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DonationController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Front\CategoryController as FrontCategoryController;
use App\Http\Controllers\Front\EventController as FrontEventController;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/blogs', [ArticleController::class, 'index'])->name('blog');
Route::get('blog/{slug}', [ArticleController::class, 'show'])->name('blog.show');

Route::get('/blogs/categories', [FrontCategoryController::class, 'indexBlog'])->name('blogs.categories');
Route::get('/events/categories', [FrontCategoryController::class, 'indexEvent'])->name('events.categories');
Route::get('/blogs/category/{slug}', [FrontCategoryController::class, 'showBlog'])->name('blogs.category');
Route::get('/events/category/{slug}', [FrontCategoryController::class, 'showEvent'])->name('events.category');

Route::get('/events', [FrontEventController::class, 'index'])->name('events');
Route::get('/events/{slug}', [FrontEventController::class, 'show'])->name('events.show');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/donation', [HomeController::class, 'donation'])->name('donation');

Route::get('/detail_donation', [HomeController::class, 'detail_donation'])->name('detail_donation');

Route::get('/event_category_all', [HomeController::class, 'event_category_all'])->name('event_category_all');

Route::get('/event_category_specific', [HomeController::class, 'event_category_specific'])->name('event_category_specific');

Route::get('/detail_event', [HomeController::class, 'detail_event'])->name('detail_event');

Route::get('/donasibarang_login', function () {
    return view('front.payment.donasibarang_login');
});

Route::get('/donasibarang_guest', function () {
    return view('front.payment.donasibarang_guest');
});

Route::get('/confirmationbarang', function () {
    return view('front.payment.confirmationbarang');
});

Route::get('/blog_categories_specific', function () {
    return view('front.blog_categories.blog_categories_specific');
});

Route::get('/transfer_guest', function () {
    return view('front.payment_transfer.transfer_guest');
});

Route::get('/transfer_login', function () {
    return view('front.payment_transfer.transfer_login');
});

Route::get('/confirmationtransfer', function () {
    return view('front.payment_transfer.confirmationtransfer');
});

Route::get('/verify-email', function () {
    return view('Auth.verify-email');
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

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])->middleware('throttle:6,1')->name('verification.resend');
});

Route::group(['middleware' => ['auth', 'useradmin', 'verified']], function () {

    Route::prefix('admin')->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('role', RoleController::class);
        Route::resource('user', UserController::class);
        Route::resource('config', ConfigController::class)
            ->only(['index', 'update']);
        Route::resource('category', CategoryController::class)
            ->only(['index', 'store', 'update', 'destroy']);
        Route::resource('article', BlogController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'show']);
        Route::resource('event', EventController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'show']);
        Route::resource('donation', DonationController::class)
            ->only(['index', 'create', 'store', 'edit', 'update', 'show']);

        Route::post('/article/upload-image', [BlogController::class, 'uploadImage'])->name('article.uploadImage');
    });
});
