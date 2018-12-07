@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-title center">{{ __('Agregar Actividad') }}</div>
                <div class="card-content">
                    <table class="highlight centered">
                        @foreach ($actividades as $actividad)  
                                <tbody>
                                    <tr>
                                        <th>Nombre:</th>
                                        <td>{{ $actividad->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <th>tipo:</th>
                                        @if( $actividad->tipo ==1 )
                                            <td>Premio</td>
                                        @elseif($actividad->tipo == 2)
                                            <td>Tarea</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th>Valor:</th>
                                        <td>{{ $actividad->valor }} puntos</td>
                                    </tr>
                                    <tr>
                                        <th>Descripción:</th>
                                        <td>{{ $actividad->descripcion }}</td>
                                    </tr>
                                    <tr>
                                        <th>Actividad:</th>
                                        <td><a href="/updateActividad/{{ $actividad->id }}" class="btn green">Modificar</a>
                                        <a onClick="javascript: return confirm('¿Estas seguro de eliminar esta actividad?');" href="/deleteActividad/{{ $actividad->id }}" class="btn red">Eliminar</a></td>
                                    </tr>
                                    <tr>
                                        <th>creada:</th>
                                        <td>{{ $actividad->created_at }}</td>
                                    </tr>
                                </tbody>          
                        @endforeach
                    </table>
                    <br>
                    <a href="{{ route('Actividades') }}" class="btn">{{ __('volver') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection