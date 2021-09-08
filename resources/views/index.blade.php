@extends('partial')

@section('content')

    <div id="pencarian">
        <div id="atas">
            <h1>Form Pencarian</h1>
            <h1>Riwayat FAQ</h1>
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
            <div id="{{ $p->id }}" class="tampil_pertanyaan">
                <div>
                    <h5>{{ $p-> pertanyaan }}</h5>
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
                <div class="tombol-kanan">
                    <i class="fa fa-caret-right" aria-hidden="true"></i>
                </div>
            </div>

            <div id="jawaban{{ $p->id }}" class="tampil_jawaban">
                <p>
                    {!! substr($p->jawaban, 0, 250) !!}... 
                </p>
                <div id="selengkapnya">
                    <a href="{{ url('/lihat_faq/'. $p->id) }}"> Baca Selengkapnya</a>
                </div>
            </div>

        </div>
        @empty
            <h2>TIDAK ADA DATA</h2>
        @endforelse              
    </div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.tampil_jawaban').hide();
    });

    $(document).on("click",".tampil_pertanyaan", function () {
        var id = $(this).attr('id');
        console.log(id);

        // $(this).find("i").toggleClass("fa fa-caret-right fa fa-caret-down");

        if($('#jawaban'+id).is(":visible")){
            $(this).find("i").attr("class", "fa fa-caret-right");
            $('#jawaban'+id).hide(80);
        }else{
            $('.tampil_pertanyaan').find("i").attr("class", "fa fa-caret-right");
            $(this).find("i").attr("class", "fa fa-caret-down");

            $('.tampil_jawaban').hide();
            $('#jawaban'+id).show(80);
        }
    });
    
</script>   
@endpush