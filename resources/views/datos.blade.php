@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-title center">Datos</div>

                <div class="card-content">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="col s6 push-s3 centered">
                    @if(Auth::user()->hasRol('admin'))
                        
                            <tr>
                                <th>Nombre:</th>
                                <td>{{ $user->name }}</td>  
                            </tr>
                            <tr>
                                <th>Apellido:</th>
                                <td>{{ $user->apellido }}</td>
                            </tr>
                            <tr>
                                <th>RUT:</th>
                                <td>{{ $user->rut }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                        
                    @elseif(Auth::user()->hasRol('doc'))
                    <tr>
                            <th>Nombre:</th>
                            <td>{{ $user->name }}</td>  
                        </tr>
                        <tr>
                            <th>Apellido:</th>
                            <td>{{ $user->apellido }}</td>
                        </tr>
                        <tr>
                            <th>RUT:</th>
                            <td>{{ $user->rut }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @else
                    <tr>
                            <th>Nombre:</th>
                            <td>{{ $user->name }}</td>  
                        </tr>
                        <tr>
                            <th>Apellido:</th>
                            <td>{{ $user->apellido }}</td>
                        </tr>
                        <tr>
                            <th>RUT:</th>
                            <td>{{ $user->rut }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endif
                    </table>
                    <br><br><br><br><br><br><br><br><br><br><br><br>
                </div>
                
            </div>
            <a href="/cambiapassword">cambiar contraseña</a>
        </div>
    </div>
</div>
@endsection