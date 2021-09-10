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
        $kategori = Kategori::orderBy('kategori', 'asc')->get();

        $status = true;
        $faq = null;

        if (request('search')) {

            $faq = Pertanyaan::latest();

            if (request('pilih_kategori')) {
                // where kategori adalah pilih_kategori
                // $faq = Pertanyaan::whereIn('kategori_id', 'pilih_kategori')->get();
                // dd($faq);
            }

            $faq->where('pertanyaan', 'like', '%' . request('search') . '%')
                ->orWhere('jawaban', 'like', '%' . request('search') . '%');


            $faq = $faq->get();

            if ($faq->count() == 0) {
                $faq = Pertanyaan::latest();
                $status = false;
            }
        }


        return view('index', compact('pertanyaan', 'kategori', 'faq', 'status'));
    }
}
