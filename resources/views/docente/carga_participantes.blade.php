@extends('layouts.app')

@section('content')
<div class="">
    <div class="col s12 row">
        <div class="card">
            <div class="card-title center">{{ __('Crgar Participantes') }}</div>

            <div class="card-content">
                @if($save==1)
                <div class="card-panel green darken-2">Actividad Agregada con exito!</div>
                @endif
                @if($save==2)
                    <div class="card-panel red darken-2">No se puede agregar una actividad ya existente!!</div>
                @endif

                <form method="POST" action="/crearParticipante" enctype="multipart/form-data">
                    @csrf
                    <div class="file-field input-field col s6">
                        <div class="btn">
                            <span>File</span>
                            <input type="file" id="excel" type="file" name="excel" value="{{ old('excel') }}" required autofocus>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" placeholder="{{ __('Cargar archivo') }}" type="text">
                        </div>
                    </div>
                    <div class="input-field col s6">
                        <select id="curso" name="curso" required>
                            <option value="" disabled selected>Seleccione Curso</option>
                            @foreach ($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->nombre}} - seccion:{{ $curso->seccion }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row center">
                        <div class="col s12">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Agregar Participantes') }}
                            </button>
                        </div>
                    </div>
                </form>

                
            </div>
        </div>
    </div>
</div>
@endsection