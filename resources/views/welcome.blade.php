<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        
        <!-- Stylesheet -->
        <link href="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/gallery-materialize.min.opt.css?8268030955633692047" rel="stylesheet">

        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- Styles -->
        <link href="{{ asset('css/materialize.css') }}" rel="stylesheet">

    </head>
    <body class="deep-orange lighten-5">
        <div class="flex-center position-ref full-height">
            

            <nav class="nav-wrapper purple lighten-3">
                <div class="container">
                    <a class="brand-logo" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                    <a href="#" data-target="mob" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    
                    @if (Route::has('login'))
                        <ul class="right hide-on-med-and-down">
                            @auth
                                <li><a href="{{ url('/home') }}">Home</a></li>
                            @else
                                <li><a href="{{ route('login') }}">Login</a></li>

                                @if (Route::has('register'))
                                    <li><a href="{{ route('register') }}">Register</a></li>
                                @endif
                            @endauth
                        </ul>
                    @endif
                </div>
            </nav>
            <!--sidebar-->
            @if (Route::has('login'))
            <ul class="sidenav pink lighten-3" id="mob">
                <li><div class="divider"></div></li>
                <li><a class="brand-logo" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a></li>
                <li><div class="divider"></div></li>
                
                        
                @auth
                    <li><a href="{{ url('/home') }}">Home</a></li>
                    <li><div class="divider"></div></li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><div class="divider"></div></li>

                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">Register</a></li>
                        <li><div class="divider"></div></li>
                    @endif
                @endauth

                
            </ul>
            @endif    

            <div class="container">
                <br>
                <div class="slider">
                    <ul class="slides">
                        <li>
                        <img class="responsive-img" src="{{ asset('imagenes/1m.jpg') }}">
                        <div class="caption center-align">
                            <h3>This is our big Tagline!</h3>
                            <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                        </div>
                        </li>
                        <li>
                        <img class="responsive-img" src="{{ asset('imagenes/2m.jpg') }}">
                        <div class="caption left-align">
                            <h3>Left Aligned Caption</h3>
                            <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                        </div>
                        </li>
                        <li>
                        <img class="responsive-img" src="{{ asset('imagenes/3m.jpg') }}">
                        <div class="caption right-align">
                            <h3>Right Aligned Caption</h3>
                            <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                        </div>
                        </li>
                    </ul>
                </div>
                <br>
                <div class="row container">
                    <ul class="collapsible popout">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">filter_drama</i>First</div>
                            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons">place</i>Second</div>
                            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons">whatshot</i>Third</div>
                            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                    </ul>
                    <video class="responsive-video" controls>
                        <source src="movie.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>

        <footer class="page-footer">
                <div class="container">
                  <div class="row">
                    <div class="col l6 s12">
                      <h5 class="white-text">Footer Content</h5>
                      <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                      <h5 class="white-text">Links</h5>
                      <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="footer-copyright">
                  <div class="container">
                  © 2014 Copyright Text
                  <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
                  </div>
                </div>
              </footer>
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
            
            var instance = M.Carousel.init({
            fullWidth: true,
            indicators: true
        });
        });
        $(document).ready(function(){
            $('.carousel').carousel();
        });

        document.addEventListener('DOMContentLoader', function() {
            instance.open();
        });

        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.slider');
            var instances = M.Slider.init(elems);
        });
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
