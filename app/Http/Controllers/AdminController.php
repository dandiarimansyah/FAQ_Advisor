<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use App\Models\Kategori;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $pertanyaan = Pertanyaan::orderBy('updated_at', 'desc')->get();
        $kategori = Kategori::orderBy('kategori', 'asc')->get();

        $status = true;
        $faq = null;
        $pilih_kategori = $request->pilih_kategori;

        //Jika ada Kategori
        // if ($request->pilih_kategori != null) {

        //     $faq = Pertanyaan::whereHas('kategori', function ($q) use ($pilih_kategori) {
        //         $q->whereIn('kategori_id', $pilih_kategori);
        //     })->get();

        //     dd($faq);
        // }

        //Jika ada Pencarian
        if (request('search')) {
            // $faq = Pertanyaan::latest()->filter(request(['search']))->get();
            $faq = Pertanyaan::latest()->filter(request(['search']))
                ->whereHas('kategori', function ($q) use ($pilih_kategori) {
                    $q->whereIn('kategori_id', $pilih_kategori);
                })->get();

            if ($faq->count() <= 0) {
                $status = false;
            }
        }

        return view('index', compact('pertanyaan', 'kategori', 'faq', 'status'));
    }
}
