<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return view('welcome');
//    return json_encode(\App\Sys_Modulo::all());
    return \App\Usuario::find(6)->submodulos()->where("angular_route", "!=", null)->get();
});

Route::post('login', 'Usuario@ComprobarCredenciales');

Route::prefix("usuario")->group(function(){
   Route::post("modulos", "Usuario@ObtenerMenus");
});