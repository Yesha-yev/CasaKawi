<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SenimanController;
use App\Http\Controllers\BudayaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StatistikController;

Route::get('/', [HomeController::class, 'index'])->name('landing');
Route::get('/statistik', [StatistikController::class, 'publik'])->name('statistik');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'formRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store');


/* ======================
     ADMIN
======================= */
Route::middleware(['auth','role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/seniman', [SenimanController::class, 'index'])->name('admin.seniman.index');
    Route::get('/seniman/create', [SenimanController::class, 'create'])->name('admin.seniman.create');
    Route::post('/seniman', [SenimanController::class, 'store'])->name('admin.seniman.store');

    Route::get('/seniman/{id}/edit', [SenimanController::class, 'edit'])->name('admin.seniman.edit');
    Route::put('/seniman/{id}', [SenimanController::class, 'update'])->name('admin.seniman.update');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
    Route::get('/admin/statistik', [AdminController::class, 'statistik'])->name('admin.statistik');
    Route::post('/laporan/{id}/status', [LaporanController::class, 'updateStatus'])->name('admin.laporan.status');
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('admin.laporan.destroy');
});


/* ======================
   SENIMAN
======================= */
Route::middleware(['auth','role:seniman'])->prefix('seniman')->group(function(){

    Route::get('/dashboard', [SenimanController::class, 'dashboard'])->name('seniman.dashboard');

    // Karya CRUD
    Route::get('/karya', [SenimanController::class, 'indexKarya'])->name('seniman.karya.index');

    Route::get('/karya/create', [SenimanController::class, 'createKarya'])->name('seniman.karya.create');
    Route::post('/karya', [SenimanController::class, 'storeKarya'])->name('seniman.karya.store');

    Route::get('/karya/{id}/edit', [SenimanController::class, 'editKarya'])->name('seniman.karya.edit');
    Route::put('/karya/{id}', [SenimanController::class, 'updateKarya'])->name('seniman.karya.update');

    Route::delete('/karya/{id}', [SenimanController::class, 'deleteKarya'])->name('seniman.karya.delete');

    // Profil
    Route::get('/profil', [SenimanController::class, 'editProfil'])->name('seniman.profil.edit');
    Route::put('/profil', [SenimanController::class, 'updateProfil'])->name('seniman.profil.update');

});

Route::get('/galeri', [ArtifactController::class, 'index'])->name('gallery.index');
Route::get('/galeri/{id}', [ArtifactController::class, 'show'])->name('gallery.show');

Route::get('/peta', [ArtifactController::class, 'map'])->name('gallery.map');

Route::get('/timeline', [TimelineController::class, 'index'])->name('timeline.index');

Route::get('/laporkan-budaya', [ReportController::class, 'create'])->name('reports.create');
Route::post('/laporkan-budaya', [ReportController::class, 'store'])->name('reports.store');
