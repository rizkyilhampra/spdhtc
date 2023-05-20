<?php

use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'index'])->name('index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('home', [\App\Http\Controllers\Controller::class, 'authenticated'])->name('home');

    Route::prefix('admin')->middleware('can:asAdmin')->group(function () {
        Route::get('beranda', [\App\Http\Controllers\AdminController::class, 'beranda'])->name('admin.beranda');
        Route::get('histori-diagnosis', [\App\Http\Controllers\AdminController::class, 'diagnosis'])->name('admin.diagnosis');
        Route::get('penyakit', [\App\Http\Controllers\PenyakitController::class, 'index'])->name('admin.penyakit');
        Route::get('penyakit/tambah', [\App\Http\Controllers\PenyakitController::class, 'create'])->name('admin.penyakit.tambah');
        Route::post('penyakit/store', [\App\Http\Controllers\PenyakitController::class, 'store'])->name('admin.penyakit.store');
        Route::get('penyakit/edit/{id}', [\App\Http\Controllers\PenyakitController::class, 'edit'])->name('admin.penyakit.edit');
        Route::put('penyakit/update/{id}', [\App\Http\Controllers\PenyakitController::class, 'update'])->name('admin.penyakit.update');
        Route::get('penyakit/hapus', [\App\Http\Controllers\PenyakitController::class, 'hapus'])->name('admin.penyakit.hapus');
        Route::delete('penyakit/destroy/{id}', [\App\Http\Controllers\PenyakitController::class, 'destroy'])->name('admin.penyakit.destroy');
        Route::get('gejala', [\App\Http\Controllers\AdminController::class, 'gejala'])->name('admin.gejala');
        Route::get('rule', [\App\Http\Controllers\AdminController::class, 'rule'])->name('admin.rule');
    });

    Route::middleware('can:asUser')->group(function () {
        Route::post('diagnosis', [DiagnosisController::class, 'Diagnosis'])
            ->middleware('can:hasUserProfile')
            ->name('user.diagnosis');
        Route::get('get-gejala', [DiagnosisController::class, 'getGejala'])->name('get-gejala')->middleware('can:hasUserProfile');
        Route::get('edit-profile', [\App\Http\Controllers\UserProfileController::class, 'index'])->name('edit-profile');
        Route::put('edit-profile', [\App\Http\Controllers\UserProfileController::class, 'updateUser'])->name('update-profile');
        Route::get('provinsi', [\App\Http\Controllers\KotaProvinsiController::class, 'indexProvince'])->name('provinsi');
        Route::get('edit-profile/lokasi/kota/{id}', [\App\Http\Controllers\KotaProvinsiController::class, 'indexCity'])->name('kota');
        Route::get('histori-diagnosis-user', [\App\Http\Controllers\UserController::class, 'historiDiagnosis'])->name('histori-diagnosis-user');
        Route::get('histori-diagnosis-user/detail', [\App\Http\Controllers\UserController::class, 'historiDiagnosisDetail'])->name('histori-diagnosis-user.detail');
        Route::delete('histori-diagnosis-user', [\App\Http\Controllers\UserController::class, 'historiDiagnosis'])->name('histori-diagnosis-user.delete');
    });
});

Route::get('/auth/google', [SocialAuthController::class, 'redirectToProvider'])->name('google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleProviderCallback'])
    ->name('google.callback');
