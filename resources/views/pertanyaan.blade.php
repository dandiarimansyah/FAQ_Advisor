@extends('partial')

@section('content')

    <h1 class="tengah">
        <strong>
            DATA PERTANYAAN JAWABAN
        </strong>
    </h1>

    <div class="kotak kotak-mini">

        <div id="tabel_pertanyaan" class="judul_tabel tombol mb-2">
            <a href="/admin/tambah_pertanyaan" class="tambah">Tambah Pertanyaan</a>
            <a href="" class="tambah" id="import">Import Excel</a>
        </div>

        <div class="tabel">
            <table class="table table-bordered table-striped" id="datatable" width="100%" cellspacing="0">
                <thead>                	
                    <tr>
                        <th width="2%">No</th>
                        <th width="20%">Pertanyaan</th>
                        <th width="20%">Jawaban</th>
                        <th width="10%">Kategori</th>
                        <th width="9%">Tanggal Dibuat</th>
                        <th width="8%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pertanyaan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p-> pertanyaan }}</td>
                            <td style="text-align: justify">{{ substr($p->jawaban, 0, 80) }} ....</td>
                            <td>
                                @foreach ($p->kategori as $kategori)
                                    {{$kategori-> kategori}}  <br>
                                @endforeach
                            </td>
                            <td>{{ \Carbon\Carbon::parse($p->updated_at)->format('d-m-Y') }}</td>
                            <td class="tombol flex flex-center">
                                <a href="{{ url('/lihat_pertanyaan/'. $p->id) }}" class="lihat">Lihat</a>
                                <a href="{{ url('/edit_pertanyaan/'. $p->id) }}" class="edit">Edit</a>
                                <a href="{{ url('/hapus_pertanyaan/'. $p->id) }}" data-toggle="tooltip" class="hapus">Hapus</a>
                            </td>
                        </tr>
                    @empty
                        <tr style="text-align: center">
                            <td colspan="10">Tidak ada Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
	<script type="text/javascript">
        $(document).on('click', '#hapus_kategori', function(e){
                e.preventDefault();
                var link = $(this).attr('href');
                
                Swal.fire({
                    title: 'Yakin Dihapus?',
                    text: "Pertanyaan Akan Dihapus Dari Daftar!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#grey',
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Hapus',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = link;
                    }
                })
            })
    </script>
@endsection