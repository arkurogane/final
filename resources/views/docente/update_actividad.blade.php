@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-title center">{{ __('Agregar Actividad') }}</div>
                <div class="card-content">
                    <form method="POST" action="/ActividadUpdate">
                        @csrf
                        <table class="highlight centered">
                            @foreach ($actividades as $actividad)  
                                    <tbody>
                                        <input type="text" name="id" value="{{ $actividad->id }}" hidden>
                                        <tr>
                                            <th>Nombre:</th>
                                            <td><input type="text" name="nombre" value="{{ $actividad->nombre }}" placeholder="Nombre"></td>
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
                                            <td><input type="number" name="valor" value="{{ $actividad->valor }}" placeholder="Valor en puntos"></td>
                                        </tr>
                                        <tr>
                                            <th>Descripción:</th>
                                            <td><input type="text" name="descripcion" value="{{ $actividad->descripcion }}" placeholder="Descripcion"></td>
                                        </tr>
                                        <tr>
                                            <th>creada:</th>
                                            <td>{{ $actividad->created_at }}</td>
                                        </tr>
                                    </tbody>          
                            @endforeach
                        </table>
                        <div class="row center">
                            <div class="col s12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Modificar Actividad') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <a href="/actividadDetalle/{{ $actividad->id }}" class="btn">{{ __('volver') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection