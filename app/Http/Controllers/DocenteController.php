<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Rol;
use App\Curso;
use App\Asignatura;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCursoRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateAsignaturaRequest;
use App\Http\Requests\CreateActividadRequest;


class DocenteController extends Controller
{
    //

    public function crearCurso()
    {
        $id = Auth::id();
        $save=false;
        $asignaturas = Asignatura::select('*')->where('docente_id',$id)->get();
        
        return view('/docente.crear_curso',[
            'asignaturas'=>$asignaturas,
            'save'=>$save,
        ]);
    }


    public function creaCurso(CreateCursoRequest $request)
    {
        $id = Auth::id();
        $curso= new Curso;
        $save=3;
        $asignaturas = Asignatura::select('*')->where('docente_id',$id)->get();
        $valida_cursos = Curso::select('*')->where('docente_id',$id)->get();
        foreach($valida_cursos as $valida_curso)
        {
            if($valida_curso->asignatura_id==$request->input('asignatura') && 
            $valida_curso->year==$request->input('year') && 
            $valida_curso->seccion==$request->input('seccion') &&
            $valida_curso->semestre==$request->input('semestre'))
            {
                $save=2;
                return view('/docente.crear_curso',[
                    'asignaturas'=>$asignaturas,
                    'save'=>$save,
                ]);
            }else{
                foreach ($asignaturas as $asignatura)
                {
                    if($asignatura->id==$request->input('asignatura'))
                    {
                        $curso->nombre=$asignatura->nombre;
                    }
                }
                
                $curso->seccion=$request->input('seccion');
                $curso->semestre=$request->input('semestre');
                $curso->year=$request->input('year');
                $curso->asignatura_id=$request->input('asignatura');
                $curso->docente_id= $id;
                $curso->save();
                $save=1;
            
                return view('/docente.crear_curso',[
                    'asignaturas'=>$asignaturas,
                    'save'=>$save,
                ]);
            }
        }
        
    }

    public function listaCurso()
    {
        $id = Auth::id();
        $cursos = Curso::select('*')->where('docente_id',$id)->get();
        return view('/docente.listado_curso',[
            'cursos'=>$cursos,
        ]);
    }

    public function cerrarCurso($id)
    {
        Curso::find($id)->delete();
        $id = Auth::id();
        $cursos = Curso::select('*')->where('docente_id',$id)->get();
        return view('/docente.listado_curso',[
            'cursos'=>$cursos,
        ]);
    }
    public function cursosCerrados()
    {
        $cursos = Curso::onlyTrashed()->get();
        return view('docente.cursos_cerrados',[
            'cursos'=>$cursos,
        ]);
    }

    public function asignaturas()
    {
        $id = Auth::id();
        $save=3;
        $asignaturas = Asignatura::select('*')->where('docente_id',$id)->get();
        return view('/docente.asignaturas',[
            'asignaturas'=>$asignaturas,
            'save'=>$save,
        ]);
    }

    public function agregarAsignatura(CreateAsignaturaRequest $request)
    {
        $save=3;
        $id = Auth::id();

        $comp_asigs=Asignatura::select('*')->where('docente_id',$id)->get();
        foreach($comp_asigs as $comp_asig)
        {
            if($comp_asig->nombre==$request->input('nombre') || $comp_asig->codigo==$request->input('codigo'))
            {
                $save=2;
                $asignaturas = Asignatura::select('*')->where('docente_id',$id)->get();
                return view('/docente.asignaturas',[
                    'asignaturas'=>$asignaturas,
                    'save'=>$save,
                ]);

            }else{
                $asignatura =new Asignatura;
                $asignatura->nombre=$request->input('nombre');
                $asignatura->codigo=$request->input('codigo');
                $asignatura->docente_id=$id;
                $asignatura->save();
                $save=1;

                $asignaturas = Asignatura::select('*')->where('docente_id',$id)->get();
                return view('/docente.asignaturas',[
                    'asignaturas'=>$asignaturas,
                    'save'=>$save,
                ]);
            }
        }
    }

    public function creaActividad(CreateActividadRequest $request)
    {
        
    }
}
