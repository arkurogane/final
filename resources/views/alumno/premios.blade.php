@extends('layouts.app')

@section('content')
    <div class="col s12">
        <div class="">
            <div class="card">
            <div class="card-title center">Premios</div>
            <div class="card-content">
                @foreach ($participantes as $participante)
                <table>
                    <tbody>
                        <tr>
                            <th>Tienes:</th>
                            <td><h6>{{ $participante->cantidad_puntos }} Puntos</h6></td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @foreach ($actividades as $actividad)
                    @foreach ($cas as $ca)
                        @if($ca->actividad_id==$actividad->id)
                            <a href="/actividad_detalle/{{ $actividad->id }}/{{ $ca->curso_id }}" class="btn btn-block btn-large blue darken-1">{{ $actividad->nombre }}</a>
                            <br>
                        @endif         
                    @endforeach
                @endforeach
                <br>
                @foreach ($cursos as $curso)
                    <a href="/curso_detalle/{{ $curso->id }}" class="btn btn-large blue darken-1">Volver</a>
                @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection