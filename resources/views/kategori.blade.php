@extends('partial')

@section('content')
    
    <h1 class="tengah">
        <strong>
            DATA KATEGORI
        </strong>
    </h1>
    
    <div class="kotak kotak-mini">

        {{-- Tambah Kategori --}}
        <div class="judul_tabel">
            <h2>TAMBAH KATEGORI</h2>	
        </div>

        <form method="post" action="">
            @csrf
            <div class="flex ml-3">
                <input class="form-control" id="input_kategori" type="text" name="kategori" placeholder="Masukkan Nama Kategori" value="{{ old('kategori') }}" />
                <div id="error" style="color: red">{{ $errors->first('kategori') }}</div>
                
                <button class="btn btn-primary pb-1 pt-1" type="submit">Tambah</button>
            </div>
        </form>

        {{-- Daftar Kategori --}}
        <div class="judul_tabel">
            <h2 class="mt-5">DAFTAR KATEGORI</h2>	
        </div>
        <div class="tabel tabel_kategori">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategori as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->kategori }}</td>
                            <td class="flex flex-center tombol">
                                <a class="edit" 
                                data-toggle="modal" 
                                data-target="#edit-modal"
                                data-id="{{ $k->id }}"
                                data-nama="{{ $k->kategori }}">
                                Edit
                            </a>
                            <a href="{{ url('/hapus_kategori/' . $k->id) }}"  data-toggle="tooltip" class="hapus">Hapus</a>
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

        {{-- Modal Edit --}}

	    <div class="modal fade" id="edit-modal">
        <div id="modal-edit" class="modal-dialog modal-dialog-centered" role="document">
        <div id="modal-content" class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">EDIT KATEGORI</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="wrapper" style="margin: 0">
                    <div class="form">
                        <form id="edit_form" action="" method="POST">
                            @csrf                          
                        <div class="form-group">
                            <label class="mb-1" for="nama">Nama Kategori</label>
                                <input class="form-control py-3" id="nama" name="kategori" type="text" value="" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    <script type="text/javascript">
      $(document).on('click','#edit_item',function(){
            let nama = $(this).data('nama');
            let id = $(this).data('id');
            $('#nama').val(nama);
            $('#edit_form').attr('action', '/edit_kategori/' + id);
      })
      $(document).on('click', '#hapus_kategori', function(e){
              e.preventDefault();
              var link = $(this).attr('href');
              
              Swal.fire({
                  title: 'Yakin Dihapus?',
                  text: "Data Kategori Akan Dihapus!",
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