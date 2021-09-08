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
            background-color: rgb(155, 155, 155);
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
            <h5>Apakah anda terbantu?</h5>
            <div class="flex flex-center">
                <button>Ya</button>
                <button>Tidak</button>
            </div>
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