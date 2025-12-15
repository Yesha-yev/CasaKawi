<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaryaController;
use App\Http\Controllers\SenimanController;
use App\Http\Controllers\BudayaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\KaryaReviewController;

Route::get('/', [HomeController::class, 'index'])->name('landing');
Route::get('/statistik', [StatistikController::class, 'publik'])->name('statistik');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');


Route::middleware(['auth','role:admin'])->prefix('admin')->group(function () {
    Route::get('/karya/review', [KaryaReviewController::class, 'index'])->name('admin.karya.review');
    Route::get('/karya/review/{id}', [KaryaReviewController::class, 'show'])->name('admin.karya.review.detail');
    Route::post('/karya/review/{id}/status', [KaryaReviewController::class, 'updateStatus'])->name('admin.karya.review.update');

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/seniman', [SenimanController::class, 'index'])->name('admin.seniman.index');
    Route::get('/seniman/create', [SenimanController::class, 'create'])->name('admin.seniman.create');
    Route::post('/seniman', [SenimanController::class, 'store'])->name('admin.seniman.store');

    Route::get('/seniman/{id}/edit', [SenimanController::class, 'edit'])->name('admin.seniman.edit');
    Route::put('/seniman/{id}', [SenimanController::class, 'update'])->name('admin.seniman.update');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
    Route::post('/laporan/{id}/status', [LaporanController::class, 'updateStatus'])->name('admin.laporan.status');
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('admin.laporan.destroy');

    Route::get('/budaya/create', [BudayaController::class, 'create'])->name('admin.budaya.create');
    Route::post('/budaya', [BudayaController::class, 'store'])->name('admin.budaya.store');
    Route::get('/budaya/{id}/edit', [BudayaController::class, 'edit'])->name('admin.budaya.edit');
    Route::put('/budaya/{id}', [BudayaController::class, 'update'])->name('admin.budaya.update');
    Route::delete('/budaya/{id}', [BudayaController::class, 'destroy'])->name('admin.budaya.destroy');

});


Route::middleware(['auth','role:seniman'])->prefix('seniman')->group(function(){

    Route::get('/dashboard', [SenimanController::class, 'dashboard'])->name('seniman.dashboard');

    Route::get('/karya', [SenimanController::class, 'indexKarya'])->name('seniman.karya.index');

    Route::get('/karya/create', [SenimanController::class, 'createKarya'])->name('seniman.karya.create');
    Route::post('/karya', [SenimanController::class, 'storeKarya'])->name('seniman.karya.store');

    Route::get('/karya/{id}/edit', [SenimanController::class, 'editKarya'])->name('seniman.karya.edit');
    Route::put('/karya/{id}', [SenimanController::class, 'updateKarya'])->name('seniman.karya.update');

    Route::delete('/karya/{id}', [SenimanController::class, 'deleteKarya'])->name('seniman.karya.delete');

    Route::get('/profil', [SenimanController::class, 'editProfil'])->name('seniman.profil.edit');
    Route::put('/profil', [SenimanController::class, 'updateProfil'])->name('seniman.profil.update');

});

Route::get('/karya', [KaryaController::class, 'index'])->name('karya.index');
Route::get('/budaya', [BudayaController::class, 'index'])->name('budaya.index');

