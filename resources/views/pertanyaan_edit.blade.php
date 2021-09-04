@extends('partial')

@section('content')

    <h1 class="tengah">
        <strong>
            EDIT PERTANYAAN
        </strong>
    </h1>

    <a href="/pertanyaan" class="back">Kembali</a>

    <div class="kotak kotak-mini">
        <form class="tambah-pertanyaan" method="post" action="">
            @csrf
            <div class="flex">
                <label for="pertanyaan">Pertanyaan</label>
                <div class="form-group mb-1">
                    <textarea id="pertanyaan" type="text" name="pertanyaan" placeholder="Masukkan Pertanyaan" value=""> {{ $pertanyaan->pertanyaan }} </textarea>
                </div>
            </div>
            <div class="flex">
                <label for="jawaban">Jawaban</label>
                <div class="form-group mb-1">
                    <textarea id="jawaban" type="text" name="jawaban" placeholder="Masukkan Jawaban" value=""> {{ $pertanyaan->jawaban }} </textarea>
                </div>
            </div>
            <div class="flex">
                <label for="kategori">Kategori</label>
                <div class="form-group mb-1">
                    <select id="kategori" name="kategori[]" multiple style="width: 100%">
                        <option disabled value="">--- Untuk memilih lebih dari 1 kategori, tekan dan tahan tombol ctrl lalu klik kategori ---</option>
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
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            var namaka = {!!json_encode($namaka)!!};
            var semuakategori = {!!json_encode($semuakategori)!!};
            var array = [];
            semuakategori.forEach(function(item){
                array.push(item['id']);
            })
            console.log(array);

            let kategori = $(this).data('kategori');

            $('#kategori option').filter(function(){
                return ($(this).val() == array)
                }).prop('selected', true);

            semuapengarang.forEach(function(item){
                $('.pilih_kategori[id='+ item["id"] + ']').attr("selected", true);
            });
        });
    </script>
@endsection