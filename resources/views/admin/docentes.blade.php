@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Listado Docente</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif 
                    <table class="table table-dark">
                            <thead>
                              <tr>
                                <th scope="col">Rut</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Correo</th>
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