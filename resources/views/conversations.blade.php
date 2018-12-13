@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col l12">
        <div class="card">
            <div class="card-content">
                @if (session('status'))
                @endif

                @if(Auth::user()->hasRol('admin'))
                        <div>Acceso como administrador</div>
                    @elseif(Auth::user()->hasRol('doc'))
                        <div class="row center">
                            @foreach ($conversations as $conversation)
                                @foreach ($alumnos as $alumno)
                                    @if($alumno->id==$conversation->alumno_id)
                                        <a href="/mensajes/{{ $conversation->id }}" class=" col s12 m5 btn btn-block btn-large blue darken-1">{{ $alumno->name }} {{ $alumno->apellido }}</a>
                                        <div class="col s0 m2"></div>
                                    @endif         
                                @endforeach
                            @endforeach
                        </div>
                    @elseif(Auth::user()->hasRol('alm'))
                        <div class="row center">
                            @foreach ($conversations as $conversation)
                                @foreach ($docentes as $docente)
                                    @if($docente->id==$conversation->docente_id)
                                        <a href="/mensajes_a_docente/{{ $conversation->id }}" class="btn btn-block btn-large blue darken-1">{{ $docente->name }} {{ $docente->apellido }}</a>
                                        <br>
                                    @endif         
                                @endforeach
                            @endforeach
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection