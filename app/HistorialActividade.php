<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialActividade extends Model
{
    //
    protected $fillable = ['participante_id','actividad_curso_id'];
}
