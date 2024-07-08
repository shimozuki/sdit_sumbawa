<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MobileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', [MobileController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/hafalan', [MobileController::class, 'hafalan']);
    Route::post('/list_siswa', [MobileController::class, 'list_siswa']);
    Route::get('/download-rapot', [MobileController::class, 'showRapot']);
    Route::post('/kelas', [MobileController::class, 'kelas']);
});
