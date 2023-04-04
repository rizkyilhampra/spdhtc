<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\SocialAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.user.app');
});
// });Route::get('/', function () {
//     return view('auth.login');
// });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('home', [App\Http\Controllers\Controller::class, 'authenticated'])->name('home');
    // Route::get('admin', function () {
    //     return view('admin.dashboard');
    // })->name('dashboard')->middleware('can:asAdmin');

    Route::prefix('admin')->middleware('can:asAdmin')->group(function () {
        Route::get('dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    });

    Route::get('home-user', function () {
        echo "home-user";
    })->name('dashboard.user')->middleware('can:asUser');

    // Route::get('home', [App\Http\Controllers\AdminController::class, 'index'])->name('home');

    //route to edit-profile
    Route::get('edit-profile', [App\Http\Controllers\UserProfileController::class, 'index'])->name('edit-profile');
    Route::get('edit-profile/lokasi/kota/{id}', [App\Http\Controllers\KotaProvinsiController::class, 'indexCity'])->name('kota');
    //route to auth google
    Route::get('/auth/google', [SocialAuthController::class, 'redirectToProvider'])->name('google');
    Route::get('/auth/google/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('google.callback');
});

// Route::get('beranda', function () {
//     return view('');
// });
// Route::get('diagnosis', function () {
//     return view('user.diagnosis');
// });
// Route::get('diagnosis/diagnosis-gejala', function () {
//     return view('user.diagnosis-gejala');
// });
// Route::get('informasi-penyakit', function () {
//     return view('user.informasi-penyakit');
// });
// Route::get('kontak', function () {
//     return view('user.kontak');
// });
