<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DataPelangganController;
use App\Http\Controllers\EntriPadamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


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
// Route::controller(AuthenticatedSessionController::class)->group(function(){
//     Route::get('/', 'create')->name('login');
//     Route::post('/store', 'store');
//     Route::get('/destroy', 'destroy');
// });
// Route::controller(RegisteredUserController::class)->group(function(){
//     Route::get('/create', 'create')->name('register');
//     Route::get('/store', 'store')->name('store');
// });
Route::controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::get('/register', 'register');
    Route::post('/store', 'store');
    Route::post('/proseslogin', 'authenticate')->name('authenticate');
    Route::post('/logout', 'logout')->name('authenticate');
});
Route::controller(DataPelangganController::class)->group(function () {
    Route::get('/beranda', 'index')->middleware('auth');
    Route::get('/entripadam', 'entri_padam')->middleware('auth');
    Route::get('/kirimwhatsapp', 'sendWhatsAppMessage');
    Route::get('/inputpelanggan', 'input_pelanggan')->middleware('auth');
    Route::get('/inputpelanggan/export_excel', 'export_excel');
    Route::post('/inputpelanggan/import_excel', 'import_excel');
    Route::get('/inputpelanggan/hapus_pelanggan', 'hapusPelanggan');
});
Route::controller(EntriPadamController::class)->group(function () {
    Route::get('/petapadam', 'petapadam')->middleware('auth');
    Route::get('/transaksipadam', 'index')->middleware('auth');
    Route::post('/entripadam/insertentripadam', 'insertEntriPadam');
    Route::post('/entripadam/import_excel_penyulangsection', 'import_excel_penyulangsection');
    Route::get('/transaksipadam/hapus_entri', 'hapusEntriPadam');
    Route::post('/transaksipadam/edit_status_padam', 'editStatusPadam');
});