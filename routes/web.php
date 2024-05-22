<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DataPegawaiController;
use App\Http\Controllers\DataPelangganController;
use App\Http\Controllers\EntriPadamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
Route::controller(UserController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::get('/register', 'register');
    Route::post('/store', 'store');
    Route::post('/proseslogin', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('authenticate');
});
Route::controller(DataPelangganController::class)->group(function () {
    Route::get('/beranda', 'index')->middleware('auth');
    Route::get('/entripadam', 'entri_padam')->middleware('auth');
    Route::delete('/hapus_pelanggan', 'hapusPelanggan');
    Route::get('/updating', 'updating')->middleware('auth');
    Route::get('/updating/tambah_wanotif', 'tambah_wanotif')->middleware('auth');
    Route::get('/updating/export_excel_pelanggan', 'export_excel_pelanggan');
    Route::get('/updating/export_excel_trafo', 'export_excel_trafo');
    Route::post('/updating/import_excel', 'import_excel');
    Route::post('/updating/import_excel_trafo', 'import_excel_trafo');
    Route::post('/updating/edit_pelanggan/{id}', 'edit_pelanggan');
    Route::post('/updating/edit_trafo/{id}', 'edit_trafo');
    Route::get('/updating/hapus_pelanggan', 'hapusPelanggan');
    Route::get('/updating/hapus_trafo', 'hapusTrafo');
    Route::post('/updating/edit_unit/{id}', 'edit_unit');
    Route::post('/updating/proses_tambah_wanotif', 'proses_tambah_wanotif');
    Route::post('/updating/edit_wanotif/{id}', 'edit_wanotif');
});
Route::controller(EntriPadamController::class)->group(function () {
    Route::get('/petapadam', 'petapadam')->middleware('auth');
    Route::get('/petatrafo', 'peta_trafo')->middleware('auth');
    Route::get('/transaksihistori', 'index')->middleware('auth');
    Route::get('/transaksiaktif', 'transaksiaktif')->middleware('auth');
    Route::post('/entripadam/insertentripadam', 'insertEntriPadam');
    Route::post('/entripadam', 'insertPadam');
    Route::get('/transaksipadam/export_kali_padam', 'export_kali_padam');
    Route::get('/transaksiaktif/export_pelanggan_padam', 'export_pelanggan_padam');
    Route::get('/transaksiaktif/export_pelanggan_padam_csv', 'export_pelanggan_padam_csv');
    Route::post('/entripadam/import_excel_penyulangsection', 'import_excel_penyulangsection');
    Route::get('/transaksipadam/hapus_entri', 'hapusEntriPadam');
    Route::post('/transaksipadam/edit_status_padam', 'editStatusPadam');
});