@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col l12">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col s12 m12">
                        @if(Auth::user()->hasRol('doc'))
                        <form method="POST" action="/crearMensaje">
                            @csrf
                            <div class="row">
                                @foreach ($cons as $con)
                                    <input id="conversation_id" value="{{ $con->id }}"  type="text" hidden name="conversation_id" required>
                                @endforeach
                                <div class="form-group row">
                                    <div class="col s12">
                                        <input id="message" class="materialize-textarea" placeholder="{{ __('Ingrese su Mensaje') }}" type="text"  name="message" required>
                                    </div>
                                </div>
                                <div class="row center">
                                    <div class="col s12">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Enviar Mensaje') }}
                                        </button>
                                    </div>
                                </div> 
                            </div>
                        </form>
                        @foreach ($docentes as $docente)
                            @foreach ($alumnos as $alumno)
                                @foreach ($messages as $message)
                                @if($message->sender_id==$alumno->id)
                                    <div class="card deep-purple lighten-5">
                                        <span class="card-title left-align indigo-text darken-4-text">{{ $alumno->name }} {{ $alumno->apellido}}</span>
                                        <div class="card-content left-align ">
                                            <p>{{ $message->message }}</p>
                                        </div>
                                        <div class="card-action left-align">
                                            <p class="indigo-text darken-4-text">{{$message->created_at}}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($message->sender_id==$docente->id)
                                    <div class="card amber lighten-4">
                                        <span class="card-title right-align indigo-text darken-4-text">Yo</span>
                                        <div class="card-content right-align ">
                                            <p>{{ $message->message }}</p>
                                        </div>
                                        <div class="card-action right-align">
                                            <p class="indigo-text darken-4-text">{{$message->created_at}}</p>
                                        </div>
                                    </div>
                                @endif
                                @endforeach
                            @endforeach
                        @endforeach

                        @elseif(Auth::user()->hasRol('alm'))
                        <form method="POST" action="/mensajeDocente">
                            @csrf
                            <div class="row">
                                @foreach ($cons as $con)
                                    <input id="conversation_id" value="{{ $con->id }}"  type="text" hidden name="conversation_id" required>
                                @endforeach
                                <div class="form-group row">
                                    <div class="col s12">
                                        <input id="message" class="materialize-textarea" placeholder="{{ __('Ingrese su Mensaje') }}" type="text"  name="message" required>
                                    </div>
                                </div>
                                <div class="row center">
                                    <div class="col s12">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Enviar Mensaje') }}
                                        </button>
                                    </div>
                                </div> 
                            </div>
                        </form>
                        @foreach ($alumnos as $alumno)
                            @foreach ($docentes as $docente)
                                @foreach ($messages as $message)
                                @if($message->sender_id==$docente->id)
                                <div class="card deep-purple lighten-5">
                                        <span class="card-title left-align indigo-text darken-4-text">{{ $docente->name }} {{ $docente->apellido}}</span>
                                        <div class="card-content left-align ">
                                            <p>{{ $message->message }}</p>
                                        </div>
                                        <div class="card-action left-align">
                                            <p class="indigo-text darken-4-text">{{$message->created_at}}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($message->sender_id==$alumno->id)
                                <div class="card amber lighten-4">
                                        <span class="card-title right-align indigo-text darken-4-text">Yo</span>
                                        <div class="card-content right-align ">
                                            <p>{{ $message->message }}</p>
                                        </div>
                                        <div class="card-action right-align">
                                            <p class="indigo-text darken-4-text">{{$message->created_at}}</p>
                                        </div>
                                    </div>
                                @endif
                                @endforeach
                            @endforeach
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection