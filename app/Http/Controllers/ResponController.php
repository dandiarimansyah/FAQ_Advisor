<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use App\Models\Kategori;
use App\Models\Respon;

class ResponController extends Controller
{
    public function tampilRespon()
    {
        // $respon = Respon::orderBy('updated_at', 'desc')->get();

        return view('respon');
        // return view('respon', compact('respon'));
    }
}
