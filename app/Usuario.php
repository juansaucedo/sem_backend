<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = "usuario";
    public $timestamps = false;

    public function modulos(){
        return $this->belongsToMany("App\Sys_Modulo", "sys_modulo_usuario", "usuario", "modulo");
    }

    public function submodulos(){
        return $this->belongsToMany("App\Sys_SubModulo", "sys_submodulo_usuario", "usuario", "submodulo");
    }
}
