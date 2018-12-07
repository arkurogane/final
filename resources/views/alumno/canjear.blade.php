@extends('layouts.app')

@section('content')
    <div class="col s12 row">
        <div class="">
            <div class="card">
            <div class="card-title center">Premio</div>

                <div class="card-content">
                        @if($save==1)
                        <div class="card-panel green darken-2">Premio Cobrado!</div>
                        @endif
                        @if($save==2)
                            <div class="card-panel red darken-2">No tienes Suficientes Puntos Para Este Premio!!</div>
                        @endif
                    <form method="POST" action="{{ route('canjear') }}">
                        @csrf
                        <table class="highlight responsive centered ">
                        @foreach ($cursos as $curso)  
                            <input type="text" name="curso_id" id="curso_id" value="{{ $curso->id }}" hidden>
                        @endforeach
                        @foreach ($actividades as $actividad)
                        <input type="text" name="actividad_id" id="actividad_id" value="{{ $actividad->id }}" hidden>
                            <tbody>
                                <tr>
                                    <th>Nombre Premio:</th>
                                    <td>{{ $actividad->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Valor:</th>
                                    <td>{{ $actividad->valor }} Puntos</td>   
                                </tr>
                                <tr>
                                    <th>Descripción</th>
                                    <td>{{ $actividad->descripcion }}</td>
                                </tr>
                            </tbody>          
                        @endforeach
                        </table>
                        <br>
                        <div class="row center">
                            <div class="col l4 push-l5 m4 push-m5 s6 push-s4">
                                <button type="submit" class="btn btn-block btn-large center btn-primary">
                                    {{ __('Cobrar Premio') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    
                    <a href="/premios/{{ $curso->id }}" class="btn btn-large blue darken-1">Volver</a>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection