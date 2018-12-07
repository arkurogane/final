@extends('layouts.app')

@section('content')
    <div class="col s12">
        <div class="">
            <div class="card">
            <div class="card-title center">Cursos</div>
            <div class="card-content">                           
                @foreach ($cursos as $curso)
                    @foreach ($participantes as $participante)
                        @if($participante->curso_id==$curso->id)
                            <a href="/curso_detalle/{{ $curso->id }}" class="btn btn-block btn-large blue darken-1">{{ $curso->nombre }}</a>
                            <br>
                        @endif         
                    @endforeach
                @endforeach
            </div>
            </div>
            </div>
        </div>
    </div>
@endsection