<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
});
Route::get('/', [HomeController::class, 'index'])->name('landing');
Route::get('/login',[AuthController::class,'formlogin'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.post');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/register',[AuthController::class,'formRegister'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register.post');
