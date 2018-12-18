<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Alumno;
use App\Rol;
use App\Curso;
use App\Actividade;
use App\ActividadCurso;
use App\HistorialActividade;
use App\Asignatura;
use App\Participante;
use App\Notification;
use App\Conversation;
use App\Message;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateCursoRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateAsignaturaRequest;
use App\Http\Requests\CreateActividadRequest;
use App\Http\Requests\AddParticipantesRequest;
use App\Http\Requests\CanjearRequest;
use App\Http\Requests\MessageRequest;

class AlumnoController extends Controller
{

    /**
     * funcion que permite ver la vista donde el alumno puede inscribirse a un curso
     */
    public function Participante()
    {
        $save=3;
        $id=Auth::id();
        $parts = Participante::select('*')->where('alumno_id',$id)->get();
        $cursos=Curso::select('*')->get();
        return view('/alumno.participar',[
            'save'=>$save,
            'parts'=>$parts,
            'cursos'=>$cursos,
        ]);
    }

    /**
     * funcion que permite al estudiante participar de un curso que exista
     */
    public function Participar(AddParticipantesRequest $request)
    {
        $save=3;
        $id=Auth::id();
        $curso=Curso::select('*')->where('codigo',$request->input('codigo'))->first();
        $parts = Participante::select('*')->where('alumno_id',$id)->get();
        foreach($parts as $part)
        {
            if($part->alumno_id==$id && $part->curso_id==$curso->id)
            {
                $save=2;
                break;
            }else{
                $save=1;
            }
        }
        $cursos=Curso::select('*')->get();
        if($save==2)
        {
            $save==2;
            $parts = Participante::select('*')->where('alumno_id',$id)->get();
            return view('/alumno.participar',[
                'save'=>$save,
                'parts'=>$parts,
                'cursos'=>$cursos,
            ]);

        }elseif($save==1){
            $participante = new Participante();
            $participante->curso_id = $curso->id;
            $participante->alumno_id = $id;
            $participante->cantidad_puntos=0;
            $participante->save();
            $save=1;
            $parts = Participante::select('*')->where('alumno_id',$id)->get();
            return view('/alumno.participar',[
                'save'=>$save,
                'parts'=>$parts,
                'cursos'=>$cursos,
            ]);
        }  
    }

    /**
     * funcion que muestra los cursos a los cuales pertenece el alumno
     */
    public function cursos()
    {
        $id = Auth::id();
        $participantes = Participante::select('*')->where('alumno_id',$id)->get();
            $cursos=Curso::select('*')->get();

        return view('/alumno.listado_cursos',[
            'cursos'=>$cursos,
            'participantes'=>$participantes,
        ]);
    }

    /**
     * funcion que devuelve los detalle de un curso en el que esta el alumno
     */
    public function curso_detalle($id)
    {
        $cursos=Curso::select('*')->where('id',$id)->get();
        return view('/alumno.curso_detalle',[
            'cursos'=>$cursos,
        ]);
    }

    /**
     * funcion que devuelve los premios de un curso en el que esta un alumno
     */
    public function premios($id)
    {
        $id_al=Auth::id();
        $cas = ActividadCurso::select('*')->where('curso_id',$id)->get();
        $cursos=Curso::select('*')->where('id',$id)->get();
        $participantes=Participante::select('*')->where('curso_id',$id)->where('alumno_id',$id_al)->get();
        $actividades=Actividade::select('*')->where('tipo',1)->get();
        return view('/alumno.premios',[
            'actividades'=>$actividades,
            'cas'=>$cas,
            'participantes'=>$participantes,
            'cursos'=>$cursos,
        ]);
    }
    /**
     * funcion que devuelve a la vista detalle del premio para que el alumno lo vea
     */

    public function actividad_detalle($id1,$id2)
    {
        $save=3;
        $cursos = Curso::select('*')->where('id',$id2)->get();
        $actividades=Actividade::select('*')->where('id',$id1)->get();
        return view('/alumno.canjear',[
            'actividades'=>$actividades,
            'cursos'=>$cursos,
            'save'=>$save,
        ]);
        
    }
    /**
     * funcion que canjea premio y llama a funcion de guardar notificacion
     */
    public function canjear(CanjearRequest $request)
    {
        $save=3;
        $id=Auth::id();
        $curso_id=$request->input('curso_id');
        $actividad_id=$request->input('actividad_id');
        $cursos = Curso::select('*')->where('id',$curso_id)->get();
        $participantes=Participante::select('*')->where('id',$curso_id)->where('alumno_id',$id)->get();
        $actividades = Actividade::select('*')->where('id',$actividad_id)->get();
        $acs=ActividadCurso::select('*')->where('curso_id',$curso_id)->where('actividad_id',$actividad_id)->get();
        foreach($participantes as $participante){
            $cantidad_puntos=$participante->cantidad_puntos;
            $id_participante=$participante->id;
        }
        foreach($actividades as $actividad){
            $valor=$actividad->valor;
        }
        foreach($acs as $ac){
            $id_ac=$ac->id;
        }
        if($cantidad_puntos>=$valor){
            $cantidad_puntos= $cantidad_puntos-$valor;
            Participante::where('id', $id_participante)
            ->update([
                'cantidad_puntos' => $cantidad_puntos,
            ]);
            $HA = new HistorialActividade;
            $HA->participante_id=$id_participante;
            $HA->actividad_curso_id=$id_ac;
            $HA->save();
            $id_ha=$HA->id;
            $this->notificacionsave($id_ac,$id_ha,$cantidad_puntos);
            $save=1;
        }else{
            $save=2;
        }
        return view('/alumno.canjear',[
            'actividades'=>$actividades,
            'cursos'=>$cursos,
            'save'=>$save,
        ]);
    }
    /**
     * funcion que guarda la notificacion en base de datos
     */

    private function notificacionsave($id_ac,$id_ha,$valor)
    {
        $ids=ActividadCurso::select('*')->where('id',$id_ac)->get();
        foreach ($ids as $id) {
            $idc=$id->curso_id;
            $actividades=Actividade::select('*')->where('id',$id->actividad_id)->get();
        }
        $idc;
        $cursos=Curso::select('*')->where('id',$idc)->get();
        foreach ($cursos as $curso) {
            $nombrecurso=$curso->nombre;
            $id_docente=$curso->docente_id;
        }
        foreach ($actividades as $actividad) {
            $nombre_actividad=$actividad->nombre;
        }
        $notificacion= new Notification;
        $alms=User::select('*')->where('id',Auth::id())->get();
        foreach ($alms as $alm) {
            $notificacion->descripcion="El Alumno ". $alm->name." ".$alm->apellido." del curso ".$nombrecurso." a canjeado el premio ".$nombre_actividad;
        }
        $notificacion->sender_id=Auth::id();
        $notificacion->receiver_id=$id_docente;
        $notificacion->hist_act_id=$id_ha;
        $notificacion->estado=0;
        $notificacion->save();
    }


    public function conversations()
    {
        $id = Auth::id();
        $conversations=Conversation::select('*')->where('alumno_id',$id)->get();
        $docentes=User::select('*')->where('rol',2)->get();

        return view('conversations',[
            'conversations'=>$conversations,
            'docentes'=>$docentes,
        ]);
        
    }

    public function messages($id)
    {
        $cons = Conversation::select('*')->where('id',$id)->get();
        $alumnos=User::select('*')->where('id',Auth::id())->get();
        foreach($cons as $con){
            $docentes=User::select('*')->where('id',$con->docente_id)->get();
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

    public function createConversation($curso_id)
    {
        $id=Auth::id();
        $cursos=Curso::select('*')->where('id',$curso_id)->get();
        foreach($cursos as $curso){
            $docentes=User::select('*')->where('id',$curso->docente_id)->get();
        }
        foreach($docentes as $docente){
         $cons = Conversation::select('*')->where('docente_id',$docente->id)->where('alumno_id',$id)->get();
        }
        $con2 = Conversation::select('*')->where('id',0)->get();

        if($cons == $con2){
            $conversation = new Conversation;
            foreach($docentes as $docente){
                $conversation->docente_id=$docente->id;
            }
            $conversation->alumno_id=$id;
            $conversation->save();
            $messages=Message::select('*')->where('conversation_id',$conversation->id)->orderByRaw('created_at DESC')->get();
        
        }else{
            foreach($cons as $con){
                $messages=Message::select('*')->where('conversation_id',$con->id)->orderByRaw('created_at DESC')->get();
            }
        }

        $alumnos=User::select('*')->where('id',$id)->get();
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
            $docentes=User::select('*')->where('id',$con->docente_id)->get();
        }
        $alumnos=User::select('*')->where('id',Auth::id())->get();
        $messages=Message::select('*')->where('conversation_id',$request->input('conversation_id'))->orderByRaw('created_at DESC')->get();
        $this->notificationMessage($alumnos,$docentes);
        return view('messages',[
            'cons'=>$cons,
            'docentes'=>$docentes,
            'messages'=>$messages,
            'alumnos'=>$alumnos,
        ]);
    }

    private function notificationMessage($alumnos,$docentes)
    {
        $notificacion= new Notification;
        foreach ($alumnos as $alumno) {
           $notificacion->descripcion="usted tiene un nuevo mensaje de ". $alumno->name ." ".$alumno->apellido; 
        }
        $notificacion->sender_id=Auth::id();
        foreach($docentes as $docente){
            $notificacion->receiver_id=$docente->id;
        }
        $notificacion->hist_act_id=0;
        $notificacion->estado=0;
        $notificacion->save();
    }
}
