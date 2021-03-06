<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FAQ</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>        
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    {{-- SweetAlert & Datatables --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
        
    {{-- Multiple Select --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Summernote --}}
    <link rel="stylesheet" href="{{ asset('summernote/summernote.min.css')}}">

    {{-- CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
    @yield('style')

    @auth
        <style>
            #navbar{
                background-color: rgba(3, 97, 53, 0.685);
            }
            body{
                background-image: url("/background2.jpg");
            }
        </style>    
    @endauth

    @guest
        <style>
            #navbar{
                background-color: rgba(0, 57, 95, 0.712);
            }
            body{
                background-image: url("/background.jpg");
            }
        </style>
    @endguest

</head>
<body>
    @auth

    <div id="navbar">
        <div id="logo">
            <h1>SWIMPRO
                <span style="color: yellow">ADMIN</span>
            </h1>
        </div>
        
        <div id="menu">
            @auth
            <li><a href="/">FAQ</a></li>
                <li><a href="/admin/faq">PERTANYAAN</a></li>
                <li><a href="/admin/kategori">KATEGORI</a></li>
                <li><a href="/admin/respon">RESPON</a></li>
                <li><a class="logout" href="/logout">LOGOUT</a></li>
            @endauth
        </div>
    </div>
    @endauth


    <div class="dalam-konten">
        @yield('content')
    </div>
    
    <script src="{{ asset('sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('summernote/summernote.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {         
            var table = $('#datatable').DataTable();
        });

        $(document).ready(function(){
            $('#summernote').summernote({
                height: 400,
                popatmouse: true,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video']],
                ]
            });
        });
    </script>

    @stack('scripts')

</body>
</html>