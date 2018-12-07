<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividade extends Model
{
    //
    protected $fillable = ['nombre','codigo','tipo','descripcion','valor','docente_id'];
}
