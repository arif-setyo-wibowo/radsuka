<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasienController;
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

Route::get('/',  [HomeController::class, 'index'])->name('home');
Route::get('/login',  [LoginController::class, 'index'])->name('login');


Route::get('/pasien',  [PasienController::class, 'index'])->name('pasien');
Route::get('/detail-pemeriksaan',  [PasienController::class, 'detail'])->name('detail.pemeriksaan');

Route::get('/admin',  [AdminController::class, 'index'])->name('dashboard');
Route::get('/admin/pasien',  [AdminController::class, 'pasien'])->name('admin.pasien');
Route::get('/admin/rontgen',  [AdminController::class, 'rontgen'])->name('admin.rontgen');
Route::get('/admin/rontgen/detail',  [AdminController::class, 'rontgen_detail'])->name('admin.rontgen.detail');
Route::get('/admin/petugas',  [AdminController::class, 'petugas'])->name('admin.petugas');