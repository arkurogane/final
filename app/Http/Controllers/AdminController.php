<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Rol;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //


    public function read_Docente()
    {
        $profs =new User;
        $profs = DB::table('users')->select()->where('rol','2')->get();
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

    
