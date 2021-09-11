<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use App\Models\Kategori;
use App\Models\Respon;
use App\Models\Komen;

use Illuminate\Support\Facades\Validator;

class ResponController extends Controller
{
    public function tampilRespon()
    {
        $pertanyaan = Pertanyaan::orderBy('like', 'desc')->get();

        // return view('respon');
        return view('respon', compact('pertanyaan'));
    }

    public function like($id)
    {
        $pertanyaan = Pertanyaan::find($id);

        $like = $pertanyaan->like + 1;
        $poin = $pertanyaan->poin + 1;

        if ($pertanyaan) {
            $pertanyaan->like = $like;
            $pertanyaan->poin = $poin;

            $pertanyaan->update();
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil Like'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada Pertanyaan'
            ]);
        }
    }

    public function dislike($id)
    {
        $pertanyaan = Pertanyaan::find($id);

        $dislike = $pertanyaan->dislike + 1;
        $poin = $pertanyaan->poin - 1;

        if ($pertanyaan) {
            $pertanyaan->dislike = $dislike;
            $pertanyaan->poin = $poin;

            $pertanyaan->update();
            return response()->json([
                'status' => 200,
                'message' => 'Berhasil Dislike'
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Tidak ada Pertanyaan'
            ]);
        }
    }

    public function komen($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'komentar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        } else {
            $pertanyaan = Pertanyaan::find($id);
            $jml_komen = $pertanyaan->jml_komen + 1;
            $pertanyaan->jml_komen = $jml_komen;
            $pertanyaan->update();

            $komen = new Komen;
            $komen->id_faqs = $id;
            $komen->komentar = $request->input('komentar');
            $komen->save();

            return response()->json([
                'status' => 200,
                'message' => 'Berhasil Komentar'
            ]);
        }
    }
}
