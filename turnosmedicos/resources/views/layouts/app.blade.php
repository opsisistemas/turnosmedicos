<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Turnos</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }


        .affix {
            top: 0;
            width: 100%;
        }
        .affix + .container-fluid {
            padding-top: 70px;
        }
    </style>

</head>
<body id="app-layout">
    <div class="container-fluid" style="text-align:center;height:80px;">
      <h1>Turnos</h1>
    </div>

    <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="197">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Inicio
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
               <!-- <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul> -->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Iniciar Sesi&oacute;n</a></li>
                        <li><a href="{{ url('/register') }}">Registrarse</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Datos Generales <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/paises') }}">Pa&iacute;ses</a></li>
                                <li><a href="{{ url('/provincias') }}">Provincias</a></li>
                                <li><a href="{{ url('/localidades') }}">Localidades</a></li>
                                <li><a href="{{ url('/especialidades') }}">Especialidades</a></li>
                                <li><a href="{{ url('/obras_sociales') }}">Obras Sociales</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('/mensajes') }}" id=mensajes>Solicitud de Turnos</a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>   
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}} 
    
    <!--IMPORTACIÓN DE COMPONENTES TIMEPICKER-->
    <script src="https://www.google-analytics.com/analytics.js" async=""></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script src="{{ asset('jquery-timepicker/lib/site.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('jquery-timepicker/lib/site.css') }}">

    <script src="{{ asset('jquery-timepicker/lib/bootstrap-datepicker.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('jquery-timepicker/lib/bootstrap-datepicker.css') }}">

    <script src="{{ asset('jquery-timepicker/jquery.timepicker.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('jquery-timepicker/jquery.timepicker.css') }}">
    <!--FIN IMPORTACIÓN DE COMPONENTES TIMEPICKER-->

    <!--IMPORTACIÓN DE COMPONENTES COLORPICKER-->
    <script src="{{ asset('bp-colorpicker/dist/js/bootstrap-colorpicker.js') }}"></script>    
    <link rel="stylesheet" href="{{ asset('bp-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <!--FIN IMPORTACIÓN DE COMPONENTES COLORPICKER-->
    @yield('scripts')
</body>
</html>
