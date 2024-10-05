<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoaiVanBanController;
use App\Http\Controllers\DonViCapCaoController;
use App\Http\Controllers\TruongController;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\TrungTamController;
use App\Http\Controllers\hanhChinhController;





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
Route::resource('/quan-ly-van-ban', LoaiVanBanController::class);

Route::resource('/loai-van-ban', LoaiVanBanController::class);

Route::resource('/don-vi-cap-cao', DonViCapCaoController::class);

Route::resource('/truong', TruongController::class);

Route::resource('/trung-tam', TrungtamController::class);

Route::resource('/hanh-chinh', HanhChinhController::class);


Route::resource('/khoa', KhoaController::class);

