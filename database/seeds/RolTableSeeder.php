<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Rol();
        $role->nombre = 'admin';
        $role->descripcion = 'Administrator';
        $role->save();
        $role = new Rol();
        $role->nombre = 'doc';
        $role->descripcion = 'Docente';
        $role->save();
        $role = new Rol();
        $role->nombre = 'alm';
        $role->descripcion = 'Alumno';
        $role->save();
    }
}
