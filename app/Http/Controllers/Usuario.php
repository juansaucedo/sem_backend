<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Usuario extends Controller
{
    //
    public function ComprobarCredenciales(Request $request){
        $usuario = \App\Usuario::where("user", "=", $request->post('user'))->first();

        try{
            if($usuario != null){
                if($usuario->{'pass'} == $request->post('pass')){
                    $key = Hash::make(uniqid().$usuario->{'pass'});
                    $usuario->{'sesion'} = $key;
                    $usuario->save();
                    try{
                        return [
                            "status" => true,
                            "mensaje" => "Bienvenido ".$usuario->{'nombre'},
                            "variables" => [
                                "key" => $key
                            ]
                        ];
                    } catch (\Exception $ex){
                        return [
                            "status" => false,
                            "mensaje" => "Error en inicio de sesión"
                        ];
                    }
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
        } catch (\Exception $ex){
            return [
                "status" => false,
                "mensaje" => $ex->getMessage()
            ];
        }
    }

    public function ObtenerMenus(Request $request){
        $usuario = \App\Usuario::where("sesion", $request->post('user'))->first();
        if($usuario != null){
            return [
                "status" => true,
                "vars" => [
                    "modulos"=> $usuario->modulos()->get(),
                    "submodulos" => $usuario->submodulos()->where("angular_route", "!=", null)->get()
                ]
            ];
        } else{
            return [
                "status" => false
            ];
        }
    }
}
