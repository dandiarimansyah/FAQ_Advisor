@extends('partial')

@section('style')
    <link rel="stylesheet" href="{{ asset('summernote/summernote.min.css')}}">
@endsection

@section('content')

    <h1 class="tengah">
        <strong>
            EDIT PERTANYAAN
        </strong>
    </h1>

    <a href="{{ url('/admin/faq') }}" class="back">Kembali</a>

    <div class="kotak kotak-mini">
        <form class="tambah-pertanyaan" method="post" action="">
            @csrf
            <div class="flex">
                <label for="pertanyaan">Pertanyaan</label>
                <div class="form-group mb-1">
                    <textarea class="pertanyaan" type="text" name="pertanyaan" placeholder="Masukkan Pertanyaan" value="">{{ $pertanyaan->pertanyaan }}</textarea>
                </div>
            </div>
            <div class="flex">
                <label for="jawaban">Jawaban</label>
                <div class="form-group mb-1">
                    <textarea class="jawaban" id="summernote" type="text" name="jawaban" placeholder="Masukkan Jawaban" value="">{{ $pertanyaan->jawaban }}</textarea>
                </div>
            </div>
            <div class="flex">
                <label for="kategori">Kategori</label>
                <div class="form-group mb-1">
                    <select id="kategori" name="kategori[]" class="mul-select" multiple="true">
                        @foreach ($kategori as $k)
                            <option id="{{ $k->id }}" class="pilih_kategori" value="{{ $k->id }}">{{ $k->kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group mt-4 mb-0" style="text-align: center;">
                <button class="btn btn-success" type="submit">Simpan Perubahan</button>
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

            $('.mul-select').select2('data', {id: '123', text: 'res_data.primary_email'});

        })
    </script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            var kategori_terpilih = {!!json_encode($kategori_terpilih)!!};
            
            kategori_terpilih.forEach(function(item){
                $('#kategori option').filter(function(){
                    return ($(this).val() == item['id'])
                }).prop('selected', true);
            })

        });
    </script>
@endpush
