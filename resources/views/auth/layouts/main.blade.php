<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.css') }}">

        <!-- Custom styles for this template -->
        <link href="{{ asset('css/full-slider.css') }}" rel="stylesheet">
    </head>

    <body>

        <section class="login-slide">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @for ($i = 0; $i < 4; $i++)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
                @endfor
            </ol>
            <div class="carousel-inner" role="listbox">
                @for ($i = 0; $i < 4; $i++)
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class="carousel-item{{ $i == 0 ? ' active' : '' }}" style="background-image: url('{{ asset('img/slide-'.$i.'.jpg') }}')">
                    <div class="carousel-caption d-none d-md-block text-left">
                        <h3>Welcome to <strong>EastWater</strong></h3>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesettin <br />
                            <span>
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                                when an unknown printer took a galley of type and <br /> it to make a type specimen book.
                            </span>
                        </p>
                    </div>
                </div>
                @endfor
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>
        </section>

        <aside class="login-content">
            @yield('content')
        </aside>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

    </body>

</html>
