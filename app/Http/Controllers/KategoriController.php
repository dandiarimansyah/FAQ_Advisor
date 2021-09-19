<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
	public function tampilKategori()
	{
		// SELECT * FROM Kategori
		$kategori = Kategori::orderBy('created_at', 'desc')->get();

		return view('kategori', compact('kategori'));
	}

	public function tambahKategori(Request $request)
	{
		$request->validate([
			'kategori' => 'required|unique:App\Models\Kategori,kategori',
		]);

		$kategori = new Kategori();
		$kategori->kategori = $request->kategori;
		$kategori->save();

		return back();
	}

	public function editKategori(Request $request, $idkategori)
	{

		$request->validate([
			'kategori' => 'required|unique:App\Models\Kategori,kategori,' . $idkategori,
		]);
		$kategori = Kategori::where('id', $idkategori)
			->update([
				'kategori' => $request->get('kategori'),
			]);
		return redirect('/admin/kategori');
	}

	public function hapusKategori($idkategori)
	{
		$kategori = Kategori::find($idkategori);
		if ($kategori) {
			$kategori->delete();
		}

		return back();
	}
}
