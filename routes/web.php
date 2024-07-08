<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\NilaiPeformaController;
use App\Http\Controllers\NilaiSiswaController;
use App\Http\Controllers\RaporController;
use App\Http\Controllers\RaporDetailController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahsinController;
use App\Http\Controllers\UpdatePasswordController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NilaiTahsinController;
use App\Http\Controllers\PeformaController;
use App\Http\Controllers\UserController;

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
    return (redirect()->intended('login'));
});



Route::get('login', 'App\Http\Controllers\AuthController@index')->name('login');
Route::post('proses_login', 'App\Http\Controllers\AuthController@proses_login');
Route::get('logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

// Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');

Route::group(['middleware' => ['auth', 'cekleveladmin', 'sweetalert'], 'prefix' => 'admin'], function () {
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::resource('siswa', SiswaController::class);
    Route::resource('matpel', MataPelajaranController::class);
    Route::resource('rapor', RaporController::class);
    Route::resource('rapor-detail', RaporDetailController::class);
    Route::get('rapor-detail/{matpelId}/{siswaId}', [
        'as' => 'rapor-detail.destroy',
        'uses' => 'App\Http\Controllers\RaporDetailController@destroy',
    ]);

    Route::put('rapor-detail/{matpelId}/{siswaId}', [
        'as' => 'rapor-detail.update',
        'uses' => 'App\Http\Controllers\RaporDetailController@update',
    ]);

    Route::resource('nilai-siswa', NilaiSiswaController::class);
    Route::get('nilai-siswa/{matpelId}/{siswaId}', [
        'as' => 'nilai-siswa.destroy',
        'uses' => 'App\Http\Controllers\NilaiSiswaController@destroy',
    ]);
    Route::put('nilai-siswa/{matpelId}/{siswaId}', [
        'as' => 'nilai-siswa.update',
        'uses' => 'App\Http\Controllers\NilaiSiswaController@update',
    ]);

    Route::get('/send-whatsapp/{username}', [SiswaController::class, 'sendWhatsApp'])->name('send.whatsapp');

    Route::resource('tahsin', TahsinController::class);
    Route::resource('kelas', KelasController::class);
    Route::post('NilaiTahsin', [NilaiTahsinController::class, 'store'])->name('nilaiTahsin.store');

    Route::resource('peforma', PeformaController::class);
    Route::post('NilaiPefroma', [NilaiPeformaController::class, 'store'])->name('nilaiPeforma.store');

    Route::resource('users', UserController::class);
});

Route::get('/admin/rapor/check-keterangan/{nisn}', [RaporController::class, 'checkKeterangan'])->name('check-keterangan');
Route::get('/admin/rapor/check-nilai/{nisn}', [RaporController::class, 'checkNilai'])->name('check-nilai');
