<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Alumno;
use App\Rol;
use App\Curso;
use App\Actividade;
use App\Asignatura;
use App\Participante;
use App\ActividadCurso;
use App\HistorialActividade;
use App\Notification;
use App\Conversation;
use App\Message;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCursoRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateAsignaturaRequest;
use App\Http\Requests\CreateActividadRequest;
use App\Http\Requests\AddParticipantesRequest;
use App\Http\Requests\ActividadCursoRequest;
use App\Http\Requests\DropActividadCursoRequest;
use App\Http\Requests\UpdateActividadRequest;
use App\Http\Requests\PuntosRequest;
use App\Http\Requests\MessageRequest;

class DocenteController extends Controller
{

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
                break;
            }else{
                $save=1;
            }
        }
        $valida_cursos = Curso::select('*')->get();
        foreach($valida_cursos as $valida_curso)
        {
            if($valida_curso->codigo==$request->input('codigo'))
            {
                $save=4;
                break;
            }else{
                $save=1;
            }
        }

        if($save==2)
        {
            $save=2;
            return view('/docente.crear_curso',[
                'asignaturas'=>$asignaturas,
                'save'=>$save,
            ]);
        }elseif($save==4){
            $save=4;
            return view('/docente.crear_curso',[
                'asignaturas'=>$asignaturas,
                'save'=>$save,
            ]);
        }elseif($save==1){
            foreach ($asignaturas as $asignatura)
            {
                if($asignatura->id==$request->input('asignatura'))
                {
                    $curso->nombre=$asignatura->nombre;
                }
            }
            
            $curso->seccion=$request->input('seccion');
            $curso->codigo=$request->input('codigo');
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

    public function listaCurso()
    {
        $id = Auth::id();
        $cursos = Curso::select('*')->where('docente_id',$id)->get();
        return view('/docente.listado_curso',[
            'cursos'=>$cursos,
        ]);
    }

    public function cursoDetalle($id)
    {
        $actividades = Actividade::select('*')->get();
        $cas = ActividadCurso::select('*')->where('curso_id',$id)->get();
        $cursos = Curso::select('*')->where('id',$id)->get();
        return view('/docente.curso_detalle',[
            'cursos'=>$cursos,
            'actividades'=>$actividades,
            'cas'=>$cas,
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
        $id = Auth::id();
        $cursos = Curso::onlyTrashed()->where('docente_id',$id)->get();
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
                break;
            }else{
                $save=1;
            }
            
        }
        if($save==2)
        {
            $save=2;
            $asignaturas = Asignatura::select('*')->where('docente_id',$id)->get();
            return view('/docente.asignaturas',[
                'asignaturas'=>$asignaturas,
                'save'=>$save,
            ]);
        }elseif($save==1){
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

    public function createActividad(CreateActividadRequest $request)
    {
        $save=3;
        $id = Auth::id();
        $actividades = Actividade::select('*')->where('docente_id',$id)->get();
        $nombre=$request->input('nombre');
        foreach($actividades as $actividade)
        {
            if($actividade->nombre==$nombre)
            {
                $save=2;
                break;
            }else{
                $save=1;
            }
        }
        
        if($save==2)
            {
            $save=2;
            return view('/docente.actividades',[
            'save'=>$save,
            'actividades'=>$actividades,
            ]);
        }elseif($save==1){
            $actividad = new Actividade;
            $actividad->nombre=$request->input('nombre');
            $actividad->tipo=$request->input('tipo');
            $actividad->valor=$request->input('valor');
            $actividad->descripcion=$request->input('descripcion');
            $actividad->docente_id=$id;
            $actividad->save();
            $save=1;
            $actividades = Actividade::select('*')->where('docente_id',$id)->get();
            return view('/docente.actividades',[
                'save'=>$save,
                'actividades'=>$actividades,
            ]);
        }
    }

    public function Actividades()
    {
        $save=3;
        $id = Auth::id();
        $actividades = Actividade::select('*')->where('docente_id',$id)->get();
        return view('/docente.actividades',[
            'save'=>$save,
            'actividades'=>$actividades,
        ]);
    }

    public function actividadDetalle($id)
    {
        $actividades = Actividade::select('*')->where('id',$id)->get();
        return view('/docente.detalle_actividad',[
            'actividades'=>$actividades,
        ]);
    }

    public function deleteActividad($id)
    {
        $actividades_cursos = ActividadCurso::select('*')->where('actividad_id',$id)->get();
        foreach($actividades_cursos as $actividad_curso){
            ActividadCurso::find($actividad_curso->id)->delete();
        }
        Actividade::find($id)->delete();
        return redirect("Actividades");
    }

    public function updateActividad($id)
    {
        $save=3;
        $actividades = Actividade::select('*')->where('id',$id)->get();
        return view('/docente.update_actividad',[
            'actividades'=>$actividades,
            'save'=>$save,
        ]);
    }

    public function ActividadUpdate(UpdateActividadRequest $request)
    {
        $id=$request->input('id');
        Actividade::where('id', $id)
          ->update([
              'nombre' => $request->input('nombre'),
              'valor' => $request->input('valor'),
              'descripcion' => $request->input('descripcion'),
          ]);
        return redirect("/actividadDetalle/$id");
    }

    public function addParticipantes()
    {
        $save=3;
        $id=Auth::id();
        $cursos = Curso::select('*')->where('docente_id',$id)->get();
        return view('/docente.carga_participantes',[
            'cursos'=>$cursos,
            'save'=>$save,
        ]);
    }

    public function crearParticipante(Request $request)
    {
        $save=3;
        $doc_id=Auth::id();
        $cursos = Curso::select('*')->where('docente_id',$doc_id)->get();

        \Excel::load($request->excel, function($reader) {
            $excel = $reader->get();
            $alums = User::select('*')->get();
            // iteracción
            $reader->each(function($row) {
                $alm_id = User::where('email', $row->email)->first();
                $participante = new Participante();
                $participante->curso_id = $request->input('curso');
                $participante->alumno_id = $alm_id->id;
                $participante->cantidad_puntos=0;
                $participante->save();
                $save=3;
            });
        });
        return view('/docente.carga_participantes',[
            'cursos'=>$cursos,
            'save'=>$save,
        ]);
    }

    public function addActividad($id)
    {
        $save=3;
        $actividades = Actividade::select('*')->get();
        return view('/docente.add_actividades',[
            'actividades'=>$actividades,
            'save'=>$save,
            'id'=>$id,
        ]);
    }

    public function actividadCurso(ActividadCursoRequest $request)
    {
        $cas = ActividadCurso::select('*')->where('curso_id',$request->input('id'))->get();
        $cos = ActividadCurso::select('*')->where('curso_id',0)->get();

        $save=3;
        $id=$request->input('id');
        $tareas=$request->input('tarea');
        $premios=$request->input('premio');
        if($cas!=$cos){
            foreach($tareas as $tarea){
                foreach($cas as $ca){
                    if($ca->actividad_id==$tarea && $ca->curso_id==$request->input('id')){
                        $save=2;
                        break;
                    }else{
                        $save=1;
                    }
                }
                if($save==1){
                    $tar = new ActividadCurso;
                    $tar->curso_id=$request->input('id');
                    $tar->actividad_id=$tarea ;
                    $tar->save();
                }
            }
            $save=3;
            foreach($premios as $premio){
                foreach($cas as $ca){
                    if($ca->actividad_id==$premio && $ca->curso_id==$request->input('id')){
                        $save=2;
                        break;
                    }else{
                        $save=1;
                    }
                }
                if($save==1){
                    $prem = new ActividadCurso;
                    $prem->curso_id=$request->input('id');
                    $prem->actividad_id=$premio ;
                    $prem->save();  
                }
            }
        }else{
            if(isset($tareas) && isset($premios)){
                foreach($tareas as $tarea){
                    $tar = new ActividadCurso;
                    $tar->curso_id=$request->input('id');
                    $tar->actividad_id=$tarea ;
                    $tar->save();
                }
                foreach($premios as $premio){
                    $prem = new ActividadCurso;
                    $prem->curso_id=$request->input('id');
                    $prem->actividad_id=$premio ;
                    $prem->save();
                }
            }elseif(!isset($tareas)){
                foreach($tareas as $tarea){
                    $tar = new ActividadCurso;
                    $tar->curso_id=$request->input('id');
                    $tar->actividad_id=$tarea ;
                    $tar->save();
                }
            }elseif(!isset($premios)){
                foreach($premios as $premio){
                    $prem = new ActividadCurso;
                    $prem->curso_id=$request->input('id');
                    $prem->actividad_id=$premio ;
                    $prem->save();
                }
            }
        }
        
        return redirect("/cursoDetalle/$id");
    }


    public function dropActividad($id)
    {
        $save=3;
        $actividades = Actividade::select('*')->get();
        $cas = ActividadCurso::select('*')->where('curso_id',$id)->get();
        
        return view('/docente.drop_actividades',[
            'id'=>$id,
            'save'=>$save,
            'actividades'=>$actividades,
            'cas'=>$cas,
        ]);
    }

    public function deleteActividadCurso(DropActividadCursoRequest $request)
    {  

        try{
            $id=$request->input('id');
            $tareas=$request->input('tarea');

            $premios=$request->input('premio');
            if($tareas==NULL){
                if($premios==NULL){
                    
                }else{
                    foreach($premios as $premio){
                        ActividadCurso::find($premio)->delete();
                    }
                }
            }elseif($premios==NULL){
                foreach($tareas as $tarea){
                    ActividadCurso::find($tarea)->delete();
                }
            }else{
                foreach($premios as $premio){
                    ActividadCurso::find($premio)->delete();
                }
                foreach($tareas as $tarea){
                    ActividadCurso::find($tarea)->delete();
                }
            }
            return redirect("/cursoDetalle/$id");
        }catch(Exception $e){
            return $e->getMessage();
        }     
    }

    public function alumnosCurso($id)
    {
        $actividades = Actividade::select('*')->get();
        $alumnos = User::select('*')->where('rol',3)->get();
        $cas = ActividadCurso::select('*')->where('curso_id',$id)->get();
        $participantes = Participante::select('*')->where('curso_id',$id)->get();
        $cursos = Curso::select('*')->where('id',$id)->get();
        return view('docente.alumnos_curso',[
            'participantes'=>$participantes,
            'alumnos'=>$alumnos,
            'cursos'=>$cursos,
            'actividades'=>$actividades,
            'cas'=>$cas,
        ]);
    }


    public function asignarPuntos($id)
    {
        $actividades = Actividade::select('*')->get();
        $alumnos = User::select('*')->where('rol',3)->get();
        $cas = ActividadCurso::select('*')->where('curso_id',$id)->get();
        $participantes = Participante::select('*')->where('curso_id',$id)->get();
        $cursos = Curso::select('*')->where('id',$id)->get();
        return view('docente.asignar_puntos',[
            'participantes'=>$participantes,
            'alumnos'=>$alumnos,
            'cursos'=>$cursos,
            'actividades'=>$actividades,
            'cas'=>$cas,
        ]);
    }

    public function puntos(PuntosRequest $request)
    {
        $id = Auth::id();
        $actividades = Actividade::select('*')->where('docente_id',$id)->get();
        $request->input('curso_id');
        $request->input('tipo');
        $tareas=$request->input('tarea');
        $participantes = $request->input('participante');
        $cas = ActividadCurso::select('*')->where('curso_id',$request->input('curso_id'))->get();

        if($request->input('tipo')==1){
            foreach($cas as $ca){
                foreach ($actividades as $actividad) {
                    foreach($tareas as $tarea){
                        foreach($participantes as $participante){
                            if( $ca->id==$tarea){
                                if( $actividad->tipo ==2 && $ca->actividad_id==$actividad->id){
                                    $parts=Participante::select('cantidad_puntos')->where('id',$participante)->get();
                                    foreach($parts as $part){
                                        $cantidad_puntos=$part->cantidad_puntos;
                                    }
                                    $cantidad_puntos= $cantidad_puntos+$actividad->valor;
                                    Participante::where('id', $participante)
                                    ->update([
                                        'cantidad_puntos' => $cantidad_puntos,
                                    ]);
                                    $HA = new HistorialActividade;
                                    $HA->participante_id=$participante;
                                    $HA->actividad_curso_id=$tarea;
                                    $HA->save();
                                    $ig=$HA->id;
                                    $this->notificacionsave($tarea,$ig,$participante,$actividad->valor,$request->input('tipo'));
                                }
                            }
                        }
                    }  
                } 
            }
        }elseif($request->input('tipo')==2){
            foreach($cas as $ca){
                foreach ($actividades as $actividad) {
                    foreach($tareas as $tarea){
                        foreach($participantes as $participante){
                            if( $ca->id==$tarea){
                                if( $actividad->tipo ==2 && $ca->actividad_id==$actividad->id){
                                    $parts=Participante::select('cantidad_puntos')->where('id',$participante)->get();
                                    foreach($parts as $part){
                                        $cantidad_puntos=$part->cantidad_puntos;
                                    }
                                    $cantidad_puntos= $cantidad_puntos-$actividad->valor;
                                    Participante::where('id', $participante)
                                    ->update([
                                        'cantidad_puntos' => $cantidad_puntos,
                                    ]);
                                    $HA = new HistorialActividade;
                                    $HA->participante_id=$participante;
                                    $HA->actividad_curso_id=$tarea;
                                    $HA->save();
                                    $ig=$HA->id;
                                    $this->notificacionsave($tarea,$ig,$participante,$actividad->valor,$request->input('tipo'));
                                }
                            }
                        }
                    }  
                } 
            }
        }
        $c_id=$request->input('curso_id');
        return redirect("/asignarPuntos/$c_id");
    }

    public function detallesAlumno($id,$id_c)
    {
        $cursos = Curso::select('*')->where('id',$id_c)->get();
        $alumnos = User::select('*')->where('id',$id)->get();
        $participantes = Participante::select('*')->where('curso_id',$id_c)->where('alumno_id',$id)->get();
        return view('docente.detalle_alumno',[
            'alumnos'=>$alumnos,
            'cursos'=>$cursos,
            'participantes'=>$participantes,
        ]);
    }

    public function quitarAlumno($id)
    {
        $cursos = Participante::select('*')->where('id',$id)->get();
        foreach($cursos as $curso){
            $idc=$curso->curso_id;
        }
        Participante::find($id)->delete();
        return redirect("/alumnosCurso/$idc");
    }

    private function notificacionsave($id_c,$id_h,$part,$valor,$tipo)
    {
        $alms=Participante::select('*')->where('id',$part)->get();
        $ids=ActividadCurso::select('*')->where('id',$id_c)->get();
        foreach ($ids as $id) {
            $idc=$id->curso_id;
        }
        $idc;
        $cursos=Curso::select('nombre')->where('id',$idc)->get();
        $id_us=Auth::id();
        foreach ($cursos as $curso) {
            $nombrecurso=$curso->nombre;
        }
        $notificacion= new Notification;
        if($tipo==1){
        $notificacion->descripcion="usted a ganado ". $valor." puntos en el curso ".$nombrecurso;
        }
        if($tipo==2){
        $notificacion->descripcion="usted a perdido ". $valor." puntos en el curso ".$nombrecurso;
        }

        $notificacion->sender_id=Auth::id();
        foreach($alms as $alm){
            $notificacion->receiver_id=$alm->alumno_id;
        }
        $notificacion->hist_act_id=$id_h;
        $notificacion->estado=0;
        $notificacion->save();
    }


    public function conversations()
    {
        $id = Auth::id();
        $conversations=Conversation::select('*')->where('docente_id',$id)->get();
        $alumnos=User::select('*')->where('rol',3)->get();

        return view('conversations',[
            'conversations'=>$conversations,
            'alumnos'=>$alumnos,
        ]);
        
    }

    public function messages($id)
    {
        $cons = Conversation::select('*')->where('id',$id)->get();
        $docentes=User::select('*')->where('id',Auth::id())->get();
        foreach($cons as $con){
            $alumnos=User::select('*')->where('id',$con->alumno_id)->get();
        }
        $messages=Message::select('*')->where('conversation_id',$id)->orderByRaw('created_at DESC')->get();
        //dd($messages);
        return view('messages',[
            'cons'=>$cons,
            'docentes'=>$docentes,
            'messages'=>$messages,
            'alumnos'=>$alumnos,
        ]);   
    }

    public function createConversation($alumno_id)
    {
        $id=Auth::id();
        $cons = Conversation::select('*')->where('docente_id',$id)->where('alumno_id',$alumno_id)->get();
        $con2 = Conversation::select('*')->where('id',0)->get();

        if($cons != $con2){
            foreach($cons as $con){
                $messages=Message::select('*')->where('conversation_id',$con->id)->orderByRaw('created_at DESC')->get();
            }
        }else{
            $conversation = new Conversation;
            $conversation->docente_id=$id;
            $conversation->alumno_id=$alumno_id;
            $conversation->save();
            $messages=Message::select('*')->where('conversation_id',$conversation->id)->orderByRaw('created_at DESC')->get();
        }

        $alumnos=User::select('*')->where('id',$alumno_id)->get();
        $docentes=User::select('*')->where('id',Auth::id())->get();
        return view('messages',[
            'cons'=>$cons,
            'docentes'=>$docentes,
            'messages'=>$messages,
            'alumnos'=>$alumnos,
        ]);
        
    }

    public function createMessage(MessageRequest $request)
    {
        $message= new Message;
        $message->message=$request->input('message');
        $message->conversation_id=$request->input('conversation_id');
        $message->sender_id=Auth::id();
        $message->save();

        $cons = Conversation::select('*')->where('id',$request->input('conversation_id'))->get();
        foreach($cons as $con){
            $alumnos=User::select('*')->where('id',$con->alumno_id)->get();
        }
        $docentes=User::select('*')->where('id',Auth::id())->get();
        $messages=Message::select('*')->where('conversation_id',$request->input('conversation_id'))->orderByRaw('created_at DESC')->get();
        $this->notificationMessage($alumnos);
        return view('messages',[
            'cons'=>$cons,
            'docentes'=>$docentes,
            'messages'=>$messages,
            'alumnos'=>$alumnos,
        ]);
    }

    private function notificationMessage($alumnos)
    {
        $docentes=User::select('*')->where('id',Auth::id())->get();
        $notificacion= new Notification;
        foreach ($docentes as $docente) {
           $notificacion->descripcion="usted tiene un nuevo mensaje de ". $docente->name ." ".$docente->apellido; 
        }
        $notificacion->sender_id=Auth::id();
        foreach($alumnos as $alumno){
            $notificacion->receiver_id=$alumno->id;
        }
        $notificacion->hist_act_id=0;
        $notificacion->estado=0;
        $notificacion->save();
    }

}
