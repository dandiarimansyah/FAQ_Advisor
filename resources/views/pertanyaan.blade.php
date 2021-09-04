@extends('partial')

@section('content')

    <div>
        <a href="/tambah_pertanyaan" id="edit_item">Tambah</a>
        
        <h1>DAFTAR PERTANYAAN</h1>
        <div class="card-body">
	        <div class="table-responsive">
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
	                	@foreach ($pertanyaan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p-> pertanyaan }}</td>
                            <td>{{ $p-> jawaban }}</td>
                            <td>
                            	@foreach ($p->kategori as $kategori)
                                    {{$kategori-> kategori}}  <br>
                                @endforeach
                            </td>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}</td>
                            <td>
                            	<a href="{{ url('/edit_pertanyaan/'. $p->id) }}" id="edit_item">Edit
                                </a>
                                <a href="{{ url('/hapus_pertanyaan/'. $p->id) }}" data-toggle="tooltip" id="hapus_kategori">Hapus</a>
                          	</td>
                        </tr>
                        @endforeach
	                </tbody>
	            </table>
	        </div>
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