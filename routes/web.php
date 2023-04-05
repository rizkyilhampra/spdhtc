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

    Route::prefix('admin')->middleware('can:asAdmin')->group(function () {
        Route::get('beranda', [App\Http\Controllers\AdminController::class, 'beranda'])->name('admin.beranda');
        Route::get('histori-diagnosis', [App\Http\Controllers\AdminController::class, 'diagnosis'])->name('admin.diagnosis');
        Route::get('penyakit', [App\Http\Controllers\AdminController::class, 'penyakit'])->name('admin.penyakit');
        Route::get('gejala', [App\Http\Controllers\AdminController::class, 'gejala'])->name('admin.gejala');
        Route::get('rule', [App\Http\Controllers\AdminController::class, 'rule'])->name('admin.rule');
    });

    Route::prefix('user')->middleware('can:asUser')->group(function () {
        Route::get('edit-profile', [App\Http\Controllers\UserProfileController::class, 'index'])->name('edit-profile');
        Route::get('edit-profile/lokasi/kota/{id}', [App\Http\Controllers\KotaProvinsiController::class, 'indexCity'])->name('kota');
    });

    Route::get('home-user', function () {
        echo "home-user";
    })->name('dashboard.user')->middleware('can:asUser');
});
Route::get('/auth/google', [SocialAuthController::class, 'redirectToProvider'])->name('google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleProviderCallback'])
    ->name('google.callback');
