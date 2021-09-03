<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function pertanyaan()
    {
        return view('pertanyaan');
    }

    public function kategori()
    {
        return view('kategori');
    }
}
