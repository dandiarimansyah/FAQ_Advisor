<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use App\Models\Kategori;


class PertanyaanController extends Controller
{
    public function tampilPertanyaan() {

   		$pertanyaan = Pertanyaan::all();

        return view('pertanyaan', compact('pertanyaan'));
    }

    public function tampilTambahPertanyaan() {

    	return view('pertanyaan_tambah');
    }
    public function tampilEditPertanyaan() {

    	return view('pertanyaan_edit');
    }



    public function hapusPertanyaan($idpertanyaan) {
    	$pertanyaan = Pertanyaan::find($idpertanyaan);
    	if ($pertanyaan) {
    		$pertanyaan->delete();
    	}

    	return back();
    }
}