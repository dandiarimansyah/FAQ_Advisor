<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class PertanyaanController extends Controller
{
    public function tampilPertanyaan()
    {

        $pertanyaan = Pertanyaan::orderBy('updated_at', 'desc')->get();

        return view('pertanyaan', compact('pertanyaan'));
    }

    public function tampilLihatPertanyaan($idpertanyaan)
    {

        $pertanyaan = Pertanyaan::find($idpertanyaan);
        $kategori_terpilih = $pertanyaan->kategori;

        return view('pertanyaan_lihat', compact('pertanyaan', 'kategori_terpilih'));
    }

    public function tampilTambahPertanyaan()
    {

        $kategori = Kategori::all();

        return view('pertanyaan_tambah', compact('kategori'));
    }

    public function tambahPertanyaan(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);
        // dd($request->kategori);
        $pertanyaan = new Pertanyaan();
        $pertanyaan->pertanyaan = $request->pertanyaan;
        $pertanyaan->jawaban = $request->jawaban;

        // dd($pertanyaan->pengarang());
        $pertanyaan->save();
        $pertanyaan->kategori()->sync($request->kategori);
        return redirect('/pertanyaan');
    }

    public function tampilEditPertanyaan($idpertanyaan)
    {
        $pertanyaan = Pertanyaan::find($idpertanyaan);
        $kategori = Kategori::all();
        $kategori_terpilih = $pertanyaan->kategori;

        // $pivot = DB::table('faqs_kategori')->where('faqs_id', $idpertanyaan)->get();
        // $array = array();
        // foreach ($pivot as $key => $k) {
        //     $array[] = $k->kategori_id;
        // }

        // $kategories = Kategori::whereIn('id', $array)->get();

        return view('pertanyaan_edit', compact('pertanyaan', 'kategori', 'kategori_terpilih'));
    }

    public function editPertanyaan(Request $request, $idpertanyaan)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);

        // dd($request->all());

        $pertanyaan = Pertanyaan::where('id', $idpertanyaan)
            ->update([
                'pertanyaan' => $request->get('pertanyaan'),
                'jawaban' => $request->get('jawaban'),
            ]);


        $pertanyaan2 = Pertanyaan::find($idpertanyaan);
        $pertanyaan2->kategori()->sync($request->kategori);

        return redirect('/pertanyaan');
    }

    public function hapusPertanyaan($idpertanyaan)
    {
        $pertanyaan = Pertanyaan::find($idpertanyaan);
        if ($pertanyaan) {
            $pertanyaan->delete();
        }

        return back();
    }
}
