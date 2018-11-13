<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

    public function datos()
    {
        $id = Auth::id();
        $user=User::find($id);
        $alumno=new Alumno;
        $alumnos = DB::table('alumnos')->select('*')->get();
        return view('datos',[
            'user'=>$user,
            'alumnos'=>$alumnos,
        ]);
    }

    public function cambiar(UpdatePasswordRequest $request)
    {
        $save=3;
        $id = Auth::id();
        $user =User::find($id);
        
        $user->password =  Hash::make($request->input('password'));
        $user->save();
        $save=1;

        return view("/password",[
            'save'=>$save,
        ]);
        
    }

    public function cambiapassword()
    {
        $save=false;
        $id = Auth::id();
        $user =User::find($id);
        return view('password',[
            'user'=>$user,
            'save'=>$save,
        ]);
    }

}
