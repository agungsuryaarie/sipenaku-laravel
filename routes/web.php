<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\SubkegiatanController;

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
Route::get('user', [UserController::class, 'index'])->name('user.index');

// bagian
Route::resource('bagian', BagianController::class);

// kegiatan
Route::resource('kegiatan', KegiatanController::class);

// sub-kegiatan
Route::get('sub-kegiatan', function () {
    $menu = "Sub Kegiatan";
    return view('admin.sub-kegiatan.data', compact('menu'));
});

Route::get('subkegiatan/{id}', [SubkegiatanController::class, 'index'])->name('subkegiatan.index');

// rekening
Route::get('rekening', function () {
    return view('admin.rekening.data');
});

// setting
Route::get('setting', function () {
    return view('admin.setting.data');
});
