@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-title center">{{ __('Agregar Asignatura') }}</div>

                <div class="card-content">
                    @if($save==1)
                    <div class="card-panel green darken-2">Asignatura Agregada con exito!</div>
                    @endif
                    @if($save==2)
                        <div class="card-panel red darken-2">No se puede agregar una asignatura ya existente!!</div>
                    @endif
                    <form method="POST" action="/agregarAsignatura">
                        @csrf

                        <div class="form-group row">
                            <div class="push-s1 col s10">
                            <input id="nombre" placeholder="{{ __('Nombre') }}" type="text" class="{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="push-s1 col s10">
                                <input id="codigo" placeholder="{{ __('Codigo') }}" type="number" class="{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" value="{{ old('codigo') }}" required>

                                @if ($errors->has('codigo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('codigo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row center">
                            <div class="col s12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Agregar Asignatura') }}
                                </button>
                            </div>
                        </div>
                    </form>

                    <table class="highlight centered">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                          </tr>
                        </thead>
                          
                @foreach ($asignaturas as $asignatura)  
                        <tbody>
                          <tr>
                            <td>{{ $asignatura->id }}</td>
                            <td>{{ $asignatura->codigo }}</td>
                            <td>{{ $asignatura->nombre }}</td></tr>
                        </tbody>          
                @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
