@extends('partial')

@section('style')
    <style>
        #judul{
            margin-bottom: 20px;
            border-bottom: 2px solid black;
        }
        h2{
            font-size: 32px;
            font-weight: 650;
        }

        h3{
            font-size: 20px;
            color: brown
        }

        p{
            text-align: justify
        }
        .konten{
            display: flex;
            gap: 20px;
            height: 100%;
        }

        .kiri{
            width: 80%;
        }

        .kanan{
            width: 20%;
        }

        ul{
            padding: 0;
            list-style: none;
            margin-left: 10px;
        }

        button{
            cursor: pointer;
        }

        button:hover{
            color: rgb(255, 255, 255);
            transform: scale(1.1);
            font-weight: 600;
        }

        .ya{
            background-color: rgb(0, 163, 14);
            color: white;
        }

        .tidak{
            background-color: rgb(255, 38, 38);
            color: white;
        }

        .saran{
            width: 500px;
            padding: 10px;
        }

    </style>
@endsection

@section('content')

<a href="{{ url()->previous() }}" style="margin-left: 0" class="back">
    <i class="fa fa-arrow-left" aria-hidden="true"></i>
    <span class="ml-2">Kembali</span>
</a>

<div class="konten">
    
    <div class="kotak kiri">
        <div id="judul">
            <h2>{{$pertanyaan->pertanyaan}}</h2>
            
            @if ($kategori_terpilih != null)
            <h4>Kategori :
                @foreach ($kategori_terpilih as $idx => $item)
                    @if (!isset($kategori_terpilih[$idx+1]))
                        {{$item->kategori}}      
                    @else
                        {{$item->kategori}},
                    @endif
                    
                @endforeach
            </h4>
            @endif
        </div>
        <p>{!!$pertanyaan->jawaban!!}</p>

        <div id="bawah" style="text-align: center">
            <h5>Jawaban sesuai dengan yang anda cari?</h5>
            <div class="flex flex-center">
                <button class="terjawab ya">Ya</button>
                <button class="terjawab tidak">Tidak</button>
            </div>
        </div>

        <div class="thank tengah mt-2">
            <h4 style="color: blue">Terima Kasih!</h4>
        </div>

        <div class="tengah" id="kotak-saran">
            <form action="">
                @csrf
                <h4 for="">Jika ada saran atau kritik, <br> Silahkan tulis di bawah ini</h4>
                <textarea class="saran" name="masukan" id="" cols="30" rows="10"></textarea>
                <div>
                    <button class="ya" type="submit">Kirim</button>
                </div>
            </form>
        </div>

    </div>

    <div class="kotak kanan">
        <h5>Referensi Pertanyaan</h5>
        <ul>
            <li>1. Ini dia pertanyaan</li>
            <li>2. Ini dia pertanyaan</li>
            <li>3. Ini dia pertanyaan</li>
            <li>4. Ini dia pertanyaan</li>
            <li>5. Ini dia pertanyaan</li>
        </ul>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#kotak-saran').hide();
        $('.thank').hide();
    });

    $(document).on("click",".terjawab", function () {
        $('#bawah').hide();
        $('.thank').fadeIn(800);
        $('.thank').fadeOut(800);

        setTimeout(function () {
            $('#kotak-saran').fadeIn(1200);
        }, 1500);
    });

</script>
    
@endpush