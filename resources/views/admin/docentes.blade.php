@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col s12">
            <div class="card">
                <div class="card-title center">Listado Docente</div>

                <div class="card-content">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif 
                    <table class="highlight">
                            <thead>
                              <tr>
                                <th>Rut</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Correo</th>
                                <th>Actualizar</th>
                                <th>Eliminar</th>
                              </tr>
                            </thead>
                              
                    @foreach ($profs as $prof)  
                            <tbody>
                              <tr>
                                <td>{{ $prof->rut }}</td>
                                <td>{{ $prof->name }}</td>
                                <td>{{ $prof->apellido }}</td>
                                <td>{{ $prof->email }}</td>
                                <td><a href="actualizarDocente/{{ $prof->id }}">Actualizar</a></td>
                                <td><a onClick="javascript: return confirm('¿Estas seguro de eliminar este docente?');" href="eliminar/{{ $prof->id }}">Eliminar</a></td>
                             </tr>
                            </tbody>          
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection