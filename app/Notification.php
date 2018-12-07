<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['descripcion','sender_id','receiver_id','hist_act_id','estado'];
}
