@extends('partial')

@section('content')

    <div id="pencarian">
        <div id="atas">
            <h1>Form Pencarian</h1>
            <h1>Riwayat FAQ</h1>
        </div>
        <div>
            <form action="/" method="GET">
                @csrf
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
                        <input class="pilih_kategori" type="checkbox" id="{{ $k->id }}" name="pilih_kategori[]" value="{{ $k->id }}">
                        <label for="{{ $k->id }}">{{ $k->kategori}}</label>
                    </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>

    <div id="kumpulan_faqs">
        @if ($faq != null)
            @forelse ($faq as $p)                
                <div class="setiap_faqs" onclick="location.href='{{ url('/lihat_faq/'. $p->id) }}'">
                    <div id="{{ $p->id }}" class="tampil_pertanyaan">
                        <div class="d-flex flex-column justify-content-center" style="">
                            <h5>{{ $p-> pertanyaan }}</h5>
                            @if (!collect($p->kategori)->isEmpty())
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
                        {{-- <div class="tombol-kanan">
                            <i class="fa fa-caret-right" aria-hidden="true"></i>
                        </div> --}}
                    </div>

                    {{-- <div id="jawaban{{ $p->id }}" class="tampil_jawaban">
                        <p>
                            {!! substr($p->jawaban, 0, 450) !!}... 
                        </p>
                        <div id="selengkapnya">
                            <a href="{{ url('/lihat_faq/'. $p->id) }}"> Baca Selengkapnya</a>
                        </div>
                    </div> --}}

                </div>
            @empty
                <h2 style="color: white" class="tengah">TIDAK ADA DATA</h2>        
            @endforelse
        @endif

    </div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.tampil_jawaban').hide();
        $('.box-filter').hide();

        var pilih_kategori = {!! json_encode(request('pilih_kategori')) !!};
        
        pilih_kategori.forEach(element => {
            console.log($('#'+element+ ' .pilih_kategori'));
            $('#'+element).attr('checked',true);
        });
        
    });

    $(document).on("click",".filter", function () {
        $('.box-filter').fadeToggle(200);
    });

    // $(document).on("click",".tampil_pertanyaan", function () {
    //     var id = $(this).attr('id');

    //     if($('#jawaban'+id).is(":visible")){
    //         $(this).find("i").attr("class", "fa fa-caret-right");
    //         $('#jawaban'+id).hide(80);
    //     }else{
    //         $('.tampil_pertanyaan').find("i").attr("class", "fa fa-caret-right");
    //         $(this).find("i").attr("class", "fa fa-caret-down");

    //         $('.tampil_jawaban').hide();
    //         $('#jawaban'+id).show(80);
    //     }
    // });
    
</script>   
@endpush