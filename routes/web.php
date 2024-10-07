<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoaiVanBanController;
use App\Http\Controllers\DonViCapCaoController;
use App\Http\Controllers\TruongController;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\TrungTamController;
use App\Http\Controllers\hanhChinhController;
use App\Http\Controllers\PhucVuController;
use App\Http\Controllers\ToChucController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VanBanDiController;
use App\Http\Controllers\VanBanDenController;




/*
|--------------------------------------------------------------------------
| Web Route
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login-manager', [AdminController::class, 'login'])->name('login');



Route::get('/register-auth',[AdminController::class, 'register_auth']); 


Route::get('/logout-auth',[AdminController::class, 'logout_auth']); 

Route::post('/register',[AdminController::class, 'register']); 

Route::POST('/dang-nhap',[AdminController::class, 'dangnhap']); 

Route::get('/logout',[AdminController::class, 'logout']); 

Route::get('/home',[HomeController::class, 'index']); 

// Route cho phần quản lý 
Route::prefix('manager')->group(function () {
    

    Route::resource('/loai-van-ban', LoaiVanBanController::class);

    Route::resource('/don-vi-cap-cao', DonViCapCaoController::class);

    Route::resource('/truong', TruongController::class);

    Route::resource('/trung-tam', TrungtamController::class);

    Route::resource('/hanh-chinh', HanhChinhController::class);

    Route::resource('/phuc-vu', PhucVuController::class);

    Route::resource('/to-chuc', ToChucController::class);

    Route::resource('/chuc-vu', ChucVuController::class);

    Route::resource('/khoa', KhoaController::class);
    // Các route khác ở đây
});


Route::resource('/user', UserController::class);

Route::get('/profile/{slug}',[UserController::class, 'profile']); 

//quản lý van ban
Route::resource('/van-ban-di', VanBanDiController::class);

Route::resource('/van-ban-den', VanBanDenController::class);