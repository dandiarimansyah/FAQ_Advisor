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
    <center>
        <div id="kumpulan_faqs">
            @forelse ($pertanyaan as $p)
                <div id="tampil_pertanyaan">
                    <h4>{{ $p-> pertanyaan }}</h4>
                </div>
                <div id="tampil_jawaban">
                    @if ($p->kategori != null)
                        <p>Kategori :
                                @foreach ($p->kategori as $idx => $item)
                                    @if (!isset($p->kategori[$idx+1]))
                                        {{$item->kategori}}      
                                    @else
                                        {{$item->kategori}},
                                    @endif
                                @endforeach
                            <br>
                            {{ substr($p->jawaban, 0, 250) }}... <a href="{{ url('/lihat_pertanyaan/'. $p->id) }}"> Baca Selengkapnya</a>
                        </p>
                    @endif
                </div>
            @empty
                <h2>TIDAK ADA DATA</h2>
            @endforelse              
        </div>
    </center>

@endsection