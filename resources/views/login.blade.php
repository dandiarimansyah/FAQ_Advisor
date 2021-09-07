<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"> </script>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('login.css') }}">
    <title>Swimpro</title>
  </head>

  <body>
    <div class="container px-4 py-5 mx-auto">
        <div class="card card0">
            <div class="d-flex flex-lg-row flex-column-reverse">
                <div class="card card1">
                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-10 my-5">
                            {{-- <h3 class="text-center heading">FAQ EA</h3> --}}
                            <div class="row justify-content-center px-3 mb-3"> 
                                <img id="logo" src="{{ asset('logo-swimpro.png') }}"> 
                            </div>
                            <h6 style="text-align: center" class="msg-info">Silahkan Login</h6>

                            <form action="{{url('proses_login')}}" method="POST" id="logForm">
                                @csrf
                                <div class="form-group"> 
                                    <input type="text" id="email" name="email" placeholder="Masukkan Email" class="form-control"> 
                                </div>
                                <div class="form-group"> 
                                    <input type="password" id="psw" name="password" placeholder="Masukkan Password" class="form-control"> 
                                </div>

                                <div class="row justify-content-center my-3 px-3"> 
                                    <button class="btn-block btn-color">Login</button>
                                </div>
                            </form>

                            <div class="row justify-content-center my-2"> <a href="#"><small class="text-muted">Lupa Password?</small></a> </div>
                        </div>
                    </div>

                </div>
                <div class="card card2">
                    <img id="gambar" src="{{ asset('swimpro.jpg')}}" alt="">
                </div>
            </div>
        </div>
    </div>

  </body>
</html>