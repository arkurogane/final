@extends('layouts.app')

@section('content')
    <div class=" ">
        <div class="col s12">
            <div class="">
                <div class="card">
                <div class="card-title center">Curso</div>

                <div class="card-content">
                    <table class="highlight responsive centered ">
                                                          
                    @foreach ($cursos as $curso)  
                            <tbody>
                                <tr>
                                    <th>Asignatura</th>
                                    <td>{{ $curso->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Codigo</th>
                                    <td>{{ $curso->codigo }}</td>
                                <tr>
                                    <th>Seccion</th>
                                    <td>{{ $curso->seccion }}</td>   
                                </tr>
                                <tr>
                                    <th>Semestre</th>
                                    <td>{{ $curso->semestre }}</td>
                                </tr>
                                <tr>
                                    <th>Año</th>
                                    <td>{{ $curso->year }}</td> 
                                </tr>
                                <tr>
                                    <th>Alumnos</th>
                                    <td><a href="/premios/{{ $curso->id }}" class="btn green">Ver Premios</a></td>
                                </tr>
                                <tr>
                                    <th>Enviar Mensaje a docente</th>
                                    <td><a href="/crear_conversacion_docente/{{ $curso->id }}" class="btn blue">Mensaje</a></td>
                                </tr>
                            </tbody>          
                    @endforeach
                    </table>
                    <br>
                    <a href="{{ route('cursos') }}" class="btn btn-large blue darken-1">{{ __('Volver') }}</a>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection