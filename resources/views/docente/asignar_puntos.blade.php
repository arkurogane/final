@extends('layouts.app')

@section('content')
    <div class=" ">
        <div class="col s12 row">
            <div class="">
                <div class="card">
                <div class="card-title center">Puntos</div>

                <div class="card-content">
                    <form method="POST" action="/puntos">
                        @csrf
                        @foreach ($cursos  as $curso)  
                            <input type="text" name='curso_id' id='curso_id' hidden value="{{ $curso->id }}">
                        @endforeach

                        <div class="input-field col col l8 push-l2 m12">
                            <select id="tipo" name="tipo" required>
                                <option value="" disabled selected>Seleccione Acción</option>
                                <option value="1">Dar Puntos</option>
                                <option value="2">Quitar Puntos</option>
                            </select>
                        </div>

                        <div>
                            <h5 class="center col l12">Tareas</h5>
                        </div>
                        <div class="row">
                            <table class="highlight centered col l8 push-l2 m12">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Puntos</th>
                                        <th>Detalles</th>
                                    </tr>
                                </thead>
                                @foreach ($actividades as $actividad)  
                                <tbody>
                                    @foreach ($cas as $ca)
                                        @if( $actividad->tipo ==2 && $ca->actividad_id==$actividad->id)
                                            <tr>   
                                                <td>
                                                    <p>
                                                        <label>
                                                        <input type="checkbox" value="{{ $ca->id }}" name="tarea[]" />
                                                        <span class="black-text">{{ $actividad->nombre }}</span>
                                                        </label>
                                                    </p> 
                                                </td>
                                                <td>{{ $actividad->valor }}</td>
                                                <td><a href="/actividadDetalle/{{ $actividad->id }}">detalles</a></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>          
                                @endforeach
                            </table>
                            <div>
                                <h5 class="center col l12">Alumnos</h5>
                            </div>
                            <table class="highlight centered col l8 push-l2 m12">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Puntos</th>
                                    </tr>
                                </thead>
                                @foreach ($alumnos as $alumno)  
                                <tbody>
                                    @foreach ($participantes as $participante)
                                        @if( $participante->alumno_id==$alumno->id)
                                            <tr>   
                                                <td>
                                                    <p>
                                                        <label>
                                                        <input type="checkbox" value="{{ $participante->id }}" name="participante[]" />
                                                        <span class="black-text">{{ $alumno->name }} {{ $alumno->apellido }}</span>
                                                        </label>
                                                    </p> 
                                                </td>
                                                <td>{{ $participante->cantidad_puntos }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>          
                                @endforeach
                            </table>
                        </div>
    
                        <div class="row center">
                            <div class="col s12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Asignar Puntos') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <a href="/cursoDetalle/{{ $curso->id }}" class="btn">{{ __('Volver') }}</a>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection