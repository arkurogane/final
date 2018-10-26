<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    public function index()
    {
        return view('home');
    }*/

    public function index(Request $request)
    {
        $request->user()->authorizeRols(['alm', 'doc', 'admin']);
        return view('home');
    }

    public function datos($id)
    {
            $user=User::find($id);
            $alumno=new Alumno;
            //$alumno=Alumno::where('user_id',$id)->get();
            $alumno->matricula = DB::table('alumnos')->select('matricula')->where('user_id',$id)->get();
            //$alumno = Alumno::where('user_id',$id)->get();
            //dd($alumno);
            return view('datos',[
                'user'=>$user,
                'alumno'=>$alumno,
            ]);
            
        
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    public function cambiar($id)
    {
        //if(validator($_POST['password'])==true){
            $user =User::find($id);
            $user->password =  Hash::make($_POST['password']);
            $user->save();
        //}
        return redirect("/datos/$user->id");
        
        
    }

    public function cambiapassword($id)
    {
        $user =User::find($id);
        return view('password',[
            'user'=>$user,
        ]);
    }

}
