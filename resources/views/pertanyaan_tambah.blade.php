@extends('partial')

@section('style')
    <link rel="stylesheet" href="{{ asset('summernote/summernote.min.css')}}">
@endsection

@section('content')

        <h1 class="tengah">
            <strong>
                TAMBAH PERTANYAAN
            </strong>
        </h1>

        <a href="{{ url('/admin/faq') }}" class="back">Kembali</a>

        <div class="kotak kotak-mini">

            <form class="tambah-pertanyaan" method="post" action="">
                @csrf
                <div class="flex">
                	<label for="pertanyaan">Pertanyaan</label>
                	<div class="form-group mb-1">
                        <textarea class="pertanyaan" type="text" name="pertanyaan" placeholder="Masukkan Pertanyaan" value="{{ old('pertanyaan') }}" required> </textarea>
                    </div>
                </div>
                <div class="flex">
                	<label for="jawaban">Jawaban</label>
                	<div class="form-group mb-1">
                        <textarea class="jawaban" id="summernote" type="text" name="jawaban" placeholder="Masukkan Jawaban" value="{{ old('jawaban') }}" required> </textarea>
                    </div>
                </div>
                <div class="flex">
                	<label for="kategori">Kategori</label>

                    <div class="form-group">
                        <select name="kategori[]" class="mul-select" multiple="true" required>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                            @endforeach
                        </select>
                    </div> 
                </div>
                <div class="form-group mt-4 mb-0" style="text-align: center;">
                    <a class="btn btn-danger" href="/pertanyaan">Batal</a>
                    <button class="btn btn-success" type="submit">Simpan</button>
                </div>
            </form>
        </div> 

        
@endsection

@push('scripts')
    <script src="{{ asset('summernote/summernote.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#summernote').summernote({
                height: 400,
                popatmouse: true
            });
        });

        $(document).ready(function(){
            $(".mul-select").select2({
            width: "400px",
            placeholder: "Pilih Kategori",
            tags: true,
            tokenSeparators: ['/',',',';'," "] 
        });
    })
    </script>
@endpush