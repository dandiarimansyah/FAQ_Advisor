@extends('partial')

@section('content')

    <h1 class="judul-section tengah">
        <strong>
            DATA RESPON CUSTOMER
        </strong>
    </h1>

    <div class="kotak kotak-mini">

        <div class="tabel">
            <table class="table table-bordered table-striped" id="datatable" width="100%" cellspacing="0">
                <thead>                	
                    <tr>
                        <th width="2%">No</th>
                        <th width="20%">Pertanyaan</th>
                        <th width="20%">Like</th>
                        <th width="10%">Dislike</th>
                        <th width="9%">Total Poin</th>
                        <th width="8%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($pertanyaan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p-> pertanyaan }}</td>
                            <td class='text-center'>{{ $p->like }}</td>
                            <td class='text-center'>{{ $p->dislike }}</td>
                            <td class='text-center'>{{ $p->poin }}</td>
                            <td>
                                @foreach ($p->kategori as $kategori)
                                    {{$kategori-> kategori}}  <br>
                                @endforeach
                            </td>
                            <td>{{ \Carbon\Carbon::parse($p->updated_at)->format('d-m-Y') }}</td>
                            <td class="tombol flex flex-center">
                                <a href="{{ url('/lihat_faq/'. $p->id) }}" class="lihat">Lihat</a>
                                <a href="{{ url('/admin/edit_faq/'. $p->id) }}" class="edit">Edit</a>
                                <a href="{{ url('/admin/hapus_faq/'. $p->id) }}" data-toggle="tooltip" class="hapus">Hapus</a>
                            </td>
                        </tr>
                    @empty
                        <tr style="text-align: center">
                            <td colspan="10">Tidak ada Data</td>
                        </tr>
                    @endforelse --}}
                </tbody>
            </table>
        </div>
    </div>
    
@endsection