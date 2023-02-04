<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BagianController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\SubkegiatanController;
use App\Http\Controllers\Admin\RekeningController;
use App\Http\Controllers\Admin\KartuController;
use App\Http\Controllers\Admin\SpjController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\DetailController;


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

// Route::get('/dashboard', function () {
//     $menu = "Dashboard";
//     return view('admin.dashboard', compact('menu'));
// });

Route::get('/dashboard', [DashboardController::class, 'index']);

// user
Route::get('user', [UserController::class, 'index'])->name('user.index');
Route::post('user', [UserController::class, 'store'])->name('user.store');
Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::delete('user/{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');


// bagian
Route::resource('bagian', BagianController::class);

// kegiatan
Route::get('kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::post('kegiatan', [KegiatanController::class, 'store'])->name('kegiatan.store');
Route::get('kegiatan/{id}/edit', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
Route::delete('kegiatan/{id}/destroy', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');


// sub-kegiatan
Route::get('kegiatan/subkegiatan/{subkegiatan}', [SubkegiatanController::class, 'index'])->name('subkegiatan.index');
Route::post('kegiatan/subkegiatan', [SubkegiatanController::class, 'store'])->name('subkegiatan.store');
Route::get('kegiatan/subkegiatan/{kegiatan_id}/{id}/edit', [SubkegiatanController::class, 'edit'])->name('subkegiatan.edit');
Route::delete('kegiatan/subkegiatan/{id}/destroy', [SubkegiatanController::class, 'destroy'])->name('subkegiatan.destroy');

// rekening
Route::get('kegiatan/rekening/{id}', [RekeningController::class, 'index'])->name('rekening.index');
Route::post('kegiatan/rekening', [RekeningController::class, 'store'])->name('rekening.store');
Route::post('kegiatan/rekening/{id}/update', [RekeningController::class, 'update'])->name('rekening.update');
Route::get('kegiatan/rekening/{subkegiatan_id}/{id}/edit', [RekeningController::class, 'edit'])->name('rekening.edit');
Route::delete('kegiatan/rekening/{id}/destroy', [RekeningController::class, 'destroy'])->name('rekening.destroy');

// detail
Route::get('kegiatan/detail/{id}', [DetailController::class, 'index'])->name('detail.index');
Route::post('kegiatan/detail', [DetailController::class, 'store'])->name('detail.store');
Route::get('kegiatan/detail/{rekening_id}/{id}/edit', [DetailController::class, 'edit'])->name('detail.edit');
Route::delete('kegiatan/detail/{id}/destroy', [DetailController::class, 'destroy'])->name('detail.destroy');

// Kartu Kendali
Route::get('kartukendali', [KartuController::class, 'index'])->name('kartukendali.index');

// SPJ
Route::get('spj', [SpjController::class, 'index'])->name('spj.index');

// Profil
Route::get('profil', [ProfilController::class, 'index'])->name('profil.index');

// Kartu Kendali
// Route::get('visi-misi', [VisiMisiController::class, 'index'])->name('visimisi.index');

// Setting
Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
Route::post('setting', [SettingController::class, 'store'])->name('setting.store');
Route::put('setting/{set}/update-schedule', [SettingController::class, 'update'])->name('setting.update');


require __DIR__ . '/front.php';
