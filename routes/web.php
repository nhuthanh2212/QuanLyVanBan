<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoaiVanBanController;

use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VanBanDiController;
use App\Http\Controllers\VanBanDenController;

use App\Http\Controllers\KhoiController;
use App\Http\Controllers\DonViController;
use App\Http\Controllers\PhongBanController;
use App\Http\Controllers\PhongController;
use App\Http\Controllers\NganhController;
use App\Http\Controllers\ChuyenNganhController;


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


Route::prefix('van-ban')->group(function () {
    //quản lý van ban
    Route::resource('/van-ban-di', VanBanDiController::class);
    
    Route::post('/check-noi-nhan', [VanBanDiController::class, 'check_noinhan']);
});
// Route cho phần quản lý 
Route::prefix('manager')->group(function () {
    

    Route::resource('/loai-van-ban', LoaiVanBanController::class);

    Route::get('/noi-nhan-loai-van-ban', [LoaiVanBanController::class, 'nhan_theo_loaiVB']);

    Route::get('/noi-nhan-loai-van-ban/createe', [LoaiVanBanController::class, 'createe']);

    Route::post('/insert', [LoaiVanBanController::class, 'insert']);

    Route::get('/noi-nhan-loai-van-ban/edite/{id}', [LoaiVanBanController::class, 'edite']);

    Route::delete('/noi-nhan-loai-van-ban/delete/{id}', [LoaiVanBanController::class, 'delete']);

    Route::POST('/updatee/{id}', [LoaiVanBanController::class, 'updatee']);

    Route::resource('/khoi', KhoiController::class);

    Route::resource('/phong-ban', PhongBanController::class);

    Route::resource('/don-vi', DonViController::class);

    Route::resource('/phong', PhongController::class);

    Route::resource('/nganh', NganhController::class);

    Route::resource('/chuyen-nganh', ChuyenNganhController::class);

    Route::resource('/chuc-vu', ChucVuController::class);

    

    Route::resource('/user', UserController::class);

    // group thanh vien
    Route::get('/group', [UserController::class, 'add_group']);

    Route::post('/select-group', [UserController::class, 'select_group']);
    Route::post('/insert-group', [UserController::class, 'insert_group']);
    Route::post('/list-group', [UserController::class, 'list_group']);

    // Các route khác ở đây
});




Route::get('/profile/{slug}',[UserController::class, 'profile']); 



Route::get('/chi-tiet/{id}',[VanBanDiController::class, 'chitiet']); 

// Route tải file
Route::get('/download-file', [VanBanDiController::class, 'downloadFile'])->name('file.download');

Route::get('/loc',[VanBanDiController::class, 'loc']); 

Route::resource('/van-ban-den', VanBanDenController::class);