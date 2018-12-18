@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col l12">
        <div class="card">
            <div class="card-content">
                @if (session('status'))
                @endif

                @if(Auth::user()->hasRol('admin'))
                        <div>Acceso como administrador</div>
                    @elseif(Auth::user()->hasRol('doc'))
                        <div class="row center">
                            <a href="{{ route('listaCurso') }}" class="col l3"><i class="large material-icons">business_center</i></a>
                            <a href="{{ route('conversations') }}" class="col l3"><i class="large material-icons red-text darken-1-text">message</i></a>
                            <a href="{{ route('Actividades') }}" class="col l3"><i class="large material-icons green-text">videogame_asset</i></a>
                            <a href="{{ route('asignaturas') }}" class="col l3"><i class="large material-icons purple-text">view_headline</i></a>
                        </div>
                        <div class="row center hide-on-med-and-down">
                            <span class="col l3">cursos</span>
                            <span class="col l3">Mensajes</span>
                            <span class="col l3">Actividades</span>
                            <span class="col l3">Asignaturas</span>
                        </div>
                    @else
                        <div>

                        </div>
                    @endif
                    
                    <div class="card cyan lighten-3">
                        <span class="card-title center-align">Notificaciones</span>
                    </div>
                @foreach ($notificaciones as $notificacion)
                            <div class="card light-green lighten-3">
                                <div class="card-content left-align ">
                                    <p>{{ $notificacion->descripcion }}</p>
                                </div>
                            </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
