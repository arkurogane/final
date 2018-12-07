<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Stylesheet -->
    <link href="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/gallery-materialize.min.opt.css?8268030955633692047" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    @auth 
    <style>
         header, main, footer {
      padding-left: 300px;
    }

    @media only screen and (max-width : 992px) {
      header, main, footer {
        padding-left: 0;
      }
    }
    .logo{
        margin-left: 5em;
    }
    
    </style>
    @endauth
    <style>
        .uno{
        height: 2em;
        width: 5em;
        border-radius: 1em;
    }
    </style>
    <link href="{{ asset('css/materialize.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <nav class="nav-wrapper cyan darken-2">
            <div class="container">
            <a class="brand-logo logo" href="{{ url('/') }}"><img class="uno" src="{{ asset('imagenes/logo1.png') }}" alt=""></a>
                <a href="#" data-target="mob" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                <ul class="right hide-on-med-and-down">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">{{ __('Registrar') }}</a>
                            @endif
                        </li>
                    @else
                        @if(Auth::user()->hasRol('admin'))
                            <li><a href="{{ route('docentes') }}">{{ __('Docentes') }}</a></li>
                        @endif
                        @if(Auth::user()->hasRol('doc'))
                            <!--<li><a href="{{ route('addParticipantes') }}">{{ __('Añadir Participantes') }}</a></li>
                            <li><a href="{{ route('Actividades') }}">{{ __('Crear Actividades') }}</a></li>
                            <li><a href="{{ route('asignaturas') }}">{{ __('Asignaturas') }}</a></li>
                            <li>
                                <a id="navbarDropdown" class="dropdown-button" href="#" role="button"
                                    data-activates="cursos2" data-belowOrigin="true" data-constrainWidth="false" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Cursos<i class="material-icons right">arrow_drop_down</i></a>
                                </a>
                                <ul class="dropdown-content" id="cursos2">
                                    <li><a href="{{ route('crearCurso') }}">{{ __('Crear Curso') }}</a></li>
                                    <li><a href="{{ route('listaCurso') }}">{{ __('listar Cursos') }}</a></li>
                                    <li><a href="{{ route('cursosCerrados') }}">{{ __('Cursos Cerrados') }}</a></li>
                                </ul>
                            </li>-->
                        @endif
                        @if(Auth::user()->hasRol('alm'))
                            <!--<li><a href="{{ route('cursos') }}">{{ __('Cursos') }}</a></li>
                            <li><a href="{{ route('Participante') }}">{{ __('Participar en Curso') }}</a></li>-->
                        @endif
                        <!--<li>
                            <a id="navbarDropdown" class="dropdown-button collection-item" href="#" role="button"
                            data-activates="dp1" data-belowOrigin="true" data-constrainWidth="false" 
                            aria-haspopup="true" aria-expanded="false" v-pre href="">
                            <i class="large material-icons">notifications_active</i>
                            </a>
                        </li>
                        <ul class="dropdown-content" id="dp1">
                            <li>
                                <a class="dropdown-item" href="#">{{ __('notificacion_1') }}</a>
                            </li>
                        </ul>-->
                        
                        <li>
                            <a id="navbarDropdown" class="dropdown-button" href="#" role="button"
                               data-activates="drop1" data-belowOrigin="true" data-constrainWidth="false" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <i class="material-icons right">arrow_drop_down</i></a>
                            </a>
                        </li>
                        <ul class="dropdown-content" id="drop1">
                            <li><a href="/datos">{{ __('Mis Datos') }}</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    @endguest
                    </ul>
            </div>
        </nav>
        <!--sidenav-->
        <ul class="sidenav @auth sidenav-fixed @endauth teal accent-4" id="mob">
                <li><a class="brand-logo" href="{{ url('/home') }}">{{ __('Home') }}</a></li>
            @guest
                <li><div class="divider"></div></li>
                <li><a href="{{ route('login') }}" class="white-text">{{ __('Login') }}</a></li>
                <li><div class="divider"></div></li>
                <li>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="white-text">{{ __('Registrar') }}<i class="material-icons">edit</i></a>
                    @endif
                </li>
            @else
                <li><div class="divider"></div></li>
                @if(Auth::user()->hasRol('admin'))
                    <li>
                        <a href="{{ route('docentes') }}" class="white-text">{{ __('Docentes') }}</a>
                    </li>
                    <li><div class="divider"></div></li>
                @endif
                @if(Auth::user()->hasRol('doc'))
                    <!--<li><a href="{{ route('addParticipantes') }}">{{ __('Añadir Participantes') }}</a></li>
                    <li><div class="divider"></div></li>-->
                    <li><a href="{{ route('Actividades') }}" >{{ __('Crear Actividades') }}</a></li>
                    <li><div class="divider"></div></li>
                    <li><a href="{{ route('asignaturas') }}">{{ __('Asignaturas') }}</a></li>
                    <li><div class="divider"></div></li>
                    <li>
                        <a id="navbarDropdown" class="dropdown-button" href="#" role="button"
                            data-activates="cursos" data-belowOrigin="true" data-constrainWidth="false" aria-haspopup="true" aria-expanded="false" v-pre>
                            Cursos<i class="material-icons right">arrow_drop_down</i></a>
                        </a>
                        <ul class="dropdown-content center" id="cursos">
                            <li><a href="{{ route('crearCurso') }}">{{ __('Crear Curso') }}</a></li>
                            <li><a href="{{ route('listaCurso') }}">{{ __('listar Cursos') }}</a></li>
                            <li><a href="{{ route('cursosCerrados') }}">{{ __('Cursos Cerrados') }}</a></li>
                        </ul>
                    </li>
                    <li><div class="divider"></div></li>
                @endif
                @if(Auth::user()->hasRol('alm'))
                    <li><a href="{{ route('cursos') }}">{{ __('Cursos') }}</a></li>
                    <li><div class="divider"></div></li>
                    <li><a href="{{ route('Participante') }}">{{ __('Participar en Curso') }}</a></li>
                    <li><div class="divider"></div></li>
                @endif
                
                <li>
                    <a id="navbarDropdown" class="dropdown-button" href="#" role="button"
                       data-activates="drop" data-belowOrigin="true" data-constrainWidth="false" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <i class="material-icons right">arrow_drop_down</i></a>
                    </a>
                    <ul class="dropdown-content" id="drop">
                        <li><a href="/datos">{{ __('Mis Datos') }}</a></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </li>
                <li><div class="divider"></div></li>
            @endguest
        </ul>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/materialize.js') }}"></script>
    <script src="{{ asset('js/prueba.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/materialize/0.98.0/js/materialize.min.js"></script>
<script src="{{ asset('js/rut.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
        });

        document.addEventListener('DOMContentLoader', function() {
            instance.open();
        })
    </script>
    <script>
        //script para evitar volver atras con el boton del navegador
            /*var url = document.URL;
            history.pushState(null, null, document.URL);
            window.addEventListener('popstate', function () {
                history.pushState(null, null, url);
            });*/
    </script>
</body>
</html>
