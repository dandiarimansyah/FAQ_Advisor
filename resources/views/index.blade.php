@extends('partial')

@section('content')

    <div id="pencarian">
        <div id="atas">
            <h1>Form Pencarian</h1>
            <h1>Riwayat FAQ</h1>
        </div>
        <div>
            <form action="/">
                <div id="form_search">
                    <input name="search" id="search" type="search" value="{{request('search')}}" placeholder="Masukkan Kata Kunci">
                    <button type="submit" id="cari">CARI</button>
                </div>
                <div class="filter">
                    <h6>Filter Pencarian 
                        <span>
                            <i class="fa fa-angle-double-down" aria-hidden="true"></i>
                        </span>
                    </h6>
                </div>
                <div class="box-filter">
                    @foreach ($kategori as $k)
                    <div>
                        <input type="checkbox" id="{{ $k->id }}" name="pilih_kategori[]" value="{{ $k->id }}">
                        <label for="{{ $k->id }}">{{ $k->kategori}}</label>
                    </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>

    <div id="kumpulan_faqs">
        @if ($status)
            @if ($faq != null)
                @foreach ($faq as $p)                
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
                @endforeach
            @endif

        @else
            <h2 style="color: white" class="tengah">TIDAK ADA DATA</h2>        
        @endif

    </div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.tampil_jawaban').hide();
        $('.box-filter').hide();
    });

    $(document).on("click",".filter", function () {
        $('.box-filter').toggle(30);
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