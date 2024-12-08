<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Front\ArticleController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Backend\ConfigController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DonationController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Front\EventController as FrontEventController;
use App\Http\Controllers\Front\CategoryController as FrontCategoryController;
use App\Http\Controllers\Front\DonationController as FrontDonationController;

Route::group(['middleware' => 'verifiedEmail'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get('/about', [HomeController::class, 'about'])->name('about');

    // Route Blog
    Route::get('/blogs', [ArticleController::class, 'index'])->name('blog');
    Route::get('blog/{slug}', [ArticleController::class, 'show'])->name('blog.show');

    // Route Category
    Route::get('/blogs/categories', [FrontCategoryController::class, 'indexBlog'])->name('blogs.categories');
    Route::get('/events/categories', [FrontCategoryController::class, 'indexEvent'])->name('events.categories');
    Route::get('/blogs/category/{slug}', [FrontCategoryController::class, 'showBlog'])->name('blogs.category');
    Route::get('/events/category/{slug}', [FrontCategoryController::class, 'showEvent'])->name('events.category');

    // Route Event
    Route::get('/events', [FrontEventController::class, 'index'])->name('events');
    Route::get('/events/{slug}', [FrontEventController::class, 'show'])->name('events.show');
    Route::post('/events/join', [FrontEventController::class, 'join'])->name('events.join');

    // Route Donation
    Route::get('/donations', [FrontDonationController::class, 'index'])->name('donations');
    Route::get('/donations/{slug}', [FrontDonationController::class, 'show'])->name('donations.show');

    // Route Form Donation Uang
    Route::get('/donations/{slug}/donation-amount', [FrontDonationController::class, 'showAmount'])->name('donations.amount');
    Route::post('/donations/{slug}/donation-amount', [FrontDonationController::class, 'storeTemporaryAmount'])->name('donations.store.amount');

    // Route Form Donation Barang
    Route::get('/donations/{slug}/donation-item', [FrontDonationController::class, 'showItem'])->name('donations.item');
    Route::post('/donations/{slug}/donation-item', [FrontDonationController::class, 'storeTemporaryItem'])->name('donations.store.item');

    // Route Konfirmasi (Barang dan Uang) dengan bukti pembayaran ddan resi
    Route::post('/donations/{slug}/confirm-amount/{temp_id}', [FrontDonationController::class, 'confirmAmount'])->name('donations.confirm-amount');
    Route::post('/donations/{slug}/confirm-item/{temp_id}', [FrontDonationController::class, 'confirmItem'])->name('donations.confirm-item');

    Route::resource('profile', ProfileController::class);
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

Route::get('/transfer_guest', function () {
    return view('front.payment_transfer.transfer_guest');
});

Route::get('/transfer_login', function () {
    return view('front.payment_transfer.transfer_login');
});

Route::get('/confirmationtransfer', function () {
    return view('front.payment_transfer.confirmationtransfer');
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

        Route::get('dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Route laporan
        Route::prefix('reports')->group(function () {
            Route::get('donations/verification', [ReportController::class, 'donationVerification'])
                ->name('reports.donations.verification'); // Verifikasi transfer dana

            Route::post('/donations/verification/confirm/{id}', [ReportController::class, 'confirmDonation'])
                ->name('reports.donations.verification.confirm');

            Route::get('donations', [ReportController::class, 'donations'])
                ->name('reports.donations'); // Laporan donasi

            Route::get('donations/export/{format}', [ReportController::class, 'exportDonations'])
                ->name('reports.donations.export'); // Export laporan donasi (PDF/Excel)

            Route::get('event-participants', [ReportController::class, 'eventParticipants'])
                ->name('reports.event.participants'); // Laporan peserta/volunteer
        });

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

        Route::get('pages', [PageController::class, 'index'])
            ->name('pages.index');
        Route::get('pages/{page}/edit/{section}', [PageController::class, 'editSection'])
            ->name('pages.edit.section');
        Route::put('pages/{page}/update/{section}', [PageController::class, 'updateSection'])
            ->name('pages.update.section');

        Route::post('/article/upload-image', [BlogController::class, 'uploadImage'])
            ->name('article.uploadImage');
    });
});
