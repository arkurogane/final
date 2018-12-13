@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col l12">
        <div class="card">
            <div class="card-content">
                
                <table class="col  ">
                    <tr>
                        <th>Notificacion</th>
                        <th>fecha</th>
                    </tr>
                @foreach ($notificaciones as $notificacion)
                    <tr>
                        <td>{{ $notificacion->descripcion }}</td>
                        <td>{{ $notificacion->created_at }}</td>
                    </tr>
                @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection