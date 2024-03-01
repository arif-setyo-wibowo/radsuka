<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\RontgenController;
use App\Http\Controllers\TestimoniController;
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

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('/', 'postlogin')->name('loginpasien');
});
Route::controller(TestimoniController::class)->group(function () {
    Route::get('/testimoni', 'index')->name('testimoni');
    Route::post('/testimoni', 'store')->name('testimoni.kirim');
});
Route::controller(LoginController::class)->prefix('login')->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/', 'postlogin')->name('postlogin');
});



Route::middleware('pasien')->group(function () {

    Route::get('logout-pasien', [HomeController::class, 'logout'])->name('logout.pasien');

    Route::get('/pasien',  [HomeController::class, 'pasien'])->name('pasien');
    Route::get('/detail-pemeriksaan',  [HomeController::class, 'detail'])->name('detail.pemeriksaan');
});

Route::middleware('petugas')->group(function () {

    Route::get('/admin',  [AdminController::class, 'index'])->name('dashboard');

    Route::controller(PasienController::class)->prefix('/admin/pasien')->group(function () {
        Route::get('/', 'index')->name('admin.pasien');
        Route::post('/', 'storeUpdate')->name('admin.pasien.storeupdate');
        Route::get('/delete', 'destroy')->name('admin.pasien.delete');
    });

    Route::controller(TestimoniController::class)->group(function () {
        Route::get('/testimoni-admin', 'admin_testimoni')->name('admin.testimoni');
    });

    Route::controller(RontgenController::class)->prefix('/admin/rontgen')->group(function () {
        Route::get('/', 'index')->name('admin.rontgen');
        Route::post('/', 'storeUpdate')->name('admin.rontgen.storeupdate');
        Route::get('/detail', 'show')->name('admin.rontgen.detail');
        Route::get('/delete', 'destroy')->name('admin.rontgen.delete');
    });

    // Route::get('/admin/rontgen',  [AdminController::class, 'rontgen'])->name('admin.rontgen');
    // Route::get('/admin/rontgen/detail',  [AdminController::class, 'rontgen_detail'])->name('admin.rontgen.detail');
    // Route::get('/admin/petugas',  [PetugasController::class, 'index'])->name('admin.petugas');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::controller(PetugasController::class)->prefix('/admin/petugas')->group(function () {
        Route::get('/', 'index')->name('admin.petugas');
        Route::post('/', 'storeUpdate')->name('petugas.store.update');
        Route::get('/delete', 'destroy')->name('delete.petugas');
    });

});