@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col s12 row">
        <div class="card">
            <div class="card-title center">{{ __('Eliminar Actividad') }}</div>

            <div class="card-content">
                @if($save==1)
                <div class="card-panel green darken-2">Actividad Agregada con exito!</div>
                @endif
                @if($save==2)
                    <div class="card-panel red darken-2">No se puede agregar una actividad ya existente!!</div>
                @endif
                <form method="POST" action="/deleteActividadCurso">
                    @csrf
                    <input type="text" name='id' id='id' hidden value="{{ $id }}">
                    <div>
                        <h5 class="center col s6">Premios</h5>
                        <h5 class="center col s6">Tareas</h5>
                    </div>
                    <div class="row">
                        <table class="highlight centered col s6">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                </tr>
                            </thead>
                            @foreach ($actividades as $actividad)  
                                <tbody>
                                    @foreach ($cas as $ca)
                                        @if( $actividad->tipo ==1 && $ca->actividad_id==$actividad->id)
                                            <tr>
                                                <td>
                                                    <p>
                                                        <label>
                                                        <input type="checkbox" value="{{ $ca->id }}" name="premio[]" />
                                                        <span class="black-text">{{ $actividad->nombre }}</b></span>
                                                        </label>
                                                    </p> 
                                                </td>
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
                                {{ __('Eliminar Actividad del Curso') }}
                            </button>
                        </div>
                    </div>
                </form>
               
            </div>
        </div>
    </div>
</div>
@endsection