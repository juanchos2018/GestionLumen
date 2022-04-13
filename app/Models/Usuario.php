<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Usuario extends Model
{
    //
    protected $primaryKey = 'id_usuario';

    public static function getAllUsuario(){

        $elementos = DB::table('usuarios')
        ->join('tipo_usuarios', 'usuarios.id_tipo', '=', 'tipo_usuarios.id_tipo')
        ->select('usuarios.nombre_usuario','usuarios.apellido_usuario','usuarios.correo_usuario','tipo_usuarios.nombre_tipo')
        ->get();  
        return $elementos;
     }

     public static function Login($correo_usuario,$password_usuario){

        $elementos = DB::table('usuarios')
        ->join('tipo_usuarios', 'usuarios.id_tipo', '=', 'tipo_usuarios.id_tipo')
        ->select('usuarios.id_usuario','usuarios.nombre_usuario','usuarios.apellido_usuario','usuarios.correo_usuario','tipo_usuarios.nombre_tipo','tipo_usuarios.id_tipo')
        ->where('usuarios.correo_usuario',$correo_usuario)
        ->where('usuarios.password_usuario',$password_usuario)
        ->first();  
        return $elementos;
     }
}
