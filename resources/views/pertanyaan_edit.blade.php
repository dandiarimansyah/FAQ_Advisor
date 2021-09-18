@extends('partial')

@section('style')
<style>
    .select2-container--default .select2-selection--multiple{
        height: 40px;
    }
</style>    
@endsection

@section('content')
    @php
        $array = [];
    @endphp

    @foreach ($pertanyaan->kategori as $item)
        @php
            array_push($array, $item->id);
        @endphp
    @endforeach


    <h1 class="judul-section tengah">
        <strong>
            EDIT PERTANYAAN
        </strong>
    </h1>

    <a href="{{ url('/admin/faq') }}" class="back">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>
        <span class="ml-2">Kembali</span>
    </a>

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
            <div class="flex mt-2">
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

    <script>
        
        $(document).ready(function(){
            $(".mul-select").select2({
                width: "400px",
                placeholder: "Pilih Kategori",
                tokenSeparators: ['/',',',';'," "] 
            });

            var data = [];
            var data = {!!json_encode($array)!!};

            console.log(data);

            $(".mul-select").val(data);
            $(".mul-select").trigger('change');

        })
    </script>

@endpush
