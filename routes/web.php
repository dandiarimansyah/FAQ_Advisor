<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\KategoriController;



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

Route::get('/', [AdminController::class, 'index']);

/*PERTANYAAN*/
Route::get('/pertanyaan', [PertanyaanController::class, 'tampilPertanyaan']);
Route::get('/tambah_pertanyaan', [PertanyaanController::class, 'tampilTambahPertanyaan']);
Route::get('/edit_pertanyaan', [PertanyaanController::class, 'tampilEditPertanyaan']);
Route::get('/hapus_pertanyaan/{idpertanyaan}', [PertanyaanController::class, 'hapusPertanyaan']);


/*KATEGORI*/
Route::get('/kategori', [KategoriController::class, 'tampilKategori']);
Route::post('/kategori', [KategoriController::class, 'tambahKategori']);
Route::post('/edit_kategori/{idkategori}', [KategoriController::class, 'editKategori']);
Route::get('/hapus_kategori/{idkategori}', [KategoriController::class, 'hapusKategori']);