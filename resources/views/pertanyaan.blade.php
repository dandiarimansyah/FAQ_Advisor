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
	                        <th width="5%">No</th>
	                        <th width="35%">Pertanyaan</th>
	                        <th width="35%">Jawaban</th>
	                        <th>Kategori</th>
	                        <th>Action</th>
	                    </tr>
	                </thead>
	                <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                            	<a href="{{ url('/edit_pertanyaan/') }}" id="edit_item">Edit
                                </a>
                                <a href="{{ url('/hapus_pertanyaan/' . $p->id) }}" id="hapus_kategori">Hapus</a>
                          	</td>
                        </tr>
	                </tbody>
	            </table>
	        </div>
	    </div>
    </div>

@endsection