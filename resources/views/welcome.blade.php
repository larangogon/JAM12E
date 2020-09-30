<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tiendas JAM</title>

        <!-- Fonts -->

        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
        <script src="{{asset('js/app.js') }}" defer></script>

        <!-- Font Awesome Icons -->
        <link href="{{asset('plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet" >

        <!-- Styles -->
        <link href="{{mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}"><button type="button" class="btn btn-dark">Home</button></a>
                    @else
                        <a href="{{ route('login') }}"><button type="button" class="btn btn-primary">Login</button></a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"><button type="button" class="btn btn-danger">Register</button></a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="media">
                    <img src="dist/img/descarga (1).png"
                        class="img-size-50 img-circle mr-3">
                    <div class="media-body">
            </div>
        </div>
    </body>
</html>

