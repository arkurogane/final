@extends('layouts.app')

@section('content')
    <div class="container">
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
                                    <td><a href="/alumnosCurso/{{ $curso->id }}" class="btn green">Ver Alumnos</a></td>
                                </tr>
                                <tr>
                                    <th>Actividad</th>
                                    <td><a href="addActividad/{{ $curso->id }}" class="btn green">Añadir</a>
                                    <a href="dropActividad/{{ $curso->id }}" class="btn red">Eliminar</a></td>
                                </tr>
                                <tr>
                                    <th>Cerrar Curso</th>                       
                                    <td><a onClick="javascript: return confirm('¿Estas seguro de Cerrar este Curso?');" href="cerrarCurso/{{ $curso->id }}" class="btn red">Cerrar</a></td>
                             </tr>
                            </tbody>          
                    @endforeach
                    </table>
                    <br>
                    <div class="row">
                        <div>
                            <h5 class="center col l6">Premios</h5>
                            <h5 class="center col l6">Tareas</h5>
                        </div>
                        <table class="highlight centered col s6">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            @foreach ($actividades as $actividad)  
                                <tbody>
                                    @foreach ($cas as $ca)
                                        @if( $actividad->tipo ==1 && $ca->actividad_id==$actividad->id)
                                            <tr>   
                                                <td>{{ $actividad->nombre }}</td>
                                                <td><a href="/actividadDetalle/{{ $actividad->id }}"><i class="material-icons">create</i></a></td>
                                            </tr>
                                        @endif
                                    @endforeach                                    
                                </tbody>          
                            @endforeach
                        </table>
                        
                        <table class="highlight centered col s6">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            @foreach ($actividades as $actividad)  
                                <tbody>
                                    @foreach ($cas as $ca)
                                        @if( $actividad->tipo ==2 && $ca->actividad_id==$actividad->id)
                                            <tr>   
                                                <td>{{ $actividad->nombre }}</td>
                                                <td><a href="/actividadDetalle/{{ $actividad->id }}"><i class="material-icons">create</i></a></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>          
                            @endforeach
                        </table>
                        <br><br>
                    </div>
                    <a href="{{ route('listaCurso') }}" class="btn">{{ __('Volver') }}</a>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection