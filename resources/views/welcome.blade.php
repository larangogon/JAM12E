<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tiendas JAM</title>

    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body class="body">

    <header class="header content">
        <div class="header-video">
            <video autoplay muted loop id="video"  height="710" >
                <source src="dist/img/mp4.1.mp4" type="video/mp4">
                Tu navecador no soporta videos en HTML5
            </video>
            <div class="header-content">
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
            </div>
        </div>
    </header>
</body>
@include('layouts.footer')
</html>

