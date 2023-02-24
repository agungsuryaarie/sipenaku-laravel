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
use App\Http\Controllers\Admin\AppSettingController;
use App\Http\Controllers\Admin\DetailController;
use App\Http\Controllers\Auth\AuthController;

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

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login')->middleware('guest');
    Route::post('login', 'login')->middleware('guest');
    Route::get('logout', 'logout')->name('logout');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // my profil
    Route::get('my-profil', [UserController::class, 'myprofil'])->name('myprofil.index');
    Route::put('my-profil/{user}/update', [UserController::class, 'updateprofil'])->name('myprofil.update');
    Route::put('my-profil/{user}/update-password', [UserController::class, 'updatepass'])->name('myprofil.update.password');
    Route::put('my-profil/{user}/update-foto', [UserController::class, 'updatefoto'])->name('myprofil.update.foto');
    Route::group(['middleware' => ['checkUser:1']], function () {
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
        Route::get('kartu-kendali', [KartuController::class, 'index'])->name('kartukendali.index');
        // SPJ Admin Verifikasi
        Route::get('spj/verifikasi', [SpjController::class, 'verifikasi'])->name('spj.verifikasi');
        Route::get('spj/{spj}/verify', [SpjController::class, 'verify'])->name('spj.verify');
        Route::post('spj/decline/{spj}', [SpjController::class, 'tolak'])->name('spj.decline');
        Route::get('spj/diterima', [SpjController::class, 'diterima'])->name('spj.diterima');
        Route::get('spj/ditolak', [SpjController::class, 'ditolak'])->name('spj.ditolak');
        Route::delete('spj/destroyed/{spj}', [SpjController::class, 'destroy'])->name('spj.destroyed');
        Route::post('spj/terima/{id}', [SpjController::class, 'terima'])->name('spj.terima');
        Route::post('spj/kembalikan/{spj}', [SpjController::class, 'kembalikan'])->name('spj.kembalikan');
        Route::get('spj/{spj}/view', [SpjController::class, 'show'])->name('spj.view');
        //app-Setting
        Route::get('app-setting', [AppSettingController::class, 'index'])->name('appsetting.index');
        Route::get('app-setting/create', [AppSettingController::class, 'create'])->name('appsetting.create');
        Route::post('app-setting', [AppSettingController::class, 'store'])->name('appsetting.store');
        Route::get('app-setting/{appsetting}/edit', [AppSettingController::class, 'edit'])->name('appsetting.edit');
        Route::put('app-setting/{appsetting}/update', [AppSettingController::class, 'update'])->name('appsetting.update');
        // Setting
        Route::get('setting', [SettingController::class, 'index'])->name('setting.index');
        Route::post('setting', [SettingController::class, 'store'])->name('setting.store');
        Route::put('setting/{set}/update-schedule', [SettingController::class, 'update'])->name('setting.update');
    });
    Route::group(['middleware' => ['checkUser:2']], function () {
        // SPJ
        Route::get('spj', [SpjController::class, 'index'])->name('spj.index');
        Route::get('spj/terima', [SpjController::class, 'diterima'])->name('spj.terima');
        Route::get('spj/tolak', [SpjController::class, 'ditolak'])->name('spj.tolak');
        Route::get('spj/create', [SpjController::class, 'create'])->name('spj.create');
        Route::post('spj/getsubkeg', [SpjController::class, 'getSubkeg'])->name('spj.getsubkeg');
        Route::post('spj/getrekening', [SpjController::class, 'getRekening'])->name('spj.getrekening');
        Route::post('spj/store', [SpjController::class, 'store'])->name('spj.store');
        Route::delete('spj/destroy/{spj}', [SpjController::class, 'destroy'])->name('spj.destroy');
        Route::get('spj/{id}/edit', [SpjController::class, 'edit'])->name('spj.edit');
        Route::put('spj/{id}/update', [SpjController::class, 'update'])->name('spj.update');
        Route::get('spj/{id}/show', [SpjController::class, 'show'])->name('spj.show');
        Route::post('spj/kirim/{spj}', [SpjController::class, 'kirim'])->name('spj.kirim');
        // Kartu Kendali
        Route::get('kartu-kendali-detail', [KartuController::class, 'kegiatan'])->name('kartukendali.kegiatan');
        Route::get('kartu-kendali-detail/{id}/sub-kegiatan', [KartuController::class, 'subkeg'])->name('kartukendali.subkeg');
        Route::get('kartu-kendali-detail/{id}/rekening', [KartuController::class, 'rek'])->name('kartukendali.rek');
    });
});

require __DIR__ . '/front.php';
