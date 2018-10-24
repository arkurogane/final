<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminController extends Controller
{
    //


    public function read_Docente()
    {

        $usuarios=User::where('rut', '17256854-8')->first();
        return view('datos');
        
    }
}
