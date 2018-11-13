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
    </style>
    @endauth
    <link href="{{ asset('css/materialize.css') }}" rel="stylesheet">
    
</head>
<body>
    <div id="app">
        <nav class="nav-wrapper purple lighten-3">
            <div class="container">
                
                <a href="#" data-target="mob" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                <ul class="right hide-on-med-and-down">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        <li>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                    @else
                        @if(Auth::user()->hasRol('admin'))
                            <li><a href="{{ route('docentes') }}">{{ __('Docentes') }}</a></li>
                        @endif
                        @if(Auth::user()->hasRol('doc'))
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
                            </li>
                        @endif


                        <li>
                            <a href="/datos">{{ __('Mis Datos') }}</a>
                        </li>


                        <li>
                            <a id="navbarDropdown" class="dropdown-button" href="#" role="button"
                               data-activates="drop1" data-belowOrigin="true" data-constrainWidth="false" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <i class="material-icons right">arrow_drop_down</i></a>
                            </a>
                        </li>
                        <ul class="dropdown-content" id="drop1">
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
        <ul class="sidenav @auth sidenav-fixed @endauth  pink lighten-3" id="mob">
                <li><a class="brand-logo" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a></li>
            @guest
                <li><div class="divider"></div></li>
                <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li><div class="divider"></div></li>
                <li>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">{{ __('Register') }}<i class="material-icons">edit</i></a>
                    @endif
                </li>
            @else
                <li><div class="divider"></div></li>
                    @if(Auth::user()->hasRol('admin'))
                        <li>
                            <a href="{{ route('docentes') }}">{{ __('Docentes') }}</a>
                        </li>
                        <li><div class="divider"></div></li>
                    @endif
                    @if(Auth::user()->hasRol('doc'))
                            <li><a href="{{ route('asignaturas') }}">{{ __('Asignaturas') }}</a></li>
                            <li><div class="divider"></div></li>
                            <li>
                                <a id="navbarDropdown" class="dropdown-button" href="#" role="button"
                                    data-activates="cursos" data-belowOrigin="true" data-constrainWidth="false" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Cursos<i class="material-icons right">arrow_drop_down</i></a>
                                </a>
                                <ul class="dropdown-content" id="cursos">
                                    <li><a href="{{ route('crearCurso') }}">{{ __('Crear Curso') }}</a></li>
                                    <li><a href="{{ route('listaCurso') }}">{{ __('listar Cursos') }}</a></li>
                                    <li><a href="{{ route('cursosCerrados') }}">{{ __('Cursos Cerrados') }}</a></li>
                                </ul>
                            </li>
                            <li><div class="divider"></div></li>
                        @endif
                <li><a href="/datos">{{ __('Mis Datos') }}</a></li>
                <li><div class="divider"></div></li>
                <li>
                    <a id="navbarDropdown" class="dropdown-button" href="#" role="button"
                       data-activates="drop" data-belowOrigin="true" data-constrainWidth="false" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <i class="material-icons right">arrow_drop_down</i></a>
                    </a>

                    <ul class="dropdown-content" id="drop">
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
            var url = document.URL;
            history.pushState(null, null, document.URL);
            window.addEventListener('popstate', function () {
                history.pushState(null, null, url);
            });
        </script>
</body>
</html>
