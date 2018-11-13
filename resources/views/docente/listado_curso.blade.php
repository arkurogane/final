@extends('layouts.app')

@section('content')
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
                                <th>año</th>
                                <th>Cerrar Curso</th>
                              </tr>
                            </thead>
                              
                    @foreach ($cursos as $curso)  
                            <tbody>
                              <tr>
                                <td>{{ $curso->nombre }}</td>
                                <td>{{ $curso->seccion }}</td>
                                <td>{{ $curso->semestre }}</td>
                                <td>{{ $curso->year }}</td>                                
                                <td><a onClick="javascript: return confirm('¿Estas seguro de Cerrar este Curso?');" href="cerrarCurso/{{ $curso->id }}">Cerrar</a></td>
                             </tr>
                            </tbody>          
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
