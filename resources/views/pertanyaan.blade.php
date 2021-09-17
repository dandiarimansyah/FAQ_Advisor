@extends('partial')

@section('content')

    <h1 class="judul-section tengah">
        <strong>
            DATA PERTANYAAN JAWABAN
        </strong>
    </h1>

    <div class="kotak kotak-mini">

        <div id="tabel_pertanyaan" class="judul_tabel tombol mb-2">
            <a href="/admin/tambah_faq" class="tambah">Tambah Pertanyaan</a>
            <a loc="/admin/template_excel" 
                href="/admin/import_faq" class="tambah import" id="import_data" 
                data-toggle="modal" data-target="#import">
                Import Excel
            </a>
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
                            <td class="text-justify">{{ $p-> pertanyaan }}</td>
                            <td class="text-justify">{!! Str::limit($p->jawaban,80) !!} </td>
                            {{-- <td class="text-justify">{!! substr($p->jawaban, 0, 80) !!} ....</td> --}}
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
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal Import Data -->
    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form id="import_form" action="" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                    <div class="template">
                        <p>
                            <a id="template_excel" href="" class="btn btn-success">Unduh Template</a>
                        </p>
                        
                    </div>
                    <input name="file" type="file" required='required' oninvalid="this.setCustomValidity('Silahkan Masukkan File!')"
                    oninput="this.setCustomValidity('')">
                    <p style="font-size: 16px; margin-top:5px">Pilih file yang akan diimport</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    
@endsection

@push('scripts')
<script type="text/javascript">

    //Import Data
    $(document).on('click','#import_data',function(){
        var link = $(this).attr('href');
        var loc = $(this).attr('loc');
        
        $('#import_form').attr('action', '' + link);
        $('#template_excel').attr('href', '' + loc);
    })

</script>
@endpush