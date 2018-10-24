<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'apellido','rut', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rols()
    {
        return $this->belongsToMany('App\Rol')->withTimestamps();
    }

    public function authorizeRols($rols)
    {
        if ($this->hasAnyRol($rols)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }
    public function hasAnyRol($rols)
    {
        if (is_array($rols)) {
            foreach ($rols as $rol) {
                if ($this->hasRol($rol)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRol($rols)) {
                return true;
            }
        }
        return false;
    }
    public function hasRol($rol)
    {
        if ($this->rols()->where('nombre', $rol)->first()) {
            return true;
        }
        return false;
    }

}
