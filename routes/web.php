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

Route::post('/home',[AdminController::class, 'dangnhap']); 

// Route cho phần quản lý văn bản
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



