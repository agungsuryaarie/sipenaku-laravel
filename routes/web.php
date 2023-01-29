<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\SubkegiatanController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\DetailController;

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
    $menu = "Dashboard";
    return view('admin.dashboard', compact('menu'));
});

// user
Route::get('user', [UserController::class, 'index'])->name('user.index');

// bagian
Route::resource('bagian', BagianController::class);

// kegiatan
Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::post('kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');
Route::get('kegiatan/{id}/edit', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
Route::delete('kegiatan/{id}/destroy', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');


// sub-kegiatan
Route::get('kegiatan/subkegiatan/{id}', [SubkegiatanController::class, 'index'])->name('subkegiatan.index');
Route::post('kegiatan/subkegiatan', [SubkegiatanController::class, 'store'])->name('subkegiatan.store');
Route::get('kegiatan/subkegiatan/{kegiatan_id}/{id}/edit', [SubkegiatanController::class, 'edit'])->name('subkegiatan.edit');
Route::delete('kegiatan/subkegiatan/{id}/destroy', [SubkegiatanController::class, 'destroy'])->name('subkegiatan.destroy');

// rekening
Route::get('kegiatan/rekening/{id}', [RekeningController::class, 'index'])->name('rekening.index');
Route::post('kegiatan/rekening', [RekeningController::class, 'store'])->name('rekening.store');
Route::get('kegiatan/rekening//{subkeg_id}/{id}/edit', [RekeningController::class, 'edit'])->name('rekening.edit');
Route::delete('kegiatan/rekening/{id}/destroy', [RekeningController::class, 'destroy'])->name('rekening.destroy');

// detail
Route::get('kegiatan/detail/{id}', [DetailController::class, 'index'])->name('detail.index');
Route::post('kegiatan/detail', [DetailController::class, 'store'])->name('detail.store');
Route::get('kegiatan/detail/{id}/edit', [DetailController::class, 'edit'])->name('detail.edit');
Route::delete('kegiatan/detail/{id}/destroy', [DetailController::class, 'destroy'])->name('detail.destroy');

// setting
Route::get('setting', function () {
    $menu = "Sub Kegiatan";
    return view('admin.setting.data', compact('menu'));
});
