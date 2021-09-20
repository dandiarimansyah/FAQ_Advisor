<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use App\Models\Kategori;

class PencarianController extends Controller
{
    public function index(Request $request)
    {
        $pertanyaan = Pertanyaan::orderBy('updated_at', 'desc')->get();
        $kategori = Kategori::orderBy('kategori', 'asc')->get();

        $status = true;
        $faq = null;

        if (request('pilih_kategori')) {
            $pilih_kategori = $request->pilih_kategori;

            $faq = Pertanyaan::whereHas('kategori', function ($q) use ($pilih_kategori) {
                $q->whereIn('kategori_id', $pilih_kategori);
            });

            if (request('search')) {
                $faq = $faq->filter(request(['search']));

                if ($faq->count() <= 0) {
                    $status = false;
                }
            }
            $faq = $faq->take(15)->orderBy('like', 'desc')->get();
        } else if (request('search')) {
            $faq = Pertanyaan::filter(request(['search']))->take(15)->orderBy('like', 'desc')->get();

            if ($faq->count() <= 0) {
                $status = false;
            }
        }

        return view('index', compact('pertanyaan', 'kategori', 'faq', 'status'));
    }
}
