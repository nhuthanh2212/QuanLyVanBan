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



Route::get('/forgot-password',[AdminController::class, 'forgot_password']); 

Route::post('/forgot',[AdminController::class, 'forgot']); 

Route::get('/new-password',[AdminController::class, 'new_password']); 

Route::post('/password',[AdminController::class, 'password']); 

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

    Route::resource('/user', UserController::class);
    // Các route khác ở đây
});




Route::get('/profile/{slug}',[UserController::class, 'profile']); 

//quản lý van ban
Route::resource('/van-ban-di', VanBanDiController::class);

Route::get('/chi-tiet/{slug}',[VanBanDiController::class, 'chitiet']); 

// Route tải file
Route::get('/download-file', [VanBanDiController::class, 'downloadFile'])->name('file.download');

Route::get('/loc',[VanBanDiController::class, 'loc']); 

Route::resource('/van-ban-den', VanBanDenController::class);