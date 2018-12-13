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
                            <a href="{{ route('listaCurso') }}" class="col l4"><i class="large material-icons">business_center</i></a>
                            <a href="{{ route('Actividades') }}" class="col l4"><i class="large material-icons green-text">videogame_asset</i></a>
                            <a href="{{ route('asignaturas') }}" class="col l4"><i class="large material-icons purple-text">view_headline</i></a>
                        </div>
                    @else
                        <div>

                        </div>
                    @endif
                    
                <table class="col l8 push-l2 ">
                    <tr>
                        <th>Notificacion</th>
                    </tr>
                @foreach ($notificaciones as $notificacion)
                    <tr>
                        <td>{{ $notificacion->descripcion }}</td>
                        
                    </tr>
                @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
