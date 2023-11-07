<?php

use App\Http\Controllers\DataPelangganController;
use App\Http\Controllers\EntriPadamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [UserController::class, ('index')]);
Route::get('/beranda', [DataPelangganController::class, ('index')]);
Route::get('/petapadam', [EntriPadamController::class, ('index')]);
Route::get('/entripadam', [DataPelangganController::class, ('entri_padam')]);
Route::get('/inputpelanggan', [DataPelangganController::class, ('input_pelanggan')]);
Route::get('/inputpelanggan/export_excel', [DataPelangganController::class, ('export_excel')]);
Route::post('/inputpelanggan/import_excel', [DataPelangganController::class, ('import_excel')]);
Route::get('/inputpelanggan/hapus_pelanggan', [DataPelangganController::class, ('hapusPelanggan')]);
Route::post('/entripadam/insertentripadam', [EntriPadamController::class, ('insertEntriPadam')]);