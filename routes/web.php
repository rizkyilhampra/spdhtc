<?php

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
    return view('dashboard.index');
});

// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// Route::get('/logout', function () {
//     return view('auth.logout');
// })->name('logout');

// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');

// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password');
// })->name('forgot-password');

// Route::get('/reset-password', function () {
//     return view('auth.reset-password');
// })->name('reset-password');