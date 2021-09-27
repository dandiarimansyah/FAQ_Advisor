<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ResponController;
use App\Http\Controllers\AuthController;


// PUBLIC
Route::get('/', [PencarianController::class, 'index']);
Route::get('/lihat_faq/{idpertanyaan}', [PertanyaanController::class, 'tampilLihatPertanyaan']);
Route::post('/like/{id}', [ResponController::class, 'like']);
Route::post('/dislike/{id}', [ResponController::class, 'dislike']);
Route::post('/komen/{id}', [ResponController::class, 'komen']);

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

    /*EXPORT*/
    Route::get('/admin/template_excel', [PertanyaanController::class, 'template_excel']);


    /*ADMIN KATEGORI*/
    Route::get('/admin/kategori', [KategoriController::class, 'tampilKategori']);
    Route::post('/admin/kategori', [KategoriController::class, 'tambahKategori']);
    Route::post('/admin/edit_kategori/{idkategori}', [KategoriController::class, 'editKategori']);
    Route::get('/admin/hapus_kategori/{idkategori}', [KategoriController::class, 'hapusKategori']);


    /*ADMIN RESPON*/
    Route::get('/admin/respon', [ResponController::class, 'tampilRespon']);
});
