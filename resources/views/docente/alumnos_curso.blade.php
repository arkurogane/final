@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col s12">
            <div class="">
                <div class="card">
                <div class="card-title center">Alumnos del Curso</div>
                <div class="card-content">
                    <div class="row">
                        @foreach ($cursos as $curso)
                        <div class="col l8 push-l2">
                            <a href="/asignarPuntos/{{ $curso->id }}" class="btn btn-block btn-large blue darken-1">Asignar Puntos</a>
                        </div>
                        @endforeach
                        <table class="highlight centered col l8 push-l2">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Detalles</th>
                                    <th>Conversacion</th>
                                </tr>
                            </thead>
                            @foreach ($alumnos as $alumno)  
                            <tbody>
                                @foreach ($participantes as $participante)
                                    @if( $participante->alumno_id==$alumno->id)
                                        <tr><td>{{ $alumno->name }}</td>
                                            <td>{{ $alumno->apellido }}</td>
                                            @foreach ($cursos as $curso)
                                                <td><a href="/detallesAlumno/{{ $alumno->id }}/{{ $curso->id }}"><i class="material-icons">create</i></a></td>
                                            @endforeach
                                            <td><a href="/crearConversacion/{{ $alumno->id }}"><i class="material-icons">message</i></a></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>          
                            @endforeach
                        </table>
                    </div>
                    <br>
                    <a href="/cursoDetalle/{{ $curso->id }}" class="btn">{{ __('Volver') }}</a>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection