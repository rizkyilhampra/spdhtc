<?php

use App\Http\Controllers\Admin\BerandaController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\ShowPdfController;
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
        Route::get('beranda', [BerandaController::class, 'index'])->name('admin.beranda');
        Route::prefix('penyakit')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\PenyakitController::class, 'index'])->name('admin.penyakit');
            Route::get('tambah', [\App\Http\Controllers\Admin\PenyakitController::class, 'create'])->name('admin.penyakit.tambah');
            Route::post('store', [\App\Http\Controllers\Admin\PenyakitController::class, 'store'])->name('admin.penyakit.store');
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\PenyakitController::class, 'edit'])->name('admin.penyakit.edit');
            Route::put('update/{id}', [\App\Http\Controllers\Admin\PenyakitController::class, 'update'])->name('admin.penyakit.update');
            Route::delete('destroy/{id}', [\App\Http\Controllers\Admin\PenyakitController::class, 'destroy'])->name('admin.penyakit.destroy');
            Route::get('pdf', [ShowPdfController::class, 'penyakitPdf'])->name('penyakit.pdf');
        });
        Route::prefix('gejala')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\GejalaController::class, 'index'])->name('admin.gejala');
            Route::get('tambah', [\App\Http\Controllers\Admin\GejalaController::class, 'create'])->name('admin.gejala.tambah');
            Route::post('store', [\App\Http\Controllers\Admin\GejalaController::class, 'store'])->name('admin.gejala.store');
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\GejalaController::class, 'edit'])->name('admin.gejala.edit');
            Route::put('update/{id}', [\App\Http\Controllers\Admin\GejalaController::class, 'update'])->name('admin.gejala.update');
            Route::delete('destroy/{id}', [\App\Http\Controllers\Admin\GejalaController::class, 'destroy'])->name('admin.gejala.destroy');
            Route::get('pdf', [ShowPdfController::class, 'gejalaPdf'])->name('gejala.pdf');
        });
        Route::prefix('rule')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\RuleController::class, 'index'])->name('admin.rule');
            Route::get('tambah', [\App\Http\Controllers\Admin\RuleController::class, 'create'])->name('admin.rule.tambah');
            Route::post('store', [\App\Http\Controllers\Admin\RuleController::class, 'store'])->name('admin.rule.store');
            Route::get('edit/{id}', [\App\Http\Controllers\Admin\RuleController::class, 'edit'])->name('admin.rule.edit');
            Route::put('update/{id}', [\App\Http\Controllers\Admin\RuleController::class, 'update'])->name('admin.rule.update');
            Route::delete('destroy/{id}', [\App\Http\Controllers\Admin\RuleController::class, 'destroy'])->name('admin.rule.destroy');
            Route::get('pdf', [ShowPdfController::class, 'rulePdf'])->name('rule.pdf');
        });
        Route::prefix('histori-diagnosis')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\HistoriDiagnosisController::class, 'index'])->name('admin.histori.diagnosis');
            Route::get('detail/{id}', [\App\Http\Controllers\Admin\HistoriDiagnosisController::class, 'detail'])->name('admin.histori.diagnosis.detail');
            Route::delete('destroy', [\App\Http\Controllers\Admin\HistoriDiagnosisController::class, 'destroy'])->name('admin.diagnosis.destroy');
            Route::get('pdf', [ShowPdfController::class, 'historiDiagnosisPdf'])->name('histori.diagnosis.pdf');
        });
    });

    Route::middleware('can:asUser')->group(function () {
        Route::post('diagnosis', [DiagnosisController::class, 'diagnosis'])
            ->middleware('can:hasUserProfile')
            ->name('user.diagnosis');
        Route::put('edit-profile', [\App\Http\Controllers\UserProfileController::class, 'updateUser'])->name('update-profile');
        Route::delete('histori-diagnosis-user', [\App\Http\Controllers\UserController::class, 'historiDiagnosis'])->name('histori-diagnosis-user.delete');
        Route::middleware('check.direct.access')->group(function () {
            Route::middleware('can:hasUserProfile')->group(function () {
                Route::get('get-gejala', [UserController::class, 'getGejala'])->name('get-gejala');
                Route::get('detail-diagnosis', [UserController::class, 'detailDiagnosis'])->name('detail-diagnosis');
                Route::get('chart-diagnosis-penyakit', [UserController::class, 'chartDiagnosisPenyakit'])->name('chart-diagnosis-penyakit');
                Route::get('get-aturan-with-next-gejala', [UserController::class, 'aturanWithNextGejala'])->name('get-aturan-with-next-gejala');
            });
            Route::get('histori-diagnosis-user', [\App\Http\Controllers\UserController::class, 'historiDiagnosis'])->name('histori-diagnosis-user');
            Route::get('edit-profile', [\App\Http\Controllers\UserProfileController::class, 'index'])->name('edit-profile');
            Route::get('provinsi', [\App\Http\Controllers\KotaProvinsiController::class, 'indexProvince'])->name('provinsi');
            Route::get('edit-profile/lokasi/kota/{id}', [\App\Http\Controllers\KotaProvinsiController::class, 'indexCity'])->name('kota');
        });
    });
});

Route::post('/auth/google', [SocialAuthController::class, 'redirectToProvider'])->name('google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleProviderCallback'])
    ->name('google.callback');
