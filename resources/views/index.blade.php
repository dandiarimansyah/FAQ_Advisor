@extends('partial')

@section('content')

    <div id="pencarian">
        <div id="atas">
            <h1>FAQ</h1>
            <h2>Frequently Asked Question</h2>
        </div>
        <div>
            <form action="">
                <div id="form_search">
                    <input id="search" type="search" placeholder="Masukkan Kata Kunci">
                    <button id="cari">CARI</button>
                </div>
            </form>
        </div>
    </div>

    <div id="kumpulan_faqs">
        @forelse ($pertanyaan as $p)
        <div id="setiap_faqs">
            <div id="tampil_pertanyaan">
                <h4>{{ $p-> pertanyaan }}</h4>
                @if ($p->kategori != null)
                    <h6>Kategori :
                        @foreach ($p->kategori as $idx => $item)
                            @if (!isset($p->kategori[$idx+1]))
                                {{$item->kategori}}      
                            @else
                                {{$item->kategori}},
                            @endif
                        @endforeach
                    </h6>
                @endif
            </div>
            <div id="tampil_jawaban">
                <p>
                    {{ substr($p->jawaban, 0, 250) }}... 
                </p>
            </div>
            <div id="selengkapnya">
                <a href="{{ url('/lihat_pertanyaan/'. $p->id) }}"> Baca Selengkapnya</a>
            </div>
        </div>
        @empty
            <h2>TIDAK ADA DATA</h2>
        @endforelse              
    </div>

@endsection