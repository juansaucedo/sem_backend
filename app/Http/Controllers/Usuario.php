<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Usuario extends Controller
{
    //
    public function ComprobarCredenciales(Request $request){
        $usuario = DB::table('usuario')
            ->select('nombre', 'pass', 'id')
            ->where('user', '=', $request->post('user'))
            ->get();
        if(count($usuario) > 0){
            if($usuario[0]->{'pass'} == $request->post('pass')){
                return [
                    "status" => true,
                    "mensaje" => "Bienvenido ".$usuario[0]->{'nombre'},
                    "variables" => [
                        "nombre" => $usuario[0]->{'nombre'},
                        "user" => $usuario[0]->{'id'},
                        "key" => sha1($usuario[0]->{'nombre'}.$usuario[0]->{'pass'})
                    ]
                ];
            } else{
                return [
                    "status" => false,
                    "mensaje" => "Contraseña incorrecta"
                ];
            }
        } else{
            return [
                "status" => false,
                "mensaje" => "Usuario no existe"
            ];
        }
    }
}
