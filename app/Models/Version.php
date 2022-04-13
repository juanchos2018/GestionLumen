<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Version extends Model
{
    //

    public static function GetReponsableVersion($id_cronograma_elemento){

        $elementos = DB::table('versions')
        ->join('miembro_proyectos', 'versions.id_miembro_proyecto', '=', 'miembro_proyectos.id_miembro_proyecto')
        ->join('usuarios', 'miembro_proyectos.id_usuario', '=', 'usuarios.id_usuario')
        ->select('versions.id_version','versions.version', 'usuarios.nombre_usuario','versions.id_miembro_proyecto')
        ->where('versions.id_cronograma_elemento',$id_cronograma_elemento)
        ->get();
  
        return $elementos;
     }
  
}
