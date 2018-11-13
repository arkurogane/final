<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Rol;
use App\Asignatura;
use App\Http\Requests\CreateAsignaturaRequest;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //


    public function read_Docente()
    {
        $profs =new User;
        $doc=DB::table('rols')->select('id')->where('nombre', 'doc')->first();
        $docentes=DB::table('rol_user')->select('user_id')->where('rol_id',2)->get();
   
        $profs = DB::table('users')->select()->where('rol',2)->get();

        //dd($profs);
        
        return view('admin.docentes',[
            'profs'=>$profs,
        ]);
        
    }

    public function eliminarDocente($id)
    {
        User::find($id)->delete();

        DB::table('rol_user')->where('user_id',$id)->delete();

        return redirect('/docentes');
    }

    public function actualizarDocente($id)
    {
        $user=new User;
            $user= User::find($id);
           // dd($user);
            return view('/admin.modificar',[
                'user'=>$user,
            ]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function actualizar(int $id)
    {

        $user =User::find($id);
        $user->name = $_POST["name"];
        $user->apellido=$_POST['apellido'];
        $user->email = $_POST['email'];
        $user->save();
        return redirect('/docentes');

        
    }

}

    
