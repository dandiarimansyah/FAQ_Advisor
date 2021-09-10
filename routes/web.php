<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ResponController;
use App\Http\Controllers\AuthController;



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

// PUBLIC
Route::get('/', [AdminController::class, 'index']);
Route::get('/lihat_faq/{idpertanyaan}', [PertanyaanController::class, 'tampilLihatPertanyaan']);

//Login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');

//Logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::group(['middleware' => ['auth']], function () {
    /*ADMIN FAQ*/
    Route::get('/admin/faq', [PertanyaanController::class, 'tampilPertanyaan']);
    Route::get('/admin/tambah_faq', [PertanyaanController::class, 'tampilTambahPertanyaan']);
    Route::post('/admin/tambah_faq', [PertanyaanController::class, 'tambahPertanyaan']);
    Route::get('/admin/edit_faq/{idpertanyaan}', [PertanyaanController::class, 'tampilEditPertanyaan']);
    Route::post('/admin/edit_faq/{idpertanyaan}', [PertanyaanController::class, 'editPertanyaan']);
    Route::get('/admin/hapus_faq/{idpertanyaan}', [PertanyaanController::class, 'hapusPertanyaan']);

    /*IMPORT*/
    Route::post('/admin/import_faq', [PertanyaanController::class, 'importPertanyaan']);


    /*ADMIN KATEGORI*/
    Route::get('/admin/kategori', [KategoriController::class, 'tampilKategori']);
    Route::post('/admin/kategori', [KategoriController::class, 'tambahKategori']);
    Route::post('/admin/edit_kategori/{idkategori}', [KategoriController::class, 'editKategori']);
    Route::get('/admin/hapus_kategori/{idkategori}', [KategoriController::class, 'hapusKategori']);


    /*ADMIN RESPON*/
    Route::get('/admin/respon', [ResponController::class, 'tampilRespon']);
});
