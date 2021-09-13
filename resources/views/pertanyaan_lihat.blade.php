@extends('partial')

@section('style')
    <style>
        .judul{
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
        h6{
            margin: 4px;
            font-weight: bold;
            /* font-style: italic; */
            color: rgba(0, 85, 85, 0.726);
        }

        h6 i{
            margin-right: 5px;
        }

        p{
            text-align: justify
        }

        .komen{
            margin: 0;
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

        ol{
            padding: 0;
            margin-left: 18px;
        }

        li{
            margin-bottom: 5px;
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
        <div class="judul">
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

        @guest
            
            <div id="bawah" style="text-align: center">
                <h5>Jawaban sesuai dengan yang anda cari?</h5>
                <div class="flex flex-center">
                    <form id="like" method="POST" action="{{ url('/like/'. $pertanyaan->id) }}">
                        @csrf
                        <button type="submit" class="terjawab ya">Ya</button>
                    </form>

                    <form id="dislike" method="POST" action="{{ url('/dislike/'. $pertanyaan->id) }}">
                        @csrf
                        <button type="submit" class="terjawab tidak">Tidak</button>
                    </form>
                </div>
            </div>

            <div class="thank tengah mt-2">
                <h4 style="color: blue">Terima Kasih!</h4>
            </div>

            <div class="tengah" id="kotak-saran">
                <form id="komen" method="POST" action="{{ url('/komen/'. $pertanyaan->id) }}">
                    @csrf
                    <h4 for="">Jika ada saran atau kritik, <br> Silahkan tulis di bawah ini</h4>
                    <textarea class="saran" name="masukan" id="" cols="30" rows="10"></textarea>
                    <div>
                        <button class="ya" type="submit">Kirim</button>
                    </div>
                </form>
            </div>
        @endguest

        @auth
            <div class="judul mt-5">
                <h2>Komentar</h2>
            </div>

            @foreach ($komen as $k)
                <div class="flex">
                    <p>{{ $loop->iteration }}.</p>
                    <div class="mb-4">
                        <p class="komen">{{ $k->komentar }}</p>
                        <h6>
                            <i class="fa fa-calendar-o" aria-hidden="true"></i>
                            {{ \Carbon\Carbon::parse($k->updated_at)->format('d-m-Y') }}
                        </h6>
                    </div>
                </div>
            @endforeach


            {{-- <div class="flex">
                <p>1.</p>
                <div>
                    <p class="komen">Di era teknologi sekarang ini banyak sekali terobosan – terobosan baru yang diciptakan oleh manusia, misalnya ada mesin pencuci piring atau masih banyak lagi. Begitupun dengan trading, sudah banyak sekali yang menggunakan jasa otomatisasi seperti robot trading.</p>
                    <h6>
                        <i class="fa fa-calendar-o" aria-hidden="true"></i>
                        20-02-2021
                    </h6>
                </div>
            </div> --}}
        @endauth


    </div>

    <div class="kotak kanan">
        <h5>Pertanyaan Terkait</h5>
        <ol>
            @foreach ($pertanyaan_terkait as $p)
                <li><a href="{{ url('/lihat_faq/'. $p->id) }}">{{ $p->pertanyaan }}</a></li>
            @endforeach
        </ol>
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

    $(document).on("click","#like", function (e) {
        e.preventDefault();
        let url = $(this).attr('action');
        let data = 'ini data';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            success: function (response){
                console.log(response);
            }
        });
    });

    $(document).on("click","#dislike", function (e) {
        e.preventDefault();
        let url = $(this).attr('action');
        let data = 'ini data';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            success: function (response){
                console.log(response);
            }
        });
    });

    $(document).on("submit","#komen", function (e) {
        e.preventDefault();
        let url = $(this).attr('action');
        let data = {
            'komentar': $('.saran').val(),
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            success: function (response){
                console.log(response);

                $('#kotak-saran').fadeOut(500);

                setTimeout(function () {
                    $('.thank').fadeIn(500);
                }, 500);

                setTimeout(function () {
                    $('.thank').fadeOut(500);
                }, 1000);

            }
        });
    });


</script>
    
@endpush