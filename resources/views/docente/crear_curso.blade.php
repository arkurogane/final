@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-title center">{{ __('Crear Curso') }}</div>

                <div class="card-content">
                    @if($save==1)
                    <div class="card-panel green darken-2">Curso Agregado con exito!</div>
                    @endif
                    @if($save==2)
                        <div class="card-panel red darken-2">No se puede agregar un curso ya existente!!</div>
                    @endif
                    <form method="POST" action="{{'/creaCurso' }}">
                        @csrf

                        <div class="input-field col s6">
                            <select id="asignatura" name="asignatura" required>
                                <option value="" disabled selected>Elija una opción</option>
                                @foreach ($asignaturas as $asignatura)  
                                    <option value={{ $asignatura->id }}>{{ $asignatura->nombre }}</option>          
                                @endforeach
                            </select>
                            <label>Seleccione Asignatura</label>
                          </div>

                        <div class="input-field col s6">
                            <input id="seccion" min="1" max="10" placeholder="{{ __('Sección') }}" type="number" class="{{ $errors->has('seccion') ? ' is-invalid' : '' }}" name="seccion" value="{{ old('seccion') }}" required>
                            @if ($errors->has('seccion'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('seccion') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="input-field col s6">
                            <input id="semestre" min='1' max="2" placeholder="{{ __('Semestre') }}" type="number" class="{{ $errors->has('semestre') ? ' is-invalid' : '' }}" name="semestre" value="{{ old('semestre') }}" required>

                            @if ($errors->has('semestre'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('semestre') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="input-field col s6">
                            <input id="year" placeholder="{{ __('Año') }}" type="number" class="{{ $errors->has('year') ? ' is-invalid' : '' }}" name="year" value="{{ old('year') }}" required>

                            @if ($errors->has('year'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('year') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="row center">
                            <div class="col s12">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Agregar Asignatura') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
