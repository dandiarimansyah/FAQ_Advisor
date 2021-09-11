<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FAQ</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

    {{-- Multiple Select --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

    {{-- Summernote --}}
    <link rel="stylesheet" href="{{ asset('summernote/summernote.min.css')}}">


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
    <div id="navbar">
        <div id="logo">
            <h1>SWIMPRO
            @auth
                <span style="color: yellow">ADMIN</span>
            @endauth
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

    <div class="dalam-konten">
        @yield('content')
    </div>
    
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('summernote/summernote.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#summernote').summernote({
                height: 400,
                width: 900,
                popatmouse: true
            });
        });

        $(document).ready(function () {         
            var table = $('#datatable').DataTable();
        });
    </script>

    @stack('scripts')

</body>
</html>