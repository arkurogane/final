<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Rol;
use App\Alumno;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol_alm = Rol::where('nombre', 'alm')->first();
        $rol_doc = Rol::where('nombre', 'doc')->first();
        $rol_admin = Rol::where('nombre', 'admin')->first();

        $user = new User();
        $user->name = 'Juan';
        $user->apellido='Perez';
        $user->rut = '17256854-8';
        $user->rol=3;
        $user->email = 'alm@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->rols()->attach($rol_alm);

        $id = User::where('rut', '17256854-8')->first();
        
        $alumno = new Alumno();
        $alumno->matricula ='2015001994';
        $alumno->user_id =$id->id;
        $alumno->save();

        $user = new User();
        $user->name = 'Dinosaurio';
        $user->apellido='Anacleto';
        $user->rut = '12345678-9';
        $user->rol=2;
        $user->email = 'doc@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->rols()->attach($rol_doc);
        
        $user = new User();
        $user->name = 'juan carlos';
        $user->apellido='Bodoque';
        $user->rut = '13245687-2';
        $user->rol=1;
        $user->email = 'admin@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->rols()->attach($rol_admin);
    }
}
