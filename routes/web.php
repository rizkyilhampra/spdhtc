<?php

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
    Route::get('home', function () {
        return view('dashboard.index');
    })->name('dashboard')->middleware('can:asAdmin');
    Route::get('home-user', function () {
        return view('dashboard.user.index');
    })->name('dashboard.user')->middleware('can:asUser');

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