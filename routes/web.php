<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\BagianController;
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

Route::get('/', function () {
    return view('admin.dashboard');
});

// user
Route::get('user', function () {
    return view('admin.user.data');
});

// bagian
Route::get('bagian', [BagianController::class, 'index'])->name('bagian.index');

// kegiatan
Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');

// sub-kegiatan
Route::get('sub-kegiatan', function () {
    return view('admin.sub-kegiatan.data');
});

// rekening
Route::get('rekening', function () {
    return view('admin.rekening.data');
});
// setting
Route::get('setting', function () {
    return view('admin.setting.data');
});
