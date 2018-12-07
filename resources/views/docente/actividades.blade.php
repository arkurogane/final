@extends('layouts.app')

@section('content')
<div class="">
    <div class="col s12 row">
        <div class="card">
            <div class="card-title center">{{ __('Agregar Actividad') }}</div>

            <div class="card-content">
                @if($save==1)
                <div class="card-panel green darken-2">Actividad Agregada con exito!</div>
                @endif
                @if($save==2)
                    <div class="card-panel red darken-2">No se puede agregar una actividad ya existente!!</div>
                @endif
                <form method="POST" action="{{ route('createActividad') }}">
                    @csrf

                    <div class="input-field col l6 s12">
                    <input id="nombre" placeholder="{{ __('Nombre') }}" type="text" class="{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>

                        @if ($errors->has('nombre'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nombre') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="input-field col l6 s12">
                        <input id="valor" placeholder="{{ __('Valor en puntos') }}" type="number" class="{{ $errors->has('valor') ? ' is-invalid' : '' }}" name="valor" value="{{ old('valor') }}" required>

                        @if ($errors->has('valor'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('valor') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="input-field col l6 s12|">
                        <select id="tipo" name="tipo" required>
                            <option value="" disabled selected>Seleccione Tipo de Actividad</option>
                            <option value="1">Premio</option>
                            <option value="2">Tarea</option>
                        </select>
                    </div>

                    <div class="input-field col s12">
                        <textarea id="descripcion" max="255" placeholder="{{ __('Descripcion') }}" type="text" class="materialize-textarea {{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ old('descripcion') }}" required></textarea>

                        @if ($errors->has('descripcion'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row center">
                        <div class="col s12">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Agregar Actividad') }}
                            </button>
                        </div>
                    </div>
                </form>
                <div>
                    <h5 class="center col s6">Premios</h5>
                    <h5 class="center col s6">Tareas</h5>
                </div>
                <div class="row">
                    <table class="highlight centered col s6">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        @foreach ($actividades as $actividad)  
                            <tbody>
                                <tr>
                                    @if( $actividad->tipo ==1 )
                                        <td>{{ $actividad->nombre }}</td>
                                        <td><a href="/actividadDetalle/{{ $actividad->id }}">detalles</a></td>
                                    @endif
                                </tr>
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
                                <tr>
                                    @if( $actividad->tipo ==2 )
                                        <td>{{ $actividad->nombre }}</td>
                                        <td><a href="/actividadDetalle/{{ $actividad->id }}">detalles</a></td>
                                    @endif
                                </tr>
                            </tbody>          
                        @endforeach
                    </table>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
