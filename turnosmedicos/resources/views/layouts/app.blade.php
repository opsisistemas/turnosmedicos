<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title class="titulo"></title>

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
      <h1 class="titulo"></h1>
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
                        @if ((Auth::user()->hasRole('admin')) || (Auth::user()->hasRole('owner')))
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Datos Secundarios <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/paises') }}">Pa&iacute;ses</a></li>
                                    <li><a href="{{ url('/provincias') }}">Provincias</a></li>
                                    <li><a href="{{ url('/localidades') }}">Localidades</a></li>
                                    <li><a href="{{ url('/feriados') }}">Feriados</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Datos Generales <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/especialidades') }}">Especialidades</a></li>
                                    <li><a href="{{ url('/obras_sociales') }}">Obras Sociales</a></li>
                                    <li><a href="{{ url('/planes') }}">Planes</a></li>
                                    <li><a href="{{ url('/pacientes') }}">Pacientes</a></li>
                                    <li><a href="{{ url('/medicos') }}">M&eacute;dicos</a></li>
                                    <li><a href="{{ url('/asuntos') }}">Asuntos</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/mensajes') }}" id=mensajes>Mensajes</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Turnos <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/turnos.listado') }}">Listado</a></li>
                                    <li><a href="{{ url('/turnos.create') }}">Dar un turno</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/empresa.perfil') }}">Empresa</a></li>

                        <!--Exclusive menues (for paciente, medico or owner)-->
                        @elseif(Auth::user()->hasRole('paciente'))
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Gesti&oacute;n de Turnos <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/turnos.create') }}">Turno por M&eacute;dico</a></li>
                                    <li><a href="{{ url('/turnos.create_por_especialidad') }}">Turno por Especialidad</a></li>
                                    <li><a href="{{ url('/turnos.misturnos') }}">Mis Turnos</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('/mensajes.create') }}">Contacto</a></li>
                        @elseif(Auth::user()->hasRole('medico'))
                            <li><a href="{{ url('/medicos.misturnos') }}">Turnos</a></li>
                            <li><a href="{{ url('/medicos.mismensajes') }}" id=mensajes>Mensajes</a></li>
                            <li><a href="{{ url('/medicos.misdiastachados') }}" id=mensajes>Inasistencias Informadas</a></li>
                        @endif

                        @if(Auth::user()->hasRole('owner'))
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Men&uacute; SuperUser <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/usersnroles') }}"><i class="fa fa-btn fa-user"></i>Usuarios y Roles</a></li>
                            </ul>
                        </li>
                        @endif

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ ucwords(Auth::user()->name) . ' ' . ucwords(Auth::user()->surname) }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                @if(Auth::user()->hasRole('medico'))
                                    <li><a href="{{ url('/medicos.perfil') }}"><i class="fa fa-btn fa-user"></i>Perfil</a></li>
                                @else
                                    <li><a href="{{ url('/pacientes.perfil') }}"><i class="fa fa-btn fa-user"></i>Perfil</a></li>
                                @endif
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar Sesi&oacute;n</a></li>
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

    {{ Html::script('js/layout/parameters.js') }}
    {{ Html::script('js/layout/alertMensajes.js') }}
    @yield('scripts')
</body>
</html>
