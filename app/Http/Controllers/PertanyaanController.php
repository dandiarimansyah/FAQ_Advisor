<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pertanyaan;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FaqImport;
use App\Models\Komen;
use Illuminate\Support\Facades\File;

use App\Exports\TemplateExport;
use App\Exports\KategoriExport;

use Path\To\DOMDocument;
use Intervention\Image\ImageManagerStatic as Image;

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
        $komen = Komen::where('id_faqs', $idpertanyaan)->get();

        $pertanyaan_terkait = Pertanyaan::latest()->where('id', '<>', $idpertanyaan)
            ->whereHas('kategori', function ($q) use ($kategori_terpilih) {
                $q->whereIn('kategori_id', $kategori_terpilih);
            })->take(20)->get();

        return view('pertanyaan_lihat', compact('pertanyaan', 'kategori_terpilih', 'komen', 'pertanyaan_terkait'));
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

        $pertanyaan = new Pertanyaan();
        $pertanyaan->pertanyaan = $request->pertanyaan;
        $pertanyaan->jawaban = 'sementara';
        // $pertanyaan->jawaban = $dom->saveHTML();
        $pertanyaan->save();
        $id_new = $pertanyaan->id;

        $pertanyaan->kategori()->sync($request->kategori);


        //Upload Image Summernote
        $storage = "storage/Images/" . $id_new;

        $path = public_path($storage);
        File::makeDirectory($path, $mode = 0777, true, true);

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->jawaban, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();

                $filepath = ("$storage/$fileNameContentRand.$mimetype");
                // dd($filepath);

                $image = Image::make($src)
                    ->encode($mimetype, 100)
                    ->save(public_path($filepath));

                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        $ubah = Pertanyaan::where('id', $id_new)
            ->update([
                'jawaban' => $dom->saveHTML(),
            ]);

        return redirect('/admin/faq')->with("tertambah", "Berhasil Dihapus");
    }

    public function tampilEditPertanyaan($idpertanyaan)
    {
        $pertanyaan = Pertanyaan::find($idpertanyaan);
        $kategori = Kategori::all();

        return view('pertanyaan_edit', compact('pertanyaan', 'kategori'));
    }

    public function editPertanyaan(Request $request, $idpertanyaan)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);

        //Upload Image Summernote
        // $storage = "storage/content";
        $storage = "storage/Images/" . $idpertanyaan;

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->jawaban, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();

                $filepath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)
                    ->encode($mimetype, 100)
                    ->save(public_path($filepath));

                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-responsive');
            }
        }

        $pertanyaan = Pertanyaan::where('id', $idpertanyaan)
            ->update([
                'pertanyaan' => $request->get('pertanyaan'),
                'jawaban' => $dom->saveHTML(),
                // 'jawaban' => $request->get('jawaban'),
            ]);

        $pertanyaan2 = Pertanyaan::find($idpertanyaan);
        $pertanyaan2->kategori()->sync($request->kategori);

        return redirect('/admin/faq')->with("update", "Berhasil Dihapus");
    }

    public function hapusPertanyaan($idpertanyaan)
    {
        $pertanyaan = Pertanyaan::find($idpertanyaan);
        $path = public_path('storage/Images/' . $idpertanyaan);

        if ($pertanyaan) {
            if (File::exists($path)) {
                File::deleteDirectory($path);
            }
            $pertanyaan->delete();
        }

        return back()->with("terhapus", "Berhasil Dihapus");
    }


    //IMPORT S 1
    public function importPertanyaan(Request $request)
    {
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('File Import', $namaFile);

        Excel::import(new FaqImport, public_path('/File Import/' . $namaFile));
        File::delete(public_path('/File Import/' . $namaFile));

        return redirect('/admin/faq')->with('toast_success', 'Import Data Berhasil!');
    }


    //EXPORT
    public function template_excel()
    {
        return (new TemplateExport())->download('Template Export.xlsx');
    }
}
