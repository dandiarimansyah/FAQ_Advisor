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

        h4{
            font-size: 20px;
            color: brown
        }

        p{
            text-align: justify
        }
    </style>
@endsection

@section('content')

<a href="{{ url()->previous() }}" style="margin-left: 0" class="back">Kembali</a>

<div class="kotak">
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
    <p>{{$pertanyaan->jawaban}}</p>

    <div id="bawah" style="text-align: center">
        <h5>Apakah anda terbantu?</h5>
        <div class="flex flex-center">
            <button>Ya</button>
            <button>Tidak</button>
        </div>
    </div>
</div>

@endsection