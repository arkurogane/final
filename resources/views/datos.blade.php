@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Datos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::user()->hasRol('admin'))
                        <br><h4>Nombre:</h4><span>{{ Auth::user()->name }}</span><br>
                        <br><h4>Apellido:</h4><span>{{ Auth::user()->apellido }}</span><br>
                        <br><h4>RUT:</h4><span>{{ Auth::user()->rut }}</span><br>
                        <br><h4>Email:</h4><span>{{ Auth::user()->email }}</span><br>
                    @elseif(Auth::user()->hasRol('doc'))
                        <br><h4>Nombre:</h4><span>{{ Auth::user()->name }}</span><br>
                        <br><h4>Apellido:</h4><span>{{ Auth::user()->apellido }}</span><br>
                        <br><h4>RUT:</h4><span>{{ Auth::user()->rut }}</span><br>
                        <br><h4>Email:</h4><span>{{ Auth::user()->email }}</span><br>
                    @else
                        <br><h4>Nombre:</h4><span>{{ Auth::user()->name }}</span><br>
                        <br><h4>Apellido:</h4><span>{{ Auth::user()->apellido }}</span><br>
                        <br><h4>Matricula:</h4><span>{{Auth::user()->matricula}}</span>
                        <br><h4>RUT:</h4><span>{{ Auth::user()->rut }}</span><br>
                        <br><h4>Email:</h4><span>{{ Auth::user()->email }}</span><br>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection