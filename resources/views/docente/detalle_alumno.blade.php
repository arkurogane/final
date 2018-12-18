@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col s12">
            <div class="">
                <div class="card">
                <div class="card-title center">Alumnos del Curso</div>
                <div class="card-content">
                    <div class="row">
                        <table class="highlight centered col l8 push-l2">
                            
                            @foreach ($alumnos as $alumno)  
                                @foreach ($participantes as $participante)
                                    <tbody>
                                        <tr>
                                            <th>Nombre</th>
                                            <td>{{ $alumno->name }} {{ $alumno->apellido }}</td>
                                        </tr>
                                        <tr>
                                            <th>Puntos</th>
                                            <td>{{ $participante->cantidad_puntos }}</td>
                                        </tr>
                                        <tr>
                                            <th>Correo</th>
                                            <td>{{ $alumno->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Quitar alumno de curso</th>
                                            @foreach ($cursos as $curso)
                                            <td><a href="/quitarAlumno/{{ $participante->id }}" class="btn red" >Quitar</a></td>
                                            @endforeach
                                        </tr>
                                    </tbody>   
                                @endforeach       
                            @endforeach
                        </table>
                    </div>
                    <br>
                    @foreach($cursos as $curso)
                    <a href="/alumnosCurso/{{ $curso->id }}" class="btn">{{ __('Volver') }}</a>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection