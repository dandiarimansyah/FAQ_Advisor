@extends('partial')

@section('style')
<style>
    .select2-container--default .select2-selection--multiple{
        height: 40px;
    }
</style>    
@endsection

@section('content')

        <h1 class="judul-section tengah">
            <strong>
                TAMBAH PERTANYAAN
            </strong>
        </h1>

        <a href="{{ url('/admin/faq') }}" class="back">
            <i class="fa fa-arrow-left" aria-hidden="true"></i>
            <span class="ml-2">Kembali</span>
        </a>

        <div class="kotak kotak-mini">
            <form class="tambah-pertanyaan" method="post" action="">
                @csrf
                <div class="flex flex-column flex-wrap form-faq" style="gap:0">
                    <label for="pertanyaan">Pertanyaan</label>
                    <div class="input">
                        <textarea class="pertanyaan" type="text" name="pertanyaan" placeholder="Masukkan Pertanyaan" value="{{ old('pertanyaan') }}" required> </textarea>
                    </div>
    
                    <label for="jawaban">Jawaban</label>
                    <div class="setiap-input" id="answer">
                        <textarea class="jawaban" id="summernote" type="text" name="jawaban" placeholder="Masukkan Jawaban" value="{{ old('jawaban') }}" required> </textarea>
                    </div>
    
                    <label for="kategori">Kategori</label>
                    <div class="input">
                        <select name="kategori[]" class="mul-select" multiple="true">
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

    <script>
        $(document).ready(function(){
            $(".mul-select").select2({
            width: "400px",
            placeholder: "Pilih Kategori",
            tokenSeparators: ['/',',',';'," "] 
        });

        $(document).ready(function(){
            $('#summernote').summernote({
                height: 400,
                popatmouse: true
            });
        });
    })
    </script>
@endpush