@extends('partial')

@section('content')

    <div>
        <h1>EDIT PERTANYAAN</h1>
        <div class="card-body">
            <form method="post" action="">
                @csrf
                <a href="/pertanyaan" >Kembali</a>
                <div class="flex">
                	<label for="pertanyaan">Pertanyaan</label>
                	<div class="form-group mb-1">
                        <textarea class="form-control py-3" id="pertanyaan" type="text" name="pertanyaan" placeholder="Masukkan Pertanyaan" value="{{ old('pertanyaan') }}"> </textarea>
                    </div>
                </div>
                <div class="flex">
                	<label for="jawaban">Jawaban</label>
                	<div class="form-group mb-1">
                        <textarea class="form-control py-3" id="jawaban" type="text" name="jawaban" placeholder="Masukkan Jawaban" value="{{ old('jawaban') }}"> </textarea>
                    </div>
                </div>
                <div class="flex">
                	<label for="kategori">Kategori</label>
                	<div class="form-group mb-1">
                		<select id="kategori" name="kategori" class="form-control py-3 bk-c mb-0">
                            <option selected disabled value="">--- Pilih Kategori ---</option>
                            <option>1</option>   
                        </select>
                    </div>
                </div>
                <div class="form-group mt-4 mb-0">
                    <button class="btn btn-success" style="float: right;" type="submit">Simpan Perubahan</button>
                </div>
            </form>
        </div> 
    </div>

@endsection