<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use App\Models\Kategori;

class AdminController extends Controller
{
    public function index()
    {
        $pertanyaan = Pertanyaan::orderBy('updated_at', 'desc')->get();

        return view('index', compact('pertanyaan'));
    }

}
