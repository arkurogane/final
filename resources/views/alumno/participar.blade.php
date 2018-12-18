@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col s12 row">
        <div class="card">
            <div class="card-title center">{{ __('Participar en Curso') }}</div>

            <div class="card-content">
                @if($save==1)
                <div class="card-panel green darken-2">Participando con exito!</div>
                @endif
                @if($save==2)
                    <div class="card-panel red darken-2">No se puede agregar un curso en el que ya estas!!</div>
                @endif

                <form method="POST" action="/Participar">
                    @csrf

                    <div class="row">
                        <div class="push-l1 col s12 l10">
                        <input id="codigo" placeholder="{{ __('Codigo Curso') }}" type="text" class="{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" value="{{ old('codigo') }}" required autofocus>

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
                                {{ __('Agregar Participantes') }}
                            </button>
                        </div>
                    </div>
                </form>  
                <table class="highlight centered push-l2 col l8 s12">
                    <thead>
                        <tr>
                            <th>curso</th>
                            <th>puntos</th>
                        </tr>
                    </thead>
                    <tbody>                    
                        @foreach ($parts as $part)
                            @foreach ($cursos as $curso)
                                @if($part->curso_id==$curso->id)
                                <tr>
                                    <td>{{ $curso->nombre }}</td>
                                    <td>{{ $part->cantidad_puntos }}</td>
                                </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>    
                <br><br><br><br><br><br><br><br><br><br><br><br>
                <br><br><br><br><br><br><br><br><br><br><br><br>    
            </div>
        </div>
    </div>
</div>
@endsection