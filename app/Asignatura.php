<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    //
    protected $fillable = ['nombre','codigo','docente_id'];
}
