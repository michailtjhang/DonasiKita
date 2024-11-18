<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ConfigController;
use App\Http\Controllers\Backend\DashboardController;

Route::get('/', function () {
<<<<<<< HEAD
    return view('front.home.home');
=======
    return view('welcome');
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
});

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
<<<<<<< HEAD
    });
});


//contoh route ke page lainnya
// Route('/about', function () {
//     return view('front.home.');
// });
=======

        Route::post('/article/upload-image', [BlogController::class, 'uploadImage'])->name('article.uploadImage');

    });
});
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
