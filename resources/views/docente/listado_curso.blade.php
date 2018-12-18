@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col s12">
            <div class="card">
                <div class="card-title center">Listado de cursos</div>

                <div class="card-content">
                    <table class="highlight responsive">
                            <thead>
                              <tr>
                                <th>asignatura</th>
                                <th>seccion</th>
                                <th>semestre</th>
                                <th>Detalles</th>
                              </tr>
                            </thead>
                    @foreach ($cursos as $curso)  
                            <tbody>
                              <tr>
                                <td>{{ $curso->nombre }}</td>
                                <td>{{ $curso->seccion }}</td>
                                <td>{{ $curso->semestre }}</td>                             
                                <td><a href="/cursoDetalle/{{ $curso->id }}"><i class="material-icons">create</i></a></td>                             </tr>
                            </tbody>          
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
