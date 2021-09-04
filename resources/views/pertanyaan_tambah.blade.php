@extends('partial')

@section('content')

    <div>
    	<h1>TAMBAH PERTANYAAN</h1>
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
                		<select id="kategori" name="kategori[]" multiple class="form-control">
                            <option disabled value="">Untuk memilih lebih dari 1 kategori, tekan dan tahan tombol ctrl lalu klik kategori</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="form-group mt-4 mb-0" style="text-align: center;">
                    <a class="btn btn-danger" href="/pertanyaan">Batal</a>
                    <button class="btn btn-success" type="submit">Simpan</button>
                </div>
            </form>
        </div> 
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    {{-- <script type="text/javascript">
     $(document).ready(function() {
        $('#kategori').select2();
     });
    </script> --}}

@endsection